{!! Form::open(['route' => ['alamats.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('alamats.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-search"></i>
    </a>
    @if (Auth::user()->hasAnyPermission(['master.*', 'master.lokasi.*', 'master.lokasi.update']))
        <a href="{{ route('alamats.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endif
    @if (Auth::user()->hasAnyPermission(['master.*', 'master.lokasi.*', 'master.lokasi.delete']))
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endif
</div>
{!! Form::close() !!}
