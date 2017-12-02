<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//I only needed one user, I used Factories with cities and places, please take a look at the cities seeder
        $user = new User();
        $user->name = "Basmah";
        $user->email = "basmah.alsaid@gmail.com";
        $user->password = '$2y$10$yjPgE4Fnsyrw9KbPHID5DOyO9DmYZjbC2yqNaAPOdgp0y9Kx.QAle';

        $user->save();
    }
}
