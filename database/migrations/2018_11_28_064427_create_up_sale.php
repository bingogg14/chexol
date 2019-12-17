<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('products', function($table) {
            $table->string('title_upsale');
            $table->string('image_upsale')->nullable();
            $table->integer('price_upsale')->nullable();
            $table->integer('price_upsale_new')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('products', function($table) {
            $table->dropColumn('title_upsale');
            $table->dropColumn('image_upsale');
            $table->dropColumn('price_upsale');
            $table->dropColumn('price_upsale_new');
        });
    }
}
