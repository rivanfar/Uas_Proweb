<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInputDataRequest;
use App\Http\Requests\StoreInputDataRequest;
use App\Http\Requests\UpdateInputDataRequest;
use App\Models\DataDua;
use App\Models\DataEmpat;
use App\Models\DataSatu;
use App\Models\DataTiga;
use App\Models\InputData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InputDataController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('input_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InputData::with(['data_satus', 'data_duas', 'data_tigas', 'data_empats', 'team'])->select(sprintf('%s.*', (new InputData())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'input_data_show';
                $editGate = 'input_data_edit';
                $deleteGate = 'input_data_delete';
                $crudRoutePart = 'input-datas';

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
            $table->editColumn('nama_input_proses_data', function ($row) {
                return $row->nama_input_proses_data ? $row->nama_input_proses_data : '';
            });
            $table->editColumn('data_satu', function ($row) {
                $labels = [];
                foreach ($row->data_satus as $data_satu) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $data_satu->nama);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('data_dua', function ($row) {
                $labels = [];
                foreach ($row->data_duas as $data_dua) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $data_dua->nama);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('data_tiga', function ($row) {
                $labels = [];
                foreach ($row->data_tigas as $data_tiga) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $data_tiga->nama);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('data_empat', function ($row) {
                $labels = [];
                foreach ($row->data_empats as $data_empat) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $data_empat->nama);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'data_satu', 'data_dua', 'data_tiga', 'data_empat']);

            return $table->make(true);
        }

        return view('admin.inputDatas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('input_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data_satus = DataSatu::all();

        $data_duas = DataDua::all();

        $data_tigas = DataTiga::all();

        $data_empats = DataEmpat::all();

        return view('admin.inputDatas.create', compact('data_duas', 'data_empats', 'data_satus', 'data_tigas'));
    }

    public function store(StoreInputDataRequest $request)
    {
        $inputData = InputData::create($request->all());
        $inputData->data_satus()->sync($request->input('data_satus', []));
        $inputData->data_duas()->sync($request->input('data_duas', []));
        $inputData->data_tigas()->sync($request->input('data_tigas', []));
        $inputData->data_empats()->sync($request->input('data_empats', []));

        return redirect()->route('admin.input-datas.index');
    }

    public function edit(InputData $inputData)
    {
        abort_if(Gate::denies('input_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data_satus = DataSatu::pluck('nama', 'id');

        $data_duas = DataDua::pluck('nama', 'id');

        $data_tigas = DataTiga::pluck('nama', 'id');

        $data_empats = DataEmpat::pluck('nama', 'id');

        $inputData->load('data_satus', 'data_duas', 'data_tigas', 'data_empats', 'team');

        return view('admin.inputDatas.edit', compact('data_duas', 'data_empats', 'data_satus', 'data_tigas', 'inputData'));
    }

    public function update(UpdateInputDataRequest $request, InputData $inputData)
    {
        $inputData->update($request->all());
        $inputData->data_satus()->sync($request->input('data_satus', []));
        $inputData->data_duas()->sync($request->input('data_duas', []));
        $inputData->data_tigas()->sync($request->input('data_tigas', []));
        $inputData->data_empats()->sync($request->input('data_empats', []));

        return redirect()->route('admin.input-datas.index');
    }

    public function show(InputData $inputData)
    {
        abort_if(Gate::denies('input_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inputData->load('data_satus', 'data_duas', 'data_tigas', 'data_empats', 'team');

        return view('admin.inputDatas.show', compact('inputData'));
    }

    public function destroy(InputData $inputData)
    {
        abort_if(Gate::denies('input_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inputData->delete();

        return back();
    }

    public function massDestroy(MassDestroyInputDataRequest $request)
    {
        InputData::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
