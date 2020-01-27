<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('Draft') }}
            {{ Form::select('draft', ['Tidak', 'Ya'], null, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.refreshDatatable()'])}}
        </div>
    </div>
</div>