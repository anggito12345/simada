<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Nilai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nilai', 'Nilai:') !!}
    {!! Form::text('nilai', null, ['class' => 'form-control']) !!}
</div>

<!-- Aktif Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aktif', 'Aktif:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('aktif', 0) !!}
        {!! Form::checkbox('aktif', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('settings.index') !!}" class="btn btn-default">Cancel</a>
</div>
