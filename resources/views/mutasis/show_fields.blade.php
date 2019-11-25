<?php 
    $uniqID = uniqid(time());
?>

<!-- Opd Asal Field -->
<div class="row">
    {!! Form::label('opd_asal', 'Opd Asal:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($mutasi->organisasiasal, "nama", "") !!}</p>
</div>

<!-- Opd Tujuan Field -->
<div class="row">
    {!! Form::label('opd_tujuan', 'Opd Tujuan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($mutasi->organisasitujuan, "nama", "") !!}</p>
</div>

<!-- No Bast Field -->
<div class="row">
    {!! Form::label('no_bast', 'No Bast:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $mutasi->no_bast !!}</p>
</div>

<!-- Tgl Bast Field -->
<div class="row">
    {!! Form::label('tgl_bast', 'Tgl Bast:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $mutasi->tgl_bast !!}</p>
</div>

<!-- Alasan Mutasi Field -->
<div class="row">
    {!! Form::label('alasan_mutasi', 'Alasan Mutasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $mutasi->alasan_mutasi !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $mutasi->keterangan !!}</p>
</div>


<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Mutasi List:', ["class" => 'col-md-12 item-view']) !!}
</div>

<div class="form-group col-sm-12">
    <table id="table-detil-mutasi-<?= $uniqID  ?>" class="table table-striped table-bordered">
        <thead>
        </thead>
    </table>
</div>


<script> 


if ( ! $.fn.DataTable.isDataTable( '#table-detil-mutasi-<?= $uniqID  ?>' ) ) {
    let dataDetils = JSON.parse('<?= json_encode(\App\Models\inventaris_mutasi::where('inventaris_mutasi.mutasi_id', $mutasi->id)
            ->select([
                'm_barang.nama_rek_aset as inventarisNama',
                'inventaris_mutasi.id as inventaris',
                'inventaris_mutasi.id as DT_RowId'
            ])
            ->join('m_barang','m_barang.id', 'inventaris_mutasi.pidbarang')
            ->get()) ?>')

    $('#table-detil-mutasi-<?= $uniqID  ?>').DataTable({
        data: dataDetils,
        dom: 'Bfrtip',
        searching: false,
        "lengthChange": false,
        "ordering": true,
        "aaSorting": [[ 0, "desc" ]],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        columns: [
            {
                data: 'inventarisNama',
                title: 'Barang',
                orderable: false,
            },
        ],
    })
}

</script>

