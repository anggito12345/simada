@section('css')
    @include('layouts.datatables_css')
@endsection


{!! $dataTable->table(['id' => 'table-inventaris', 'width' => '100%', 'class' => 'table table-striped ']) !!}

<div class="summarize">
    NILAI PEROLEHAN PER PAGE: <span class="per_page_harga_satuan"></span> &nbsp;&nbsp;
    TOTAL NILAI PEROLEHAN : <span class="total_harga_satuan"></span>
</div>

@section('scripts')
    <script>

        //store recent filter of grid, this varible would be use on calculating grand total
        let recFilter = {}

        let colspan = {
            "Kode Barang": {
                value: 2,
                title: "Nomor"
            },
        }

        let isReady = {

        }

        let dokumenKronologisGalery = [];

        function onCallbackPemeliharaanTab(tableId) {
            $(tableId).DataTable().ajax.reload();
        }


        function onCallbackPemanfaatanTab(tableId) {
            $(tableId).DataTable().ajax.reload();
        }

        function onPemeliharaan(currentData, param) {
            if (currentData == null && $("#table-inventaris").DataTable().rows('.selected').count()!= 1 ) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih 1',
                    title: 'Pemeliharaan'
                })
            } else {
                viewModel.data.formPemeliharaan().pidinventaris = $("#table-inventaris").DataTable().rows('.selected').data()[0].id
                $("#modal-pemeliharaan").attr('is_mode_insert', true)
                if(currentData != null) {
                    viewModel.data.formPemeliharaan(currentData)


                    const tgl = document.getElementById('tgl')
                    tgl.value = currentData.tgl
                    tgl.dispatchEvent(new Event('change'))

                    const tglkontrak = document.getElementById('tglkontrak')
                    tglkontrak.value = currentData.tglkontrak
                    tglkontrak.dispatchEvent(new Event('change'))

                    $("#modal-pemeliharaan").attr('is_mode_insert', false)
                    $("#modal-pemeliharaan").attr('callback', 'onCallbackPemeliharaanTab|'+param)
                }

                $("#modal-pemeliharaan").modal('show')
            }
        }

        function onDeletePenghapusan() {
            let table = $('#table-penghapusan').DataTable()
            var count = table.rows('.selected').count();

            if (count < 1) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih minimal 1 data',
                    title: 'Pemeliharaan'
                })
                return
            }

            __ajax({
                url : $("[base-path]").val() + "/api/penghapusans/" + table.rows('.selected').data().map((d) => {
                return d.id
            }).join(','),
                data: {
                    _token: "<?php csrf_token() ?>"
                },
                method: "DELETE",
                dataType: "json"
            }).then(() => {
                swal.fire({
                    type: 'success',
                    text: 'Data berhasil dihapus',
                    title: 'Hapus',
                    onClose: () => {
                        table.ajax.reload();
                        $('#table-inventaris').DataTable().ajax.reload();
                    }
                })
            })
        }


        function onPemanfaatanGetFiles(foreignId, callback) {
            return __ajax({
                method: 'GET',
                url: "<?= url('api/system_uploads') ?>",
                data: {
                    jenis: 'dokumen',
                    foreign_field: 'id',
                    foreign_id: foreignId,
                    foreign_table: 'pemanfaatan',
                },
            }).then((files) => {
                fileGalleryPemanfaatan.fileList(files)
                __ajax({
                    method: 'GET',
                    url: "<?= url('api/system_uploads') ?>",
                    data: {
                        jenis: 'foto',
                        foreign_field: 'id',
                        foreign_id: foreignId,
                        foreign_table: 'pemanfaatan'
                    },
                }).then((files) => {
                    fotoPemanfaatan.fileList(files)

                    callback();
                })
            })
        }

        function onPemanfaatan(currentData, param) {

            if (currentData == null && $("#table-inventaris").DataTable().rows('.selected').count()!= 1 ) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih 1',
                    title: 'Pemanfaatan'
                })
            } else {

                $("#modal-pemanfaatan").attr('is_mode_insert', true)
                if(currentData != null) {
                    viewModel.data.formPemanfaatan(currentData)
                    $("#modal-pemanfaatan").attr('is_mode_insert', false)
                    $("#modal-pemanfaatan").attr('callback', 'onCallbackPemanfaatanTab|'+param)
                    onPemanfaatanGetFiles(currentData.id, () => {

                        const tgl_mulai = document.getElementById('tgl_mulai')
                        tgl_mulai.value = currentData.tgl_mulai
                        tgl_mulai.dispatchEvent(new Event('change'))

                        const tgl_akhir = document.getElementById('tgl_akhir')
                        tgl_akhir.value = currentData.tgl_akhir
                        tgl_akhir.dispatchEvent(new Event('change'))

                        App.Helpers.defaultSelect2($("#mitra"), `${$('[base-path]').val()}/api/mitras/${viewModel.data.formPemanfaatan().mitra}`,"id","nama", (response) => {

                        })

                        $("#modal-pemanfaatan").modal('show')
                    })
                } else {
                    viewModel.data.formPemanfaatan().pidinventaris = $("#table-inventaris").DataTable().rows('.selected').data()[0].id

                    $("#modal-pemanfaatan").modal('show')
                }
            }
        }

        function onPenghapusanGetFiles(foreignId,callback) {
            return __ajax({
                method: 'GET',
                url: "<?= url('api/system_uploads') ?>",
                data: {
                    jenis: 'dokumen',
                    foreign_field: 'id',
                    foreign_id: foreignId,
                    foreign_table: 'penghapusan',
                },
            }).then((files) => {
                fileGallery.fileList(files)
                __ajax({
                    method: 'GET',
                    url: "<?= url('api/system_uploads') ?>",
                    data: {
                        jenis: 'foto',
                        foreign_field: 'id',
                        foreign_id: foreignId,
                        foreign_table: 'penghapusan'
                    },
                }).then((files) => {
                    foto.fileList(files)

                    callback();
                })
            })
        }

        function onPenghapusan(currentData, param) {
            if (currentData == null && $("#table-inventaris").DataTable().rows('.selected').count()!= 1 ) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih 1',
                    title: 'Penghapusan'
                })
            } else {

                $("#modal-penghapusan").attr('is_mode_insert', true)
                if(currentData != null) {
                    viewModel.data.formPenghapusan(currentData)
                    $("#modal-penghapusan").attr('is_mode_insert', false)
                    $("#modal-penghapusan").attr('callback', 'onCallbackPemeliharaanTab|'+param)
                    onPenghapusanGetFiles(currentData.id,function(){
                        const tglhapus = document.getElementById('tglhapus')
                        tglhapus.value = currentData.tglhapus
                        tglhapus.dispatchEvent(new Event('change'))

                        const tglsk = document.getElementById('tglsk')
                        tglsk.value = currentData.tglsk
                        tglsk.dispatchEvent(new Event('change'))

                        $("#modal-penghapusan").modal('show')
                    })
                } else {
                    viewModel.data.formPenghapusan($("#table-inventaris").DataTable().rows('.selected').data().toArray()[0])
                    fileGallery.fileList([])
                    foto.fileList([])
                    $("#modal-penghapusan").modal('show')
                }
            }
        }

        function onDokumenKronologisGetFiles(foreignId) {
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
                dokumenKronologisGalery[foreignId].fileList(files);
            });
        }

        function onSaveDokumenKronologis(inventarisid) {
            Swal.fire({
                title: 'Anda yakin?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.value) {
                    let formData = new FormData($(`#dokumen-kronologis-form-${inventarisid}`)[0]);
                    formData.append('id', inventarisid);

                    let keys = null;
                    dokumenKronologisGalery[inventarisid].fileList().forEach((d, index) => {
                        if (d.rawFile) {
                            formData.append(`dokumen_kronologis[${index}]`, d.rawFile)
                        } else {
                            formData.append(`dokumen_kronologis[${index}]`, false)
                        }

                        keys = Object.keys(d)
                        keys.forEach((key) => {
                            if (key == 'rawFile') {
                                return
                            }

                            formData.append(`dokumen_kronologis_metadata_${key}[${index}]`, d[key])
                        })

                        formData.append(`dokumen_kronologis_metadata_id_inventaris[${index}]`, inventarisid);
                        return d.rawFile
                    });

                    __ajax({
                        method: 'POST',
                        url: "<?= url('api/inventaris/dokumenkronologis') ?>",
                        data: formData,
                        processData: false,
                        contentType: false,

                    }).then((d, resp) => {
                        swal.fire({
                            type: "success",
                            text: "Berhasil menyimpan data!",
                            onClose: () => {
                                onDokumenKronologisGetFiles(inventarisid);
                            }
                        })

                    })
                }
            });
        }

        // Confirm inventaris draft
        function onMultiSelect() {
            Swal.fire({
                title: 'Anda yakin?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.value) {
                    let count = $("#table-inventaris").DataTable().rows('.selected').count();
                    let successCount = [];

                    if (count > 0) {
                        // update item menjadi non draft
                        let selectedRows = $("#table-inventaris").DataTable().rows('.selected').data();

                        selectedRows.each(function (index, key) {
                            console.log(index.id);

                            __ajax({
                                url: `<?= url('api/konfirmasidraft') ?>`,
                                method: 'POST',
                                dataType: "json",
                                data: {
                                    id: index.id
                                }
                            }).then((d) => {
                                successCount.push(key);

                                if (successCount.length == count) {
                                    swal.fire({
                                        type: "success",
                                        text: "Berhasil!",
                                        onClose: () => {
                                            $("#table-inventaris").DataTable().ajax.reload();
                                        }
                                    })
                                }
                            })
                        });
                    }
                }
            });
        }

        function onEdit() {

            if ($("#table-inventaris").DataTable().rows('.selected').count()!= 1 ) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih 1 yang ingin diubah',
                    title: 'Ubah'
                })
            } else {
                window.location = `${$("[base-path]").val()}/inventaris/${$("#table-inventaris").DataTable().rows('.selected').data()[0].id}/edit`
            }
        }

        function onDelete() {
            if ($("#table-inventaris").DataTable().rows('.selected').count() < 1 ) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih minimal 1 yang ingin dihapus',
                    title: 'Ubah'
                })
            } else {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Anda tidak akan bisa mengembalikan data yang telah terhapus",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus!'
                }).then((result) => {
                    let _ids = $("#table-inventaris").DataTable().rows('.selected').data().toArray().map((d) => {
                        return d.id
                    })
                    if (result.value) {
                        __ajax({
                            method: "DELETE",
                            url: `${$("[base-path]").val()}/api/inventaris/${_ids.join("|")}`
                        }).then(function() {
                            swal.fire({
                                type: 'success',
                                text: 'Data berhasil dihapus',
                                title: 'Hapus',
                                onClose: () => {
                                    $("#table-inventaris").DataTable().ajax.reload();
                                }
                            })
                        })
                    }
                })

            }
        }

        function onLoadRowDataTable(e) {
            if (viewModel.data.checkedItem == undefined) {
                return
            }

            if (viewModel.data.checkedItem.indexOf($(e).find("td input[type=checkbox]").attr('value')) > -1) {
                $(e).find("td input[type=checkbox]").prop('checked', true)
            } else {
                $(e).find("td input[type=checkbox]").prop('checked', false)
            }
        }

        function onCalcAllPenyusutan() {
            __ajax({
                url: `${$("[base-path]").val()}/api/calcall/inventaris_penyusutan`,
                method: 'POST'
            }).then((d) => {
                //window.open(`${$("[base-path]").val()}/${d.path}`,'blank');
                swal.fire({
                    icon: 'success',
                    type: 'success',
                    text: 'Penyusutan berhasil dihitung',
                })
            })
        }

        function onExportPenyusutan() {
            __ajax({
                url: `${$("[base-path]").val()}/api/exportall/inventaris_penyusutan`,
                method: 'GET'
            }).then((d) => {
                window.open(`${$("[base-path]").val()}/${d.path}`,'blank');
            })
        }

        function onLoadDataTable(e) {

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
                "History",
                "Penyusutan"
            ]

            let selectEvent = 0
            $(`#${e.sTableId} tbody`).on('click', 'td.details-control i', function (i, n) {

                const self = this

                selectEvent++

                let ulTabs = document.createElement('ul')
                ulTabs.className = "nav nav-tabs"
                ulTabs.id = `idTab-<?= uniqid() ?>${selectEvent}`
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


                <?php
                    $uniqId = uniqid() . sha1(time());
                ?>

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


                var tr = $(this).closest('tr');
                var row = $(`#${e.sTableId}`).DataTable().row( tr );

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
                        url: `${$("[base-path]").val()}${viewModel.data.urlEachKIB("kib"+row.data().kelompok_kib)}/${row.data().pidinventaris == undefined ? row.data().id : row.data().pidinventaris}`
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


                        document.querySelector(`#Penyusutan-${selectEvent}`).innerHTML = `
                        <button class='btn btn-success' id='button-export-xl-penyusutan-<?= $uniqId ?>${selectEvent}'>
                            <img src='${$("[base-path]").val()}/images/icons/icon_xlsx_2.png' width='32' />
                            Export
                        </button>
                        <br>
                        <br>
                        <table class='mt-2 table  table-striped' id='table-penyusutan-<?= $uniqId ?>${selectEvent}'>
                            <thead>
                                <tr>
                                    <th>Running Penyusutan</th>
                                    <th>Running Sd Bulan</th>
                                    <th>Beban Penyusutan Per Bulan</th>
                                    <th>Masa manfaat Sd Akhir tahun</th>
                                    <th>Penyusutan Sd tahun sebelumnya</th>
                                    <th>Bulan Manfaat Berjalan</th>
                                    <th>Penyusutan Tahun Sekarang</th>
                                    <th>Penyusutan Sd Tahun Sekarang</th>
                                    <th>Nilai Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>`

                        $(`#button-export-xl-penyusutan-<?= $uniqId ?>${selectEvent}`).click(() => {
                            __ajax({
                                url: `${$("[base-path]").val()}/api/export/inventaris_penyusutan`,
                                method: 'GET'
                            }).then((d) => {
                                window.open(`${$("[base-path]").val()}/${d.path}`,'blank');
                            })
                        })

                        let tablePenyusutan = $(`#table-penyusutan-<?= $uniqId ?>${selectEvent}`).DataTable({
                            ajax: {
                                url: `${$("[base-path]").val()}/api/inventaris_penyusutan`,
                                dataType: "json",
                                data: (d) => {
                                    d.pidinventaris = row.data().id
                                },
                                'beforeSend': function (request) {
                                    request.setRequestHeader("Authorization", 'Bearer ' + sessionStorage.getItem('api token'));
                                }
                            },
                            order : [[ 1, "asc"]],
                            dom: 'Bfrtip',
                            buttons: [

                            ],
                            columns: [
                                {
                                    data: 'running_penyusutan'
                                },
                                {
                                    data: 'running_sd_bulan'
                                },
                                {
                                    data: 'beban_penyusutan_perbulan'
                                },
                                {
                                    data: 'masa_manfaat_sd_akhir_tahun'
                                },
                                {
                                    data: 'penyusutan_sd_tahun_sebelumnya'
                                },
                                {
                                    data: 'bulan_manfaat_berjalan'
                                },
                                {
                                    data: 'penyusutan_tahun_sekarang'
                                },
                                {
                                    data: 'penyusutan_sd_tahun_sekarang'
                                },
                                
                                {
                                    data: 'nilai_buku'
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

                        document.querySelector(`#Pemeliharaan-${selectEvent}`).innerHTML = `<table class='mt-2 table  table-striped' id='table-pemeliharaan-<?= $uniqId ?>${selectEvent}'>
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

                        let table = $(`#table-pemeliharaan-<?= $uniqId ?>${selectEvent}`).DataTable({
                            ajax: {
                                url: `${$("[base-path]").val()}/pemeliharaans`,
                                dataType: "json",
                                data: (d) => {
                                    d.pidinventaris = row.data().id
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


                        document.querySelector(`#Pemanfaatan-${selectEvent}`).innerHTML = `<table class='mt-2 table  table-striped' id='table-pemanfaatan-<?= $uniqId ?>${selectEvent}'>
                            <thead>
                            </thead>
                        </table>`

                        let tablePemanfaatan = $(`#table-pemanfaatan-<?= $uniqId ?>${selectEvent}`).DataTable({
                            ajax: {
                                url: `${$("[base-path]").val()}/pemanfaatans`,
                                dataType: "json",
                                data: (d) => {
                                    d.pidinventaris = row.data().id
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
                                        onDokumenKronologisGetFiles(row.data().id);
                                    })
                                })
                            }
                        })

                        onDokumenKronologisGetFiles(row.data().id);

                        document.querySelector(`#History-${selectEvent}`).innerHTML = `
                        <div class='btn btn-success' onclick='onCompare("#table-history-<?= $uniqId ?>${selectEvent}")'>
                            Bandingkan
                        </div>
                        <br />
                        <br />
                        <table class='mt-2 table  table-striped' id='table-history-<?= $uniqId ?>${selectEvent}'>
                            <thead>
                            </thead>
                        </table>`

                        let tableHistory = $(`#table-history-<?= $uniqId ?>${selectEvent}`).DataTable({
                            ajax: {
                                url: `${$("[base-path]").val()}/inventarisHistories?fid=${row.data().id}`,
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


        function onLoadComplete() {
            __ajax({
                method: 'GET',
                url: `${$("[base-path]").val()}/api/inventaris-api/sum-harga-satuan`,
                data: recFilter
            }).then((d) => {
                $('.total_harga_satuan').html(d.all_page)
                $('.per_page_harga_satuan').html(d.per_page)

            })
        }

        let colCount = 1;

        // for handle comparing data inventaris history you only find the trigger in this file
        function onCompare(idTable) {
            let html = ''
            let selectedRows = $(idTable).DataTable().rows('.selected').data().toArray()

            if (selectedRows.length != 2) {
                swal.fire({
                    type: 'warning',
                    text: 'Silahkan pilih 1',
                })
                return
            }


            for (let index = 0; index < selectedRows.length; index++) {
                const element = selectedRows[index];

                if(colCount == 1) {
                    html += `<div class='row'>`
                }
                html += `<div class='col-md-4 mr-3'>Compare ${index} </br> </br> <table class='table table-striped table-bordered'>`;

                let keys = Object.keys(element);

                for (let keyIndex = 0; keyIndex < keys.length; keyIndex++) {
                    const elementKey = keys[keyIndex];

                    html += `<tr>
                            <td style='width: 50px'>${elementKey}</td>
                            <td style='width: 200px'>${element[elementKey]}</td>
                        </tr>`
                }

                html += `</table></div>`

                colCount++

                if(colCount >= 3) {
                    html += `</div>`
                    colCount = 1
                }
            }
            // get the selected
            $(`.modal-compare-body`).html(html)
            $(`#modal-compare`).modal('show')
        }
    </script>
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}


@endsection
