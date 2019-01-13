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
            $table->increments('id')->unique();
            $table->string('title')->unique();
            $table->string('type', 20);
            $table->string('description', 100);
            $table->string('content', 1500);
			$table->integer('creatorID')->unsigned();
			$table->string('fileDir');
			$table->string('circledDir');
			$table->string('pixelatedDir');
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
        Schema::drop('posts');
    }
}
