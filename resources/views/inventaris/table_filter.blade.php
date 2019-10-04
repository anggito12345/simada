
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('draft', 'Draft:') }}
            {{ Form::select('draft', \App\Models\BaseModel::$YesNoDs, 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
    </div>    
</div>