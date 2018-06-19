<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required|max:50',
			'short_title' => 'required|max:17',
			'slag' => 'required|max:100',
			'description' => 'max:255',
			'img' => 'image|mimes:jpeg,jpg,bmp,png',
			'web' => ' active_url',
			'status' => 'required',
		];
	}

	/**
	 * Set custom messages for validator errors for number of persons to avoid displaying "num persons" in error
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'name.required' => 'Polje Ime je obavezno!',
			'name.max:50' => 'Polje Ime može sadržati maximum 50 karaktera!',
			'short_title.required' => 'Polje Kratak Naslov je obavezno!',
			'short_title.max:17' => 'Polje Kratak Naslov može sadržati maximum 17 karaktera!',
			'slag.required' => 'Polje Slag je obavezno!',
			'slag.max:100' => 'Polje Slag može sadržati maximum 100 karaktera!',
			'description.max:255' => 'Polje Opis može sadržati maximum 255 karaktera!',
			'img.image' => 'Polje Slika mora biti slika!',
			'img.image' => 'Slika mora biti fajl tipa: :values!',
			'web.active_url' => 'Url nije validan URL!',
			'status' => 'Polje Status je obavezno!',
		];
	}

	/**
	 * Get the proper failed validation response for the request.
	 *
	 * @param  array  $errors
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function response(array $errors) {
		if (($this->ajax() && !$this->pjax()) || $this->wantsJson()) {
			return response()->json(compact('errors'), 401);
		}
		return $this->redirector->to('categories.create')
			->withInput($this->except($this->dontFlash))
			->withErrors($errors, $this->errorBag);
	}
}
