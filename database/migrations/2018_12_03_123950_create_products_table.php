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
            $table->string('url');
            $table->string('slug');
//            $table->string('link');
            $table->string('asin');
            $table->string('image');
            $table->decimal('price',10,2);
            $table->decimal('discount_price',10,2);
            $table->decimal('rating',10,2)->nullable();
            $table->text('description');
            $table->integer('promocode_id');
//            $table->tinyInteger('popular');
//            $table->integer('views');
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
