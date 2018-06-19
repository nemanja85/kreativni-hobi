<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basket extends Model {
	use SoftDeletes;

	protected $table = 'baskets';
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
		'id', 'item_id',
		'user_id',
		'amount',
		'notice',
		'price',
		'color_id',
		'token', 'ip',
		'sumare',
		'bill_to_name',
		'bill_to_street',
		'bill_to_city',
		'bill_to_postal_code',
		'bill_to_country',
		'ship_to_address',
		'ship_to_city',
		'ship_to_country',
		'ship_to_name',
		'ship_to_zip',
		'Invoice',
		'return_oid',
		'status',
		'response',
		'deleted_at',
	];

	public function baskets() {
		return $this->all();
	}

	public function belongsToUser() {
		return $this->belongsTo('App\User', 'id', 'id');
	}

	public function ItemInBasket() {
		return $this->hasMany('App\Model\Product', 'id', 'item_id');
	}

	public function ItemInBasketColor() {
		return $this->hasMany('App\Model\Color', 'id', 'color_id');
	}

}
