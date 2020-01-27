viewModel.data = Object.assign(viewModel.data, {
    formPenghapusan: ko.observable({
        kodebarang: "",
        namabarang: "",
        noreg: "",
        tglhapus: moment().format("DD-MM-YYYY"),
        kriteria: "",
        kondisi: "",
        // harga_apprisal: "",
        nosk: "",
        tglsk: moment().format("DD-MM-YYYY"),
        keterangan: "",
    }),
})


viewModel.changeEvent = Object.assign(viewModel.changeEvent, {
    refreshDatatable: () => {
        $('#penghapusan').DataTable().ajax.reload()
    }
})