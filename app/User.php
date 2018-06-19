<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'avatar', 'first_name', 'lat', 'lng', 'last_name', 'phone', 'address', 'city', 'country', 'zip', 'remember_token',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	/**
	 * A user can have many roles.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles() {
		return $this->belongsToMany('App\Role')->withTimestamps();
	}

	public function hasRole($name) {
		foreach ($this->roles as $role) {
			if ($role->name == $name) {
				return true;
			}
		}
		return false;
	}

	public function assignRole($role) {
		return $this->roles()->attach($role);
	}

	public function removeRole($role) {
		return $this->roles()->detach($role);
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail() {
		return $this->email;
	}

	public function InBasketActive() {
		$this->hasMany('App\Model\Basket', 'user_id', 'id', 'status', 1);
	}

	public function InBasketInActive() {
		$this->hasMany('App\Model\Basket', 'user_id', 'id', 'status', 0);
	}
}
