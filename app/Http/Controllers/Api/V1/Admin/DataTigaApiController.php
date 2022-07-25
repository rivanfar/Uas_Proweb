<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataTigaRequest;
use App\Http\Requests\UpdateDataTigaRequest;
use App\Http\Resources\Admin\DataTigaResource;
use App\Models\DataTiga;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataTigaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('data_tiga_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataTigaResource(DataTiga::with(['team'])->get());
    }

    public function store(StoreDataTigaRequest $request)
    {
        $dataTiga = DataTiga::create($request->all());

        return (new DataTigaResource($dataTiga))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataTiga $dataTiga)
    {
        abort_if(Gate::denies('data_tiga_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataTigaResource($dataTiga->load(['team']));
    }

    public function update(UpdateDataTigaRequest $request, DataTiga $dataTiga)
    {
        $dataTiga->update($request->all());

        return (new DataTigaResource($dataTiga))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataTiga $dataTiga)
    {
        abort_if(Gate::denies('data_tiga_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataTiga->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
