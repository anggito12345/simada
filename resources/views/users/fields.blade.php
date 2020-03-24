<!-- Name Field -->
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('nip', 'NIP:') !!} <span class='text text-danger'>*</span>
    {!! Form::text('nip', null, ['class' => 'form-control', 'maxlength' => '18', 'minlength' => '18']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('name', 'Nama:') !!} <span class='text text-danger'>*</span>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('email', 'Email:') !!} <span class='text text-danger'>*</span>
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('no_hp', 'HP:') !!} <span class='text text-danger'>*</span>
    {!! Form::text('no_hp', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!} <span class='text text-danger'>*</span>
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
    {!! Form::label('pid_organisasi', 'Organisasi:') !!} <span class='text text-danger'>*</span>
    {!! Form::select('pid_organisasi', [], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('jabatan', 'Jabatan:') !!} <span class='text text-danger'>*</span>
    {!! Form::select('jabatan', [], null, ['class' => 'form-control']) !!}
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
    {!! Form::label('username', 'Username:') !!} <span class='text text-danger'>*</span>
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('password', 'Password:') !!} <span class='text text-danger'>*</span>
    {!! Form::password('password', ['class' => 'form-control', 'readonly' => 'true', 'onfocus' => 'this.removeAttribute("readonly");this.blur();    this.focus();']) !!}
</div>

<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('password_confirmation', 'Konfirmasi Password:') !!} <span class='text text-danger'>*</span>
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'readonly' => 'true', 'onfocus' => 'this.removeAttribute("readonly");this.blur();    this.focus();']) !!}
</div>
<!-- Remember Token Field
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?>">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
@if(!isset($noBtnSubmit))
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?> col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif

@section('scripts_2')
    @include('users.script')
@endsection