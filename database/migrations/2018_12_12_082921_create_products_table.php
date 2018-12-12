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
        if(!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->integer('quantity')->default(0);
                $table->double('price', 8, 2)->nullable();
                $table->text('content')->nullable();
                $table->string('product_sku')->nullable();

                $table->integer('created_by')->unsigned()->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products', function(Blueprint $table) {
            $table->dropForeign('created_by');
        });
    }
}