<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\SubCategory;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest\CategoryFormRequest;
use Illuminate\Http\Request;

class AdminController extends Controller {
	public $data = [];
	public $crud;
	public $request;
	public function __construct() {}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Category $category) {
		$categories = $category->all();
		// load the create form (app/views/nerds/create.blade.php)
		return view('admin.create')->with(compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CategoryFormRequest $request, Category $categories) {
		// fallback to global request instance
		if (is_null($request)) {
			$request = \Request::instance();
		}
		// replace empty values with NULL, so that it will work with MySQL strict mode on
		foreach ($request->input() as $key => $value) {
			if (empty($value) && '0' !== $value) {
				$request->request->set($key, null);
			}
		}
		$category = $categories->create($request->except(['_token']));
		if ($category) {
			// redirect
			Session::flash('message', 'Uspešno ste uneli proizvod!');
			return Redirect::to('admin.create');
		}
		Session::flash('message', 'Proizvod nije unet, pokušaj te ponovo!');
		return Redirect::to('admin.create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, Category $categories) {
		// get the nerd
		$product = $categories->find($request->input('id'));
		return response()->json(compact('product'));
		// show the view and pass the nerd to it
		//return view('admin.show')->with(compact('product'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getSubcat(Request $request, SubCategory $subCat) {
		// get the nerd
		$subCategory = $subCat->where(['category_id' => $request->input('id'), 'status' => 1])->get();
		return response()->json(compact('subCategory'));
		// show the view and pass the nerd to it
		//return view('admin.show')->with(compact('product'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CategoryFormRequest $request, Category $categories, $id) {
		// validate
		$product = $categories->find($id);
		$req = $request->except(['_token']);
		foreach ($req as $key => $value) {
			$product->$key = $value;
		}
		$product = save();
		// redirect
		if ($product) {
			Session::flash('message', 'Uspešno ste ažurilali proizvod!');
			return Redirect::to('admin.update');
		} else {
			Session::flash('message', 'Proizvod nije ažuriran, pokušaj te ponovo!');
			return Redirect::to('admin.update');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateStatus(Request $request, Product $product, SubCategory $subCat, Category $categories) {
		// validate
		if ($request->has('id') && $request->has('status') && $request->has('type')) {
			$id = $request->input('id');
			$status = $request->input('status');
			$type = $request->input('type');
			$updated = Carbon::now()->format('l jS \\of F Y h:i:s A');
			switch ($type) {
				case "Kategorija":
					$cat = $categories->where('id', $id)->update(['status' => $status]);
					$message = $cat ? 'Status Kategorije je uspešno ažuriran!' : 'Status Kategorije nije ažuriran, pokušaj te ponovo!';
					$className = $cat ? 'success' : 'errar';
					return response()->json(['message' => $message, 'updated' => $updated, 'className' => $className]);
					break;
				case "Pod-Kategorija":
					$sub = $subCat->where('id', $id)->update(['status' => $status]);
					$message = $sub ? 'Status Pod-Kategorije je uspešno ažuriran!' : 'Status Pod-Kategorije nije ažuriran, pokušaj te ponovo!';
					$className = $sub ? 'success' : 'errar';
					return response()->json(['message' => $message, 'updated' => $updated, 'className' => $className]);
					break;
				case "Proizvod":
					$pro = $product->where('id', $id)->update(['status' => $status]);
					$message = $pro ? 'Status Proizvoda je uspešno ažuriran!' : 'Status Proizvoda nije ažuriran, pokušaj te ponovo!';
					$className = $pro ? 'success' : 'errar';
					return response()->json(['message' => $message, 'updated' => $updated, 'className' => $className]);
					break;
				default:
					return response()->json(['message' => 'Status ' . $type . ' nije ažuriran, pokušaj te ponovo!', 'className' => 'error']);
			}
		} else {
			return response()->json(['message' => 'Zahtev za ažuriranje je neispravan, pokušaj te ponovo!', 'className' => 'error']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Category $categories, $id) {
		// delete
		$product = $categories->find($id);
		$product->delete();

		if ($product) {
			// redirect
			Session::flash('message', 'Uspešno ste obrisali proizvod!');
			return Redirect::to('nerds.show');
		} else {
			Session::flash('message', 'Proizvod nije obrisan, pokušaj te ponovo!');
			return Redirect::to('admin.show');
		}
	}
}