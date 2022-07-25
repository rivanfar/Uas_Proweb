<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDataTigaRequest;
use App\Http\Requests\StoreDataTigaRequest;
use App\Http\Requests\UpdateDataTigaRequest;
use App\Models\DataTiga;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataTigaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('data_tiga_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DataTiga::with(['team'])->select(sprintf('%s.*', (new DataTiga())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'data_tiga_show';
                $editGate = 'data_tiga_edit';
                $deleteGate = 'data_tiga_delete';
                $crudRoutePart = 'data-tigas';

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

        return view('admin.dataTigas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('data_tiga_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataTigas.create');
    }

    public function store(StoreDataTigaRequest $request)
    {
        $dataTiga = DataTiga::create($request->all());

        return redirect()->route('admin.data-tigas.index');
    }

    public function edit(DataTiga $dataTiga)
    {
        abort_if(Gate::denies('data_tiga_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataTiga->load('team');

        return view('admin.dataTigas.edit', compact('dataTiga'));
    }

    public function update(UpdateDataTigaRequest $request, DataTiga $dataTiga)
    {
        $dataTiga->update($request->all());

        return redirect()->route('admin.data-tigas.index');
    }

    public function show(DataTiga $dataTiga)
    {
        abort_if(Gate::denies('data_tiga_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataTiga->load('team', 'dataTigaInputDatas');

        return view('admin.dataTigas.show', compact('dataTiga'));
    }

    public function destroy(DataTiga $dataTiga)
    {
        abort_if(Gate::denies('data_tiga_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataTiga->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataTigaRequest $request)
    {
        DataTiga::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
