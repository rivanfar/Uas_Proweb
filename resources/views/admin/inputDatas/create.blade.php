@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.inputData.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.input-datas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_input_proses_data">{{ trans('cruds.inputData.fields.nama_input_proses_data') }}</label>
                <input class="form-control {{ $errors->has('nama_input_proses_data') ? 'is-invalid' : '' }}" type="text" name="nama_input_proses_data" id="nama_input_proses_data" value="{{ old('nama_input_proses_data', '') }}" required>
                @if($errors->has('nama_input_proses_data'))
                <div class="invalid-feedback">
                    {{ $errors->first('nama_input_proses_data') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.inputData.fields.nama_input_proses_data_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_satus">{{ trans('cruds.inputData.fields.data_satu') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('data_satus') ? 'is-invalid' : '' }}" name="data_satus[]" id="data_satus" multiple required>
                    @foreach($data_satus as $data_satu)
                    <option value="{{ $data_satu->id }}" {{ in_array($data_satu->id, old('data_satus', [])) ? 'selected' : '' }}>{{ $data_satu->nama }}</option>
                    @endforeach
                </select>
                @if($errors->has('data_satus'))
                <div class="invalid-feedback">
                    {{ $errors->first('data_satus') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.inputData.fields.data_satu_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_duas">{{ trans('cruds.inputData.fields.data_dua') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('data_duas') ? 'is-invalid' : '' }}" name="data_duas[]" id="data_duas" multiple required>
                    @foreach($data_duas as $data_dua)
                    <option value="{{ $data_dua->id }}" {{ in_array($data_dua->id, old('data_duas', [])) ? 'selected' : '' }}>{{ $data_dua->nama }}</option>
                    @endforeach
                </select>
                @if($errors->has('data_duas'))
                <div class="invalid-feedback">
                    {{ $errors->first('data_duas') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.inputData.fields.data_dua_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_tigas">{{ trans('cruds.inputData.fields.data_tiga') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('data_tigas') ? 'is-invalid' : '' }}" name="data_tigas[]" id="data_tigas" multiple required>
                    @foreach($data_tigas as $data_tiga)
                    <option value="{{ $data_tiga->id }}" {{ in_array($data_tiga->id, old('data_tigas', [])) ? 'selected' : '' }}>{{ $data_tiga->nama }}</option>
                    @endforeach
                </select>
                @if($errors->has('data_tigas'))
                <div class="invalid-feedback">
                    {{ $errors->first('data_tigas') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.inputData.fields.data_tiga_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_empats">{{ trans('cruds.inputData.fields.data_empat') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('data_empats') ? 'is-invalid' : '' }}" name="data_empats[]" id="data_empats" multiple required>
                    @foreach($data_empats as $data_empat)
                    <option value="{{ $data_empat->id }}" {{ in_array($data_empat->id, old('data_empats', [])) ? 'selected' : '' }}>{{ $data_empat->nama }}</option>
                    @endforeach
                </select>
                @if($errors->has('data_empats'))
                <div class="invalid-feedback">
                    {{ $errors->first('data_empats') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.inputData.fields.data_empat_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
@section('scripts')
<script>
    // var data_satu = <?php echo json_encode($data_satus); ?>;
    var data_duas = <?php echo json_encode($data_duas); ?>;
    var data_tigas = <?php echo json_encode($data_tigas); ?>;
    var data_empats = <?php echo json_encode($data_empats); ?>;

    $('#data_satus').on('change', function() {
        var kons_satu = $('#data_satus option:selected').text()[0]
        $('#data_duas').empty()
        for (const eliminasi of data_duas) {
            if (kons_satu == eliminasi.nama.charAt(0)) {
                $("#data_duas").append('<option value="' + eliminasi.id + '">' + eliminasi.nama + '</option>');
            }
        }
    });
    $('#data_duas').on('change', function() {
        var kons_dua = $('#data_duas option:selected').text().substr(0,3)
        // console.log(temp_dua);
        $('#data_tigas').empty()
        for (const eliminasi of data_tigas) {
            // console.log(eliminasi.nama.substr(0,3));
            if (kons_dua == eliminasi.nama.substr(0,3)) {
                $("#data_tigas").append('<option value="' + eliminasi.id + '">' + eliminasi.nama + '</option>');
            }
        }
    });
    $('#data_tigas').on('change', function() {
        var kons_tiga = $('#data_tigas option:selected').text().substr(0,5)
        // console.log(temp_tiga);
        $('#data_empats').empty()
        for (const eliminasi of data_empats) {
            // console.log(eliminasi.nama.substr(0,5));
            if (kons_tiga == eliminasi.nama.substr(0,5)) {
                $("#data_empats").append('<option value="' + eliminasi.id + '">' + eliminasi.nama + '</option>');
            }
        }
    }); 
</script>
@endsection