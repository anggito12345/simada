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
                'rka_detil.id as id',
                'rka_detil.id as DT_RowId',
                'rka_detil.nama_barang',
                'rka_detil.jumlah_real',
                'rka_detil.harga_satuan_real',
                'rka_detil.nilai_kontrak',
                'rka_detil.kib',
                'rka_detil.keterangan',
            ])
           // ->join('m_barang','m_barang.id', 'rka_detil.kode_barang')
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
                data: 'nama_barang',
                title: 'Nama Barang',
                orderable: false,
            },
            {
                data: 'jumlah_real',
                title: 'Jumlah',
                orderable: false,
            },
            {
                data: 'harga_satuan_real',
                title: 'Harga Satuan',
                orderable: false,
            },
            {
                data: 'nilai_kontrak',
                title: 'Nilai',
                orderable: false,
            },
            {
                data: 'kib',
                title: 'KIB',
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
