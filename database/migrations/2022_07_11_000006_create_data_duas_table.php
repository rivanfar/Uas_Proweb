<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDuasTable extends Migration
{
    public function up()
    {
        Schema::create('data_duas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
