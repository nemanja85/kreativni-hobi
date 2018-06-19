<?php

namespace App\Http\Controllers;

use App\Model\Basket;
use App\Model\Category;
use App\Model\Product;
use App\Model\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller {

	public function categories(Category $category, SubCategory $subCategory) {

		$parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) {
			$query->where('status', 1);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();

		$subCat = $subCategory->where(['category_id' => 1, 'status' => 1])->get();

		foreach ($parents as $category) {
			if (1 == $category->id) {
				$curentCat = $category->category_name;
			}
		}
		return view('proizvodi')->with(compact('parents', 'subCat'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  Illuminate\Http\Request $request
	 * @return Response
	 */
	public function allProducts(Request $request, Product $product, Category $category, SubCategory $subCategory) {

		$id = $request->input('id');

		$all_products = $product->where(['sub_category_id' => $id, 'status' => 1])->get();
		$cat = $category->where(['id' => $all_products[0]->category_id, 'status' => 1])->first();

		if (($request->ajax() && !$request->pjax()) || $request->wantsJson()) {
			return response()->json(compact('all_products', 'cat'));
		}
		dd('nije ajax');
		return view('proizvodi')->with(compact('all_products', 'cat'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  Illuminate\Http\Request $request
	 * @return Response
	 */
	public function getSubcat(Request $request, Category $category, SubCategory $subCategory) {

		$id = $request->input('id');

		$parents = $category->with(['subCategory' => function ($query) {
			$query->where(['status' => 1]);
		}, 'subCategory.products' => function ($query) {
			$query->where(['status' => 1]);
		}, 'products' => function ($query) use ($id) {
			$query->where(['status' => 1, 'category_id' => $id]);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where(['status' => 1])->get();

		$subCat = $subCategory->where(['category_id' => $id, 'status' => 1])->get();
		$items = $category->with(['products' => function ($query) use ($id) {
			$query->where(['category_id' => $id, 'status' => 1]);
		}])->where(['id' => $id, 'status' => 1])->get();

		if (($request->ajax() && !$request->pjax()) || $request->wantsJson()) {
			return response()->json(compact('subCat', 'parents', 'items'));
		}

		return view('proizvodi')->with(compact('subCat', 'parents'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getSubcatHtml(Category $category, SubCategory $subCategory, $category_id, $category_name, $subcategory_id, $subcategory_name) {

		$parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) {
			$query->where('status', 1);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();

		$subCat = $subCategory->where(['id' => $subcategory_id, 'status' => 1])->get();

		return view('proizvodi')->with(compact('subCat', 'category_name', 'subcategory_name', 'parents'));
	}

	public function getSubCategories(Category $category, SubCategory $subCategory, $category_id, $category_name) {

		$parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) {
			$query->where('status', 1);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();

		$items = $category->with(['products' => function ($query) use ($category_id) {
			$query->where(['category_id' => $category_id, 'status' => 1]);
		}])->where(['id' => $category_id, 'status' => 1])->get();

		$subCat = $subCategory->where(['category_id' => $category_id, 'status' => 1])->get();
		return view('proizvodi')->with(compact('subCat', 'category_name', 'parents', 'items'));
	}

	public function bySlug(Category $category, SubCategory $subCategory, $category_name) {
		//dd($category_id, $category_name);
		$parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) {
			$query->where('status', 1);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();

		$subCat = $subCategory->where(['category_id' => $category_id, 'status' => 1])->get();

		return view('proizvodi')->with(compact('subCat', 'category_name', 'parents'));
	}

	public function action(Request $request, Basket $basket, Product $product, $num = false) {

		$num = $num ? $num : 6;
		$action_products = $product->where(['action' => 1, 'status' => 1])->take($num)->get();
		$user = $request->user();

		$basketToken = $request->input('basketToken');

		$allInBaskets = $basket->with(['ItemInBasket', 'ItemInBasketColor'])->where(['token' => $basketToken, 'status' => 1])->get();

		$count = $sumare = 0;

		foreach ($allInBaskets as $allInBasket) {
			$sumare += ($allInBasket->price * $allInBasket->amount);
			$count += $allInBasket->amount;
		}
		return response()->json(compact('action_products', 'allInBaskets', 'sumare', 'basketToken', 'count'));
	}

	public function singleProduct(Category $category, Product $product, $category_id, $category_name, $subcategory_id, $sub_slug, $item_id, $item_slug) {

		$item = $product->where(['id' => $item_id, 'status' => 1], ['slug' => $item_slug])->first();

		$item_parents = $item->with(['belongsTocategory', 'belongsTosubCat'])->where(['sub_category_id' => $subcategory_id, 'status' => 1])->first();

		$similars = $this->similar($category, $category_id, $item_id);
		$parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) {
			$query->where('status', 1);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();

		return view('item')->with(compact('item', 'item_parents', 'parents', 'similars'));
	}

	public function singleNoSubProduct(Category $category, Product $product, $category_id, $item_id, $item_slug) {

		$item = $product->where(['id' => $item_id, 'status' => 1], ['slug' => $item_slug])->first();

		$item_parents = $item->with(['belongsTocategory'])->where(['category_id' => $category_id, 'status' => 1])->first();

		$similars = $this->similar($category, $category_id, $item_id);

		$parents = $category->with(['subCategory' => function ($query) {
			$query->where('status', 1);
		}, 'subCategory.products' => function ($query) {
			$query->where('status', 1);
		}, 'products' => function ($query) use ($category_id) {
			$query->where(['status' => 1, 'category_id' => $category_id]);
		}, 'products.colors' => function ($query) {
			$query->where('status', 1);
		}])->where('status', 1)->get();

		return view('item')->with(compact('item', 'item_parents', 'parents', 'similars'));
	}

	public function similar($category, $category_id, $item_id, $num = false) {
		$num = $num ? $num : 4;
		$similar_products = $category->with(['products' => function ($query) use ($item_id, $category_id, $num) {
			$query->where('id', '<>', $item_id)->where('status', '=', '1')->take($num)->inRandomOrder();
		}])->where(['id' => $category_id, 'status' => 1])->get();

		return $similar_products;
	}
}
