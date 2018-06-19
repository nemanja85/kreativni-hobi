<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model {
	protected $table = 'colors';
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at', 'created_at', 'updated_at'];
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id', 'price', 'code', 'name', 'img', 'status',
	];

	public function getAll() {
		return $this->all();
	}

	public function belongsToProduct() {
		return $this->belongsTo('App\Model\Product', 'product_id', 'id');
	}
}
