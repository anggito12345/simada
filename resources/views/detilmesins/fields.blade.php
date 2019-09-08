<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<!-- Pidinventaris Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pidinventaris', 'Pidinventaris:') !!}
    {!! Form::number('pidinventaris', null, ['class' => 'form-control']) !!}
</div>

<!-- Merk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('merk', 'Merk:') !!}
    {!! Form::number('merk', null, ['class' => 'form-control']) !!}
</div>

<!-- Ukuran Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ukuran', 'Ukuran:') !!}
    {!! Form::text('ukuran', null, ['class' => 'form-control']) !!}
</div>

<!-- Bahan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bahan', 'Bahan:') !!}
    {!! Form::text('bahan', null, ['class' => 'form-control']) !!}
</div>

<!-- Nopabrik Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nopabrik', 'Nopabrik:') !!}
    {!! Form::text('nopabrik', null, ['class' => 'form-control']) !!}
</div>

<!-- Norangka Field -->
<div class="form-group col-sm-6">
    {!! Form::label('norangka', 'Norangka:') !!}
    {!! Form::text('norangka', null, ['class' => 'form-control']) !!}
</div>

<!-- Nomesin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomesin', 'Nomesin:') !!}
    {!! Form::text('nomesin', null, ['class' => 'form-control']) !!}
</div>

<!-- Nopol Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nopol', 'Nopol:') !!}
    {!! Form::text('nopol', null, ['class' => 'form-control']) !!}
</div>

<!-- Bpkb Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bpkb', 'Bpkb:') !!}
    {!! Form::text('bpkb', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Dokumen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::text('dokumen', null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('detilmesins.index') !!}" class="btn btn-default">Cancel</a>
</div>
