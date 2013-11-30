<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotReviewUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('review_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('review_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
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
		Schema::drop('review_user');
	}

}
