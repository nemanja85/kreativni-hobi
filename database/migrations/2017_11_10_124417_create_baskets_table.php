<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('baskets', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('item_id');
			$table->integer('user_id');
			$table->integer('amount');
			$table->string('token', 100);
			$table->ipAddress('ip');
			$table->string('city', 50);
			$table->string('country', 50);
			$table->boolean('status');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('baskets');
	}
}
