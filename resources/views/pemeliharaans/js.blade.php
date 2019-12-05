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

    new inlineDatepicker(document.getElementById('tgl'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });

    new inlineDatepicker(document.getElementById('tglkontrak'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,        
    });

    
</script>

@if(isset($pemeliharaan))
<script>
    viewModel.jsLoaded.subscribe(() => {
        $("#pidinventaris_pemeliharaan").LookupTable().setValAjax("<?= url('api/inventaris', [$pemeliharaan->pidinventaris]) ?>").then((d) => {})
    })
</script>
@endif