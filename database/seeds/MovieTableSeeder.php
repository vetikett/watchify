<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Movie;

class MovieTableSeeder extends Seeder {
    public function run() {

        Movie::create([
            'id' => 'tt0120737',
            'title' => 'The Lord of the Rings: The Fellowship of the Ring',
            'rating' => '8.8',
            'director' => 'Peter Jackson',
            'genres' => 'Adventure, Action',
            'plot' => 'An ancient Ring thought lost for centuries has been found, and through a strange twist in fate has been given to a small Hobbit named Frodo. When Gandalf discovers the Ring is in fact the One Ring of the Dark Lord Sauron, Frodo must make an epic quest to the Cracks of Doom in order to destroy it! However he does not go alone. He is joined by Gandalf, Legolas the elf, Gimli the Dwarf, Aragorn, Boromir and his three Hobbit friends Merry, Pippin and Samwise. Through mountains, snow, darkness, forests, rivers and plains, facing evil and danger at every corner the Fellowship of the Ring must go. Their quest to destroy the One Ring is the only hope for the end of the Dark Lords reign!',
            'simplePlot' => 'A meek hobbit of the Shire and eight companions set out on a journey to Mount Doom to destroy the One Ring and the dark lord Sauron.',
            'urlPoster' => 'http://image.tmdb.org/t/p/w396/9HG6pINW1KoFTAKY3LdybkoOKAm.jpg',
            'releaseDate' => '20011219',
            'runtime' => '178 min',
            'year' => '2001',
            'votes' => '1,037,071'
        ]);

        for($i = 1; $i < 16; $i++ ) {
            $user = User::find($i);
            $user->movies()->attach('tt0120737');
        }
    }
}