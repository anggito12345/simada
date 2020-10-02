<!-- Nama Field -->
<div class="form-group">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $sysWorkflow->nama }}</p>
</div>

<!-- Trigger Field -->
<div class="form-group">
    {!! Form::label('trigger', 'Trigger:') !!}
    <p>{{ $sysWorkflow->trigger }}</p>
</div>

<!-- Pid User Field -->
<div class="form-group">
    {!! Form::label('pid_user', 'Pid User:') !!}
    <p>{{ $sysWorkflow->pid_user }}</p>
</div>

<!-- Do Field -->
<div class="form-group">
    {!! Form::label('do', 'Do:') !!}
    <p>{{ $sysWorkflow->do }}</p>
</div>

<!-- Seq Order Field -->
<div class="form-group">
    {!! Form::label('seq_order', 'Seq Order:') !!}
    <p>{{ $sysWorkflow->seq_order }}</p>
</div>

<!-- Data Field -->
<div class="form-group">
    {!! Form::label('data', 'Data:') !!}
    <p>{{ $sysWorkflow->data }}</p>
</div>

<!-- Data Do Field -->
<div class="form-group">
    {!! Form::label('data_do', 'Data Do:') !!}
    <p>{{ $sysWorkflow->data_do }}</p>
</div>

