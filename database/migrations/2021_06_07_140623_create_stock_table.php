<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->uuid('transactionNumber');
            $table->unsignedBigInteger('productId');
            $table->double('sumProductCount');
            $table->double('sumTradingVolume');
            $table->string('supplier')->nullable();
            $table->string('adress')->nullable();
            $table->timestamp('date')->nullable()->comment('işlem tarihi');
            $table->tinyInteger('inOrOut')->comment('0:out, 1:in');
            $table->string('desription')->nullable();
            $table->timestamps();
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
