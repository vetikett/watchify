<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMoviesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('imdbID')->unique();
			$table->string('title');
			$table->string('imdbRating');
			$table->string('actors');
			$table->string('awards');
			$table->string('country');
			$table->string('director');
			$table->string('genre');
			$table->string('language');
			$table->string('metascore');
			$table->text('plot');
			$table->string('poster');
			$table->string('rated');
			$table->string('released');
			$table->string('response');
			$table->string('runtime');
			$table->string('type');
			$table->string('writer');
			$table->string('year');
			$table->string('imdbVotes');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movies');
	}

}
