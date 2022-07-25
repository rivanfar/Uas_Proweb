<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataEmpatRequest;
use App\Http\Requests\UpdateDataEmpatRequest;
use App\Http\Resources\Admin\DataEmpatResource;
use App\Models\DataEmpat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataEmpatApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('data_empat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataEmpatResource(DataEmpat::with(['team'])->get());
    }

    public function store(StoreDataEmpatRequest $request)
    {
        $dataEmpat = DataEmpat::create($request->all());

        return (new DataEmpatResource($dataEmpat))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataEmpat $dataEmpat)
    {
        abort_if(Gate::denies('data_empat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataEmpatResource($dataEmpat->load(['team']));
    }

    public function update(UpdateDataEmpatRequest $request, DataEmpat $dataEmpat)
    {
        $dataEmpat->update($request->all());

        return (new DataEmpatResource($dataEmpat))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataEmpat $dataEmpat)
    {
        abort_if(Gate::denies('data_empat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataEmpat->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
