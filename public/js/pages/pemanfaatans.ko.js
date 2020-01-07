viewModel.data = Object.assign(viewModel.data, {
    formPemanfaatan: ko.observable({
        kodebarang: "",
        namabarang: "",
        noreg: "",
        tglhapus: moment().format("DD-MM-YYYY"),
        kriteria: "",
        kondisi: "",
        harga_apprisal: "",
        nosk: "",
        tglsk: moment().format("DD-MM-YYYY"),
        keterangan: "",
    }),
    tipeKontribusi: ko.observable()
})

viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    refreshDatatable: () => {
        $('#pemanfaatans-table').DataTable().ajax.reload()
    }
})