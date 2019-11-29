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

            formData.append('dokumen[]', document.getElementById('dokumen').files[0])
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
    approvementPenghapusanBPKAD: (tableListSelected) => {
        let formData = new FormData($('#form-penghapusan-mutasi')[0])
        formData.append('dokumen[]', document.getElementById('dokumen-penghapusan').files[0])
        formData.append('items', JSON.stringify(tableListSelected))
        
        return __ajax({
            url: `${$("[base-path]").val()}/api/inventaris_penghapusan/approvements`,
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
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
    }
})