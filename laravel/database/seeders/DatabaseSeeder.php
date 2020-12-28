<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PostTableSeeder::class);
        $this->call(TagTableSeeder::class);
        // We have to set up our DataBase seeder to call both of the other seeders we set up so that we can run our seeders
        // To run our seeders, we use the following command 
        // php artisan db:seed

        // If we want to run our migrations and seeds at the same time, we use the following command
        // php artisan migrate --seed
    }
}
