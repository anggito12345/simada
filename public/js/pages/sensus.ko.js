viewModel.data.urlEachKIB = (newVal) => {
    return `/api/detil${newVal.replace(/ /g,"").toLowerCase()}get`
}

let sensus = {
    data: {

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
            status_barang_hilang: ko.observable("")
        }
    },
    methods: {
        showSkForm: (choosen) => {
            sensus.data.step(3)
            sensus.data.form.status_barang_hilang(choosen)
        },
        backToStep: (step) => {
            sensus.data.step(step)
        },
        nextStep: (step) => {
            sensus.data.step(step)

        },
        loadGrid: () => {
            $(`#${sensus.data.statics.idGridSensus}`).DataTable({
                "ajax": {
                    "url": "inventarisSensuses",
                    "dataSrc": 'data',
                },
                "processing": true,
                "serverSide": true,
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
                    'data': 'status_barang_hilang',
                    'title': 'Status Barang Menghilang'
                },
                {
                    'data': 'status_barang',
                    'title': 'Status Barang'
                }]
            })
        },
        storeSensus: () => {
            let formData = new FormData()
            let item = ko.mapping.toJS(sensus.data.form)
            for ( var key in item ) {
                formData.append(key, item[key]);
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
            })
        },
        onSensus: () => {
            if ($(`#${sensus.data.statics.idGridInventaris}`).DataTable().rows('.selected').count()!= 1 ) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih 1 yang ingin disensus',
                    title: 'Ubah'
                })
            } else {
                sensus.data.form.idinventaris(parseInt($(`#${sensus.data.statics.idGridInventaris}`).DataTable().rows('.selected').data().toArray()[0].id))
                $(`#${sensus.data.statics.idModalSensus}`).modal('show')

            }
        }
    }
}


sensus.data.form.status_barang.subscribe(() => {
    sensus.data.step(2)
    sensus.data.step.notifySubscribers()
})


$(document).ready(() => {
    $(`#${sensus.data.statics.idModalSensus}`).on('shown.bs.modal', function () {
        let keys = Object.keys(sensus.data.form)
        $.each(keys, (i, s) => {
            if (s != "idinventaris") {
                sensus.data.form[s]("")
            }

        })

        sensus.data.step(1)
    })

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
