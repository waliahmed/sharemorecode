<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotSnippetUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('snippet_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('snippet_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('snippet_id')->references('id')->on('snippets')->onDelete('cascade');
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
		Schema::drop('snippet_user');
	}

}
