<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	use Sluggable;

	protected $table = 'categories';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category_name', 'slug', 'description', 'img', 'short_title', 'status',
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

	public function getAll() {
		return $this->all();
	}

	public function products() {
		return $this->hasMany('App\Model\Product', 'category_id', 'id', 'status', 1);
	}

	public function subCategory() {
		return $this->hasMany('App\Model\SubCategory', 'category_id', 'id', 'status', 1);
	}
}
