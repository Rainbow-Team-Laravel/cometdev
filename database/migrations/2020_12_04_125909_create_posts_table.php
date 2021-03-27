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

            //Category will be many to many relationship
            //Tag also will be many to many relationship

            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->unsignedInteger('user_id');  //One to many relationship
            $table->longText('content');
            $table->string('featured_image');
            $table->string('status')->default('Published');
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
        Schema::dropIfExists('posts');
    }
}
