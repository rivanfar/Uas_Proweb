@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataTiga.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-tigas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dataTiga.fields.id') }}
                        </th>
                        <td>
                            {{ $dataTiga->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataTiga.fields.nama') }}
                        </th>
                        <td>
                            {{ $dataTiga->nama }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-tigas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#data_tiga_input_datas" role="tab" data-toggle="tab">
                {{ trans('cruds.inputData.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="data_tiga_input_datas">
            @includeIf('admin.dataTigas.relationships.dataTigaInputDatas', ['inputDatas' => $dataTiga->dataTigaInputDatas])
        </div>
    </div>
</div>

@endsection