<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	use Sluggable;

	protected $table = 'products';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id', 'category_id', 'sub_category_id', 'name', 'slag',
		'code', 'short_description', 'description', 'old_price',
		'price', 'quantity', 'amount', 'img', 'note',
		'manufacturer_id', 'product_type_id',
		'product_order_id', 'status', 'created_at', 'updated_at',
	];

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable() {
		return [
			'slug' => [
				'source' => 'category_name',
			],
		];
	}

	public function products() {
		return $this->all();
	}

	public function belongsTosubCat() {
		return $this->belongsTo('App\Model\SubCategory', 'sub_category_id', 'id');
	}

	public function belongsTocategory() {
		return $this->belongsTo('App\Model\Category', 'category_id', 'id');
	}

	public function colors() {
		return $this->hasMany('App\Model\Color', 'product_id', 'id', 'status', 1);
	}
}
