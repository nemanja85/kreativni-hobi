<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model {
	use Sluggable;

	protected $table = 'blogs';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'img', 'description', 'short_description', 'title', 'slag', 'status', 'created_at', 'updated_at',
	];
	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable() {
		return [
			'slug' => [
				'source' => 'title',
			],
		];
	}

	public function blogs() {
		return $this->all();
	}
}
