<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotSnippetTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('snippet_tag', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('snippet_id')->unsigned()->index();
			$table->integer('tag_id')->unsigned()->index();
			$table->foreign('snippet_id')->references('id')->on('snippets')->onDelete('cascade');
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('snippet_tag');
	}

}
