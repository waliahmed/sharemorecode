<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotReviewSnippetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('review_snippet', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('review_id')->unsigned()->index();
			$table->integer('snippet_id')->unsigned()->index();
			$table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
			$table->foreign('snippet_id')->references('id')->on('snippets')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('review_snippet');
	}

}
