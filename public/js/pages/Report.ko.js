viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    // ....
    changeRefreshGrid: () => {
      $("#report-daftarbarang").DataTable().ajax.reload();
    }
})