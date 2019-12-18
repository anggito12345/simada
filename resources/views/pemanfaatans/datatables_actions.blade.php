{!! Form::open(['route' => ['pemanfaatans.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('pemanfaatans.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-search"></i>
    </a>
    @if(!empty($draft))
    <a href="{{ route('pemanfaatans.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
    @endif
    
</div>
{!! Form::close() !!}
