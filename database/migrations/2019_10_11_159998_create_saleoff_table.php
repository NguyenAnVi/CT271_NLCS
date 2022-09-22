<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleoffTable extends Migration
{
    public function up()
    {
        Schema::create('saleoff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->timestamp('expire');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('saleoff');
    }
}
