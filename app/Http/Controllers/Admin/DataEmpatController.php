<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDataEmpatRequest;
use App\Http\Requests\StoreDataEmpatRequest;
use App\Http\Requests\UpdateDataEmpatRequest;
use App\Models\DataEmpat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataEmpatController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('data_empat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DataEmpat::with(['team'])->select(sprintf('%s.*', (new DataEmpat())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'data_empat_show';
                $editGate = 'data_empat_edit';
                $deleteGate = 'data_empat_delete';
                $crudRoutePart = 'data-empats';

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

        return view('admin.dataEmpats.index');
    }

    public function create()
    {
        abort_if(Gate::denies('data_empat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataEmpats.create');
    }

    public function store(StoreDataEmpatRequest $request)
    {
        $dataEmpat = DataEmpat::create($request->all());

        return redirect()->route('admin.data-empats.index');
    }

    public function edit(DataEmpat $dataEmpat)
    {
        abort_if(Gate::denies('data_empat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataEmpat->load('team');

        return view('admin.dataEmpats.edit', compact('dataEmpat'));
    }

    public function update(UpdateDataEmpatRequest $request, DataEmpat $dataEmpat)
    {
        $dataEmpat->update($request->all());

        return redirect()->route('admin.data-empats.index');
    }

    public function show(DataEmpat $dataEmpat)
    {
        abort_if(Gate::denies('data_empat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataEmpat->load('team', 'dataEmpatInputDatas');

        return view('admin.dataEmpats.show', compact('dataEmpat'));
    }

    public function destroy(DataEmpat $dataEmpat)
    {
        abort_if(Gate::denies('data_empat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataEmpat->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataEmpatRequest $request)
    {
        DataEmpat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
