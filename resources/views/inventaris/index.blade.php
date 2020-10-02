@extends('layouts.app')

@section('content')
<section class="content-header">
  <h3 class="pull-left">{{ Breadcrumbs::render() }}</h3>
  <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('inventaris.create') !!}">Add New</a>
        </h1> -->
</section>
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="box box-primary">
    <div class="box-body">
      <label class="advance_filter_toggle text-info" style="cursor: pointer" onclick="viewModel.clickEvent.toggleAdvanceFilter()">
        Advance Filter
        <i class="fa fa-filter"></i>
      </label>
      <div class="advance_body">
        @include('inventaris.table_filter')
      </div>

      <div class="clearfix"></div>

      <div class="box box-primary">
        <div class="box-body">
          @include('inventaris.table')
        </div>
      </div>
    </div>
  </div>


  <div class="text-center">

  </div>
</div>
@endsection

<?php

// in some php file to detect they are called from inventaris page, needed this variable to be true.
$isInventarisPage = true;
?>


@section('scripts_2')

<div class="modal" id="modal-compare" role="dialog">
    <div class="modal-dialog modal-lg" style="width:100vw;padding:0;margin:0" role="document">
      <div class="modal-content" style="width:100vw">
        <div class="modal-header">
          <h5 class="modal-title">Compare</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal-compare-body">
            Test
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>



<div class="modal" id="modal-mutasi" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mutasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Ke Kode Barang Baru:</label>
          {{ Form::select('kode', [], null, ['class' => 'form-control', 'id' => 'kode'] ) }}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="viewModel.clickEvent.confirmMutasiSwal()">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modal-pemeliharaan" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pemeliharaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('pemeliharaans.fields')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="viewModel.clickEvent.savePemeliharaan()">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modal-pemanfaatan" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pemanfaatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['id' => 'form-pemanfaatan']) !!}
        @include('pemanfaatans.fields')
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="viewModel.clickEvent.savePemanfaatan()">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
  viewModel.jsLoaded.subscribe(() => {


    $("#table-penghapusan").DataTable({
      ajax: `${$("[base-path]").val()}/penghapusans`,
      dom: 'Bfrtip',
      columns: [{
          'orderable': false,
          "className": "details-control",
          "render": function(data, type, row) {
            return '<i class="fa fa-plus-circle text-success"></i>'
          },
          data: "id",
        },
        {
          title: 'Kode Barang',
          data: 'kode_barang'
        },
        {
          title: 'Tahun Perolehan',
          data: 'tahun_perolehan'
        },
        {
          title: 'Kondisi',
          data: 'kondisi'
        },
        {
          title: 'Kriteria',
          data: 'kriteria'
        },
      ],
      'drawCallback': onLoadDataTable,
      'select': {
        'style': 'multi'
      },
      "processing": true,
      "serverSide": true,
      'order': [
        [1, 'desc']
      ],
      buttons: [{
        extend: 'collection',
        text: 'Aksi',
        buttons: [{
            text: 'Ubah',
            action: () => {
              var count = $("#table-penghapusan").DataTable().rows('.selected').count();

              if (count != 1) {
                swal.fire({
                  type: 'error',
                  text: 'Silahkan pilih 1 data',
                  title: 'Pemeliharaan'
                })
                return
              }

              onPenghapusan($("#table-penghapusan").DataTable().rows('.selected').data()[0], `#table-penghapusan`)
            }
          },
          {
            text: 'delete',
            action: () => {
              onDeletePenghapusan()
            }
          },
        ]
      }]
    })
  })
  viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    // ....
    changeRefreshGrid: () => {
      $("#table-inventaris").DataTable().ajax.reload();
    }
  })
  viewModel.clickEvent = Object.assign(viewModel.clickEvent, {
    toggleAdvanceFilter: ()  => {
        $('.advance_body').slideToggle('slow')
    },
    showModalMutasi: ($id, $barangInfo) => {
      // try to match each default field to and from

      $('#kode').select2({
        ajax: {
          url: $("[base-path]").val() + "/api/barangs/get?length=10",
          dataType: "json",
          data: function(params) {
            params.length = 10
            params['search-lookup'] = {
              "nama_rek_aset": {
                operator: 'like',
                value: params.term,
                logic: 'or',
                group: 'filter'
              },
              "CONCAT(kode_akun,'.',kode_kelompok,'.',kode_jenis,'.',kode_objek,'.', kode_rincian_objek, '.', kode_sub_rincian_objek,'.',kode_sub_sub_rincian_objek)": {
                operator: 'like',
                value: params.term,
                logic: 'or',
                group: 'filter'
              },
              "kode_jenis": {
                operator: '=',
                value: parseInt($barangInfo.kode_sub_sub_rincian_objek),
              },

            }
            return params;
          },
          processResults: function(data) {
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
              results: data.data.map((d) => {
                d.text = viewModel.helpers.buildKodeBarang(d) + " - " + d.nama_rek_aset
                return d
              })
            };
          }
        },
        minimumInputLength: 1,
        theme: 'bootstrap',
      })

      $("#modal-mutasi").modal('show')
      $("#modal-mutasi").attr("data-id", $id)
      $("#modal-mutasi").attr("data-kode_sub_sub_rincian_objek", $barangInfo.kode_sub_sub_rincian_objek)
    },
    confirmMutasiSwal: () => {
      Swal.fire({
        title: 'Anda yakin?',
        text: "Anda tidak akan bisa mengembalikan data yang sudah dimutasi",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!'
      }).then((result) => {
        if (result.value) {
          __ajax({
            url: `<?= url('api/mutasiinventaris') ?>/${$("#modal-mutasi").attr("data-id")}`,
            method: 'POST',
            dataType: 'json',
            data: {
              tipe_kib: $("#modal-mutasi").attr("data-kode_sub_sub_rincian_objek"),
              id: $("#modal-mutasi").attr("data-id"),
              newidbarang: $("#kode").val()
            }
          }).then((d) => {
            swal.fire({
              type: "success",
              text: "Berhasil menyimpan data!",
              onClose: () => {
                $("#modal-mutasi").modal('hide')
                $("#table-inventaris").DataTable().ajax.reload();
              }
            })
          })
        }
      })
    },
    deleteInventaris: (id) => {
      let url = $("[base-path]").val() + "/api/inventaris/" + id
      let method = "DELETE"

      Swal.fire({
        title: 'Anda yakin?',
        text: "Anda tidak akan bisa mengembalikan data yang sudah dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!'
      }).then((result) => {
        if (result) {
          __ajax({
            url: url,
            method: method,
            dataType: "json",
          }).then((d) => {
            swal.fire({
              type: "success",
              text: "Berhasil menghapus data inventaris!",
              onClose: () => {
                $("#table-inventaris").DataTable().ajax.reload();
              }
            })
          })
        }
      })
    },
    savePemeliharaan: () => {
      let url = $("[base-path]").val() + "/api/pemeliharaans"
      let method = "POST"
      if ($('#modal-pemeliharaan').attr('is_mode_insert') == 'false') {
        url += "/" + viewModel.data.formPemeliharaan().id
        method = "patch"
      }

      __ajax({
        url: url,
        method: method,
        dataType: "json",
        data: viewModel.data.formPemeliharaan(),
      }).then((d) => {
        swal.fire({
          type: "success",
          text: "Berhasil menyimpan data pemeliaraan!",
          onClose: () => {
            $("#modal-pemeliharaan").modal('hide')

            if ($('#modal-pemeliharaan').attr('callback') != undefined) {

              let funcCallbackAndParam = $('#modal-pemeliharaan').attr('callback').split("|")
              window[funcCallbackAndParam[0]](funcCallbackAndParam[1])
              $('#modal-pemeliharaan').removeAttr('callback')
              return;
            }
            $("#table-inventaris").DataTable().ajax.reload();
          }
        })
      })
    },
    savePemanfaatan: () => {
      let url = $("[base-path]").val() + "/api/pemanfaatans"
      let formData = new FormData($('#form-pemanfaatan')[0])
      let method = "POST"

      for (let index = 0; index < fileGalleryPemanfaatan.fileList().length; index++) {
        const d = fileGalleryPemanfaatan.fileList()[index]
        if (d.rawFile) {
          formData.append(`dokumen[${index}]`, d.rawFile)
        } else {
          formData.append(`dokumen[${index}]`, false)
        }

        let keys = Object.keys(d)

        keys.forEach((key) => {
          if (key == 'rawFile') {
            return
          }
          formData.append(`dokumen_metadata_${key}[${index}]`, d[key])
        })

        formData.append(`dokumen_metadata_id_inventaris[${index}]`, $("#table-inventaris").DataTable().rows('.selected').data()[0].id)
      }

      fotoPemanfaatan.fileList().forEach((d, index) => {
        if (d.rawFile) {
          formData.append(`foto[${index}]`, d.rawFile)
        } else {
          formData.append(`foto[${index}]`, false)
        }

        let keys = Object.keys(d)

        keys.forEach((key) => {
          if (key == 'rawFile') {
            return
          }
          formData.append(`foto_metadata_${key}[${index}]`, d[key])
        })

        formData.append(`foto_metadata_id_inventaris[${index}]`, $("#table-inventaris").DataTable().rows('.selected').data()[0].id)

        return d.rawFile
      })



      if ($('#modal-pemanfaatan').attr('is_mode_insert') == 'false') {
        formData.append(`pidinventaris`, viewModel.data.formPemanfaatan().pidinventaris)
        url = $("[base-path]").val() + "/api/pemanfaatans" + "/edit/" + viewModel.data.formPemanfaatan().id
        method = "POST"
      } else {
        formData.append(`pidinventaris`, viewModel.data.formPemanfaatan().pidinventaris)
      }

      __ajax({
        method: method,
        url: url,
        data: formData,
        processData: false,
        contentType: false,
      }).then((d, resp) => {
        swal.fire({
          type: "success",
          text: "Berhasil menyimpan data!",
          onClose: () => {
            $("#modal-pemanfaatan").modal('hide')

            if ($('#modal-pemanfaatan').attr('callback') != undefined) {

              let funcCallbackAndParam = $('#modal-pemanfaatan').attr('callback').split("|")
              window[funcCallbackAndParam[0]](funcCallbackAndParam[1])
              $('#modal-pemanfaatan').removeAttr('callback')
              return;
            }
            $("#table-inventaris").DataTable().ajax.reload();

          }
        })

      })
    },
  })


</script>
@endsection
