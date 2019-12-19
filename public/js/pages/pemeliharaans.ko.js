viewModel.data = Object.assign(viewModel.data, {
    formPemeliharaan: ko.observable({
        pidinventaris: ''
    })
})

viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    refreshDatatable: () => {
        $('#pemeliharaan-table').DataTable().ajax.reload()
    }
})