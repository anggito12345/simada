<!-- Name Field -->
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('nip', 'Nip:') !!}
    {!! Form::text('nip', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('name', 'Nama:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('no_hp', 'HP:') !!}
    {!! Form::text('no_hp', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tgl_lahir', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?> ">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}&nbsp;
    <br />
    <div class="radio">
        {!! Form::radio('jenis_kelamin', 'L', true, []) !!} Laki - Laki <br />
        {!! Form::radio('jenis_kelamin', 'P', false, []) !!} Perempuan
    </div>
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('pid_organisasi', 'Organisasi:') !!}
    {!! Form::select('pid_organisasi', [], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('jabatan', 'Jabatan:') !!}
    {!! Form::text('jabatan', null, ['class' => 'form-control']) !!}
</div>
<!-- Email Verified At Field
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    {!! Form::text('email_verified_at', null, ['class' => 'form-control','id'=>'email_verified_at', 'autocomplete' => 'false']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#email_verified_at').datepicker({
            
        })
    </script>
@endsection -->

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('password_confirmation', 'Konfirmasi Password:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
<!-- Remember Token Field
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
@if(!isset($noBtnSubmit))
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?> col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
@endif

@section('scripts_2')
<script>
new inlineDatepicker(document.getElementById('tgl_lahir'), {
    format: 'DD-MM-YYYY',
    buttonClear: true,
});


$('#pid_organisasi').select2({
    ajax: {
        url: "<?= url('api/organisasis') ?>",
        dataType: 'json',
        processResults: function (data) {
        // Transforms the top-level key of the response object from 'items' to 'results'
            return {
                results: data.data
            };
        }
    },
    theme: 'bootstrap' , 
})
</script>

@if(isset($users))
<script>

App.Helpers.defaultSelect2(
    $("#pid_organisasi"), 
        `${$('[base-path]').val()}/api/organisasis/${<?= $users->pid_organisasi ?>}`,
        "id",
        "nama",
        () => {
    }
)
</script>
@endif
@endsection