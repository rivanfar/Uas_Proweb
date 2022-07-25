@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.inputData.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.input-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.inputData.fields.id') }}
                        </th>
                        <td>
                            {{ $inputData->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inputData.fields.nama_input_proses_data') }}
                        </th>
                        <td>
                            {{ $inputData->nama_input_proses_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inputData.fields.data_satu') }}
                        </th>
                        <td>
                            @foreach($inputData->data_satus as $key => $data_satu)
                                <span class="label label-info">{{ $data_satu->nama }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inputData.fields.data_dua') }}
                        </th>
                        <td>
                            @foreach($inputData->data_duas as $key => $data_dua)
                                <span class="label label-info">{{ $data_dua->nama }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inputData.fields.data_tiga') }}
                        </th>
                        <td>
                            @foreach($inputData->data_tigas as $key => $data_tiga)
                                <span class="label label-info">{{ $data_tiga->nama }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inputData.fields.data_empat') }}
                        </th>
                        <td>
                            @foreach($inputData->data_empats as $key => $data_empat)
                                <span class="label label-info">{{ $data_empat->nama }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.input-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection