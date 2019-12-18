{!! Form::open(['route' => ['pemeliharaans.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('pemeliharaans.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-search"></i>
    </a>
    @if ($draft == '1')
    <a href="{{ route('pemeliharaans.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endif
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
