<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi 1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kondisi_1', 'Kondisi 1:') !!}
    {!! Form::text('kondisi_1', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi 2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kondisi_2', 'Kondisi 2:') !!}
    {!! Form::text('kondisi_2', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi 3 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kondisi_3', 'Kondisi 3:') !!}
    {!! Form::text('kondisi_3', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi 4 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kondisi_4', 'Kondisi 4:') !!}
    {!! Form::text('kondisi_4', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sysWorkflowMasters.index') }}" class="btn btn-default">Cancel</a>
</div>
