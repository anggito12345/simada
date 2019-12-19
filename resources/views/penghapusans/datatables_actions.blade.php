{!! Form::open(['route' => ['penghapusans.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <!-- <a href="{{ route('penghapusans.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a> -->
    @if(!empty($draft))
        <a href="{{ route('penghapusans.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endif
</div>
{!! Form::close() !!}
