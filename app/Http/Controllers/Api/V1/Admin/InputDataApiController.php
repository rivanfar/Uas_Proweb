<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInputDataRequest;
use App\Http\Requests\UpdateInputDataRequest;
use App\Http\Resources\Admin\InputDataResource;
use App\Models\InputData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InputDataApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('input_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InputDataResource(InputData::with(['data_satus', 'data_duas', 'data_tigas', 'data_empats', 'team'])->get());
    }

    public function store(StoreInputDataRequest $request)
    {
        $inputData = InputData::create($request->all());
        $inputData->data_satus()->sync($request->input('data_satus', []));
        $inputData->data_duas()->sync($request->input('data_duas', []));
        $inputData->data_tigas()->sync($request->input('data_tigas', []));
        $inputData->data_empats()->sync($request->input('data_empats', []));

        return (new InputDataResource($inputData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InputData $inputData)
    {
        abort_if(Gate::denies('input_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InputDataResource($inputData->load(['data_satus', 'data_duas', 'data_tigas', 'data_empats', 'team']));
    }

    public function update(UpdateInputDataRequest $request, InputData $inputData)
    {
        $inputData->update($request->all());
        $inputData->data_satus()->sync($request->input('data_satus', []));
        $inputData->data_duas()->sync($request->input('data_duas', []));
        $inputData->data_tigas()->sync($request->input('data_tigas', []));
        $inputData->data_empats()->sync($request->input('data_empats', []));

        return (new InputDataResource($inputData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InputData $inputData)
    {
        abort_if(Gate::denies('input_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inputData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
