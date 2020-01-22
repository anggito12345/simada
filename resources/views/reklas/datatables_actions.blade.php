{!! Form::open(['route' => ['reklas.destroy', $headerid], 'method' => 'delete']) !!}
<div class='btn-group'>
    {{-- <a href="{{ route('reklas.show', $headerid) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a> --}}
    {{-- @if(!empty($draft))
        <a href="{{ route('reklas.edit', $headerid) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-search"></i>
        </a>
    @endif --}}
</div>
{!! Form::close() !!}
