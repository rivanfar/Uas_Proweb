<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataSatuRequest;
use App\Http\Requests\UpdateDataSatuRequest;
use App\Http\Resources\Admin\DataSatuResource;
use App\Models\DataSatu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataSatuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('data_satu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataSatuResource(DataSatu::with(['team'])->get());
    }

    public function store(StoreDataSatuRequest $request)
    {
        $dataSatu = DataSatu::create($request->all());

        return (new DataSatuResource($dataSatu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataSatu $dataSatu)
    {
        abort_if(Gate::denies('data_satu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataSatuResource($dataSatu->load(['team']));
    }

    public function update(UpdateDataSatuRequest $request, DataSatu $dataSatu)
    {
        $dataSatu->update($request->all());

        return (new DataSatuResource($dataSatu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataSatu $dataSatu)
    {
        abort_if(Gate::denies('data_satu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataSatu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
