<?php

namespace App\Http\Requests;

use App\Models\DataEmpat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDataEmpatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_empat_edit');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'nullable',
            ],
        ];
    }
}
