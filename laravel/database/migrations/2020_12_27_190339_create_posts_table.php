<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('content');
            




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
        Schema::dropIfExists('posts');
    }
}
