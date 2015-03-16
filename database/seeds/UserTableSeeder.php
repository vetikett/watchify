<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Faker\Factory as Faker;
class UserTableSeeder extends Seeder {
    public function run() {
        $faker = Faker::create();
        for($i = 1; $i < 16; $i++ ) {
            User::create([
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => bcrypt('password')
            ]);
        }
    }
}