<?php

namespace App\Http\Requests;

use App\Models\InputData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInputDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('input_data_create');
    }

    public function rules()
    {
        return [
            'nama_input_proses_data' => [
                'string',
                'required',
            ],
            'data_satus.*' => [
                'integer',
            ],
            'data_satus' => [
                'required',
                'array',
            ],
            'data_duas.*' => [
                'integer',
            ],
            'data_duas' => [
                'required',
                'array',
            ],
            'data_tigas.*' => [
                'integer',
            ],
            'data_tigas' => [
                'required',
                'array',
            ],
            'data_empats.*' => [
                'integer',
            ],
            'data_empats' => [
                'required',
                'array',
            ],
        ];
    }
}
