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
            <a href="{!! route('inventaris.index') !!}"><i class="fa fa-edit"></i><span>Penata Usahaan</span></a>
        </li>
        <!-- <li class="{{ Request::is('pemeliharaans*') ? 'active' : '' }}">
            <a href="{!! route('pemeliharaans.index') !!}"><i class="fa fa-edit"></i><span>Pemeliharaan</span></a>
        </li>

        <li class="{{ Request::is('penghapusans*') ? 'active' : '' }}">
            <a href="{!! route('penghapusans.index') !!}"><i class="fa fa-edit"></i><span>Penghapusan</span></a>
        </li> -->
    </ul>
</li>

<li class="{{ Request::is('barangs*') ? 'active' : '' }}">
    <a href="{!! route('barangs.index') !!}"><i class="fa fa-car"></i><span>Master Barang</span></a>
</li>

<li class="treeview {{ Request::is('alamats*') 
    || Request::is('jenisbarangs*') 
    || Request::is('kondisis*') 
    || Request::is('lokasis*') 
    || Request::is('merkbarangs*') 
    || Request::is('organisasis*') 
    || Request::is('perolehans*') 
    || Request::is('satuanbarangs*') 
    || Request::is('jenisopds*')
    || Request::is('statustanahs*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-edit"></i>
        <span>Master Data</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
   
    <ul class="treeview-menu">
        <li class="{{ Request::is('alamats*') ? 'active' : '' }}">
            <a href="{!! route('alamats.index') !!}"><i class="fa fa-edit"></i><span>Alamat</span></a>
        </li>
        <li class="{{ Request::is('jenisbarangs*') ? 'active' : '' }}">
            <a href="{!! route('jenisbarangs.index') !!}"><i class="fa fa-edit"></i><span>Jenis Barang</span></a>
        </li>
        <li class="{{ Request::is('kondisis*') ? 'active' : '' }}">
            <a href="{!! route('kondisis.index') !!}"><i class="fa fa-edit"></i><span>Kondisi</span></a>
        </li>
        <li class="{{ Request::is('lokasis*') ? 'active' : '' }}">
            <a href="{!! route('lokasis.index') !!}"><i class="fa fa-edit"></i><span>Lokasi</span></a>
        </li>
        <li class="{{ Request::is('merkbarangs*') ? 'active' : '' }}">
            <a href="{!! route('merkbarangs.index') !!}"><i class="fa fa-edit"></i><span>Merk Barang</span></a>
        </li>
        <li class="{{ Request::is('organisasis*') ? 'active' : '' }}">
            <a href="{!! route('organisasis.index') !!}"><i class="fa fa-edit"></i><span>Organisasi</span></a>
        </li>
        <li class="{{ Request::is('perolehans*') ? 'active' : '' }}">
            <a href="{!! route('perolehans.index') !!}"><i class="fa fa-edit"></i><span>Perolehan</span></a>
        </li>
        <li class="{{ Request::is('satuanbarangs*') ? 'active' : '' }}">
            <a href="{!! route('satuanbarangs.index') !!}"><i class="fa fa-edit"></i><span>Satuan Barang</span></a>
        </li>
        <li class="{{ Request::is('jenisopds*') ? 'active' : '' }}">
            <a href="{!! route('jenisopds.index') !!}"><i class="fa fa-edit"></i><span>Jenis OPD</span></a>
        </li>
        <li class="{{ Request::is('statustanahs*') ? 'active' : '' }}">
            <a href="{!! route('statustanahs.index') !!}"><i class="fa fa-edit"></i><span>Status Tanah</span></a>
        </li>
    </ul>
</li>

<?php 
    $countUserNeedOtor = \App\Models\users::where('aktif','0')->count();
?>

<li class="treeview {{ Request::is('users*')? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-wrench"></i>
        <span>Pengaturan</span>
        <span class="bg-green padding-notif"><?= $countUserNeedOtor ?></span>
        <span class="pull-right-container">
            
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>   
    <ul class="treeview-menu">
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}">
                <i class="fa fa-users"></i>
                <span>Users</span>
                <div class="pull-right-container">
                    <div class="bg-green padding-notif"><?= $countUserNeedOtor ?></div>
                </div>
            </a>
        </li>
        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
            <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
        </li>

    </ul>
</li>
