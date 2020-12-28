<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('post_id');
            // We created the post_id field to store the id of the related liked post
            // We have to name this post_id to fit laravels assumptions

            // Something to keep in mind - likes for a post is a One-to-Many relationship - each post can have multiple likes, but each like is only for one post












            // Once we've finished all our migrations, we need to run them with the following command
            // php artisan migrate

            // To refresh our migrations once we've made changes to them, we need to run the following command
            // php artisan migrate:refresh

            // You can refresh your migrations and re-seed your database by running the following command
            // php artisan migrate:refresh --seed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
