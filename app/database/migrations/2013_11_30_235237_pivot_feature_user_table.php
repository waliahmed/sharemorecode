<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotFeatureUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feature_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('feature_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('feature_user');
	}

}
