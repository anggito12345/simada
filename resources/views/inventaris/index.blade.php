@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Inventaris</h1>
        <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('inventaris.create') !!}">Add New</a>
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="box box-primary">
            <div class="box-body">
                    @include('inventaris.table_filter')
            </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="box box-primary">
            <div class="box-body">
                    @include('inventaris.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

<div class="modal" id="modal-mutasi"  role="dialog">
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


<div class="modal" id="modal-pemeliharaan"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mutasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('pemeliharaans.fields')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="viewModel.clickEvent.confirmMutasiSwal()">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@section('scripts_2')
<script>
  viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    // ....
    changeRefreshGrid: () => {
      $("#table-inventaris").DataTable().ajax.reload();
    }
  })
  viewModel.clickEvent = Object.assign(viewModel.clickEvent, {      
      showModalMutasi: ($id, $barangInfo) => {               
          // try to match each default field to and from          

          $('#kode').select2({
            ajax: {
                url: $("[base-path]").val() + "/api/barangs/get?length=10",                
                dataType: "json",
                data: function (params) {
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
                processResults: function (data) {
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
            theme: 'bootstrap' , 
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
                    tipe_kib:  $("#modal-mutasi").attr("data-kode_sub_sub_rincian_objek"),
                    id:  $("#modal-mutasi").attr("data-id"),
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
      }
  })
</script>
@endsection

