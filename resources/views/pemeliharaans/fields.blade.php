<!-- Tgl Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tgl', 'Tanggal Buku Pemeliharaan:') !!}
    {!! Form::date('tgl', null, ['class' => 'form-control','id'=>'tgl']) !!}
</div>

<!-- Uraian Field -->
<div class="form-group col-sm-12">
    {!! Form::label('uraian', 'Uraian:') !!}
    {!! Form::text('uraian', null, ['class' => 'form-control']) !!}
</div>

<!-- Persh Field -->
<div class="form-group col-sm-12">
    {!! Form::label('persh', 'Persh:') !!}
    {!! Form::text('persh', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Nokontrak Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nokontrak', 'Nokontrak:') !!}
    {!! Form::text('nokontrak', null, ['class' => 'form-control']) !!}
</div>

<!-- Tglkontrak Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tglkontrak', 'Tglkontrak:') !!}
    {!! Form::date('tglkontrak', null, ['class' => 'form-control','id'=>'tglkontrak']) !!}
</div>


<!-- Biaya Field -->
<div class="form-group col-sm-12">
    {!! Form::label('biaya', 'Biaya:') !!}
    {!! Form::number('biaya', null, ['class' => 'form-control']) !!}
</div>

<!-- Menambah Field -->
<div class="form-group col-sm-12">
    {!! Form::label('menambah', 'Menambah:') !!}
    {!! Form::number('menambah', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pemeliharaans.index') !!}" class="btn btn-default">Cancel</a>
</div>
