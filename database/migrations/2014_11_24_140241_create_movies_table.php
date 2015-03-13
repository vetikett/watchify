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
			$table->string('id')->unique();
			$table->string('title');
			$table->string('rating');
			$table->string('director');
			$table->string('genres');
			$table->text('plot');
            $table->text('simplePlot');
			$table->string('urlPoster');
			$table->string('releaseDate');
			$table->string('runtime');
            $table->string('votes');
			$table->string('year');
			$table->timestamps();
		});

        Schema::create('movie_user', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('movie_id')->unique();
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');

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

        Schema::drop('user_movie');
        Schema::drop('movies');

	}

}
