viewModel.data = Object.assign(viewModel.data, {
    pidinventaris: "",
    tipeKib: ko.observable(),
    "KIB A": ko.observable({
        idkota: null,
        idkecamatan: null,
        alamat: '',
        luas: 0,
        koordinatlokasi: '',
        koordinattanah:'',
        tgl_sertifikat: moment().format("DD-MM-YYYY")
    }),
    urlEachKIB: {
        'KIB A': `/api/detiltanahsget`,
    }
})

viewModel.data.tipeKib.subscribe((newVal) => {
    if (viewModel.data.pidinventaris == "") {
        return        
    }
    __ajax({
        "method": "GET",
        "url": `${$('[base-path]').val()}${viewModel.data.urlEachKIB[newVal]}/${viewModel.data.pidinventaris}`,
        "dataType": "json",
    }).then((response) => {
        viewModel.data[newVal](response)
        if (newVal == 'KIB A') {
            const tglSertifikat = document.getElementById('tgl_sertifikat')
            tglSertifikat.value = response.tgl_sertifikat
            tglSertifikat.dispatchEvent(new Event('change'))

        }
        
    })
})