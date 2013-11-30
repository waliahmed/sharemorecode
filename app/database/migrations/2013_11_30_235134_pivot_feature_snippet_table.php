<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotFeatureSnippetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feature_snippet', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('feature_id')->unsigned()->index();
			$table->integer('snippet_id')->unsigned()->index();
			$table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
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
		Schema::drop('feature_snippet');
	}

}
