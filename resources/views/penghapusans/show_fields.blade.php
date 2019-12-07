<?php 
    $uniqID = uniqid(time());
?>

<!-- Kriteria Field -->
<div class="row">
    {!! Form::label('kriteria', 'Kriteria:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->kriteria !!}</p>
</div>

<!-- Kondisi Field -->
<div class="row">
    {!! Form::label('kondisi', 'Kondisi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->kondisi !!}</p>
</div>

<!-- Harga Apprisal Field -->
<div class="row">
    {!! Form::label('harga_apprisal', 'Harga Apprisal:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->harga_apprisal !!}</p>
</div>

<!-- Dokumen Field -->
<div class="row">
    {!! Form::label('dokumen', 'Dokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->dokumen !!}</p>
</div>


<!-- Nosk Field -->
<div class="row">
    {!! Form::label('nosk', 'Nosk:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->nosk !!}</p>
</div>

<!-- Tglsk Field -->
<div class="row">
    {!! Form::label('tglsk', 'Tglsk:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->tglsk !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->keterangan !!}</p>
</div>

<!-- Updated At Field -->
<div class="row">
    {!! Form::label('updated_at', 'Updated At:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="row">
    {!! Form::label('created_at', 'Created At:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->created_at !!}</p>
</div>

<div class="form-group col-sm-12">
    <table id="table-detil-penghapusan-<?= $uniqID  ?>" class="table table-striped ">
        <thead>
        </thead>
    </table>
</div>



<script> 


if ( ! $.fn.DataTable.isDataTable( '#table-detil-penghapusan-<?= $uniqID  ?>' ) ) {
    let dataDetils = JSON.parse('<?= json_encode(\App\Models\inventaris_penghapusan::where('pid_penghapusan', $penghapusan->id)
        ->select([
            'inventaris_penghapusan.id_pk as DT_RowId',
            'm_barang.nama_rek_aset as inventarisNama',
            'inventaris_penghapusan.id as inventaris',
        ])
        ->join('m_barang','m_barang.id', 'inventaris_penghapusan.pidbarang')
        ->get()) ?>')

    $('#table-detil-penghapusan-<?= $uniqID  ?>').DataTable({
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
