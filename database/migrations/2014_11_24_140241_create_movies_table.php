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
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('movie_id')->index();
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');

            $table->unique(['user_id', 'movie_id']);

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

        Schema::drop('movie_user');
        Schema::drop('movies');

	}

}
