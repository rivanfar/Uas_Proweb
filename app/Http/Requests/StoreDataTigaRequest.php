<?php

namespace App\Http\Requests;

use App\Models\DataTiga;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataTigaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_tiga_create');
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
