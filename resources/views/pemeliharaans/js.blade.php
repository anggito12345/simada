<script>
    if ($("#pidinventaris_pemeliharaan").length > 0) {

        $("#pidinventaris_pemeliharaan").LookupTable({
            DataTable: {
                ajax: {
                    url: $("[base-path]").val() + "/inventaris",
                    dataSrc: 'data',
                    data: (d) => {
                        return d
                    },
                    headers: {
                        'Authorization': 'Bearer ' + sessionStorage.getItem('api token'),
                    }
                },
                columns: [{
                        data: 'id',
                        title: 'ID'
                    },{
                        data: 'harga_satuan',
                        title: 'Nilai Perolehan'
                    },{
                        data: 'noreg',
                        title: 'Nomor Registrasi'
                    },
                    {
                        data: 'nama_rek_aset',
                        'name': 'm_barang.nama_rek_aset',
                        title: 'Nama Barang'
                    },
                    {
                        data: 'tahun_perolehan',
                        title: 'Tahun Perolehan'
                    },

                ],
                "processing": true,
                "serverSide": true,
                "searching": true,
                responsive: true,
                custom: {
                    typeInput: 'radio',
                    textField: 'nama_rek_aset',
                    valueField: 'id',
                    autoClose: false,
                    filters: [
                        // { name: "nama_rek_aset", type:"text", title: "Ketik nama barang yang dicari"},
                    ]
                }
            }
        })
    }

    var url_string = window.location.href; //window.location.href
    var url = new URL(url_string);
    var idbarang = url.searchParams.get("idbarang");
    var tgldibukukan = url.searchParams.get("tgldibukukan");
    if (idbarang) {
        $("#pidinventaris_pemeliharaan").LookupTable().setValAjax("<?= url('api/barangs') ?>/"+idbarang).then((d) => {
        })
    }

    if (tgldibukukan) {
        $('#tgl').val(tgldibukukan)
    }

    let tglPemeliharaan = new inlineDatepicker(document.getElementById('tgl'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });


    new inlineDatepicker(document.getElementById('tglkontrak'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });





    function doSave(isDraft) {
        Swal.fire({
            title: 'Anda yakin?',
            html: `Data akan tersimpan <b>${isDraft ? "" : "tidak"} sebagai draft</b>`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                $('[name=draft]').val(isDraft ? '1' : '')
                $('#pemeliharaan-form').submit()
            }
        })

    }
</script>

@if(isset($pemeliharaan))
<script>
    $("#pidinventaris_pemeliharaan").LookupTable().setValAjax("<?= url('api/inventaris', [$pemeliharaan->pidinventaris]) ?>").then((d) => {})
</script>
@endif
