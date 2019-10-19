<!-- Npwp Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('npwp', 'Npwp:') !!}
    {!! Form::text('npwp', null, ['class' => 'form-control']) !!}
</div>

<!-- Siup Tdp Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('siup_tdp', 'Siup Tdp:') !!}
    {!! Form::text('siup_tdp', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Telp Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('telp', 'Telp:') !!}
    {!! Form::text('telp', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Usaha Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('jenis_usaha', 'Jenis Usaha:') !!}
    {!! Form::text('jenis_usaha', null, ['class' => 'form-control']) !!}
</div>

<!-- Pic Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pic', 'Pic:') !!}
    {!! Form::text('pic', null, ['class' => 'form-control']) !!}
</div>

<!-- Jabatan Pic Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('jabatan_pic', 'Jabatan Pic:') !!}
    {!! Form::text('jabatan_pic', null, ['class' => 'form-control']) !!}
</div>

<!-- Hp Pic Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('hp_pic', 'Hp Pic:') !!}
    {!! Form::text('hp_pic', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Pic Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('email_pic', 'Email Pic:') !!}
    {!! Form::text('email_pic', null, ['class' => 'form-control']) !!}
</div>

<!-- Aktf Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('aktf', 'Aktf:') !!}
    {!! Form::number('aktf', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mitras.index') !!}" class="btn btn-default">Cancel</a>
</div>
