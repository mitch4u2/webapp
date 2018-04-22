<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigner();
            $table->string('title');
            $table->mediumText('body');
            $table->string('cover_image');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        // Schema::table('posts', function ($table) {
        //     $table->dropForeign(['user_id']);
        //     $table->dropcolumn('user_id');
        // });
        Schema::dropIfExists('posts');
    }
}
