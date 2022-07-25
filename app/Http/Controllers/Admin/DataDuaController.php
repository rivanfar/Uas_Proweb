<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDataDuaRequest;
use App\Http\Requests\StoreDataDuaRequest;
use App\Http\Requests\UpdateDataDuaRequest;
use App\Models\DataDua;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataDuaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('data_dua_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DataDua::with(['team'])->select(sprintf('%s.*', (new DataDua())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'data_dua_show';
                $editGate = 'data_dua_edit';
                $deleteGate = 'data_dua_delete';
                $crudRoutePart = 'data-duas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.dataDuas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('data_dua_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataDuas.create');
    }

    public function store(StoreDataDuaRequest $request)
    {
        $dataDua = DataDua::create($request->all());

        return redirect()->route('admin.data-duas.index');
    }

    public function edit(DataDua $dataDua)
    {
        abort_if(Gate::denies('data_dua_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataDua->load('team');

        return view('admin.dataDuas.edit', compact('dataDua'));
    }

    public function update(UpdateDataDuaRequest $request, DataDua $dataDua)
    {
        $dataDua->update($request->all());

        return redirect()->route('admin.data-duas.index');
    }

    public function show(DataDua $dataDua)
    {
        abort_if(Gate::denies('data_dua_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataDua->load('team', 'dataDuaInputDatas');

        return view('admin.dataDuas.show', compact('dataDua'));
    }

    public function destroy(DataDua $dataDua)
    {
        abort_if(Gate::denies('data_dua_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataDua->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataDuaRequest $request)
    {
        DataDua::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
