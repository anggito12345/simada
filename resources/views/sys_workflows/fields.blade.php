<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Trigger Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trigger', 'Trigger:') !!}
    {!! Form::text('trigger', null, ['class' => 'form-control']) !!}
</div>

<!-- Pid User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pid_user', 'Pid User:') !!}
    {!! Form::number('pid_user', null, ['class' => 'form-control']) !!}
</div>

<!-- Do Field -->
<div class="form-group col-sm-6">
    {!! Form::label('do', 'Do:') !!}
    {!! Form::text('do', null, ['class' => 'form-control']) !!}
</div>

<!-- Seq Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seq_order', 'Seq Order:') !!}
    {!! Form::number('seq_order', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('data', 'Data:') !!}
    {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Do Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_do', 'Data Do:') !!}
    {!! Form::text('data_do', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sysWorkflows.index') }}" class="btn btn-default">Cancel</a>
</div>
