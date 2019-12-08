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
    {!! Form::label('keterangan', 'Daftar Barang Mutasi:', ["class" => 'col-md-12 item-view']) !!}
</div>

<div class="form-group col-sm-12">
    <table id="table-detil-mutasi-<?= $uniqID  ?>" class="table table-striped ">
        <thead>
        </thead>
    </table>
</div>
<div class="form-group col-sm-12">
    {!! Form::label('', '') !!}
</div>
<br>
<div class="row">
    {!! Form::label('dokumen', 'Daftar Dokumen Mutasi:', ["class" => 'col-md-12 item-view']) !!}
</div>

<div class="form-group col-sm-12">
    <table id="table-dokumen-mutasi-<?= $uniqID  ?>" class="table table-striped table-bordered">
        <thead>
        </thead>
    </table>
</div>

<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4> 
      </div>
      <div class="modal-body">
        <div style="text-align: center;">
<iframe src="http://docs.google.com/gview?url=http://www.pdf995.com/samples/pdf.pdf&embedded=true" 
style="width:500px; height:500px;" frameborder="0"></iframe>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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

if ( ! $.fn.DataTable.isDataTable( '#table-dokumen-mutasi-<?= $uniqID  ?>' ) ) {
    let dataDetils = JSON.parse('<?= json_encode(\App\Models\inventaris_mutasi::where('inventaris_mutasi.mutasi_id', $mutasi->id)
            ->select([
                'system_upload.name as dokumenNama',
                'system_upload.path as dokumenPath',
                'inventaris_mutasi.id as DT_RowId'
            ])
            ->join('system_upload','system_upload.foreign_id', 'inventaris_mutasi.id')
            ->get()) ?>')

    $('#table-dokumen-mutasi-<?= $uniqID  ?>').DataTable({
        data: dataDetils,
        dom: 'Bfrtip',
        buttons: [],
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
                data: 'dokumenNama',
                title: 'Nama Dokumen',
                orderable: false,
            },
            {
                data: 'dokumenPath',
                title: 'Lokasi Dokumen',
                orderable: false,
            },
            {
            data: null,
            render: function ( data, type, row ) {
            return '<!-- Button trigger modal --><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewDocModal">Lihat Dokumen</button><!-- Modal --><div class="modal fade" id="viewDocModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title" id="myModalLabel">'+data.dokumenNama+'</h4></div><div class="modal-body"><div style="text-align: center;"><iframe src="http://docs.google.com/gview?url={{ url(Storage::url('+data.dokumenPath+')) }}&embedded=true" style="width:500px; height:500px;" frameborder="0"></iframe></div></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div>';
            }
            },
        ],
    })
}

</script>

