{!! Form::open(['route' => ['mitras.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('mitras.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-search"></i>
    </a>
    <a href="{{ route('mitras.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
