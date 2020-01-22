viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    refreshDatatable: () => {
        $('#reklas-table').DataTable().ajax.reload()
    }
})