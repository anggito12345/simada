

<li class="treeview {{ Request::is('inventaris*') || Request::is('pemeliharaans*') || Request::is('penghapusans*')? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-edit"></i>
        <span>Transaksi</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
   
    <ul class="treeview-menu">
        <li class="{{ Request::is('inventaris*') ? 'active' : '' }}">
            <a href="{!! route('inventaris.index') !!}"><i class="fa fa-edit"></i><span>Inventaris</span></a>
        </li>
        <li class="{{ Request::is('pemeliharaans*') ? 'active' : '' }}">
            <a href="{!! route('pemeliharaans.index') !!}"><i class="fa fa-edit"></i><span>Pemeliharaan</span></a>
        </li>

        <li class="{{ Request::is('penghapusans*') ? 'active' : '' }}">
            <a href="{!! route('penghapusans.index') !!}"><i class="fa fa-edit"></i><span>Penghapusan</span></a>
        </li>
    </ul>
</li>

<li class="treeview {{ Request::is('users*')? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-wrench"></i>
        <span>Pengaturan</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
   
    <ul class="treeview-menu">
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Users</span></a>
        </li>
    </ul>
</li>



