<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Models\Post([
            'title' => 'Learning Laravel',
            'content' => 'This course will get you right on track with learning laravel'
        ]);
        // in seeders, you have to specify the namespace you're going to use
        $post->save();
        // after creating a seeded post, we want to save them - like we do above
        
        $post = new \App\Models\Post([
            'title' => 'Something else',
            'content' => 'Some other new or used content'
        ]);
        $post->save();

        // See DatabaseSeeder on how to get this seeder run
    }
}
