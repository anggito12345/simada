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

            console.log(document.getElementById('dokumen').files)
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
    countMutasiWorkflow: () => {
        __ajax({
            url: `${$("[base-path]").val()}/api/inventaris_mutasi/count`,
            dataType: 'json',
        }).then((d) => {
            viewModel.data.count(d)
        })
    }
})