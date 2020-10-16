

viewModel.data.urlEachKIB = (newVal) => {
    return `/api/detil${newVal.replace(/ /g,"").toLowerCase()}get`
}

let sensus = {
    step: {
        3: {
           steplist: [
                {
                    label: "pilih opsi",
                    step: 1,
                },
                {
                    label: "isi form",
                    step: 3
                }
           ]
        },
        4: {
            steplist: [
                 {
                     label: "Pilih opsi",
                     step: 1,
                 },
                 {
                    label: "Pilih inventaris",
                    step: 2
                 },
                 {
                     label: "isi form",
                     step: 3
                 }
            ]
        },
        0: {
            steplist: [
                {
                    label: "Pilih opsi",
                    step: 1,
                },
                {
                   label: "Pilih opsi status Tidak Ada",
                   step: 2
                },
                {
                    label: "Pilih inventaris",
                    step: 3
                },
                {
                    label: "Isi form",
                    step: 4
                }
            ]
        },
        1: {
            steplist: [
                {
                    label: "Pilih opsi",
                    step: 1,
                },
                {
                   label: "Pilih opsi status Ubah Satuan",
                   step: 2
                },
                {
                    label: "Pilih inventaris",
                    step: 3
                },
                {
                    label: "isi form",
                    step: 4
                }
            ]
        }
    },
    data: {
        dropdownDataSource: {
            statusBarang: ko.observableArray([])
        },
        select2Objects: {
            kodeTujuan: null
        },
        statics: {
            idGridInventaris: 'table-inventaris',
            idGridSensus: 'table-sensus',
            idModalSensus: 'modal-sensus',
            idInputFileSK: 'file-sensus-sk'
        },
        step: ko.observable(1),
        fileGallery: null,
        form: {
            idinventaris: ko.observable(),
            status_barang: ko.observable(""),
            no_sk: ko.observable(""),
            tgl_sk: ko.observable(""),
            status_barang_hilang: ko.observable(""),
            status_ubah_satuan: ko.observable("")
        }
    },
    methods: {
        changeStatusBarang: () => {
            setTimeout(() => {
                if (sensus.data.form.status_barang() == 3) {
                    sensus.data.form.idinventaris(-1)
                    sensus.data.step(3)
                    sensus.data.step.notifySubscribers()
                } else {
                    sensus.data.step(2)
                    sensus.data.step.notifySubscribers()
                }
            }, 500);
        },
        showSkForm: (choosen, tipe) => {
            sensus.data.step(3)
            sensus.data.form[tipe](choosen)
        },
        backToStep: (step) => {
            if (sensus.data.form.status_barang() == '3') {
                step = 1
            } else if (sensus.data.form.status_barang() <= 1) {

            }

            sensus.data.step(step)

        },
        nextStep: (step) => {

            if(step == 2) {
                sensus.data.form.status_barang.notifySubscribers()
            }


            if(step == 3) {
                if (sensus.data.form.status_barang() == 4) {
                    // status barang barang tercatat
                    if ($(`#${sensus.data.statics.idGridInventaris}`).DataTable().rows('.selected').data().toArray().length != 1) {
                        swal.fire({
                            text: 'Silahkan Pilih 1 inventaris',
                            icon: 'warning'
                        })
                        return;
                    }
                }

                if (sensus.data.form.status_barang() <= 1) {
                    if ($(`#${sensus.data.statics.idGridInventaris}`).DataTable().rows('.selected').data().toArray().length != 1) {
                        swal.fire({
                            text: 'Silahkan Pilih 1 inventaris',
                            icon: 'warning'
                        })
                        return;
                    }
                    step = 4
                }
            }
            sensus.data.step(step)
            sensus.data.step.notifySubscribers()

        },
        reloadGrid: () => {
            $(`#${sensus.data.statics.idGridSensus}`).DataTable().ajax.reload();
        },
        loadGrid: () => {
            $(`#${sensus.data.statics.idGridSensus}`).DataTable({
                "ajax": {
                    "url": "inventarisSensuses",
                    "dataSrc": 'data',
                    'data' : function(d) {

                        d.jenis_sensus = $("[name=jenis_sensus]").val()

                        delete d.search.regex;

                        recFilter = d
                    }
                },
                "processing": true,
                "serverSide": true,
                "createdRow": function( row, data, dataIndex){
                    console.log(data)
                    if( data['status_approval'] ==  `STEP-2`){
                        $(row).addClass('bg-green');
                    }
                },
                columns:[{
                    'data': 'nama',
                    'title': 'Nama Barang'
                },{
                    'data': 'noreg',
                    'title': 'No Registrasi'
                },
                {
                    'data': 'kode_barang',
                    'title': 'Kode Barang'
                },
                {
                    'data': 'tanggal_sk',
                    'title': 'Tanggal Sensus'
                },
                {
                    'data': 'status_barang_',
                    'title': 'Jenis Barang'
                }]
            })
        },
        storeSensus: () => {
            let formData = new FormData()
            let item = ko.mapping.toJS(sensus.data.form)
            for ( var key in item ) {
                formData.append(key, item[key]);
            }
            let selectedRowGrid = $(`#${sensus.data.statics.idGridInventaris}`).DataTable().rows('.selected').data().toArray()[0]
            //if not barang tidak tercatat
            if (sensus.data.form.status_barang() != 3) {
                formData.append('idinventaris', selectedRowGrid.id)
            }

            for (let index = 0; index < sensus.data.fileGallery.fileList().length; index++) {
                const d = sensus.data.fileGallery.fileList()[index]
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

                //formData.append(`dokumen_metadata_id_inventaris[${index}]`, $("#table-inventaris").DataTable().rows('.selected').data()[0].id)
            }
            __ajax({
                url: `api/sensus`,
                method: 'POST',
                processData: false,
                contentType: false,
                data:formData
            }).then((d) => {
                swal.fire({
                    type: 'success',
                    text: 'Sensus berhasil dilakukan',
                    title: 'Ubah'
                })
                $(`#${sensus.data.statics.idModalSensus}`).modal('hide')
                $(`#${sensus.data.statics.idGridInventaris}`).DataTable().ajax.reload()
                $(`#${sensus.data.statics.idGridSensus}`).DataTable().ajax.reload()

                if(sensus.data.form.status_barang() == 0 && (sensus.data.form.status_barang_hilang() == 1 || sensus.data.form.status_barang_hilang() == 2)) {

                    window.location = `reklas/create?`+
                    `id_awal=${selectedRowGrid.id}&`+
                    `id_tujuan=${$("select[name=kode_tujuan]").select2('data')[0].id}&`+
                    `nama_awal=${selectedRowGrid.kodebarang + ' - ' + selectedRowGrid.nama_rek_aset}&`+
                    `nama_tujuan=${$("select[name=kode_tujuan]").select2('data')[0].text}`
                } else if (sensus.data.form.status_barang() == 1 && sensus.data.form.status_ubah_satuan() == 1) {
                    window.location = `pemeliharaans/create?`+
                    `idinventaris=${selectedRowGrid.id}&` +
                    `tgldibukukan=${selectedRowGrid.tgl_dibukukan}&` +
                    `hargasatuan=${selectedRowGrid.harga_satuan}`
                } else if (sensus.data.form.status_barang() == 3) {
                    window.location= 'inventaris/create?is_sensus=' + d.id
                } else if (sensus.data.form.status_barang() == 4) {
                    window.location= `inventaris/${selectedRowGrid.id}/edit?is_sensus=${d.id}`
                }
            })
        },
        onSensus: () => {

            $(`#${sensus.data.statics.idModalSensus}`).modal('show')
            /*if ($(`#${sensus.data.statics.idGridInventaris}`).DataTable().rows('.selected').count()!= 1 ) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih 1 yang ingin disensus',
                    title: 'Ubah'
                })
            } else {


            }*/
        }
    }
}

sensus.data.form.status_barang.subscribe(() => {




})


$(document).ready(() => {
    sensus.data.select2Objects.kodeTujuan = $("select[name=kode_tujuan]").select2({
        ajax: {
            url: "api/barangs/get?length=10",
            dataType: 'json',
            headers: {
                'Authorization':'Bearer ' + sessionStorage.getItem('api token'),
            },

            data: function (params) {
                params['search-lookup'] = {
                    "nama_rek_aset": {
                        operator: 'like',
                        value: params.term === undefined ? '' : params.term,
                        logic: 'or',
                        group: 'filter'
                    },
                    "CONCAT(kode_akun,'.',kode_kelompok,'.',kode_jenis,'.',kode_objek,'.', kode_rincian_objek, '.', kode_sub_rincian_objek,'.',kode_sub_sub_rincian_objek)": {
                        operator: 'like',
                        value: params.term === undefined ? '' : params.term,
                        logic: 'or',
                        group: 'filter'
                    },
                }

                return params;
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data.map((d) => {
                        d.text = `${viewModel.helpers.buildKodeBarang(d)} - ${d.nama_rek_aset}`;
                        return d
                    })
                };
            }
        },
        dropdownParent: $(`#${sensus.data.statics.idModalSensus}`),
        theme: 'bootstrap' ,
    });

    const tglDibukukanInline = new inlineDatepicker(document.getElementById('tgl_sk'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });

    sensus.data.fileGallery = new FileGallery(document.getElementById(sensus.data.statics.idInputFileSK), {
        title: 'File Dokumen',
        maxSize: 25000000,
        onDelete: () => {
            return new Promise((resolve, reject) => {
                let checkIfIdExist = fileGallery.checkedRow().filter((d) => {
                    return d.id != undefined
                })
                if (checkIfIdExist.length < 1) {
                    resolve(true)
                    return
                }
                __ajax({
                    method: 'DELETE',
                    url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                            return d.id
                        }),
                }).then((d) => {
                    resolve(true)
                    funcGetDokumenFileList()
                })
            })
        }
    })




    sensus.methods.loadGrid()
})
