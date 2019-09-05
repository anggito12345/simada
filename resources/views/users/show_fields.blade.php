
<!-- Name Field -->
<div class="row">
    {!! Form::label('name', 'Name:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $users->name !!}</p>
</div>

<!-- Email Field -->
<div class="row">
    {!! Form::label('email', 'Email:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $users->email !!}</p>
</div>


