let sensus = {
    data: {

        statics: {
            idGridInventaris: 'table-inventaris',
            idModalSensus: 'modal-sensus',
            idInputFileSK: 'file-sensus-sk'
        },
        step: ko.observable(1),
        form: {
            idinventaris: ko.observable(),
            status_barang: ko.observable(""),
            no_sk: ko.observable(""),
            tgl_sk: ko.observable(""),
            item_miss: ko.observable("")
        }
    },
    methods: {
        showSkForm: (choosen) => {
            sensus.data.step(3)
            sensus.data.form.item_miss(choosen)
        },
        backToStep: (step) => {
            sensus.data.step(step)
        },
        nextStep: (step) => {
            sensus.data.step(step)

        },
        storeSensus: () => {
            __ajax({
                url: `api/sensus`,
                method: 'POST',
                dataType: 'JSON',
                data: JSON.stringify(ko.mapping.toJSON(sensus.data.form))
            }).then((d) => {
                console.log(d)
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

    const tglDibukukanInline = new inlineDatepicker(document.getElementById('tgl_sk'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });

    let fileGallery = new FileGallery(document.getElementById(sensus.data.statics.idInputFileSK), {
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
})
