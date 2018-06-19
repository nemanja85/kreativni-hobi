<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	 */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest')->except('logout');
	}

	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLoginForm(Category $category) {
		$parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) {
			$query->where('status', 1);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();

		return view('auth.login')->with(compact('parents'));
	}
}
