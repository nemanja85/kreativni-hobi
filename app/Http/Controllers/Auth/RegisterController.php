<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	 */

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';
	public $ip;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request) {
		$this->middleware('guest');
		$this->ip = $request->ip();
	}

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm(Category $category) {
		$parents = $category->with(['subCategory', 'subCategory.products'])->where(['status' => 1])->get();
		return view('auth.register')->with(compact('parents'));
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'first_name' => 'required|string|min:2',
			'last_name' => 'required|string|min:2',
			'phone' => 'string',
			'address' => 'required|string',
			'city' => 'required|string',
			'zip' => 'required|numeric',
			'country' => 'required|string',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\User
	 */
	protected function create(array $data) {
		$ip = $this->ip;
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
		$city = isset($details->city) ? $details->city : $data['city'];
		$country = isset($details->country) ? $details->country : $data['country'];
		$loc = isset($details->loc) ? explode(',', $details->loc) : explode(',', array('44.835591', '20.410648'));

		return User::create([
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'phone' => $data['phone'],
			'address' => $data['address'],
			'city' => $city,
			'zip' => $data['zip'],
			'lat' => $loc[0],
			'lng' => $loc[1],
			'country' => $country,
		]);
	}
}
