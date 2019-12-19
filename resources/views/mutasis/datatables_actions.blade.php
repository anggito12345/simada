{!! Form::open(['route' => ['mutasis.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @if(!empty($draft))
    <a href="{{ route('mutasis.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endif
</div>
{!! Form::close() !!}
