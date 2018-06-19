<?php

namespace App\Http\Controllers;

use App\Model\Blog;
use App\Model\Category;
use App\Model\Product;

//use App\Model\SubCategory;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
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
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$parents = $this->parents;
		$blogs = $this->blogs($num = false);
		$action_sliders = [];
		$action_slider_imgs = [];
		$chosen_products = [];
		$new_products = [];
		/*	foreach ($parents as $category) {
		foreach ($category->subCategory as $subcat) {
		foreach ($subcat->products as $product) {
		if (1 == $product->action_slider) {
		$action_sliders[] = $product;
		}
		if (1 == $product->action_slider_img) {
		//$action_slider_imgs[0][] = ['category' => $category->slug, 'subcat' => $subcat->slug];
		$action_slider_imgs[] = $product;
		}
		if (1 == $product->chosen_product) {
		//$chosen_products[0][] = ['category' => $category->slug, 'subcat' => $subcat->slug];
		$chosen_products[] = $product;
		}
		if (1 == $product->new_product) {
		//$new_products[0][] = ['category' => $category->slug, 'subcat' => $subcat->slug];
		$new_products[] = $product;
		}
		}
		}
		}*/

		//$action_sliders = array_slice($action_sliders, -5, 5, true);

		//	$chosen_products = array_slice($chosen_products, -6, 6, true);

		//	$new_products = array_slice($new_products, -3, 3, true);
		//dd($action_sliders);

		return view('home')->with(compact('parents', 'blogs', 'new_products', 'chosen_products', 'action_slider_imgs', 'action_sliders', 'allInBaskets'));
	}

	public function blogs($num = false) {
		//\DB::enableQueryLog();
		$num = $num ? $num : 3;
		$blogs = Blog::where(['action_show' => 1, 'status' => 1])->take($num)->get();
		//dd(\DB::getQueryLog(), $all_products);
		return $blogs;
	}

	public function about() {
		$parents = $this->parents;
		return view('about-us')->with(compact('parents'));
	}

	public function profil() {
		$parents = $this->parents;
		return view('profil')->with(compact('parents'));
	}

	public function single_product($slug) {
		$parents = $this->parents;
		return view('item')->with(compact('parents'));
	}

	function new (Product $product, $num = false) {
		$parents = $this->parents;
		$num = $num ? $num : 4;
		$products = $product->where(['new_product' => 1, 'status' => 1])->take($num)->get();
		return view('novo')->with(compact('parents', 'products'));
	}

	public function contact() {
		$parents = $this->parents;
		return view('contact')->with(compact('parents'));
	}

	public function gift(Product $product) {
		$parents = $this->parents;
		$vau = $product->where('gift', 1)->get();

		return view('gift-card')->with(compact('parents', 'vau'));
	}

	/*public function terms() {
	return view('uslovi-koriscenja');
	}*/

	public function private_policy() {
		$parents = $this->parents;
		return view('politika-privatnosti')->with(compact('parents'));
	}

	public function delivery_terms() {
		$parents = $this->parents;
		return view('opsti-uslovi')->with(compact('parents'));
	}

	/*public function payment() {
return view('placanje');
}

public function delivery() {
return view('isporuka');
}

public function exchange() {
return view('zamena-proizvoda');
}*/
}
