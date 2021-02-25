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
                <label>Filter</label>
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        {{ Form::label('jenisbarangs_filter', 'Kelompok:') }}
                        {{ Form::select('jenisbarangs_filter', [], 0, ['class' => 'form-control']) }}
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        {{ Form::label('kodeobjek_filter', 'Objek:') }}
                        {{ Form::select('kodeobjek_filter', [], 0, ['class' => 'form-control']) }}
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        {{ Form::label('koderincianobjek_filter', 'Rincian Objek:') }}
                        {{ Form::select('koderincianobjek_filter', [], 0, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        {{ Form::label('penggunafilter', 'Pengguna:') }}
                        {{ Form::select('penggunafilter', [], 0, ['class' => 'form-control']) }}
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        {{ Form::label('kuasapengguna_filter', 'Kuasa Pengguna:') }}
                        {{ Form::select('kuasapengguna_filter', [], 0, ['class' => 'form-control']) }}
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                        {{ Form::label('subkuasa_filter', 'Sub Kuasa Pengguna:') }}
                        {{ Form::select('subkuasa_filter', [], 0, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table id="report-daftarbarang" class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">
                                Nomor
                            </th>
                            <th colspan="4" class="text-center">
                                Spefikasi Barang
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Cara Perolehan/Status Barang
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Bulan Perolehan
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Tahun Perolehan
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Ukuran Barang / Konstruksi (P,SP,D)
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Keadaan Barang (B,KB,RB)
                            </th>
                            <th colspan="2" class="text-center align-middle">
                                Jumlah
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Penyusutan s.d Tahun Sebelumnya
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Beban Penyusutan Tahun Berkenaan
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Penyusutan s.d Tahun Berkenaan
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Nilai Buku
                            </th>
                            <th rowspan="2" class="text-center align-middle">
                                Keterangan/Tgl Buku/ Tahun Sensus
                            </th>
                        </tr>
                        <tr>
                            <th class="align-middle">
                                No.
                            </th>
                            <th class="align-middle">
                                Kode Barang/ID Barang.
                            </th>
                            <th class="align-middle">
                                Reg.
                            </th>
                            <th class="align-middle">
                                Nama Barang
                            </th>
                            <th class="align-middle">
                                Alamat
                            </th>
                            <th class="align-middle">
                                Merk / Tipe
                            </th>
                            <th style="min-width: 200px;" class="align-middle">
                                No. Sertifikat / No. Pabrik / No. Chasis / No. Mesin / No. Polisi/ No. Ruas Jalan/ No. Daerah Irigasi
                            </th>
                            <th class="align-middle">
                                Volume
                            </th>
                            <th class="align-middle">
                                Nilai Perolehan
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection
@section('scripts')
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/datatables.min.css"/>
  
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/datatables.min.js"></script> -->

<script>

    $(document).ready(() => {

        $("#jenisbarangs_filter").select2({
            ajax: {
                url: "<?= url('api/jenisbarangs') ?>",
                dataType: 'json',
                data: function (params) {

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.nama
                            d.id = parseInt(d.kode)

                            return d
                        })
                    };
                }
            },
            theme: 'bootstrap' ,
        })

        $('#jenisbarangs_filter').on('change', function (e) {
            $("#kodeobjek_filter").val("").trigger("change")
        });

        $("#kodeobjek_filter").select2({
            ajax: {
                url: "<?= url('api/barangs') ?>",
                dataType: 'json',
                data: function (params) {
                    idInput = $(this)[0].id

                    params.kode_jenis = $("#jenisbarangs_filter").val()

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.nama_rek_aset
                            d.id = d.id
                            return d
                        })
                    };
                },
            },
            theme: 'bootstrap' ,
        })

        $('#kodeobjek_filter').on('change', function (e) {
            $("#koderincianobjek_filter").val("").trigger("change")
        });

        $("#koderincianobjek_filter").select2({
            ajax: {
                url: "<?= url('api/barangs') ?>",
                dataType: 'json',
                data: function (params) {
                    idInput = $(this)[0].id


                    params.kode_objek = $("#kodeobjek_filter").select2('data')[0].kode_objek
                    params.kode_jenis = $("#jenisbarangs_filter").val()

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.nama_rek_aset
                            d.id = d.id
                            return d
                        })
                    };
                },

            },
            theme: 'bootstrap' ,
        })

        $('#koderincianobjek_filter').on('change', function (e) {
            viewModel.changeEvent.changeRefreshGrid()
        });

        

        $("#penggunafilter").select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function (params) {
                    params.level = "-1,0,1"

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.text
                            d.id = d.id
                            return d
                        })
                    };
                }
            },
            theme: 'bootstrap' ,
        })

        $('#penggunafilter').on('change', function (e) {
            $("#kuasapengguna_filter").val("").trigger("change")
        });

        $("#kuasapengguna_filter").select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function (params) {
                    params.level = "1,2"
                    params.pid = $("#penggunafilter").select2('data')[0].id
                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.text
                            d.id = d.id
                            return d
                        })
                    };
                },
            },
            theme: 'bootstrap' ,
        })

        $('#kuasapengguna_filter').on('change', function (e) {
            $("#subkuasa_filter").val("").trigger("change")
        });

        $("#subkuasa_filter").select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function (params) {
                    params.level = 2
                    params.pid = $("#kuasapengguna_filter").select2('data')[0].id

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.text
                            d.id = d.id
                            return d
                        })
                    };
                },

            },
            theme: 'bootstrap' ,
        })

        $('#subkuasa_filter').on('change', function (e) {
            viewModel.changeEvent.changeRefreshGrid()
        });

        // d is Base filter
        function filterAppend(d) {
            if ($("[name=jenisbarangs_filter]").data("select2"))
                d.f_jenisbarangs = $("[name=jenisbarangs_filter]").select2("val")

            if ($("[name=kodeobjek_filter]").data("select2") && $("[name=kodeobjek_filter]").select2("data").length > 0)
                d.f_kodeobjek = $("[name=kodeobjek_filter]").select2("data")[0].kode_objek

            if ($("[name=koderincianobjek_filter]").data("select2") && $("[name=koderincianobjek_filter]").select2("data").length > 0)
                d.f_koderincianobjek = $("[name=koderincianobjek_filter]").select2("data")[0].kode_rincian_objek

            if ($("[name=kodesubrincianobjek_filter]").data("select2") && $("[name=kodesubrincianobjek_filter]").select2("data").length > 0)
                d.f_kodesubrincianobjek = $("[name=kodesubrincianobjek_filter]").select2("data")[0].kode_sub_rincian_objek

            if ($("[name=penggunafilter]").data("select2") && $("[name=penggunafilter]").select2("data").length > 0)
                d.f_penggunafilter = $("[name=penggunafilter]").select2("val")

            if ($("[name=kuasapengguna_filter]").data("select2") && $("[name=kuasapengguna_filter]").select2("data").length > 0)
                d.f_kuasapengguna_filter = $("[name=kuasapengguna_filter]").select2("val")

            if ($("[name=subkuasa_filter]").data("select2") && $("[name=subkuasa_filter]").select2("data").length > 0)
                d.f_subkuasa_filter = $("[name=subkuasa_filter]").select2("val")

            return d
        }

        function firstLoad() {
            let pemeliharaanHargaTotal = 0

            $(`#report-daftarbarang`).DataTable({    
                ajax: {
                    url: `${$("[base-path]").val()}/api/report/daftarbarang/get`,
                    dataType: "json",
                    data: (d) => {
                        d.filter = {}

                        d = filterAppend(d);

                        return d
                    },
                    'beforeSend': function (request) {
                        request.setRequestHeader("Authorization", 'Bearer ' + sessionStorage.getItem('api token'));
                    }
                },
                order : [[ 1, "asc"]],
                dom: 'Bfrtip',                
                buttons: [
                    {
                        text: 'Export',
                        extend: 'collection',
                        buttons: [
                            {
                                text: `<img src="<?= asset('images/icons/icon_xlsx_2.png') ?>" width="18" /> Excel`,
                                action: () => {
                                    const ret = [];
                                    let data = {
                                        to: 'excel'
                                    }

                                    data = filterAppend(data)

                                    for (let d in data)
                                        ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));

                                    __ajax({
                                        url: `${$("[base-path]").val()}/api/exportall/inventaris_penyusutan?${ret.join('&')}`,
                                        method: 'GET'
                                    }).then((d) => {
                                        window.open(`${$("[base-path]").val()}/${d.path}`,'blank');
                                    })
                                }
                            }
                        ]
                    },
                ],
                "drawCallback": function( settings ) {
                },
                "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                    $("td:first", nRow).html(iDisplayIndex +1);
                    $(nRow).remove();
                    return nRow;
                },
                "createdRow": function( row, data, dataIndex ) {
                    let classRow = 'even';
                    if($(row).hasClass('odd')) {
                        classRow = 'odd'
                    }
                      
                    setTimeout(() => {

                        if (data.pemeliharaan.length > 0) {
                            $(row).after(`<tr class='${classRow}'>
                                <td colspan=13>
                                    Jumlah (Rp)
                                </td>
                                <td>
                                    ${$.fn.dataTable.render.number( ',', '.', 2 ).display(parseFloat(_.sum(_.map(data.pemeliharaan, (d) => d.biaya))) + parseFloat(data.harga_satuan)) }
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>`);

                            $(row).after(`<tr class='${classRow}'>
                                <td colspan=13>
                                    Jumlah Rehabilitasi (Rp)
                                </td>
                                <td>
                                    ${$.fn.dataTable.render.number( ',', '.', 2 ).display(_.sum(_.map(data.pemeliharaan, (d) => d.biaya)))}
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>`);
                        }

                        data.pemeliharaan.forEach(element => {
                            let ele = $(row).after(`<tr class='${classRow}'>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    ${dataIndex +1}
                                </td>
                                <td colspan=3>
                                    ${element.uraian}
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>    
                                    ${$.fn.dataTable.render.number( ',', '.', 2 ).display(element.biaya) }
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    ${element.keterangan}
                                </td>
                            </tr>`);
                        });
                            
                        
                    }, 100)
                    
                },
                columns: [
                    {
                        data: 'noreg'
                    },
                    {
                        data: 'kodeid_barang'
                    },
                    {
                        data: 'noreg'
                    },
                    {
                        data: 'nama_barang'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'merk'
                    },
                    {
                        data: 'info_item'
                    },
                    {
                        data: 'perolehan'
                    },
                    {
                        data: 'bulan_perolehan'
                    },
                    
                    {
                        data: 'tahun_perolehan'
                    },
                    {
                        data: 'ukuran_barang'
                    },
                    {
                        data: 'kondisi'
                    },
                    {
                        data: 'volume'
                    },
                    {
                        data: 'harga_satuan',
                        render: $.fn.dataTable.render.number( ',', '.', 2 )
                    },
                    {
                        data: 'penyusutan_sd_tahun_sebelumnya',
                        render: $.fn.dataTable.render.number( ',', '.', 2 )
                    },
                    {
                        data: 'beban_penyusutan_perbulan',
                        render: $.fn.dataTable.render.number( ',', '.', 2 )
                    },
                    {
                        data: 'penyusutan_sd_tahun_sekarang',
                        render: $.fn.dataTable.render.number( ',', '.', 2 )
                    },
                    {
                        data: 'nilai_buku',
                        render: $.fn.dataTable.render.number( ',', '.', 2 )
                    },
                    {
                        data: 'keterangan'
                    },
                ],
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': {
                        'selectRow': true
                        }
                    }
                ],
                'select': {
                    'style': 'multi'
                },
                "processing": true,
                "serverSide": true,
            })
        }

        firstLoad();
    })
</script>
@endsection
