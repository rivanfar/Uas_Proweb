<?php

namespace App\Http\Requests;

use App\Models\DataSatu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataSatuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_satu_create');
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
