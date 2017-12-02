<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class,15)->create();

        //Trying factory with relations
        factory(App\City::class, 10)->create()->each(function ($city) {
          $city->places()->save(factory(App\Place::class)->make());
         });

        factory(App\Place::class,30)->create();



    }
}
