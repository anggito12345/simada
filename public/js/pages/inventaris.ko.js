viewModel.data = Object.assign(viewModel.data, {
    pidinventaris: "",
    tipeKib: ko.observable(),
    "KIB F": ko.observable({
        koordinatlokasi: '',
        koordinattanah: {},
        idkota: "",
        idkecamatan: null,
        idkelurahan: null,
        beton: 0,
        bertingkat: 0,
    }),
    "KIB E": ko.observable({
    }),
    "KIB D": ko.observable({
        koordinatlokasi: '',
        koordinattanah: {},
        idkota: "",
        idkecamatan: null,
        idkelurahan: null,
    }),
    "KIB C": ko.observable({
        koordinatlokasi: '',
        koordinattanah: {},
        idkota: "",
        idkecamatan: null,
        idkelurahan: null,
        beton: 0,
        bertingkat: 0,
    }),
    "KIB B": ko.observable({
    }),
    "KIB A": ko.observable({
        idkota: null,
        idkecamatan: null,
        alamat: '',
        luas: 0,
        koordinatlokasi: '',
        koordinattanah:'',
        tgl_sertifikat: moment().format("DD-MM-YYYY")
    }),
    urlEachKIB: (newVal) => {
        return `/api/detil${newVal.replace(/ /g,"").toLowerCase()}get`
    }
})

viewModel.data.tipeKib.subscribe((newVal) => {
    if (viewModel.data.pidinventaris == "") {
        return        
    }
    __ajax({
        "method": "GET",
        "url": `${$('[base-path]').val()}${viewModel.data.urlEachKIB(newVal)}/${viewModel.data.pidinventaris}`,
        "dataType": "json",
    }).then((response) => {
        if (response == null) {
            response = {}
        }
        
        if (newVal == 'KIB A') {
            const tglSertifikat = document.getElementById('tgl_sertifikat')
            tglSertifikat.value = response.tgl_sertifikat
            tglSertifikat.dispatchEvent(new Event('change'))

            App.Helpers.defaultSelect2(
                $("#idkota"), `${$('[base-path]').val()}/api/alamats/${response.idkota}`,
                "id",
                "nama",
                () => {
                    App.Helpers.defaultSelect2(
                        $("#idkecamatan"), 
                        `${$('[base-path]').val()}/api/alamats/${response.idkecamatan}`,
                        "id",
                        "nama",
                        () => {
                            App.Helpers.defaultSelect2($("#idkelurahan"), `${$('[base-path]').val()}/api/alamats/${response.idkelurahan}`,"id","nama", () => {
                                viewModel.data[newVal](response)
                            })
                        }
                    )
                }
            )

            
        } else if (newVal == 'KIB B') {            
            App.Helpers.defaultSelect2($('#merk-detilmesin'), `${$('[base-path]').val()}/api/merkbarangs/${response.merk}`,"id","nama",() => {

                viewModel.data[newVal](response)
            })
        } else if (newVal == 'KIB C') {
            const tgldokumen = document.getElementById('tgldokumen')
            tgldokumen.value = response.tgldokumen
            tgldokumen.dispatchEvent(new Event('change'))

            
            App.Helpers.defaultSelect2($('#kodetanah'), `${$('[base-path]').val()}/api/detiltanahs/${response.kodetanah}`,"id",["nama_kota",", ", "nama_kecamatan", ", ", "nomor_sertifikat"], () => {
                App.Helpers.defaultSelect2($('#statustanah'), `${$('[base-path]').val()}/api/statustanahs/${response.statustanah}`,"id","nama", () => {
                    App.Helpers.defaultSelect2(
                        $("#idkota-detilbangunan"), `${$('[base-path]').val()}/api/alamats/${response.idkota}`,
                        "id",
                        "nama",
                        () => {
                            App.Helpers.defaultSelect2(
                                $("#idkecamatan-detilbangunan"), 
                                `${$('[base-path]').val()}/api/alamats/${response.idkecamatan}`,
                                "id",
                                "nama",
                                () => {
                                    App.Helpers.defaultSelect2($("#idkelurahan-detilbangunan"), `${$('[base-path]').val()}/api/alamats/${response.idkelurahan}`,"id","nama", () => {
                                        viewModel.data[newVal](response)
                                    })
                                }
                            )
                        }
                    )
                })
            })            
            
        } else if (newVal == 'KIB D') {
            const tgldokumen = document.getElementById('tgldokumen-detiljalan')
            tgldokumen.value = response.tgldokumen
            tgldokumen.dispatchEvent(new Event('change'))

            
            App.Helpers.defaultSelect2($('#kodetanah-detiljalan'), `${$('[base-path]').val()}/api/detiltanahs/${response.kodetanah}`,"id",["nama_kota",", ", "nama_kecamatan", ", ", "nomor_sertifikat"], () => {
                App.Helpers.defaultSelect2($('#statustanah-detiljalan'), `${$('[base-path]').val()}/api/statustanahs/${response.statustanah}`,"id","nama", () => {
                    App.Helpers.defaultSelect2(
                        $("#idkota-detiljalan"), `${$('[base-path]').val()}/api/alamats/${response.idkota}`,
                        "id",
                        "nama",
                        (t) => {
                            console.log(t)
                            App.Helpers.defaultSelect2(
                                $("#idkecamatan-detiljalan"), 
                                `${$('[base-path]').val()}/api/alamats/${response.idkecamatan}`,
                                "id",
                                "nama",
                                () => {
                                    App.Helpers.defaultSelect2($("#idkelurahan-detiljalan"), `${$('[base-path]').val()}/api/alamats/${response.idkelurahan}`,"id","nama", () => {
                                        viewModel.data[newVal](response)
                                    })
                                }
                            )
                        }
                    )
                })
            })                        
        } else if (newVal == 'KIB E') {            
            viewModel.data[newVal](response)
        } else if (newVal == 'KIB F') {
            const tgldokumen = document.getElementById('tgldokumen-detilkonstruksi')
            tgldokumen.value = response.tgldokumen
            tgldokumen.dispatchEvent(new Event('change'))

            const tglmulai = document.getElementById('tglmulai-detilkonstruksi')
            tglmulai.value = response.tglmulai
            tglmulai.dispatchEvent(new Event('change'))

            
            App.Helpers.defaultSelect2($('#kodetanah-detilkonstruksi'), `${$('[base-path]').val()}/api/detiltanahs/${response.kodetanah}`,"id",["nama_kota",", ", "nama_kecamatan", ", ", "nomor_sertifikat"], () => {
                App.Helpers.defaultSelect2($('#statustanah-detilkonstruksi'), `${$('[base-path]').val()}/api/statustanahs/${response.statustanah}`,"id","nama", () => {
                    App.Helpers.defaultSelect2(
                        $("#idkota-detilkonstruksi"), `${$('[base-path]').val()}/api/alamats/${response.idkota}`,
                        "id",
                        "nama",
                        () => {
                            App.Helpers.defaultSelect2(
                                $("#idkecamatan-detilkonstruksi"), 
                                `${$('[base-path]').val()}/api/alamats/${response.idkecamatan}`,
                                "id",
                                "nama",
                                () => {
                                    App.Helpers.defaultSelect2($("#idkelurahan-detilkonstruksi"), `${$('[base-path]').val()}/api/alamats/${response.idkelurahan}`,"id","nama", () => {
                                        viewModel.data[newVal](response)
                                    })
                                }
                            )
                        }
                    )
                })
            })            
            
        }
    })
})