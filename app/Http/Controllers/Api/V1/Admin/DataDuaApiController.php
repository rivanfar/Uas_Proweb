<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataDuaRequest;
use App\Http\Requests\UpdateDataDuaRequest;
use App\Http\Resources\Admin\DataDuaResource;
use App\Models\DataDua;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataDuaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('data_dua_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataDuaResource(DataDua::with(['team'])->get());
    }

    public function store(StoreDataDuaRequest $request)
    {
        $dataDua = DataDua::create($request->all());

        return (new DataDuaResource($dataDua))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataDua $dataDua)
    {
        abort_if(Gate::denies('data_dua_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataDuaResource($dataDua->load(['team']));
    }

    public function update(UpdateDataDuaRequest $request, DataDua $dataDua)
    {
        $dataDua->update($request->all());

        return (new DataDuaResource($dataDua))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataDua $dataDua)
    {
        abort_if(Gate::denies('data_dua_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataDua->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
