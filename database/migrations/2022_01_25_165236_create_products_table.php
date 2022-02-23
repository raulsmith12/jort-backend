<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('seller_id')->foreign()->references('seller_id')->on('users');
            $table->string('short_desc', 500);
            $table->text('long_desc');
            $table->string('category');
            $table->string('title');
            $table->time('creation_time');
            $table->integer('normal_timer');
            $table->integer('quick_timer');
            $table->decimal('current_bid', 5,2);
            $table->decimal('increment', 5,2);
            $table->boolean('is_going_once');
            $table->boolean('is_going_twice');
            $table->integer('sold_timer');
            $table->boolean('is_sold');
            $table->integer('del_timer');
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
        Schema::dropIfExists('products');
    }
}
