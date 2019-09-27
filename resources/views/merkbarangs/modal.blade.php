<div class="modal" id="modal-merkbarang" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Merk Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-modal-merkbarang" class="container" onsubmit="return false">
            @include('merkbarangs.fields')
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="viewModel.modal.saveJsonMerkBarang()">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  viewModel.jsLoaded.subscribe(() => {
    viewModel.modal.saveJsonMerkBarang = () => {
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
  })
</script>