
<!-- NIPield -->
<div class="row">
    {!! Form::label('nip', 'NIP:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $users->nip !!}</p>
</div>

<!-- Name Field -->
<div class="row">
    {!! Form::label('name', 'Name:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $users->name !!}</p>
</div>

<!-- Username Field -->
<div class="row">
    {!! Form::label('username', 'Username:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $users->username !!}</p>
</div>

<div class="row">
    {!! Form::label('tgl_lahir', 'Tanggal Lahir:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $users->tgl_lahir !!}</p>
</div>


<div class="row">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$JenisKelaminDs[$users->jenis_kelamin] !!}</p>
</div>


<div class="row">
    {!! Form::label('email', 'Email:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $users->email !!}</p>
</div>


