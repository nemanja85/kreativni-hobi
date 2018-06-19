<?php

namespace App\Http\Controllers;

use App\Mail\OtkazanaPorudžbina;
use App\Mail\PotvrdjenaPorudžbina;
use App\Model\Basket;
use App\Model\Category;
use App\Model\Color;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {

	public $parents;

	public function __construct(Category $category) {
		$this->parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) {
			$query->where('status', 1);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();
	}

	public function basket(Request $request, Basket $basket, $basketToken = null) {

		$parents = $this->parents;
		$user = $request->user();
		//$getBasketToken = null;
		if ($user) {
			$getBasketToken = $basket->withTrashed()->where([
				'user_id' => $user->id,
			])->first();
		}
		$basketToken = isset($getBasketToken->token) && !empty($getBasketToken->token) ? $getBasketToken->token : $basketToken;
		$allInBaskets = $basket->with(['ItemInBasket', 'ItemInBasketColor'])->where(['token' => $basketToken, 'status' => 1])->get();
		return view('korpa')->with(compact('parents', 'allInBaskets'));
	}

	public function payment(Request $request, Product $product, Basket $basket, $basketToken = null) {

		$parents = $this->parents;
		$user = $request->user();
		$basketToken = $request->input('basketToken') ? $request->input('basketToken') : $basketToken;
		$clientId = config('aik.clientId'); //Merchant Id defined by bank to user

		$oid = sha1(time()) . mt_rand(10, 1000); //Order Id. Must be unique. If left blank, system will generate a unique one.

		$clientIp = $request->ip();
		$urlAik = config('aik.aikUrl'); //URL which client be redirected if authentication is successful
		$okUrl = config('aik.aikSuccess'); //URL which client be redirected if authentication is successful
		$failUrl = config('aik.aikFail'); //URL which client be redirected if authentication is not successful

		$rnd = $this->getToken(20); //A random number, such as date/time
		$currencyVal = config('aik.currencyVal'); //Currency code, 949 for TL, ISO_4217 standard
		$storekey = config('aik.storekey'); ///"123456";			//Store key value, defined by bank.
		$storetype = config('aik.storetype'); ///"3d_pay_hosting";	//3D authentication model
		$lang = config('app.locale'); //Language parameter, "tr" for Turkish (default), "en" for English
		$instalment = ""; //Instalment count, if there's no instalment should left blank
		$transactionType = config('aik.auth'); //"Auth";		//transaction type

		$vaucer = false;
		if ($request->has('direct')) {
			$amount = $request->input('amount');
			$id = $request->input('id');
			$item = $product->find($id);

			$name = $request->input('ship_to_name');
			$address = $request->input('ship_to_address');
			$city = $request->input('ship_to_city');
			$country = $request->input('ship_to_country');
			$zip = $request->input('ship_to_zip');

			$user = $request->user();
			$price = ($item->price * $amount);

			session('basketToken', $basketToken);
			session('oid', $oid);

			$details = json_decode(file_get_contents("http://ipinfo.io/{$request->ip()}"));

			if ($details) {
				$city = isset($details->city) ? $details->city : $request->input('city');
				$country = isset($details->country) ? $details->country : $request->input('country');
			} else {
				$city = $request->input('city');
				$country = $request->input('country');
			}
			$userBasket = $basket->updateOrCreate([
				'item_id' => $id,
				'token' => $basketToken,
			], [
				'user_id' => $user ? $user->id : null,
				'amount' => $amount,
				'price' => $price,
				'ip' => $request->ip(),
				'bill_to_name' => $name,
				'bill_to_street' => $address,
				'bill_to_city' => $city,
				'bill_to_postal_code' => $zip,
				'bill_to_country' => $country,
				'status' => 1,
				'response' => 'Pending',
			]);
		}

		$allInBaskets = $basket->with(['ItemInBasket', 'ItemInBasketColor'])->where(['token' => $basketToken, 'status' => 1])->get();

		$amount = 0;

		foreach ($allInBaskets as $allInBasket) {
			$amount += ($allInBasket->price * $allInBasket->amount); //Transaction amount
			if ('Vaučer' == $allInBasket->ItemInBasket[0]->name) {
				$vaucer = true;
			}
		}

		$hashstr = $clientId . $oid . $amount . $okUrl . $failUrl . $transactionType . $instalment . $rnd . $storekey;

		$hash = base64_encode(pack('H*', sha1($hashstr)));

		if ($request->has('direct')) {
			$request->session()->put($basketToken, $allInBaskets);
		}
		return view('placanje')->with(compact('vaucer', 'parents', 'clientId', 'amount', 'oid', 'clientIp', 'urlAik', 'okUrl', 'failUrl', 'rnd', 'currencyVal', 'storekey', 'storetype', 'lang', 'instalment', 'transactionType', 'hash'));
	}

	public function unpaid(Request $request, Basket $basket) {
		//return dd($request->all());
		$user = $request->user();
		$parents = $this->parents;

		$basketToken = $request->input('basketToken');
		$invoice = $request->input('invoice');
		$vaucer = false;

		if ($user) {
			$basket->where([
				'Invoice' => $request->input('invoice'),
				'user_id' => $user->id,
			])->update([
				'token' => $basketToken,
			]);
		}
		$allInBaskets = $basket->withTrashed()->with(['ItemInBasket', 'ItemInBasketColor'])->where(['invoice' => $invoice, 'status' => 1])->get();
		//dd($allInBaskets);
		$amount = 0;
		foreach ($allInBaskets as $allInBasket) {
			$amount += ($allInBasket->price * $allInBasket->amount); //Transaction amount
			if ('Vaučer' == $allInBasket->ItemInBasket[0]->name) {
				$vaucer = true;
			}
			$allInBasket->restore();
		}
		$pdv = $amount - ($amount / (1 + (20 / 100)));
		$pdv = number_format($pdv, 2, '.', ',');
		$amount = number_format($amount, 2, '.', ',');
		$active = true;
		//dd($amount);
		$clientId = config('aik.clientId'); //100300000";			//Merchant Id defined by bank to user
		$oid = sha1(time()) . mt_rand(10, 1000); //Order Id. Must be unique. If left blank, system will generate a unique one.

		$clientIp = $request->ip();
		$urlAik = config('aik.aikUrl'); //URL which client be redirected if authentication is successful
		$okUrl = config('aik.aikSuccess'); //URL which client be redirected if authentication is successful
		$failUrl = config('aik.aikFail'); //URL which client be redirected if authentication is not successful

		$rnd = $this->getToken(20); //A random number, such as date/time
		$currencyVal = config('aik.currencyVal'); //Currency code, 949 for TL, ISO_4217 standard
		$storekey = config('aik.storekey'); ///"123456";			//Store key value, defined by bank.
		$storetype = config('aik.storetype'); ///"3d_pay_hosting";	//3D authentication model
		$lang = config('app.locale'); //Language parameter, "tr" for Turkish (default), "en" for English
		$instalment = ""; //Instalment count, if there's no instalment should left blank
		$transactionType = config('aik.auth'); //"Auth";		//transaction type

		$hashstr = $clientId . $oid . $amount . $okUrl . $failUrl . $transactionType . $instalment . $rnd . $storekey;

		$hash = base64_encode(pack('H*', sha1($hashstr)));

		if ($invoice) {
			$request->session()->put($basketToken, $allInBaskets);
			$request->session()->put('invoice', $invoice);
		}
		//	return view('placanje')->with(compact('vaucer', 'parents', 'clientId', 'amount', 'oid', 'clientIp', 'urlAik', 'okUrl', 'failUrl', 'rnd', 'currencyVal', 'storekey', 'storetype', 'lang', 'instalment', 'transactionType', 'hash'));

		return view('placanje')->with(compact('parents', 'vaucer', 'allInBaskets', 'active', 'clientId', 'amount', 'pdv', 'oid', 'clientIp', 'urlAik', 'okUrl', 'failUrl', 'rnd', 'currencyVal', 'storekey', 'storetype', 'lang', 'instalment', 'transactionType', 'hash'));
	}

	public function getToken($length) {
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i = 0; $i < $length; $i++) {
			$token .= $codeAlphabet[random_int(0, $max - 1)];
		}

		return $token;
	}

	public function addToBasket(Request $request, Product $product, Basket $basket, Color $color) {

		$user = $request->user();
		$basketToken = $request->has('basketToken') ? $request->input('basketToken') : sha1(time());
		$amount = $request->input('amount');
		$id = $request->input('id');
		$color_id = $request->input('color');

		if ($color_id) {
			$colors = $color->where(['id' => $color_id, 'status' => 1])->first();
		} else {
			$colors = $color->where(['product_id' => $id, 'status' => 1])->first();
		}

		$item = $product->find($id);

		if (isset($colors) && !empty($colors)) {
			$price = ($colors->price * $amount);
		} else {
			$price = ($item->price * $amount);
		}

		$name = $request->input('BillToName');
		$address = $request->input('BillToStreet1');
		$city = $request->input('BillToCity');
		$country = $request->input('BillToCountry');
		$zip = $request->input('BillToPostalCode');

		session('basketToken', $basketToken);

		$details = json_decode(file_get_contents("http://ipinfo.io/{$request->ip()}"));

		if ($details) {
			$city = isset($details->city) ? $details->city : null;
			$country = isset($details->country) ? $details->country : null;
		}
		$userBasket = $basket->updateOrCreate([
			'item_id' => $id,
			'token' => $basketToken,
		], [
			'user_id' => $user ? $user->id : null,
			'color_id' => $colors ? $colors->id : null,
			'amount' => $amount,
			'price' => $price,
			'sumare' => ($price * $amount),
			'ip' => $request->ip(),
			'bill_to_name' => $name,
			'bill_to_street' => $address,
			'bill_to_city' => $city,
			'bill_to_postal_code' => $zip,
			'bill_to_country' => $country,
			'status' => 1,
			'response' => 'Pending',
		]);

		$allInBaskets = $basket->with(['ItemInBasket', 'ItemInBasketColor'])->where(['token' => $basketToken, 'status' => 1])->get();

		$count = $sumare = 0;

		foreach ($allInBaskets as $allInBasket) {
			$sumare += ($allInBasket->price * $allInBasket->amount);
			$count += $allInBasket->amount;
		}
		$request->session()->put($basketToken, $allInBaskets);

		$classCss = $userBasket ? 'success' : 'error';

		$trashedBaskets = $basket->onlyTrashed()->where(['token' => $basketToken])->get();

		return response()->json(compact('allInBaskets', 'trashedBaskets', 'userBasket', 'basketToken', 'classCss', 'count', 'sumare'));
	}

	public function deleteFromBasket(Request $request, Basket $basket) {

		$user = $request->user();
		$basketToken = $request->input('basketToken');
		$id = $request->has('id') ? $request->input('id') : null;

		$deleted = $basket->where(['item_id' => $id, 'token' => $basketToken])->delete();

		$classCss = $deleted ? 'success' : 'error';

		$allInBaskets = $basket->with(['ItemInBasket', 'ItemInBasketColor'])->where(['token' => $basketToken, 'status' => 1])->get();
		$trashedBaskets = $basket->onlyTrashed()->where(['token' => $basketToken])->get();
		if (!$deleted) {
			return response()->json(compact('allInBaskets', 'trashedBaskets', 'classCss'));
		}

		$count = $sumare = 0;
		if (!empty($allInBaskets) && isset($allInBaskets)) {
			foreach ($allInBaskets as $allInBasket) {
				$sumare += ($allInBasket->ItemInBasket[0]->price * $allInBasket->amount);
				$count += $allInBasket->amount;
			}
		} else {
			$allInBaskets = null;
		}
		$classCss = $allInBaskets ? 'success' : 'error';
		return response()->json(compact('allInBaskets', 'trashedBaskets', 'sumare', 'classCss', 'count'));
	}

	public function increment(Request $request, Basket $basket) {
		$user = $request->user();
		$basketToken = $request->input('basketToken');
		$id = $request->has('id') ? $request->input('id') : null;
		if (!$basketToken) {
			return;
		}
		$incr = $basket->where(['id' => $id, 'token' => $basketToken])->increment('amount', 1);

		$allInBaskets = $basket->with(['ItemInBasket', 'ItemInBasketColor'])->where(['token' => $basketToken, 'status' => 1])->get();
		$count = $sumare = 0;
		foreach ($allInBaskets as $allInBasket) {
			$sumare += ($allInBasket->price * $allInBasket->amount);
			$count += $allInBasket->amount;
			$basket->where([
				'id' => $allInBasket->id,
			])->update([
				'sumare' => ($allInBasket->price * $allInBasket->amount),
			]);
		}
		$classCss = $allInBaskets ? 'success' : 'error';
		return response()->json(compact('allInBaskets', 'sumare', 'classCss', 'count'));
	}

	public function decrement(Request $request, Basket $basket) {
		$user = $request->user();
		$basketToken = $request->input('basketToken');
		$id = $request->has('id') ? $request->input('id') : null;
		if (!$basketToken) {
			return;
		}
		$decr = $basket->where(['id' => $id, 'token' => $basketToken])->decrement('amount', 1);
		$allInBaskets = $basket->with(['ItemInBasket', 'ItemInBasketColor'])->where(['token' => $basketToken, 'status' => 1])->get();
		$count = $sumare = 0;
		foreach ($allInBaskets as $allInBasket) {
			$sumare += ($allInBasket->price * $allInBasket->amount);
			$count += $allInBasket->amount;
			$basket->where([
				'id' => $allInBasket->id,
			])->update([
				'sumare' => ($allInBasket->price * $allInBasket->amount),
			]);
		}
		$classCss = $allInBaskets ? 'success' : 'error';
		return response()->json(compact('allInBaskets', 'sumare', 'classCss', 'count'));
	}

	public function customSearch($keyword, $arrayToSearch) {
		$arr = [];
		foreach ($arrayToSearch as $key => $arrayItem) {
			if (strpos($key, $keyword) !== false) {
				$arr[] = [$key => $arrayItem];
			}
		}
		return $arr;
	}

	public function string2Cut($string = '', $first = 0, $last = 0) {
		return substr($string, $first, $last);
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null  $token
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function aikSuccess(Request $request, Basket $basket) {

		$parents = $this->parents;

		$test_array = $request->all();

		$purchased_products = $this->customSearch('Price_', $test_array);
		$qty = $this->customSearch('Qty_', $test_array);

		foreach ($qty as $values) {
			foreach ($values as $key => $value) {
				$quantitys[$this->string2Cut($key, 4, 10)] = $value;
			}
		}
		foreach ($purchased_products as $values) {
			foreach ($values as $key => $value) {
				$pur_prs[$this->string2Cut($key, 6, 10)] = $value;
			}
		}

		//	dd($quantitys, $pur_prs);
		$user = $request->user();
		$id = $user ? $user->id : null;
		$basketToken = $request->has('tokenizer') ? $request->input('tokenizer') : null;

		$allInBaskets = $request->session()->get($basketToken, 'null');
		$invoice = $request->session()->get('invoice') ? $request->session()->get('invoice') : false;

		if (null == $allInBaskets) {
			$allInBaskets = $basket->with(['ItemInBasket', 'ItemInBasketColor'])->where(['invoice' => $invoice, 'status' => 1])->get();
		}
		//dd($invoice);
		//	dd($basketToken);
		if ($invoice) {
			dd('proba');
			foreach ($quantitys as $k => $v) {
				$basket->where([
					'invoice' => $invoice,
					'item_id' => $k,
				])->update([
					'user_id' => $id,
					'token' => $basketToken,
					'return_oid' => $request->has('ReturnOid') ? $request->input('ReturnOid') : null,
					'ip' => $request->input('clientIp'),
					'status' => null,
					'amount' => $v,
					'notice' => $request->input('notice'),
					'bill_to_name' => $request->input('BillToName'),
					'bill_to_street' => $request->input('BillToStreet1'),
					'bill_to_city' => $request->input('BillToCity'),
					'bill_to_postal_code' => $request->input('BillToPostalCode'),
					'bill_to_country' => $request->input('BillToCountry'),
					'ship_to_name' => $request->input('ShipToName'),
					'ship_to_address' => $request->input('ShipToStreet1'),
					'ship_to_city' => $request->input('ShipToCity'),
					'ship_to_country' => $request->input('ShipToCountry'),
					'ship_to_zip' => $request->input('ShipToPostalCode'),
					'response' => $request->has('Response') ? $request->input('Response') : 'Cancelled',
				]);
			}
		} else {
			//dd($basketToken, $quantitys);
			foreach ($quantitys as $k => $v) {
				$basket->where([
					'token' => $basketToken,
					'item_id' => $k,
				])->update([
					'user_id' => $id,
					'amount' => $v,
					'token' => $basketToken,
					'invoice' => $request->has('TransId') ? $request->input('TransId') : null,
					'return_oid' => $request->has('ReturnOid') ? $request->input('ReturnOid') : null,
					'ip' => $request->input('clientIp'),
					'status' => null,
					'notice' => $request->input('notice'),
					'bill_to_name' => $request->input('BillToName'),
					'bill_to_street' => $request->input('BillToStreet1'),
					'bill_to_city' => $request->input('BillToCity'),
					'bill_to_postal_code' => $request->input('BillToPostalCode'),
					'bill_to_country' => $request->input('BillToCountry'),
					'ship_to_name' => $request->input('ShipToName'),
					'ship_to_address' => $request->input('ShipToStreet1'),
					'ship_to_city' => $request->input('ShipToCity'),
					'ship_to_country' => $request->input('ShipToCountry'),
					'ship_to_zip' => $request->input('ShipToPostalCode'),
					'response' => $request->has('Response') ? $request->input('Response') : 'Cancelled',
				]);
			}
			//dd($basketToken, $quantitys);
		}

		$storekey = config('aik.storekey');

		$hashparams = $request->input('HASHPARAMS');
		$hashparamsval = $request->input('HASHPARAMSVAL');
		$hashparam = $request->input('HASH');
		$paramsval = "";
		$index1 = 0;
		$index2 = 0;

		while ($index1 < strlen($hashparams)) {
			$index2 = strpos($hashparams, ":", $index1);
			$vl = $_POST[substr($hashparams, $index1, $index2 - $index1)];
			if (null == $vl) {
				$vl = "";
			}

			$paramsval = $paramsval . $vl;
			$index1 = $index2 + 1;
		}
		$hashval = $paramsval . $storekey;

		$hash = base64_encode(pack('H*', sha1($hashval)));
		//dd($hash);
		if (null != $hashparams) {
			if ($paramsval != $hashparamsval || $hashparam != $hash) {
				$msg[] = ['error' => "Security warning. Hash values mismatch. "];
			} else {
				if ("1" == $request->input('mdStatus') || "2" == $request->input('mdStatus') || "3" == $request->input('mdStatus') || "4" == $request->input('mdStatus')) {
					$msg[] = ['success' => "3D Authentication is successful. "];
				} else {
					$msg[] = ['error' => "3D authentication unsuccesful."];
				}
			}
		} else {
			$msg[] = ['error' => "Hash values error. Please check parameters posted to 3D secure page."];
		}
		foreach ($quantitys as $k => $v) {
			$basket_to_email[] = $basket->with(['ItemInBasket', 'ItemInBasketColor'])
				->where(['item_id' => $k, 'token' => $basketToken])
				->get();
		}
		$formatedResponse = [
			'Response' => $request->has('Response') ? $request->input('Response') : null,
			'Credit Card' => $request->has('maskedCreditCard') ? $request->input('maskedCreditCard') : null,
			'Amount' => $request->has('amount') ? $request->input('amount') : null,
			'invoice' => $request->has('TransId') ? $request->input('TransId') : null,
			'user' => Auth::check() ? $user : null,
			'basket' => $basket_to_email,
		];
		//dd($formatedResponse['basket'][0][0]);
		\Mail::to($user)->send(new PotvrdjenaPorudžbina($formatedResponse, $allInBaskets));

		$request->session()->put('invoice', null);
		if (Auth::check()) {
			$allInBaskets = $basket->with(['ItemInBasket'])->withTrashed()->where('user_id', $user->id)->where('response', '<>', 'Pending')->get();

			$trashedBaskets = $basket->onlyTrashed()->where(['user_id' => $user->id])->get();

			$approved = $allInBaskets->where('response', 'Approved');

			$pending = $allInBaskets->where('response', 'Pending');
			$sum = number_format($approved->sum->sumare, 2, '.', ',');
			$amount = $approved->sum->amount;
			$approved->all();
			$pending->all();

			return view('profil')->with(compact('parents', 'basketToken', 'pending', 'approved', 'allInBaskets', 'sum', 'amount', 'formatedResponse'));
		}
		return view('3DSuccessResult')->with(compact('parents', 'basketToken', 'allInBaskets', 'formatedResponse'));
	}

	public function sendOrder(Request $request, Basket $basket) {
		$test_array = $request->all();

		$purchased_products = $this->customSearch('Price_', $test_array);
		$qty = $this->customSearch('Qty_', $test_array);

		foreach ($qty as $values) {
			foreach ($values as $key => $value) {
				$quantitys[$this->string2Cut($key, 4, 10)] = $value;
			}
		}
		foreach ($purchased_products as $values) {
			foreach ($values as $key => $value) {
				$pur_prs[$this->string2Cut($key, 6, 10)] = $value;
			}
		}
		foreach ($quantitys as $k => $v) {
			$basket_to_email[] = $basket->with(['ItemInBasket', 'ItemInBasketColor'])
				->where(['item_id' => $k, 'token' => $request->input('tokenizer')])
				->get();
		}
		$formatedResponse = [
			'user' => Auth::check() ? $user : null,
			'basket' => $basket_to_email,
		];
		dd($formatedResponse);
		if (\Mail::to($user)->send(new PotvrdjenaPorudžbina($formatedResponse, $allInBaskets))) {
			$msg = 'Uspesno ste poslali Narudžbenicu';
			$classCss = 'success';
		} else {
			$msg = 'Nismo uspeli da prosledimo Narudžbenicu';
			$classCss = 'error';
		}
		return response()->json(compact('msg', 'classCss'));
	}

	public function aikFail(Request $request, Basket $basket) {
		$user = $request->user();
		$parents = $this->parents;
		$formatedResponse = $request->all();
		$basketToken = $request->has('tokenizer') ? $request->input('tokenizer') : null;
		$allInBaskets = $basket->with(['ItemInBasket'])->where(['token' => $basketToken, 'status' => 1])->get();

		foreach ($allInBaskets as $basket_item) {
			$userBasket = $basket->where([
				'token' => $basketToken,
				'id' => $basket_item->id,
			])->update([
				'user_id' => $user ? $user->id : null,
				'invoice' => $request->has('TransId') ? $request->input('TransId') : null,
				'ip' => $request->ip(),
				'status' => 1,
				'response' => $request->has('Response') ? $request->input('Response') : 'Cancelled',
			]);
		}
		if ("1" != $request->input('mdStatus') || "2" != $request->input('mdStatus') || "3" != $request->input('mdStatus') || "4" != $request->input('mdStatus')) {
			if ('The credit card number is not in a valid format.' == $formatedResponse['ErrMsg']) {
				$formatedResponse['ErrMsg'] = 'Kreditna kartica nije u odgovarajućem formatu!';
			} elseif ('BillTo Name field is required.' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Polje Ime i Prezime  je obavezno!';
			} elseif ('BillTo City field is required.' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Polje Grad je obavezno!';
			} elseif ('BillTo PostalCode field is required.' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Polje Poštanski broj je obavezno!';
			} elseif ('BillTo Country field is required.' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Polje Zemlja je obavezno!';
			} elseif ('BillTo Address field is required.' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Polje Adresa je obavezno!';
			} elseif ('Invalid Gate State' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Kreditna kartica nije u odgovarajućem formatu!';
			} elseif ('This order has been paid already' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Narudžbenica sa ovim brojem [ ' . $formatedResponse['TransId'] . ' ] je već plaćena!';
			} elseif ('Wrong security code' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Pogrešan zaštitni broj, IP adresa [ ' . $formatedResponse['clientIp'] . ' ]  je zabeležena!';
			} elseif ('UNDEFINED ERROR CODE.' == $formatedResponse['ErrMsg']) {

				$formatedResponse['ErrMsg'] = 'Došlo je do greške. Pokušaj te ponovo!';
			} elseif ('Transaction timed out. Please try again' == $formatedResponse['ErrMsg']) {
				$formatedResponse['ErrMsg'] = 'Vreme za izvršenje Transakcije je isteklo. Pokušaj te ponovo!';
			} elseif ('BillTo Zip Code field is required.' == $formatedResponse['ErrMsg']) {
				$formatedResponse['ErrMsg'] = 'Polje Poštanski broj je obavezno!';
			} elseif ('Amount parameter is missing or in invalid format' == $formatedResponse['ErrMsg']) {
				$formatedResponse['ErrMsg'] = 'Cena nedostaje ili je u nevažećem formatu!';
			} elseif ('Reenter, try again.' == $formatedResponse['ErrMsg']) {
				$formatedResponse['ErrMsg'] = 'Unesite ponovo podatke, pokušaj te ponovo!';
			}
		}
		\Mail::to($user)->send(new OtkazanaPorudžbina($formatedResponse, $allInBaskets));
		return view('3DFailResult')->with(compact('parents', 'formatedResponse'));
	}
}