<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotIssueUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('issue_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('issue_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
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
		Schema::drop('issue_user');
	}

}
