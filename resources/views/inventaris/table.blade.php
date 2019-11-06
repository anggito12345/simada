@section('css')
    @include('layouts.datatables_css')
@endsection


{!! $dataTable->table(['id' => 'table-inventaris', 'width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@section('scripts')
    
    <script>    
        let colspan = {
            "Kode Barang": {
                value: 2, 
                title: "Nomor"
            },
        }

        let isReady = {
            
        }

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
                    fileGalleryPemanfaatan.fileList([])
                    fotoPemanfaatan.fileList([])
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
        
        function onLoadDataTable(e) {
            
            if (isReady[e.sTableId]) {
                return
            }

            let allHeader = $(e.nTHead).find("th")
            let createdMerge = document.createElement("tr")
            createdMerge.setAttribute("row-cloned" ,true)
            let headerByPass = 0
            
            // for (let i = 0; i < allHeader.length ; i ++) {
            //     const col = allHeader[i]
            //     let th = document.createElement("th")
            //     let title = col.getAttribute('title')
            //     if (colspan[title] != undefined && headerByPass == 0) {
                    
            //         th.setAttribute("colspan",2)
            //         th.innerHTML = colspan[title].title
            //         th.style.textAlign = "center"
                    
            //         createdMerge.appendChild(th)
            //         headerByPass = colspan[title].value                    
            //     }

            //     if (headerByPass > 0) {                    
            //         headerByPass--
            //     } else {

            //         th = col.cloneNode(true)

            //         th.setAttribute("rowspan",2)

            //         th.addEventListener("click", (ev) => {
            //             col.click();     
            //             let currentClassname = ev.target.className                   

            //             $("[row-cloned] th[col-cloned]").attr("class", "sorting")

            //             if ( currentClassname  == "sorting_asc") {
            //                 ev.target.className = "sorting_desc"
            //             } else {
            //                 ev.target.className = "sorting_asc"
            //             }
                        
            //         })

            //         if (th.className.indexOf("sorting_disabled") < 0) {
            //             th.setAttribute("col-cloned", true)
            //         }
                    

            //         th.style.verticalAlign = "middle"
            //         createdMerge.appendChild(th)

            //         col.style.display = "none"

            //     }


            // }

            isReady[e.sTableId] = true

            let element = $(e.nTHead).find("tr")[0]

            e.nTHead.prepend(createdMerge)

            // var template = Handlebars.compile($("#details-template").html())

            const tabItems = [
                "Detail",
                "Pemeliharaan",
                // "Penghapusan"
                "Pemanfaatan"
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

                    aNavItemReadyForInit.textContent = tabItem

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
                    $.get(`${$("[base-path]").val()}${viewModel.data.urlEachKIB("kib"+row.data().kelompok_kib)}/${row.data().pidinventaris == undefined ? row.data().id : row.data().pidinventaris}`).then((data) => {
                                                
                        let url = viewModel.data.informations[kib].url

                        row.child($(`<tr style="background:white" class="detail-pemeliharaan"><td colspan="${allHeader.length}">${ulTabs.outerHTML}${tabContent.outerHTML}</td>/tr>`)).show();

                        tr.addClass('shown');
                        if (data.data == null) {
                            document.querySelector(`#Detail-${selectEvent}`).innerHTML = '<div class="text-center">Data not found</div>'
                        } else {
                            $.get(`${$("[base-path]").val()}/${url}/${data.data.id}?isAjax=true`).then((html) => {                                                        
                                document.querySelector(`#Detail-${selectEvent}`).innerHTML = $(html).find(".container-view")[0].outerHTML
                            })
                        }
                        
                                                                         
                        document.querySelector(`#Pemeliharaan-${selectEvent}`).innerHTML = `<table class='mt-2 table table-bordered table-striped' id='table-pemeliharaan-<?= $uniqId ?>${selectEvent}'>
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
                                {
                                    extend: 'collection',
                                    text: 'Action',
                                    buttons: [
                                        {
                                            text: "Edit",
                                            action: function () {
                                                var count = table.rows('.selected').count();
                            
                                                if (count != 1) {
                                                    swal.fire({
                                                        type: 'error',
                                                        text: 'Silahkan pilih 1 data',
                                                        title: 'Pemeliharaan'
                                                    })
                                                    return
                                                }

                                                onPemeliharaan(table.rows('.selected').data()[0], `#table-pemeliharaan-<?= $uniqId ?>${selectEvent}`)
                                            }
                                        },
                                        {
                                            text: "Delete",
                                            action: function () {
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
                                                    url : $("[base-path]").val() + "/api/pemeliharaans/" + table.rows('.selected').data().map((d) => {
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
                                                        }
                                                    })
                                                })
                                            }
                                        }
                                    ]
                                    
                                }
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


                        document.querySelector(`#Pemanfaatan-${selectEvent}`).innerHTML = `<table class='mt-2 table table-bordered table-striped' id='table-pemanfaatan-<?= $uniqId ?>${selectEvent}'>
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
                                {
                                    extend: 'collection',
                                    text: 'Action',
                                    buttons: [
                                        {
                                            text: "Edit",
                                            action: function () {
                                                var count = tablePemanfaatan.rows('.selected').count();
                            
                                                if (count != 1) {
                                                    swal.fire({
                                                        type: 'error',
                                                        text: 'Silahkan pilih 1 data',
                                                        title: 'Pemanfaatan'
                                                    })
                                                    return
                                                }

                                                onPemanfaatan(tablePemanfaatan.rows('.selected').data()[0], `#table-pemanfaatan-${selectEvent}`)
                                            }
                                        },
                                        {
                                            text: "Delete",
                                            action: function () {
                                                var count = tablePemanfaatan.rows('.selected').count();
                            
                                                if (count < 1) {
                                                    swal.fire({
                                                        type: 'error',
                                                        text: 'Silahkan pilih minimal 1 data',
                                                        title: 'Pemanfaatan'
                                                    })
                                                    return
                                                }

                                                __ajax({
                                                    url : $("[base-path]").val() + "/api/pemanfaatans/" + tablePemanfaatan.rows('.selected').data().map((d) => {
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
                                                            tablePemanfaatan.ajax.reload();
                                                        }
                                                    })
                                                })
                                            }
                                        }
                                    ]
                                    
                                }
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
                        
                    })
                    
                }
            });
        }
        
    </script>
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

    
@endsection