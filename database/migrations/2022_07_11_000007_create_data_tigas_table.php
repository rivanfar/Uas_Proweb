<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTigasTable extends Migration
{
    public function up()
    {
        Schema::create('data_tigas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
