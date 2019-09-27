<?php 
    $idPostfix = "";
    $notShowSubmit = true; 
?>
<div class="box box-primary">
  <div class="box-header bg-blue" >
    <div class="collapse-toggle" data-toggle="collapse" data-target="#detilkib" data-bind="text: 'Tampilkan ' + viewModel.data.tipeKib()">
    </div>
  </div>    
  <div class="box-body collapse" id="detilkib">
      <div class="collapse-toggle" data-bind="visible: viewModel.data.tipeKib() == 'KIB A'">
        @include('detiltanahs.fields')
      </div>
      <div data-bind="visible: viewModel.data.tipeKib() == 'KIB B'">
        @include('detilmesins.fields')
      </div>
      <div data-bind="visible: viewModel.data.tipeKib() == 'KIB C'">
        @include('detilbangunans.fields')
      </div>
  </div>
</div>