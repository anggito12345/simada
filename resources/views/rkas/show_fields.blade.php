<?php 
    $uniqID = uniqid(time());
?>

<!-- No Spk Field -->
<div class="row">
    {!! Form::label('no_spk', 'No Spk:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $rka->no_spk !!}</p>
</div>

<!-- No Bast Field -->
<div class="row">
    {!! Form::label('no_bast', 'No Bast:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $rka->no_bast !!}</p>
</div>

<br />

<div class="form-group col-sm-12">
    <table id="table-detil-rka-<?= $uniqID  ?>" class="table table-striped ">
        <thead>
        </thead>
    </table>
</div>


<script>


if ( ! $.fn.DataTable.isDataTable( '#table-detil-rka-<?= $uniqID  ?>' ) ) {
    let dataDetils = JSON.parse('<?= json_encode(\App\Models\rka_detil::where('pid', $rka->id)
            ->select([
                'm_barang.nama_rek_aset as kode_barangNama',
                'rka_detil.id as id',
                'rka_detil.keterangan',
                'rka_detil.id as DT_RowId',
                'rka_detil.nilai_rka',
                'rka_detil.kode_barang',
                'rka_detil.nilai_kontrak',
            ])
            ->join('m_barang','m_barang.id', 'rka_detil.kode_barang')
            ->get()) ?>')
    $('#table-detil-rka-<?= $uniqID  ?>').DataTable({
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
                data: 'kode_barangNama',
                title: 'Kode Barang',
                orderable: false,
            },
            {
                data: 'nilai_rka',
                title: 'Nilai RKA',
                orderable: false,
            },
            {
                data: 'keterangan',
                title: 'Keterangan',
                className: 'keterangan',    
                orderable: false,
            },
        ],
    })
}

</script>
