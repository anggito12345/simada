{!! Form::open(['route' => ['inventaris.destroy', $id], 'method' => 'delete']) !!}
<?php 
    $barangInfo = \App\Models\barang::find($pidbarang)
?>
<div class='btn-group'>
    @if($barangInfo->kode_jenis == '6')
        <div class='btn btn-default btn-sm btn-xs' title="mutasi" onclick="viewModel.clickEvent.showModalMutasi({{$id}}, {{ json_encode($barangInfo->toArray()) }})">
            <i class="fa fa-recycle"></i>
        </div>
    @endif
    <a href="{{ route('inventaris.edit', $id) }}" title="ubah" class='btn btn-sm btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'title' => 'hapus',
        'class' => 'btn btn-danger btn-sm btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}

