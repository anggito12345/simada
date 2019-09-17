<div class="container">
    <!-- Name Field -->
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Email Field -->
    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Email Verified At Field
    <div class="form-group">
        {!! Form::label('email_verified_at', 'Email Verified At:') !!}
        {!! Form::text('email_verified_at', null, ['class' => 'form-control','id'=>'email_verified_at', 'autocomplete' => 'false']) !!}
    </div>

    @section('scripts')
        <script type="text/javascript">
            $('#email_verified_at').datepicker({
              
            })
        </script>
    @endsection -->

    <!-- Password Field -->
    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Konfirmasi Password:') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
    <!-- Remember Token Field
    <div class="form-group">
        {!! Form::label('remember_token', 'Remember Token:') !!}
        {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
    </div> -->

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
