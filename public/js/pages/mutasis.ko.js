viewModel.data = Object.assign(viewModel.data, {
    formMutasiDetil: ko.observable({
        'inventaris': '',
        'keterangan': ''
    })
})

viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    refreshDatatable: () => {
        $('#table-mutasi').DataTable().ajax.reload()
    }
})