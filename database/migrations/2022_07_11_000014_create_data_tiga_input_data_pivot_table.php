<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTigaInputDataPivotTable extends Migration
{
    public function up()
    {
        Schema::create('data_tiga_input_data', function (Blueprint $table) {
            $table->unsignedBigInteger('input_data_id');
            $table->foreign('input_data_id', 'input_data_id_fk_6963800')->references('id')->on('input_datas')->onDelete('cascade');
            $table->unsignedBigInteger('data_tiga_id');
            $table->foreign('data_tiga_id', 'data_tiga_id_fk_6963800')->references('id')->on('data_tigas')->onDelete('cascade');
        });
    }
}
