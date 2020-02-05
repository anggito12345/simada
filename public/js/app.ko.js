let viewModel = {
    pages: {
        loadJs: []
    },    
    data: {
        title: "SIMADA",        
        informations: {
            kibA: {
                url: "detiltanahs",
                string1: "KIB A",
                string2: "detil_tanah",
                string3: "detiltanah"
            },
            kibB: {
                url: "detilmesins",
                string1: "KIB B",
                string2: "detil_mesin",
                string3: "detilmesin"
            },
            kibC: {
                url: "detilbangunans",
                string1: "KIB C",
                string2: "detil_bangunan",
                string3: "detilbangunan"
            },
            kibD: {
                url: "detiljalans",
                string1: "KIB D",
                string2: "detil_jalan",
                
            },
            kibE: {
                url: "detilasets",
                string1: "KIB E",
                string2: "detil_aset_lainnya"
            },
            kibF: {
                url: "detilkonstruksis",
                string1: "KIB F",
                string2: "detil_konstruksi"
            }
        }
    },

    services: {

    },

    modal: {

    },
    
    clickEvent: {

    },

    changeEvent: {

    },
    
    collections: {

    },

    helpers : {

        buildKodeBarang: (d) => {
            let appendKode = ""
            if (d.kode_akun != "" && d.kode_akun != null) {
                appendKode += d.kode_akun
            }

            if (d.kode_kelompok != "" && d.kode_kelompok != null) {
                appendKode += "." + d.kode_kelompok
            }

            if (d.kode_jenis != "" && d.kode_jenis != null) {
                appendKode += "." + d.kode_jenis
            }

            if (d.kode_objek != "" && d.kode_objek != null) {
                appendKode += "." + d.kode_objek
            }

            if (d.kode_rincian_objek != "" && d.kode_rincian_objek != null) {
                appendKode += "." + d.kode_rincian_objek
            }

            if (d.kode_sub_rincian_objek != "" && d.kode_sub_rincian_objek != null) {
                appendKode += "." + d.kode_sub_rincian_objek
            }

            if (d.kode_sub_sub_rincian_objek != "" && d.kode_sub_sub_rincian_objek != null) {
                appendKode += "." + d.kode_sub_sub_rincian_objek
            }

            return appendKode
        }

    },
    jsLoaded: ko.observable(false)
}


