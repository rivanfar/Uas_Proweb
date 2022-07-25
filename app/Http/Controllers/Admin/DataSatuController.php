<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDataSatuRequest;
use App\Http\Requests\StoreDataSatuRequest;
use App\Http\Requests\UpdateDataSatuRequest;
use App\Models\DataSatu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataSatuController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('data_satu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DataSatu::with(['team'])->select(sprintf('%s.*', (new DataSatu())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'data_satu_show';
                $editGate = 'data_satu_edit';
                $deleteGate = 'data_satu_delete';
                $crudRoutePart = 'data-satus';

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

        return view('admin.dataSatus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('data_satu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataSatus.create');
    }

    public function store(StoreDataSatuRequest $request)
    {
        $dataSatu = DataSatu::create($request->all());

        return redirect()->route('admin.data-satus.index');
    }

    public function edit(DataSatu $dataSatu)
    {
        abort_if(Gate::denies('data_satu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataSatu->load('team');

        return view('admin.dataSatus.edit', compact('dataSatu'));
    }

    public function update(UpdateDataSatuRequest $request, DataSatu $dataSatu)
    {
        $dataSatu->update($request->all());

        return redirect()->route('admin.data-satus.index');
    }

    public function show(DataSatu $dataSatu)
    {
        abort_if(Gate::denies('data_satu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataSatu->load('team', 'dataSatuInputDatas');

        return view('admin.dataSatus.show', compact('dataSatu'));
    }

    public function destroy(DataSatu $dataSatu)
    {
        abort_if(Gate::denies('data_satu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataSatu->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataSatuRequest $request)
    {
        DataSatu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
