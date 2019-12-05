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
</div>
{!! Form::close() !!}

