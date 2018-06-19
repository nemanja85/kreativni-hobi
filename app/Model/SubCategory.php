<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model {
	protected $table = 'sub_categories';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'subcategory_name', 'slag', 'short_name', 'img', 'category_id', 'status',
	];

	public function getAll() {
		return $this->all();
	}

	public function products() {
		return $this->hasMany('App\Model\Product', 'sub_category_id', 'id', 'status', 1);
	}

	public function belongsToCat() {
		return $this->belongsTo('App\Model\Category', 'category_id', 'id');
	}
}
