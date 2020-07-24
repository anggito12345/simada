<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! url('/home') !!}"><i class="fa fa-home"></i><span>Dashboard</span></a>
</li>

<li class="treeview {{ Request::is('inventaris*', 'penghapusans*', 'pemeliharaans*', 'pemanfaatans*', 'mutasis*', 'rkas*', 'reklas*', 'koreksis*') ? 'active' : '' }}">
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
        <li class="{{ Request::is('pemeliharaans*') ? 'active' : '' }}">
            <a href="{!! route('pemeliharaans.index') !!}"><i class="fa fa-edit"></i><span>Pemeliharaan</span></a>
        </li>
        @if(c::is([],[],[Constant::$GROUP_OPD_ORG, Constant::$GROUP_BPKAD_ORG]))
        <li class="{{ Request::is('penghapusans*') ? 'active' : '' }}">
            <a href="{!! route('penghapusans.index') !!}"><i class="fa fa-edit"></i><span>Penghapusan</span></a>
        </li>
        <li class="{{ Request::is('pemanfaatans*') ? 'active' : '' }}">
            <a href="{!! route('pemanfaatans.index') !!}"><i class="fa fa-edit"></i><span>Pemanfaatan</span></a>
        </li>
        <li class="{{ Request::is('mutasis*') ? 'active' : '' }}">
            <a href="{!! route('mutasis.index') !!}"><i class="fa fa-edit"></i><span>Mutasi Keluar</span></a>
        </li>
        <li class="{{ Request::is('rkas*') ? 'active' : '' }}">
            <a href="{!! route('rkas.index') !!}"><i class="fa fa-edit"></i><span>RKA</span></a>
        </li>
        <li class="{{ Request::is('reklas*') ? 'active' : '' }}">
            <a href="{!! route('reklas.index') !!}"><i class="fa fa-edit"></i><span>Reklas</span></a>
        </li>
        @endif
        @if (c::is([],[],[Constant::$GROUP_BPKAD_ORG]))
            <li class="{{ Request::is('koreksis*') ? 'active' : '' }}">
                <a href="{!! route('koreksis.index') !!}"><i class="fa fa-edit"></i><span>Koreksi</span></a>
            </li>
        @endif
    </ul>
</li>
@if(c::is([],[],[Constant::$GROUP_BPKAD_ORG]))
<li class="{{ Request::is('barangs*') ? 'active' : '' }}">
    <a href="{!! route('barangs.index') !!}"><i class="fa fa-car"></i><span>Master Barang</span></a>
</li>
<li class="{{ Request::is('rkaBarangs*') ? 'active' : '' }}">
    <a href="{{ route('rkaBarangs.index') }}"><i class="fa fa-cubes"></i><span>Master Barang RKA</span></a>
</li>

<li class="treeview {{ Request::is('alamats*', 'jenisbarangs*', 'kondisis*', 'merkbarangs*', 'organisasis*', 'perolehans*', 'satuanbarangs*', 'pengunaans*', 'mitras*', 'statustanahs*') && !Request::is('organisasis/settings') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-edit"></i>
        <span>Master Data</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li class="{{ Request::is('alamats*') ? 'active' : '' }}">
            <a href="{!! route('alamats.index') !!}"><i class="fa fa-edit"></i><span>Lokasi</span></a>
        </li>
        <!-- <li class="{{ Request::is('jenisbarangs*') ? 'active' : '' }}">
            <a href="{!! route('jenisbarangs.index') !!}"><i class="fa fa-edit"></i><span>Jenis Barang</span></a>
        </li> -->
        <!-- <li class="{{ Request::is('kondisis*') ? 'active' : '' }}">
            <a href="{!! route('kondisis.index') !!}"><i class="fa fa-edit"></i><span>Kondisi</span></a>
        </li> -->
        <li class="{{ Request::is('merkbarangs*') ? 'active' : '' }}">
            <a href="{!! route('merkbarangs.index') !!}"><i class="fa fa-edit"></i><span>Merk Barang</span></a>
        </li>
        <li class="{{ Request::is('organisasis*') && !Request::is('organisasis/settings') ? 'active' : '' }}">
            <a href="{!! route('organisasis.index') !!}"><i class="fa fa-edit"></i><span>Organisasi</span></a>
        </li>
        <!-- <li class="{{ Request::is('perolehans*') ? 'active' : '' }}">
            <a href="{!! route('perolehans.index') !!}"><i class="fa fa-edit"></i><span>Perolehan</span></a>
        </li> -->
        <li class="{{ Request::is('satuanbarangs*') ? 'active' : '' }}">
            <a href="{!! route('satuanbarangs.index') !!}"><i class="fa fa-edit"></i><span>Satuan Barang</span></a>
        </li>
        <!-- <li class="{{ Request::is('jenisopds*') ? 'active' : '' }}">
            <a href="{!! route('jenisopds.index') !!}"><i class="fa fa-edit"></i><span>Jenis OPD</span></a>
        </li> -->
        <!-- <li class="{{ Request::is('statustanahs*') ? 'active' : '' }}">
            <a href="{!! route('statustanahs.index') !!}"><i class="fa fa-edit"></i><span>Status Tanah</span></a>
        </li> -->
        <li class="{{ Request::is('mitras*') ? 'active' : '' }}">
            <a href="{!! route('mitras.index') !!}"><i class="fa fa-edit"></i><span>Mitra</span></a>
        </li>
        <li class="{{ Request::is('pengunaans*') ? 'active' : '' }}">
            <a href="{!! route('pengunaans.index') !!}"><i class="fa fa-edit"></i><span>Pengunaan KIB A</span></a>
        </li>
    </ul>
</li>

<?php
$countUserNeedOtor = \App\Models\users::where('aktif', '0')->count();
?>

<li class="treeview {{ Request::is('users*', 'organisasis/settings', 'jabatans', 'settings')? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-wrench"></i>
        <span>Pengaturan</span>
        <span class="bg-green padding-notif"><?= $countUserNeedOtor ?></span>
        <span class="pull-right-container">

            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('users*')
        || Request::is('jabatans*')
        || Request::is('settings*')
        ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}">
                <i class="fa fa-users"></i>
                <span>Users</span>
                <div class="pull-right-container">
                    <div class="bg-green padding-notif"><?= $countUserNeedOtor ?></div>
                </div>
            </a>
        </li>
        <li class="{{ Request::is('organisasis/settings') ? 'active' : '' }}">
            <a href="{!! route('organisasis.settings') !!}"><i class="fa fa-building"></i><span>OPD</span></a>
        </li>
        <li class="{{ Request::is('jabatans*') ? 'active' : '' }}">
            <a href="{!! route('jabatans.index') !!}"><i class="fa fa-edit"></i><span>Jabatan/Roles</span></a>
        </li>
        <li class="{{ Request::is('import*') ? 'active' : '' }}">
            <a href="{!! route('import.index') !!}"><i class="fa fa-import"></i><span>Import Data</span></a>
        </li>
        <li class="{{ Request::is('settings*') ? 'active' : '' }}">
            <a href="{!! route('settings.index') !!}"><i class="fa fa-edit"></i><span>Setting</span></a>
        </li>

    </ul>
</li>
@endif

