$('<?= "#merk-".$idPostfix ?>').select2({
    ajax: {
        url: "<?= url('api/merkbarangs') ?>",
        dataType: 'json',
        processResults: function (data) {

            let options = {
                id: "-",
                text: "<div class='text-gray'>Tambah Merk Barang Baru</div>"
            }
            let id = '<?=  "#merk-".$idPostfix ?>'
            if (id.indexOf("non-ajax") > -1) {
                data.data.unshift(options)
            }
            
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
                results: data.data
            };
        }
    },
    templateResult: function (d) {                 
        return $("<span>"+d.text+"</span>"); 
    },
    templateSelection: function (d) { return $("<span>"+d.text+"</span>"); },
    theme: 'bootstrap' ,
})

$('<?=  "#merk-".$idPostfix ?>').on('select2:select', function (e) {
    var data = e.params.data;
    if (data.id == "-") {
        $("#modal-merkbarang").modal("show")
        $('<?=  "#merk-".$idPostfix ?>').val("").trigger("change")
    }
});


// handler modal section here
// this function will available if implement modal section
function saveJsonMerkBarang() {
    $.ajax({
        url: "<?= url('api/merkbarangs') ?>",
        dataType: "json",
        method: "POST",
        data: App.Helpers.getFormData($("#form-modal-merkbarang")),
        success: (response) => {
            if (response.success) {
                Swal.fire({
                    type: 'success',
                    text: 'Data berhasil disimpan',
                })
            } else {
                Swal.fire({
                    type: 'error',
                    text: 'Data gagal disimpan',
                })
            }
            
            $("#modal-merkbarang").modal("hide")
        },
        error: (response) => {                    
            Swal.fire({
                type: 'error',
                text: 'Data gagal disimpan',
            })
        }
    })
}


$('<?=  "#pidinventaris-".$idPostfix ?>').select2({
    ajax: {
        url: "<?= url('api/inventaris') ?>",
        dataType: 'json',
        processResults: function (data) {

            let options = {
                id: "-",
                text: "<div class='text-gray'>Tambah Inventaris Baru</div>"
            }
            let id = '<?=  "#pidinventaris-".$idPostfix ?>'
            if (id.indexOf("non-ajax") > -1) {
                data.data.unshift(options)
            }                    
            return {
                results: data.data
            };
        }
    },
    templateResult: function (d) {                 
        return $("<span>"+d.text+"</span>"); 
    },
    templateSelection: function (d) { return $("<span>"+d.text+"</span>"); },
    theme: 'bootstrap' ,
})

$('<?=  "#pidinventaris-".$idPostfix ?>').on('select2:select', function (e) {
    var data = e.params.data;
    if (data.id == "-") {
        $("#modal-inventaris").modal("show")
        $('<?=  "#pidinventaris-".$idPostfix ?>').val("").trigger("change")
    }
});


// handler modal section here
// this function will available if implement modal section
function saveJson() {

    $.ajax({
        url: "<?= url('api/inventaris') ?>",
        dataType: "json",
        method: "POST",
        data: App.Helpers.getFormData($("#form-modal-inventaris")),
        success: (response) => {
            if (response.success) {
                Swal.fire({
                    type: 'success',
                    text: 'Data berhasil disimpan',
                })
            } else {
                Swal.fire({
                    type: 'error',
                    text: 'Data gagal disimpan',
                })
            }
            
            $("#modal-inventaris").modal("hide")
        },
        error: (response) => {                    
            Swal.fire({
                type: 'error',
                text: 'Data gagal disimpan',
            })
        }
    })
}