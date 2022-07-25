@can('input_data_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.input-datas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.inputData.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.inputData.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-dataSatuInputDatas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.inputData.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.inputData.fields.nama_input_proses_data') }}
                        </th>
                        <th>
                            {{ trans('cruds.inputData.fields.data_satu') }}
                        </th>
                        <th>
                            {{ trans('cruds.inputData.fields.data_dua') }}
                        </th>
                        <th>
                            {{ trans('cruds.inputData.fields.data_tiga') }}
                        </th>
                        <th>
                            {{ trans('cruds.inputData.fields.data_empat') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inputDatas as $key => $inputData)
                        <tr data-entry-id="{{ $inputData->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $inputData->id ?? '' }}
                            </td>
                            <td>
                                {{ $inputData->nama_input_proses_data ?? '' }}
                            </td>
                            <td>
                                @foreach($inputData->data_satus as $key => $item)
                                    <span class="badge badge-info">{{ $item->nama }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($inputData->data_duas as $key => $item)
                                    <span class="badge badge-info">{{ $item->nama }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($inputData->data_tigas as $key => $item)
                                    <span class="badge badge-info">{{ $item->nama }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($inputData->data_empats as $key => $item)
                                    <span class="badge badge-info">{{ $item->nama }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('input_data_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.input-datas.show', $inputData->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('input_data_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.input-datas.edit', $inputData->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('input_data_delete')
                                    <form action="{{ route('admin.input-datas.destroy', $inputData->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('input_data_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.input-datas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-dataSatuInputDatas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection