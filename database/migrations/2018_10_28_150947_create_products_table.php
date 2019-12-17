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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('price');
            $table->integer('price_new')->nullable();

            $table->integer('lp_product_id');

            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->string('image_landing')->nullable();

            $table->string('slug')->nullable()->index();

            $table->boolean('active')->default(false);
            $table->boolean('landing_page')->default(false);

            $table->integer('sortable')->nullable();
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
