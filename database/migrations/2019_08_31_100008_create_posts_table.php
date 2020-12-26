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
            $table->unsignedInteger('category')->nullable();
            $table->foreign('category')->references('id')->on('post_categories');
            $table->unsignedInteger('tag')->nullable();
            $table->foreign('tag')->references('id')->on('tags')->onDelete('cascade');
            $table->string('title');
            $table->string('author');
            $table->string('description');
            $table->longText('content');
            $table->string('slug');
            $table->integer('status')->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
