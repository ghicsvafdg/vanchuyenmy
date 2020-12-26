<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unique();

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');

            $table->string('tag')->nullable();

            $table->longText('name');
            $table->mediumText('filename');
            $table->longText('description');
            $table->longText('content');
            $table->integer('quantity');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->decimal('price');
            $table->decimal('promotion')->nullable();
            $table->string('slug');

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
        Schema::dropIfExists('products');
    }
}
