<div class="form-group btn btn-default" data-toggle="collapse" data-target="#collapse-kib-form">
    Tampilkan KIB
</div>  

<?php 
    $idPostfix = "";
    $notShowSubmit = true; 
?>
<div class="collapse" id="collapse-kib-form">
  <div class="box box-primary">
    <div class="box-header bg-blue" data-bind="text: viewModel.data.tipeKib">
    </div>    
    <div class="box-body">
        @include('detiltanahs.fields')
    </div>
  </div>
</div>