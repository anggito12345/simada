viewModel.data = Object.assign(viewModel.data, {

    urlEachKIB: (newVal) => {
        return `/api/detil${newVal.replace(/ /g,"").toLowerCase()}get`
    }
})

let dokumenKronologisGalery = [];

let isReady = {

}


new inlineDatepicker(document.getElementById('tglsk'), {
    format: 'DD-MM-YYYY',
    buttonClear: true,
});

function onDokumenPenghapusanGetFiles(foreignId, callback) {
    return __ajax({
        method: 'GET',
        url: "<?= url('api/system_uploads') ?>",
        data: {
            jenis: 'penghapusan-step1',
            foreign_field: 'id',
            foreign_id: foreignId,
            foreign_table: 'inventaris_penghapusan',
        },
    }).then((files) => {
        dokumenPenghapusan.fileList(files);
        callback();
    });
}

const dokumenPenghapusan = new FileGallery(document.getElementById('dokumen-penghapusan'), {
    title: 'Dokumen',
    accept: `${App.Constant.MimeOffice}|image/*`,
    onDelete: () => {
        return new Promise((resolve, reject) => {
            let checkIfIdExist = dokumenPenghapusan.checkedRow().filter((d) => {
                return d.id != undefined
            })
            if (checkIfIdExist.length < 1) {
                resolve(true)
                return
            }
            __ajax({
                method: 'DELETE',
                url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                    return d.id
                }),
            }).then((d) => {
                resolve(true)
                onDokumenPenghapusanGetFiles(checkIfIdExist[0].foreign_id, () => {})
            })
        })
    }
});

function onBeritaAcaraPenghapusanGetFiles(foreignId, callback) {
    return __ajax({
        method: 'GET',
        url: "<?= url('api/system_uploads') ?>",
        data: {
            jenis: 'penghapusan-step2',
            foreign_field: 'id',
            foreign_id: foreignId,
            foreign_table: 'inventaris_penghapusan',
        },
    }).then((files) => {
        dokumenPenghapusan.fileList(files);
        callback();
    });
}

const beritaAcaraPenghapusan = new FileGallery(document.getElementById('berita-acara'), {
    title: 'Dokumen',
    accept: `${App.Constant.MimeOffice}|image/*`,
    onDelete: () => {
        return new Promise((resolve, reject) => {
            let checkIfIdExist = beritaAcaraPenghapusan.checkedRow().filter((d) => {
                return d.id != undefined
            })
            if (checkIfIdExist.length < 1) {
                resolve(true)
                return
            }
            __ajax({
                method: 'DELETE',
                url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                    return d.id
                }),
            }).then((d) => {
                resolve(true)
                onBeritaAcaraPenghapusanGetFiles(checkIfIdExist[0].foreign_id, () => {})
            })
        })
    }
});

const dokumenSensus = new FileGallery(document.getElementById('dokumen-sensus-bpkad'), {
    title: 'Dokumen',
    onDelete: () => {
        return new Promise((resolve, reject) => {
            let checkIfIdExist = beritaAcaraPenghapusan.checkedRow().filter((d) => {
                return d.id != undefined
            })
            if (checkIfIdExist.length < 1) {
                resolve(true)
                return
            }
            __ajax({
                method: 'DELETE',
                url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                    return d.id
                }),
            }).then((d) => {
                resolve(true)
                onBeritaAcaraPenghapusanGetFiles(checkIfIdExist[0].foreign_id, () => {})
            })
        })
    }
});

function onDokumenValidasiPenghapusanGetFiles(foreignId, callback) {
    return __ajax({
        method: 'GET',
        url: "<?= url('api/system_uploads') ?>",
        data: {
            jenis: 'penghapusan-step3',
            foreign_field: 'id',
            foreign_id: foreignId,
            foreign_table: 'inventaris_penghapusan',
        },
    }).then((files) => {
        dokumenValidasiPenghapusan.fileList(files);
        callback();
    });
}

const dokumenValidasiPenghapusan = new FileGallery(document.getElementById('dokumen-validasi-penghapusan'), {
    title: 'Dokumen',
    accept: `${App.Constant.MimeOffice}|image/*`,
    onDelete: () => {
        return new Promise((resolve, reject) => {
            let checkIfIdExist = dokumenValidasiPenghapusan.checkedRow().filter((d) => {
                return d.id != undefined
            })
            if (checkIfIdExist.length < 1) {
                resolve(true)
                return
            }
            __ajax({
                method: 'DELETE',
                url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                    return d.id
                }),
            }).then((d) => {
                resolve(true)
                onDokumenValidasiPenghapusanGetFiles(checkIfIdExist[0].foreign_id, () => {})
            })
        })
    }
});

function onDokumenPersetujuanMutasiBpkadGetFiles(foreignId, callback) {
    return __ajax({
        method: 'GET',
        url: "<?= url('api/system_uploads') ?>",
        data: {
            jenis: 'Dokumen Persetujuan Mutasi (BPKAD)',
            foreign_field: 'id',
            foreign_id: foreignId,
            foreign_table: 'inventaris_mutasi',
        },
    }).then((files) => {
        dokumenPersetujuanMutasiBpkad.fileList(files);
        callback();
    });
}

const dokumenPersetujuanMutasiBpkad = new FileGallery(document.getElementById('dokumen-persetujuan-mutasi-bpkad'), {
    title: 'Dokumen',
    accept: `${App.Constant.MimeOffice}|image/*`,
    onDelete: () => {
        return new Promise((resolve, reject) => {
            let checkIfIdExist = dokumenPersetujuanMutasiBpkad.checkedRow().filter((d) => {
                return d.id != undefined
            })
            if (checkIfIdExist.length < 1) {
                resolve(true)
                return
            }
            __ajax({
                method: 'DELETE',
                url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                    return d.id
                }),
            }).then((d) => {
                resolve(true)
                onDokumenPersetujuanMutasiBpkadGetFiles(checkIfIdExist[0].foreign_id, () => {})
            })
        })
    }
});

function onDokumenMutasiCancelGetFiles(foreignId, callback) {
    return __ajax({
        method: 'GET',
        url: "<?= url('api/system_uploads') ?>",
        data: {
            jenis: 'Dokumen Pembatalan Mutasi (BPKAD)',
            foreign_field: 'id',
            foreign_id: foreignId,
            foreign_table: 'inventaris_mutasi',
        },
    }).then((files) => {
        dokumenMutasiCancel.fileList(files);
        callback();
    });
}

const dokumenMutasiCancel = new FileGallery(document.getElementById('dokumen-mutasi-cancel'), {
    title: 'Dokumen',
    accept: `${App.Constant.MimeOffice}|image/*`,
    onDelete: () => {
        return new Promise((resolve, reject) => {
            let checkIfIdExist = dokumenMutasiCancel.checkedRow().filter((d) => {
                return d.id != undefined
            })
            if (checkIfIdExist.length < 1) {
                resolve(true)
                return
            }
            __ajax({
                method: 'DELETE',
                url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                    return d.id
                }),
            }).then((d) => {
                resolve(true)
                onDokumenMutasiCancelGetFiles(checkIfIdExist[0].foreign_id, () => {})
            })
        })
    }
});

/**
 * Handle make home map
 */
function makeHomeMap() {
    const element = document.getElementById('home-map-container');
    $(element).html(`<i class="fa fa-refresh fa-spin fa-lg fa-fw"></i> Mohon tunggu...`);

    new GoogleMapInput(element, {
        autoClose: false,
        isNotInput: true,
    });
}

/**
 * mutasi section
 */

viewModel.data = Object.assign(viewModel.data, {
    count: ko.observable({
        step1: 0,
        step2: 0,
        step3: 0
    }),
    countPenghapusan: ko.observable({
        step1: 0,
        step2: 0
    }),
    countSensus: ko.observable({
        step1: 0,
    }),
    countReklas: ko.observable({
        step1: 0
    }),
    currentTab: ko.observable('home-map'),
    currentHighlight: ko.observable('')
})


viewModel.clickEvent = Object.assign(viewModel.clickEvent, {
    setCurrentTab: (tab) => {
        viewModel.data.currentTab(tab)
        if (tab == 'home-map') {
            makeHomeMap();
        }
    },
    setCurrentHighlight: (currentHighlight) => {
        $(`#table-${currentHighlight}`).DataTable().ajax.reload();
        viewModel.data.currentHighlight(currentHighlight)
    }
})

/**
 * load datatble reklas step-1
 */
function loadDataTableReklas() {
    $('#table-reklas-bpkad').DataTable({
        ajax: `${$("[base-path]").val()}/reklas?status=STEP-1`,
        dom: 'Bfrtip',
        'drawCallback': onloadDataTableMutasiMutasiMasuk,
        'select': {
            'style': 'multi'
        },
        columns: [
            {
                title: 'Nama Inventaris',
                data: 'kode_awal'
            },
            {
                title: 'Nama Inventaris  tujuan',
                data: 'kode_tujuan'
            },
            {
                title: 'Pemohon',
                data: 'pemohon'
            },
            {
                title: 'Tanggal Permohonan',
                data: 'tglsurat'
            },
        ]
    })
}

/**
 * load datatble mutasi step-1
 */
function loadDataTableMutasi() {
    $('#table-mutasi-masuk').DataTable({
        ajax: `${$("[base-path]").val()}/mutasis?opd_tujuan=${localStorage.getItem('pid_organisasi')}&status=STEP-1`,
        dom: 'Bfrtip',
        'drawCallback': onloadDataTableMutasiMutasiMasuk,
        'select': {
            'style': 'multi'
        },
        columns: [{
            'orderable': false,
            "className": "details-control",
            "render": function (data, type, row) {
                return '<i class="fa fa-plus-circle text-success"></i>'
            },
            data: "id",
        },
        {
            title: 'No BAST',
            data: 'no_bast'
        },
        {
            title: 'Tanggal BAST',
            data: 'tgl_bast'
        },
        {
            title: 'Dibuat pada',
            data: 'created_at'
        }
        ]
    })
}


/**
 * step - 2 for bpkad
 */

function loadDataTableMutasiBPKAD() {
    $('#table-mutasi-bpkad').DataTable({
        ajax: `${$("[base-path]").val()}/mutasis?status=STEP-2`,
        dom: 'Bfrtip',
        'drawCallback': onloadDataTableMutasiMutasiBPKAD,
        'select': {
            'style': 'single'
        },
        columns: [{
            'orderable': false,
            "className": "details-control",
            "render": function (data, type, row) {
                return '<i class="fa fa-plus-circle text-success"></i>'
            },
            data: "id",
        },
        {
            title: 'No BAST',
            data: 'no_bast'
        },
        {
            title: 'Tanggal BAST',
            data: 'tgl_bast'
        },
        {
            title: 'Dibuat pada',
            data: 'created_at'
        }
        ]
    })
}


/**
 * for modal step-3 confirmation
 */

function loadDataTableMutasiStep3() {
    $('#table-mutasi-konfirmasi').DataTable({
        ajax: `${$("[base-path]").val()}/mutasis?opd_tujuan=${localStorage.getItem('pid_organisasi')}&status=STEP-3`,
        dom: 'Bfrtip',
        'drawCallback': onloadDataTableMutasiMutasiStep3,
        'select': {
            'style': 'multi'
        },
        columns: [{
            'orderable': false,
            "className": "details-control",
            "render": function (data, type, row) {
                return '<i class="fa fa-plus-circle text-success"></i>'
            },
            data: "id",
        },
        {
            title: 'No BAST',
            data: 'no_bast'
        },
        {
            title: 'Tanggal BAST',
            data: 'tgl_bast'
        },
        {
            title: 'Dibuat pada',
            data: 'created_at'
        }
        ]
    })
}

/**
 * step - 1 for penghapusan bpkad
 */

function loadDataTablePenghapusanBPKAD() {
    $('#table-penghapusan-bpkad').DataTable({
        ajax: `${$("[base-path]").val()}/penghapusans?status=STEP-1`,
        dom: 'Bfrtip',
        'drawCallback': onloadDataTablePenghapusan,
        'select': {
            'style': 'single'
        },
        columns: [{
            'orderable': false,
            "className": "details-control",
            "render": function (data, type, row) {
                return '<i class="fa fa-plus-circle text-success"></i>'
            },
            data: "id",
        },
        {
            title: 'Kriteria',
            data: 'kriteria'
        },
        {
            title: 'Kondisi',
            data: 'kondisi'
        },
        {
            title: 'Pemohon',
            data: 'pemohon'
        },
        {
            title: 'Tanggal SK',
            data: 'tglsk'
        }
        ]
    })
}

/**
 * step - 2 penghapusan for bpkad
 */

function loadDataTableKonfirmasiPenghapusan() {
    $('#table-penghapusan-konfirmasi').DataTable({
        ajax: `${$("[base-path]").val()}/penghapusans?status=STEP-2&pid_organisasi=${localStorage.getItem('pid_organisasi')}`,
        dom: 'Bfrtip',
        'drawCallback': onloadDataTablePenghapusan,
        'select': {
            'style': 'single'
        },
        columns: [{
            'orderable': false,
            "className": "details-control",
            "render": function (data, type, row) {
                return '<i class="fa fa-plus-circle text-success"></i>'
            },
            data: "id",
        },
        {
            title: 'Kriteria',
            data: 'kriteria'
        },
        {
            title: 'Kondisi',
            data: 'kondisi'
        },
        {
            title: 'Pemohon',
            data: 'pemohon'
        },
        {
            title: 'Tanggal SK',
            data: 'tglsk'
        }
        ]
    })
}

/**
 * step - 3 penghapusan for bpkad
 */

function loadDataTableValidasiPenghapusan() {
    $('#table-penghapusan-validasi').DataTable({
        ajax: `${$("[base-path]").val()}/penghapusans?status=STEP-3`,
        dom: 'Bfrtip',
        'drawCallback': onloadDataTablePenghapusan,
        'select': {
            'style': 'single'
        },
        columns: [{
            'orderable': false,
            "className": "details-control",
            "render": function (data, type, row) {
                return '<i class="fa fa-plus-circle text-success"></i>'
            },
            data: "id",
        },
        {
            title: 'Kriteria',
            data: 'kriteria'
        },
        {
            title: 'Kondisi',
            data: 'kondisi'
        },
        {
            title: 'Pemohon',
            data: 'pemohon'
        },
        {
            title: 'Tanggal SK',
            data: 'tglsk'
        }
        ]
    })
}


/**
 * sensus for step - 1
 */

function loadDataTableSensusBPKAD() {
    $('#table-sensus-bpkad').DataTable({
        ajax: `${$("[base-path]").val()}/inventarisSensuses?status=STEP-1`,
        dom: 'Bfrtip',
        'drawCallback': onloadDataTableSensus,
        'select': {
            'style': 'sing'
        },
        columns: [{
            'orderable': false,
            "className": "details-control",
            "render": function (data, type, row) {
                return '<i class="fa fa-plus-circle text-success"></i>'
            },
            data: "id",
        },
        {
            title: 'Nomor Registrasi',
            data: 'noreg'
        },
        {
            title: 'Nama Barang',
            data: 'nama'
        },
        {
            title: 'Kode Barang',
            data: 'kode_barang'
        },
        {
            title: 'Tanggal Sensus',
            data: 'tanggal_sk'
        },
        {
            title: 'Jenis Sensus',
            data: 'status_barang_'
        },
        {
            title: 'Pemohon',
            data: 'pemohon'
        },
        ]
    })
}

/**
 * show modal mutasi for step-1
 */
function showMutasiMasuk() {
    $('#modal-mutasi-masuk').modal('show')
}


/**
 * to approve each mutasi for step-1
 */
function approvementMutasi(step) {
    viewModel.services.approveMutasi($('#table-mutasi-masuk').DataTable().rows('.selected').data().toArray(), step)
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'inventaris berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                $('#modal-mutasi-masuk').modal('hide')
                countMutasiProgress();
            })
        })
}

/**
 * to approve each mutasi for step-2
 *
 */

function approvementMutasiStep2(step) {
    viewModel.services.approveMutasi($('#table-mutasi-bpkad').DataTable().rows('.selected').data().toArray(), step)
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'inventaris berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                $('#modal-mutasi-bpkad').modal('hide')
                $('#modal-mutasi-bpkad-form').modal('hide')
                countMutasiProgress();
            })
        })
}

function cancelMutasiStep2(step) {
    viewModel.services.cancelMutasi($('#table-mutasi-bpkad').DataTable().rows('.selected').data().toArray(), step)
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'inventaris berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                $('#modal-mutasi-bpkad').modal('hide')
                $('#modal-mutasi-bpkad-cancel-form').modal('hide')
                countMutasiProgress();
            })
        })
}




/**
 * approve bpkad for penghapusan
 *
 */


function approvementPenghapusanBPKAD() {
    viewModel.services.approvementPenghapusanBPKAD($('#table-penghapusan-bpkad').DataTable().rows('.selected').data().toArray(), 'STEP-1')
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'Penghapusan inventaris berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                $('#modal-penghapusan-bpkad').modal('hide')
                $('#modal-penghapusan-bpkad-form').modal('hide')
                countPenghapusanProgress();
            })
        })
}


/**
 * approve konfirmasi for penghapusan
 *
 */


function approvementKonfirmasiPenghapusan() {
    viewModel.services.approvementPenghapusanBPKAD($('#table-penghapusan-konfirmasi').DataTable().rows('.selected').data().toArray(), 'STEP-2')
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'Penghapusan inventaris berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                $('#modal-penghapusan-konfirmasi').modal('hide')
                $('#modal-penghapusan-konfirmasi-form').modal('hide')
                countPenghapusanProgress();
            })
        })
}

/**
 * approve validasi for penghapusan
 *
 */


function approvementValidasiPenghapusan() {
    viewModel.services.approvementPenghapusanBPKAD($('#table-penghapusan-validasi').DataTable().rows('.selected').data().toArray(), 'STEP-3')
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'Penghapusan inventaris berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                $('#modal-validasi-penghapusan-konfirmasi-form').modal('hide')
                $('#dokumen-validasi-penghapusan').val('');
                countPenghapusanProgress();
            })
        })
}



/**
 * approvement for step -3
 *
 */

function approvementMutasiStep3(step) {
    viewModel.services.approveMutasi($('#table-mutasi-konfirmasi').DataTable().rows('.selected').data().toArray(), step)
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'inventaris berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                $('#modal-mutasi-konfirmasi').modal('hide')
                countMutasiProgress();
            })
        })
}

/**
 * approvement for reklas step 1
 *
 */

function approvementReklas(step) {
    viewModel.services.approveReklas($('#table-reklas-bpkad').DataTable().rows('.selected').data().toArray(), step)
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'inventaris berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                countReklasProgress();
            })
        })
}

/**
 * approvement sensus bpkad
 */

 function approvementSensusBPKAD(step) {
    viewModel.services.approveSensus($('#table-sensus-bpkad').DataTable().rows('.selected').data().toArray(), step)
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'Sensus berhasil di setujui!'
            }).then((d) => {
                viewModel.clickEvent.setCurrentHighlight(viewModel.data.currentHighlight())
                countSensusProgress();
                $('#modal-sensus-bpkad-form').modal('hide')
            })
    })
 }

/**
 * form before bpkad giving approvement to mutation
 *
 */


function beforeApproveStep2(isApprovement) {
    if (isApprovement) {
        dokumenPersetujuanMutasiBpkad.fileList([]);
        $('#modal-mutasi-bpkad-form').modal('show')
    } else {
        dokumenMutasiCancel.fileList([]);
        $('#modal-mutasi-bpkad-cancel-form').modal('show')
    }

}

function beforeApproveBPKADPenghapusan() {
    dokumenPenghapusan.fileList([]);
    $('#modal-penghapusan-bpkad-form').modal('show')
}

function beforeApproveKonfirmasiPenghapusan() {
    beritaAcaraPenghapusan.fileList([]);
    $('#modal-penghapusan-konfirmasi-form').modal('show')
}

function beforeApproveValidasiPenghapusan() {
    dokumenValidasiPenghapusan.fileList([]);
    $('#modal-validasi-penghapusan-konfirmasi-form').modal('show')
}

/**
 *
 * before approve sensus
 */

 function beforeApproveBPKADSensus() {
    dokumenSensus.fileList([]);
    $('#modal-sensus-bpkad-form').modal('show')
 }

 function onDokumenKronologisGetFiles(foreignId, id) {
    return __ajax({
        method: 'GET',
        url: "<?= url('api/system_uploads') ?>",
        data: {
            jenis: 'dokumen_kronologis',
            foreign_field: 'id',
            foreign_id: foreignId,
            foreign_table: 'inventaris',
        },
    }).then((files) => {
        dokumenKronologisGalery[id].fileList(files);
    });
}

 function onloadDataTableSensus(e) {

    if (isReady[e.sTableId]) {
        return
    }

    let allHeader = $(e.nTHead).find("th")
    let createdMerge = document.createElement("tr")
    createdMerge.setAttribute("row-cloned" ,true)
    let headerByPass = 0


    isReady[e.sTableId] = true

    let element = $(e.nTHead).find("tr")[0]

    e.nTHead.prepend(createdMerge)

    // var template = Handlebars.compile($("#details-template").html())

    const tabItems = [
        "Detail",
        "Pemeliharaan",
        // "Penghapusan"
        "Pemanfaatan",
        "Dokumen-Kronologis",
        "History"
    ]

    let selectEvent = 0




    $(`#${e.sTableId} tbody`).on('click', 'td.details-control i', function (i, n) {

        const self = this

        var tr = $(this).closest('tr');
        var row = $(`#${e.sTableId}`).DataTable().row(tr);

        selectEvent++

        let ulTabs = document.createElement('ul')
        ulTabs.className = "nav nav-tabs"
        ulTabs.id = `idTab-${row.data().id}${selectEvent}`
        ulTabs.setAttribute('role', 'tablist')


        let navItem = document.createElement("li")
        navItem.className = "nav-item"

        let aNavItem = document.createElement("a")
        aNavItem.className = "nav-link"
        aNavItem.setAttribute('data-toggle', 'tab')
        aNavItem.setAttribute('role', 'tab')
        aNavItem.setAttribute('arial-selected', true)

        let tabContent = document.createElement("div")
        tabContent.className = "tab-content"

        let tabPane = document.createElement("div")
        tabPane.className = "tab-pane fade p-2"
        tabPane.setAttribute('role', 'tab')

        for (let index = 0; index < tabItems.length; index++) {
            const tabItem = tabItems[index];
            const aNavItemReadyForInit = aNavItem.cloneNode(true)
            const navItemReadyForInit = navItem.cloneNode(true)
            aNavItemReadyForInit.id = `${tabItem}-tab-${selectEvent}`
            aNavItemReadyForInit.setAttribute("href", `#${tabItem}-${selectEvent}`)
            aNavItemReadyForInit.setAttribute("aria-controls", `${tabItem}-${selectEvent}`)

            aNavItemReadyForInit.textContent = tabItem.split('-').join(' ');

            if (index == 0) {
                aNavItemReadyForInit.className += " active"
            }

            navItemReadyForInit.appendChild(aNavItemReadyForInit)

            ulTabs.appendChild(navItemReadyForInit)

            // --- tab-content

            const tabPaneReadyForInit = tabPane.cloneNode(true)
            if (index == 0) {
                tabPaneReadyForInit.className += " show active  "
            }

            tabPaneReadyForInit.id = `${tabItem}-${selectEvent}`
            tabPaneReadyForInit.setAttribute("aria-labelledby", `${tabItem}-${selectEvent}`)

            tabContent.appendChild(tabPaneReadyForInit)
        }



        if ( row.child.isShown() ) {
            // This row is already open - close it
            $(this).attr('class',$(this).attr('class').replace('minus-circle', 'plus-circle'))

            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            $(this).attr('class',$(this).attr('class').replace('plus-circle', 'minus-circle'))

            let kib = "kib"+row.data().kelompok_kib
            __ajax({
                url: `${$("[base-path]").val()}${viewModel.data.urlEachKIB("kib"+row.data().kelompok_kib)}/${row.data().pidinventaris == undefined ? row.data().idinventaris : row.data().pidinventaris}`
            }).then((data) => {

                let url = viewModel.data.informations[kib].url

                row.child($(`<tr style="background:white" class="detail-pemeliharaan"><td colspan="${allHeader.length}">${ulTabs.outerHTML}${tabContent.outerHTML}</td>/tr>`)).show();

                tr.addClass('shown');
                if (data == null) {
                    document.querySelector(`#Detail-${selectEvent}`).innerHTML = '<div class="text-center">Data not found</div>'
                } else {
                    $.get(`${$("[base-path]").val()}/${url}/${data.id}?isAjax=true`).then((html) => {
                        document.querySelector(`#Detail-${selectEvent}`).innerHTML = $(html).find(".container-view")[0].outerHTML
                        // new GoogleMapInput(document.getElementsByClassName(`map-${data.pidinventaris}`)[0], {
                        //     value : `${data.koordinattanah}`,
                        //     draw: true,
                        // })
                        // setTimeout(() => {
                        //    new GoogleMapInput(document.getElementsByClassName(`map-non-draw-${data.pidinventaris}`)[0], {
                        //         value : `${data.koordinatlokasi}`,
                        //         draw: false,
                        //     })
                        // }, 5000)
                    })
                }


                document.querySelector(`#Pemeliharaan-${selectEvent}`).innerHTML = `<table class='mt-2 table  table-striped' id='table-pemeliharaan-${row.data().id}${selectEvent}'>
                    <thead>
                        <tr>
                            <th>Uraian</th>
                            <th>Tanggal Pemakaian</th>
                            <th>Tanggal Kontrak</th>
                            <th>Nama Instansi/CV/PT</th>
                            <th>Biaya Pemeliharaan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>`

                let table = $(`#table-pemeliharaan-${row.data().id}${selectEvent}`).DataTable({
                    ajax: {
                        url: `${$("[base-path]").val()}/pemeliharaans`,
                        dataType: "json",
                        data: (d) => {
                            d.pidinventaris = row.data().idinventaris
                        }
                    },
                    order : [[ 1, "asc"]],
                    dom: 'Bfrtip',
                    buttons: [

                    ],
                    columns: [
                        {
                            data: 'uraian'
                        },
                        {
                            data: 'tgl'
                        },
                        {
                            data: 'tglkontrak'
                        },
                        {
                            data: 'persh'
                        },
                        {
                            data: 'biaya'
                        }
                    ],
                    'columnDefs': [
                        {
                            'targets': 0,
                            'checkboxes': {
                            'selectRow': true
                            }
                        }
                    ],
                    'select': {
                        'style': 'multi'
                    },
                    "processing": true,
                    "serverSide": true,
                })


                document.querySelector(`#Pemanfaatan-${selectEvent}`).innerHTML = `<table class='mt-2 table  table-striped' id='table-pemanfaatan-${row.data().id}${selectEvent}'>
                    <thead>
                    </thead>
                </table>`

                let tablePemanfaatan = $(`#table-pemanfaatan-${row.data().id}${selectEvent}`).DataTable({
                    ajax: {
                        url: `${$("[base-path]").val()}/pemanfaatans`,
                        dataType: "json",
                        data: (d) => {
                            d.pidinventaris = row.data().idinventaris
                        }
                    },
                    order : [[ 0, "asc"]],
                    dom: 'Bfrtip',
                    buttons: [
                    ],
                    columns: [
                        {
                            title: 'Jenis Pemanfaatan',
                            data: 'peruntukan'
                        },
                        {
                            title: 'Tipe Kontribusi',
                            data: 'tipe_kontribusi'
                        },
                        {
                            title: 'Tanggal Mulai',
                            data: 'tgl_mulai'
                        },
                        {
                            title: 'Tanggal Akhir',
                            data: 'tgl_akhir'
                        },
                    ],
                    'select': {
                        'style': 'multi'
                    },
                    "processing": true,
                    "serverSide": true,
                })

                // dokumen kronologis
                document.querySelector(`#Dokumen-Kronologis-${selectEvent}`).innerHTML = `
                <form id="dokumen-kronologis-form-${row.data().id}">
                    <div class="form-group col-sm-12 col-md-12 row">
                        <input class="form-control" id="dokumen-kronologis-${row.data().id}" name="dummy" multiple="" type="file" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-12 col-md-12 justify-content-center row">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" onclick="onSaveDokumenKronologis('${row.data().id}')">Simpan</button>
                        </div>
                    </div>
                </form>`;

                dokumenKronologisGalery[row.data().id] = new FileGallery(document.getElementById(`dokumen-kronologis-${row.data().id}`), {
                    title: 'Dokumen Kronologis',
                    maxSize: 5000000,
                    accept: `${App.Constant.MimeOffice}|image/*|video/*`,
                    onDelete: () => {
                        return new Promise((resolve, reject) => {
                            let checkIfIdExist = dokumenKronologisGalery[row.data().id].checkedRow().filter((d) => {
                                return d.id != undefined
                            })
                            if (checkIfIdExist.length < 1) {
                                resolve(true)
                                return
                            }
                            __ajax({
                                method: 'DELETE',
                                url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                                        return d.id
                                    }),
                            }).then((d) => {
                                resolve(true)
                                onDokumenKronologisGetFiles(row.data().idinventaris, row.data().id);
                            })
                        })
                    }
                })

                onDokumenKronologisGetFiles(row.data().idinventaris, row.data().id);

                document.querySelector(`#History-${selectEvent}`).innerHTML = `
                <div class='btn btn-success' onclick='onCompare("#table-history-${row.data().id}${selectEvent}")'>
                    Bandingkan
                </div>
                <br />
                <br />
                <table class='mt-2 table  table-striped' id='table-history-${row.data().id}${selectEvent}'>
                    <thead>
                    </thead>
                </table>`

                let tableHistory = $(`#table-history-${row.data().id}${selectEvent}`).DataTable({
                    ajax: {
                        url: `${$("[base-path]").val()}/inventarisHistories?fid=${row.data().pidinventaris}`,
                        dataType: "json",
                    },
                    order : [[ 0, "asc"]],
                    dom: 'Bfrtip',
                    buttons: [
                    ],
                    columns: [
                        {
                            title: 'Action',
                            data: 'action'
                        },
                        {
                            title: 'Tanggal History',
                            data: 'history_at'
                        },
                    ],
                    'select': {
                        'style': 'multi'
                    },
                    "processing": true,
                    "serverSide": true,
                })



            })

        }
    });
}


// function onloadDataTableSensus(e) {
//     //  $(`#${e.sTableId} tbody`).unbind()
//     $(`#${e.sTableId} tbody`).unbind('click').on('click', 'td.details-control i', function (i, n) {
//         var tr = $(this).closest('tr');
//         var row = $(`#${e.sTableId}`).DataTable().row(tr);
//         // alert (row.child.isShown())
//         if (row.child.isShown()) {
//             // This row is already open - close it
//             $(this).attr('class', $(this).attr('class').replace('minus-circle', 'plus-circle'))

//             row.child.hide();
//             tr.removeClass('shown');
//         }
//         else {
//             $(this).attr('class', $(this).attr('class').replace('plus-circle', 'minus-circle'))

//             let kib = "kib"+row.data().kelompok_kib
//             __ajax({
//                 url: `${$("[base-path]").val()}${viewModel.data.urlEachKIB("kib"+row.data().kelompok_kib)}/${row.data().pidinventaris == undefined ? row.data().id : row.data().pidinventaris}`
//             }).then((data) => {

//                 let url = viewModel.data.informations[kib].url


//                 tr.addClass('shown');
//                 if (data == null) {
//                     document.querySelector(`#Detail-${selectEvent}`).innerHTML = '<div class="text-center">Data not found</div>'
//                 } else {
//                     $.get(`${$("[base-path]").val()}/${url}/${data.id}?isAjax=true`).then((html) => {
//                         row.child(`<div class='container container-view'>${$(html).find(".container-view")[0].outerHTML}</div>`).show();

//                     })
//                 }
//             })
//         }
//     })
// }


/**
 * onDrawCallback DataTable
 * @param {e} e parameter of datatable itself
 */
function onloadDataTableMutasiMutasiMasuk(e) {
    //  $(`#${e.sTableId} tbody`).unbind()
    $(`#${e.sTableId} tbody`).unbind('click').on('click', 'td.details-control i', function (i, n) {
        var tr = $(this).closest('tr');
        var row = $(`#${e.sTableId}`).DataTable().row(tr);
        // alert (row.child.isShown())
        if (row.child.isShown()) {
            // This row is already open - close it
            $(this).attr('class', $(this).attr('class').replace('minus-circle', 'plus-circle'))

            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            $(this).attr('class', $(this).attr('class').replace('plus-circle', 'minus-circle'))

            $.get(`${$("[base-path]").val()}/partials/view.mutasi/${row.data().id}`).then((data) => {

                row.child(`<div class='container container-view'>${data}</div>`).show();
            })
        }
    })
}

/**
 * onDrawCallback DataTable
 * @param {e} e parameter of datatable itself
 */
function onloadDataTableMutasiMutasiBPKAD(e) {
    $(`#${e.sTableId} tbody`).unbind('click').on('click', 'td.details-control i', function (i, n) {
        var tr = $(this).closest('tr');
        var row = $(`#${e.sTableId}`).DataTable().row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            $(this).attr('class', $(this).attr('class').replace('minus-circle', 'plus-circle'))

            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            $(this).attr('class', $(this).attr('class').replace('plus-circle', 'minus-circle'))

            $.get(`${$("[base-path]").val()}/partials/view.mutasi/${row.data().id}`).then((data) => {

                row.child(`<div class='container container-view'>${data}</div>`).show();
            })
        }
    })
}


/**
 * onDrawCallback DataTable Penghapusan
 * @param {e} e parameter of datatable itself
 */
function onloadDataTableMutasiMutasiStep3(e) {
    $(`#${e.sTableId} tbody`).unbind('click').on('click', 'td.details-control i', function (i, n) {
        var tr = $(this).closest('tr');
        var row = $(`#${e.sTableId}`).DataTable().row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            $(this).attr('class', $(this).attr('class').replace('minus-circle', 'plus-circle'))

            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            $(this).attr('class', $(this).attr('class').replace('plus-circle', 'minus-circle'))

            $.get(`${$("[base-path]").val()}/partials/view.mutasi/${row.data().id}`).then((data) => {

                row.child(`<div class='container container-view'>${data}</div>`).show();
            })
        }
    })
}

/**
 * onDrawCallback DataTable Penghapusan
 * @param {e} e parameter of datatable itself
 */

function onloadDataTablePenghapusan(e) {
    $(`#${e.sTableId} tbody`).unbind('click').on('click', 'td.details-control i', function (i, n) {

        var tr = $(this).closest('tr');
        var row = $(`#${e.sTableId}`).DataTable().row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            $(this).attr('class', $(this).attr('class').replace('minus-circle', 'plus-circle'))

            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            $(this).attr('class', $(this).attr('class').replace('plus-circle', 'minus-circle'))

            $.get(`${$("[base-path]").val()}/partials/view.penghapusan/${row.data().id}`).then((data) => {

                row.child(`<div class='container container-view'>${data}</div>`).show();
            })
        }
    })
}


/**
 * counting sensus masuk
 * sensus on progress
 * etc
 */
function countSensusProgress() {
    viewModel.services.countSensusWorkflow()
}


/**
 * counting mutasi masuk
 * mutasi on progress
 * etc
 */
function countMutasiProgress() {
    viewModel.services.countMutasiWorkflow()
}

/**
 * counting penghapusan
 * etc
 */

function countPenghapusanProgress() {
    viewModel.services.countPenghapusan()
}

/**
 * counting penghapusan
 * etc
 */

function countReklasProgress() {
    viewModel.services.countReklas()
}

/**
 * load functions
 */
countSensusProgress()
countMutasiProgress()
countPenghapusanProgress()
countReklasProgress()
loadDataTableSensusBPKAD()
loadDataTableMutasi()
loadDataTableMutasiBPKAD();
loadDataTableMutasiStep3();
loadDataTablePenghapusanBPKAD();
loadDataTableKonfirmasiPenghapusan();
loadDataTableValidasiPenghapusan();
loadDataTableReklas()
makeHomeMap();


/**
 * end mutasi section
 */
