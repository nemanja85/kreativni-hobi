<?php

namespace App\Http\Controllers;
use App\Model\Basket;
use App\Model\Category;
use Illuminate\Http\Request;

class UserProfil extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//	$this->middleware('guest')->except('logout');
		$this->middleware('auth');
	}

	public function profil(Request $request, $token = null, Basket $basket, Category $category) {
		//\DB::enableQueryLog();

		$parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) {
			$query->where('status', 1);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();

		$basketToken = $request->has('basketToken') ? $request->input('basketToken') : null;
		$sessionBaskets = $request->session()->get($basketToken, 'default');

		$user = $request->user();
		$email = $user->email;

		$allInBaskets = $basket->with(['ItemInBasket'])->withTrashed()->where('user_id', $user->id)->where('response', '<>', 'Pending')->get();

		$trashedBaskets = $basket->onlyTrashed()->where(['user_id' => $user->id])->get();

		$approved = $allInBaskets->where('response', 'Approved');
		$pending = $allInBaskets->where('response', 'Pending');
		$sum = number_format($approved->sum->price, 2, '.', ',');
		$amount = $approved->sum->amount;

		$approved->all();
		$pending->all();
		return view('profil')->with(compact('parents', 'pending', 'approved', 'allInBaskets', 'sum', 'amount'));
	}
}
