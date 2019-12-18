viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    refreshDatatable: () => {
        $('#rka-table').DataTable().ajax.reload()
    }
})