<?php

namespace App\Http\Requests;

use App\Models\DataSatu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDataSatuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_satu_edit');
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
