/**
 * mutasi section
 */

viewModel.data = Object.assign(viewModel.data, {
    count: ko.observable({
        step1: 0,
        step2: 0,
        step3: 0
    })
})

/**
 * load datatble mutasi step-1
 */
function loadDataTableMutasi() {
    $('#table-mutasi').DataTable({
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
        'drawCallback': onloadDataTableMutasiMutasiMasuk,
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
 * show modal mutasi for step-1
 */
function showMutasiMasuk() {
    $('#modal-mutasi-masuk').modal('show')
}


/**
 * to approve each mutasi for step-1
 */
function approvementMutasi(step) {
    viewModel.services.approveMutasi($('#table-mutasi').DataTable().rows('.selected').data().toArray(), step)
        .then((d) => {
            swal.fire({
                type: 'success',
                text: 'inventaris berhasil di setujui!'
            }).then((d) => {
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
                $('#modal-mutasi-bpkad').modal('hide')
                $('#modal-mutasi-bpkad-form').modal('hide')
                countMutasiProgress();
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
                $('#modal-mutasi-konfirmasi').modal('hide')
                countMutasiProgress();
            })
        })
}

/**
 * form before bpkad giving approvement to mutation
 * 
 */


function beforeApproveStep2(step) {
    $('#modal-mutasi-bpkad-form').modal('show')
}


/**
 * onDrawCallback DataTable
 * @param {e} e parameter of datatable itself
 */
function onloadDataTableMutasiMutasiMasuk(e) {
    $(`#${e.sTableId} tbody`).on('click', 'td.details-control i', function (i, n) {
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
 * counting mutasi masuk
 * mutasi on progress 
 * etc
 */
function countMutasiProgress() {
    viewModel.services.countMutasiWorkflow()
}

/**
 * load functions
 */
countMutasiProgress()
loadDataTableMutasi()
loadDataTableMutasiBPKAD();
loadDataTableMutasiStep3();


/**
 * end mutasi section
 */