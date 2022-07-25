<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataEmpatInputDataPivotTable extends Migration
{
    public function up()
    {
        Schema::create('data_empat_input_data', function (Blueprint $table) {
            $table->unsignedBigInteger('input_data_id');
            $table->foreign('input_data_id', 'input_data_id_fk_6963801')->references('id')->on('input_datas')->onDelete('cascade');
            $table->unsignedBigInteger('data_empat_id');
            $table->foreign('data_empat_id', 'data_empat_id_fk_6963801')->references('id')->on('data_empats')->onDelete('cascade');
        });
    }
}
