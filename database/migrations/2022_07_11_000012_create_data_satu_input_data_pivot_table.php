<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSatuInputDataPivotTable extends Migration
{
    public function up()
    {
        Schema::create('data_satu_input_data', function (Blueprint $table) {
            $table->unsignedBigInteger('input_data_id');
            $table->foreign('input_data_id', 'input_data_id_fk_6963798')->references('id')->on('input_datas')->onDelete('cascade');
            $table->unsignedBigInteger('data_satu_id');
            $table->foreign('data_satu_id', 'data_satu_id_fk_6963798')->references('id')->on('data_satus')->onDelete('cascade');
        });
    }
}
