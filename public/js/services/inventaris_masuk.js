viewModel.services = Object.assign(viewModel.services, {
    approveMutasi: (tableListSelected, step) => {

        if (step === 'STEP-1' || step === 'STEP-3') {
            return __ajax({
                url: `${$("[base-path]").val()}/api/inventaris_mutasi/approvements`,
                method: 'PATCH',
                data: {
                    items: JSON.stringify(tableListSelected),
                    step: step
                },
                dataType: 'json'
            })
        } else if (step === 'STEP-2') {
            let formData = new FormData($('#form-bpkad-mutasi')[0])

            dokumenPersetujuanMutasiBpkad.fileList().forEach((d, index) => {
                if (d.rawFile) {
                    formData.append(`dokumen_persetujuan_mutasi[${index}]`, d.rawFile)
                } else {
                    formData.append(`dokumen_persetujuan_mutasi[${index}]`, false)
                }

                let keys = Object.keys(d)

                keys.forEach((key) => {
                    if (key == 'rawFile') {
                        return
                    }
                    formData.append(`dokumen_persetujuan_mutasi_metadata_${key}[${index}]`, d[key])
                })

                return d.rawFile
            });

            formData.append('items', JSON.stringify(tableListSelected))
            formData.append('step', step)

            return __ajax({
                url: `${$("[base-path]").val()}/api/inventaris_mutasi/approvements`,
                method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
            })
        }

    },
    approveReklas: (tableListSelected, step) => {

        return __ajax({
            url: `${$("[base-path]").val()}/api/reklas/approvements`,
            method: 'POST',
            data: {
                items: JSON.stringify(tableListSelected),
                step: step
            },
            dataType: 'json',
        })
    },
    approveSensus: (tableListSelected, step) => {
        let formData = new FormData($('#form-bpkad-sensus')[0])

        dokumenMutasiCancel.fileList().forEach((d, index) => {
            if (d.rawFile) {
                formData.append(`dokumen_sensus_metadata_[${index}]`, d.rawFile)
            } else {
                formData.append(`dokumen_sensus_metadata_[${index}]`, false)
            }

            let keys = Object.keys(d)

            keys.forEach((key) => {
                if (key == 'rawFile') {
                    return
                }
                formData.append(`dokumen_sensus_metadata_${key}[${index}]`, d[key])
            })

            return d.rawFile
        });

        console.log(tableListSelected)


        formData.append('items', JSON.stringify(tableListSelected))
        formData.append('step', step)

        return __ajax({
            url: `${$("[base-path]").val()}/api/sensus_/approvements`,
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
        })
    },
    cancelMutasi: (tableListSelected, step) => {
        let formData = new FormData($('#form-bpkad-mutasi')[0])

        dokumenMutasiCancel.fileList().forEach((d, index) => {
            if (d.rawFile) {
                formData.append(`dokumen_mutasi_cancel[${index}]`, d.rawFile)
            } else {
                formData.append(`dokumen_mutasi_cancel[${index}]`, false)
            }

            let keys = Object.keys(d)

            keys.forEach((key) => {
                if (key == 'rawFile') {
                    return
                }
                formData.append(`dokumen_mutasi_cancel_metadata_${key}[${index}]`, d[key])
            })

            return d.rawFile
        });


        formData.append('items', JSON.stringify(tableListSelected))
        formData.append('step', step)
        formData.append('cancel_note', document.getElementById('cancel_note').value)

        return __ajax({
            url: `${$("[base-path]").val()}/api/inventaris_mutasi/cancel`,
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
        })
    },
    approvementPenghapusanBPKAD: (tableListSelected, step) => {
        let formData = new FormData($('#form-penghapusan-mutasi')[0])

        switch (step) {
            case 'STEP-1':
                dokumenPenghapusan.fileList().forEach((d, index) => {
                    if (d.rawFile) {
                        formData.append(`dokumen_penghapusan[${index}]`, d.rawFile)
                    } else {
                        formData.append(`dokumen_penghapusan[${index}]`, false)
                    }

                    let keys = Object.keys(d)

                    keys.forEach((key) => {
                        if (key == 'rawFile') {
                            return
                        }
                        formData.append(`dokumen_penghapusan_metadata_${key}[${index}]`, d[key])
                    })

                    return d.rawFile
                });

                formData.append('nomor_surat', document.getElementById('nomor-persetujuan-step1').value)
                /* formData.append('nosk', document.getElementById('nosk').value) */
                formData.append('tglsp', document.getElementById('tglsk').value)
                formData.append('keterangan', document.getElementById('keterangan').value)
                break;

            case 'STEP-2':
                beritaAcaraPenghapusan.fileList().forEach((d, index) => {
                    if (d.rawFile) {
                        formData.append(`berita_acara_penghapusan[${index}]`, d.rawFile)
                    } else {
                        formData.append(`berita_acara_penghapusan[${index}]`, false)
                    }

                    let keys = Object.keys(d)

                    keys.forEach((key) => {
                        if (key == 'rawFile') {
                            return
                        }
                        formData.append(`berita_acara_penghapusan_metadata_${key}[${index}]`, d[key])
                    })

                    return d.rawFile
                });
                formData.append('nomor_berita_acara', document.getElementById('nomor-berita-acara-step2').value)
                /* formData.append('nosk', document.getElementById('nosk').value) */
                formData.append('tglba', document.getElementById('tglsk').value)
                break;

            case 'STEP-3':
                dokumenValidasiPenghapusan.fileList().forEach((d, index) => {
                    if (d.rawFile) {
                        formData.append(`dokumen_validasi_penghapusan[${index}]`, d.rawFile)
                    } else {
                        formData.append(`dokumen_validasi_penghapusan[${index}]`, false)
                    }

                    let keys = Object.keys(d)

                    keys.forEach((key) => {
                        if (key == 'rawFile') {
                            return
                        }
                        formData.append(`dokumen_validasi_penghapusan_metadata_${key}[${index}]`, d[key])
                    })

                    return d.rawFile
                });
                formData.append('nosk', document.getElementById('nosk').value)
                formData.append('tglsk', document.getElementById('tglsk').value)
                break;

            default:
                // no action
                break;
        }

        formData.append('items', JSON.stringify(tableListSelected))
        formData.append('step', step)

        return __ajax({
            url: `${$("[base-path]").val()}/api/inventaris_penghapusan/approvements`,
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
        })
    },
    countSensusWorkflow: () => {
        __ajax({
            url: `${$("[base-path]").val()}/api/inventaris_sensus/count`,
            dataType: 'json',
        }).then((d) => {
            viewModel.data.countSensus(d)
        })
    },
    countMutasiWorkflow: () => {
        __ajax({
            url: `${$("[base-path]").val()}/api/inventaris_mutasi/count`,
            dataType: 'json',
        }).then((d) => {
            viewModel.data.count(d)
        })
    },
    countPenghapusan: () => {
        __ajax({
            url: `${$("[base-path]").val()}/api/inventaris_penghapusan/count`,
            dataType: 'json',
        }).then((d) => {
            viewModel.data.countPenghapusan(d)
        })
    },
    countReklas: () => {
        __ajax({
            url: `${$("[base-path]").val()}/api/reklas/count`,
            dataType: 'json',
        }).then((d) => {
            viewModel.data.countReklas(d)
        })
    }
})
