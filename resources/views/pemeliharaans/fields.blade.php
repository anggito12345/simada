<!-- Pidinventaris Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pidinventaris', __('field.pidinventaris')) !!}
    {!! Form::select('pidinventaris', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tgl', 'Tanggal:') !!}
    {!! Form::text('tgl', null, ['class' => 'form-control','id'=>'tgl']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#pidinventaris').select2({
            ajax: {
                url: "<?= url('api/inventaris') ?>",
                dataType: 'json',
                processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data
                };
                }
            } 
        })
        
        $('#tgl').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('#tglkontrak').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

    </script>
@endsection

<!-- Uraian Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('uraian', 'Uraian:') !!}
    {!! Form::textarea('uraian', null, ['class' => 'form-control']) !!}
</div>

<!-- Persh Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('persh', __('field.persh')) !!}
    {!! Form::text('persh', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Nokontrak Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nokontrak', 'No Kontrak:') !!}
    {!! Form::text('nokontrak', null, ['class' => 'form-control']) !!}
</div>

<!-- Tglkontrak Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tglkontrak', 'Tgl kontrak:') !!}
    {!! Form::text('tglkontrak', null, ['class' => 'form-control','id'=>'tglkontrak']) !!}
</div>


<!-- Biaya Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('biaya', 'Biaya:') !!}
    {!! Form::number('biaya', null, ['class' => 'form-control']) !!}
</div>

<!-- Menambah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('menambah', 'Menambah:') !!}
    <div class="radio">
        {!! Form::radio('menambah', 1, isset($pemeliharaan) ? $pemeliharaan->menambah == 1 : false) !!} Ya
        {!! Form::radio('menambah', 0, isset($pemeliharaan) ? $pemeliharaan->menambah == 0 : false) !!} Tidak
    </div>    
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pemeliharaans.index') !!}" class="btn btn-default">Cancel</a>
</div>
