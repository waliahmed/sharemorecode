<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('SnippetsTableSeeder');
		$this->call('CommentsTableSeeder');
		$this->call('RevisionsTableSeeder');
		$this->call('FeaturesTableSeeder');
		$this->call('IssuesTableSeeder');
		$this->call('ReviewsTableSeeder');
		$this->call('UsersTableSeeder');
	}

}