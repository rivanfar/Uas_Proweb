<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputDatasTable extends Migration
{
    public function up()
    {
        Schema::create('input_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_input_proses_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
