<!-- Pidinventaris Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pidinventaris', __('field.pidinventaris')) !!}
    {!! Form::select('pidinventaris',[], null, ['class' => 'form-control']) !!}
</div>

<!-- Noreg Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('noreg', __('field.noreg')) !!}
    {!! Form::text('noreg', null, ['class' => 'form-control']) !!}
</div>

<!-- Tglhapus Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tglhapus', __('field.tglhapus')) !!}
    {!! Form::text('tglhapus', null, ['class' => 'form-control','id'=>'tglhapus']) !!}
</div>

<!-- Kriteria Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('kriteria', 'Kriteria:') !!}
    {!! Form::text('kriteria', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('kondisi', 'Kondisi:') !!}
    {!! Form::select('kondisi', \App\Models\BaseModel::$kondisiDs , null, ['class' => 'form-control']) !!}
</div>

<!-- Harga Apprisal Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('harga_apprisal', 'Harga Apprisal:') !!}
    {!! Form::text('harga_apprisal', null, ['class' => 'form-control']) !!}
</div>

<!-- Dokumen Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('dokumen', 'Dokumen:') !!} <br />
    {!! Form::file('dokumen', ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('foto', 'Foto:') !!} <br />
    {!! Form::file('foto', ['class' => 'form-control']) !!}
</div>

<!-- Nosk Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nosk', 'No sk:') !!}
    {!! Form::text('nosk', null, ['class' => 'form-control']) !!}
</div>

<!-- Tglsk Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tglsk', 'Tgl sk:') !!}
    {!! Form::text('tglsk', null, ['class' => 'form-control','id'=>'tglsk']) !!}
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

        $('#tglhapus').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('#tglsk').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    </script>

     @if (isset($penghapusan))
    <script>
        App.Helpers.defaultSelect2($('#pidinventaris'), "<?= url('api/inventaris', [$penghapusan->pidinventaris]) ?>","id","noreg")
    </script>
    @endif
@endsection

<!-- Keterangan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('penghapusans.index') !!}" class="btn btn-default">Cancel</a>
</div>
