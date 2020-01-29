viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    refreshDatatable: () => {
        $('#koreksi-table').DataTable().ajax.reload()
    }
})