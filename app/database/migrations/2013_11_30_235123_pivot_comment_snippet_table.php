<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotCommentSnippetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment_snippet', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('comment_id')->unsigned()->index();
			$table->integer('snippet_id')->unsigned()->index();
			$table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
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
		Schema::drop('comment_snippet');
	}

}
