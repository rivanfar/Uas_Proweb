<?php

namespace App\Http\Requests;

use App\Models\InputData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInputDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('input_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:input_datas,id',
        ];
    }
}
