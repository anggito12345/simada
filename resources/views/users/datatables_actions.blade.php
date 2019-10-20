
<div class='btn-group'>
    <a href="{{ route('users.show', $id) }}" class='btn btn-default btn-sm'>
        <i class="fa fa-search"></i>
    </a>
    <a href="{{ route('users.edit', $id) }}" class='btn btn-default btn-sm'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-sm',
            'onclick' => "return confirm('Anda Yakin?')"
        ]) !!}    
    {!! Form::close() !!}
    {!! Form::open(['route' => ['users.update', $id], 'method' => 'PATCH', 'class' => 'pull-right']) !!}
        
        @if($aktif == 0)
            {!! Form::hidden('from_aktif_process', '1', []) !!}
            {!! Form::button($email_verification_code != '' ? 'Kirim Ulang Email' : 'Kirim Email', [
                'type' => 'submit',
                'class' => 'btn btn-primary btn-sm ml-1',
                'onclick' => "return confirm('Anda Yakin?')"
            ]) !!}
        @else 
            {!! Form::hidden('aktif', '0', []) !!}
            {!! Form::button('Non Aktifkan', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-sm ml-1',
                'onclick' => "return confirm('Anda Yakin?')"
            ]) !!}
        @endif
    {!! Form::close() !!}
</div>





