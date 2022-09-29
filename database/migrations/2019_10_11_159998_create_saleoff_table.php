<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleoffTable extends Migration
{
    public function up()
    {
        Schema::create('saleoffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('percent');
            $table->integer('amount');
            $table->datetime('starttime');
            $table->datetime('endtime');
            $table->string('imageurl');
        });
    }
    public function down()
    {
        Schema::dropIfExists('saleoffs');
    }
}
