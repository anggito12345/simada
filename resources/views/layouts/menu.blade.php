<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('inventaris*') ? 'active' : '' }}">
    <a href="{!! route('inventaris.index') !!}"><i class="fa fa-edit"></i><span>Inventaris</span></a>
</li>

<li class="{{ Request::is('pemeliharaans*') ? 'active' : '' }}">
    <a href="{!! route('pemeliharaans.index') !!}"><i class="fa fa-edit"></i><span>Pemeliharaans</span></a>
</li>

