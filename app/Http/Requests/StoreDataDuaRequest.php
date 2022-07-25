<?php

namespace App\Http\Requests;

use App\Models\DataDua;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataDuaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_dua_create');
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
