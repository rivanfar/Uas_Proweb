<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDuaInputDataPivotTable extends Migration
{
    public function up()
    {
        Schema::create('data_dua_input_data', function (Blueprint $table) {
            $table->unsignedBigInteger('input_data_id');
            $table->foreign('input_data_id', 'input_data_id_fk_6963799')->references('id')->on('input_datas')->onDelete('cascade');
            $table->unsignedBigInteger('data_dua_id');
            $table->foreign('data_dua_id', 'data_dua_id_fk_6963799')->references('id')->on('data_duas')->onDelete('cascade');
        });
    }
}
