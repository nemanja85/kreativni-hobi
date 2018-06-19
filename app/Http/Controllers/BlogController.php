<?php

namespace App\Http\Controllers;

use App\Model\Blog;
use App\Model\Category;
use Illuminate\Http\Request;

class BlogController extends Controller {
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
		}])->where('status', 1)->get();
		// $this->middleware('auth');
	}

	public function blogs(Blog $blog, $num = false) {
		//\DB::enableQueryLog();
		$num = $num ? $num : 3;
		$blogs = $blog->where(['action_show' => 1, 'status' => 1])->take($num)->get();
		//dd(\DB::getQueryLog(), $all_products);
		return response()->json(compact('all_products'));

	}

	public function inspiration(Blog $blog) {
		$parents = $this->parents;
		$main_blog = $blog->where('status', 1)->inRandomOrder()->first();
		$blogs = $blog->where('status', 1)->get();
		return view('inspiration')->with(compact('parents', 'main_blog', 'blogs'));
	}

	public function get_inspiration(Request $request, Blog $blog) {
		$get_blog = $blog->where('status', 1)->find($request->input('id'));
		return response()->json(compact('get_blog'));
	}
}
