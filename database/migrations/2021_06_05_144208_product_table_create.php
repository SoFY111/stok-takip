<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductTableCreate extends Migration
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
            $table->string('code')->comment('ean13 barcode');
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('categoryId')->default(1)->nullable();
            $table->unsignedBigInteger('brandId')->default(1)->nullable();
            $table->unsignedBigInteger('unitId');
            $table->integer('taxRate');
            $table->integer('buyingPrice');
            $table->integer('salesPrice');
            $table->string('description')->nullable();
            $table->tinyInteger('followStock')->comment('0:hayır, 1:evet');
            $table->tinyInteger('criticStockAlert')->comment('-1 ise yapılmayacak');
            $table->string('image')->nullable();
            $table->tinyInteger('isActive');
            $table->timestamps();
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brandId')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('unitId')->references('id')->on('units')->onDelete('cascade');
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
