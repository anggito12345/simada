{!! Form::open(['route' => ['inventaris.destroy', $id], 'method' => 'delete']) !!}
<?php 
    $barangInfo = \App\Models\barang::find($pidbarang)
?>
<div class='btn-group'>
    @if($barangInfo->kode_jenis == '6')
        @if(empty($ir))
        <div class='btn btn-default btn-sm btn-xs' title="mutasi" onclick="viewModel.clickEvent.showModalMutasi({{$id}}, {{ json_encode($barangInfo->toArray()) }})">
            <i class="fa fa-recycle"></i>
        </div>
        @else
        <i class="text text-info fa fa-warning" title="Menunggu Persetujuan BPKAD">
        </i>
        @endif

    @endif
</div>
{!! Form::close() !!}

