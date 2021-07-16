<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! url('/home') !!}"><i class="fa fa-home"></i><span>Dashboard</span></a>
</li>
@if(
    Auth::user()->hasPermissionTo('transaksi.*') ||
    Auth::user()->hasPermissionTo('transaksi.inventaris.*') ||
    Auth::user()->hasPermissionTo('transaksi.inventaris.read') ||
    Auth::user()->hasPermissionTo('transaksi.mutasi.*') ||
    Auth::user()->hasPermissionTo('transaksi.mutasi.read') ||
    Auth::user()->hasPermissionTo('transaksi.penghapusan.*') ||
    Auth::user()->hasPermissionTo('transaksi.penghapusan.read') ||
    Auth::user()->hasPermissionTo('transaksi.pemeliharaan.*') ||
    Auth::user()->hasPermissionTo('transaksi.pemeliharaan.read') ||
    Auth::user()->hasPermissionTo('transaksi.pemanfaatan.*') ||
    Auth::user()->hasPermissionTo('transaksi.pemanfaatan.read') ||
    Auth::user()->hasPermissionTo('transaksi.rka.*') ||
    Auth::user()->hasPermissionTo('transaksi.rka.read') ||
    Auth::user()->hasPermissionTo('transaksi.reklas.*') ||
    Auth::user()->hasPermissionTo('transaksi.reklas.read') ||
    Auth::user()->hasPermissionTo('transaksi.sensus.*') ||
    Auth::user()->hasPermissionTo('transaksi.sensus.read') ||
    Auth::user()->hasPermissionTo('transaksi.koreksi.*') ||
    Auth::user()->hasPermissionTo('transaksi.koreksi.read')
)
<li class="treeview {{ Request::is('inventaris*', 'penghapusans*', 'pemeliharaans*', 'pemanfaatans*', 'mutasis*', 'rkas*', 'reklas*', 'koreksis*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-edit"></i>
        <span>Transaksi</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        @if(
            Auth::user()->hasPermissionTo('transaksi.inventaris.*') ||
            Auth::user()->hasPermissionTo('transaksi.inventaris.read')
        )
            <li class="{{ Request::is('inventaris*') ? 'active' : '' }}">
                <a href="{!! route('inventaris.index') !!}"><i class="fa fa-edit"></i><span>Penata Usahaan</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('transaksi.pemeliharaan.*') ||
            Auth::user()->hasPermissionTo('transaksi.pemeliharaan.read')
        )
            <li class="{{ Request::is('pemeliharaans*') ? 'active' : '' }}">
                <a href="{!! route('pemeliharaans.index') !!}"><i class="fa fa-edit"></i><span>Pemeliharaan</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('transaksi.penghapusan.*') ||
            Auth::user()->hasPermissionTo('transaksi.penghapusan.read')
        )
            <li class="{{ Request::is('penghapusans*') ? 'active' : '' }}">
                <a href="{!! route('penghapusans.index') !!}"><i class="fa fa-edit"></i><span>Penghapusan</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('transaksi.pemanfaatan.*') ||
            Auth::user()->hasPermissionTo('transaksi.pemanfaatan.read')
        )
            <li class="{{ Request::is('pemanfaatans*') ? 'active' : '' }}">
                <a href="{!! route('pemanfaatans.index') !!}"><i class="fa fa-edit"></i><span>Pemanfaatan</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('transaksi.mutasi.*') ||
            Auth::user()->hasPermissionTo('transaksi.mutasi.read')
        )
            <li class="{{ Request::is('mutasis*') ? 'active' : '' }}">
                <a href="{!! route('mutasis.index') !!}"><i class="fa fa-edit"></i><span>Mutasi Keluar</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('transaksi.rka.*') ||
            Auth::user()->hasPermissionTo('transaksi.rka.read')
        )
            <li class="{{ Request::is('rkas*') ? 'active' : '' }}">
                <a href="{!! route('rkas.index') !!}"><i class="fa fa-edit"></i><span>RKA</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('transaksi.reklas.*') ||
            Auth::user()->hasPermissionTo('transaksi.reklas.read')
        )
            <li class="{{ Request::is('reklas*') ? 'active' : '' }}">
                <a href="{!! route('reklas.index') !!}"><i class="fa fa-edit"></i><span>Reklas</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('transaksi.sensus.*') ||
            Auth::user()->hasPermissionTo('transaksi.sensus.read')
        )
            <li class="{{ Request::is('sensus*') ? 'active' : '' }}">
                <a href="{!! route('sensus.index') !!}"><i class="fa fa-edit"></i><span>Sensus</span></a>
            </li>
        @endif
         @if(
            Auth::user()->hasPermissionTo('transaksi.koreksi.*') ||
            Auth::user()->hasPermissionTo('transaksi.koreksi.read')
         )
            <li class="{{ Request::is('koreksis*') ? 'active' : '' }}">
                <a href="{!! route('koreksis.index') !!}"><i class="fa fa-edit"></i><span>Koreksi</span></a>
            </li>
        @endif
    </ul>
</li>
@endif

@if(
    Auth::user()->hasPermissionTo('master.*') ||
    Auth::user()->hasPermissionTo('master.barang.*') ||
    Auth::user()->hasPermissionTo('master.barang.read')
)
    <li class="{{ Request::is('barangs*') ? 'active' : '' }}">
        <a href="{!! route('barangs.index') !!}"><i class="fa fa-car"></i><span>Master Barang</span></a>
    </li>
@endif

@if(
    Auth::user()->hasPermissionTo('master.*') ||
    Auth::user()->hasPermissionTo('master.lokasi.*') ||
    Auth::user()->hasPermissionTo('master.lokasi.read') ||
    Auth::user()->hasPermissionTo('master.organisasi.*') ||
    Auth::user()->hasPermissionTo('master.organisasi.read') ||
    Auth::user()->hasPermissionTo('master.satuan_barang.*') ||
    Auth::user()->hasPermissionTo('master.satuan_barang.read') ||
    Auth::user()->hasPermissionTo('master.mitra.*') ||
    Auth::user()->hasPermissionTo('master.mitra.read') ||
    Auth::user()->hasPermissionTo('master.penggunaan_kib_a.*') ||
    Auth::user()->hasPermissionTo('master.penggunaan_kib_a.read') ||
    Auth::user()->hasPermissionTo('master.kode_daerah.*') ||
    Auth::user()->hasPermissionTo('master.kode_daerah.read') ||
    Auth::user()->hasPermissionTo('master.merk.*') ||
    Auth::user()->hasPermissionTo('master.merk.read')
)

<li class="treeview {{ Request::is('alamats*', 'jenisbarangs*', 'kondisis*', 'merkbarangs*', 'organisasis*', 'perolehans*', 'satuanbarangs*', 'pengunaans*', 'mitras*', 'statustanahs*') && !Request::is('organisasis/settings') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-edit"></i>
        <span>Master Data</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        @if(
            Auth::user()->hasPermissionTo('master.lokasi.*') ||
            Auth::user()->hasPermissionTo('master.lokasi.read')
        )
            <li class="{{ Request::is('alamats*') ? 'active' : '' }}">
                <a href="{!! route('alamats.index') !!}"><i class="fa fa-edit"></i><span>Lokasi</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('master.merk.*') ||
            Auth::user()->hasPermissionTo('master.merk.read')
        )
            <li class="{{ Request::is('merkbarangs*') ? 'active' : '' }}">
                <a href="{!! route('merkbarangs.index') !!}"><i class="fa fa-edit"></i><span>Merk Barang</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('master.organisasi.*') ||
            Auth::user()->hasPermissionTo('master.organisasi.read')
        )
            <li class="{{ Request::is('organisasis*') && !Request::is('organisasis/settings') ? 'active' : '' }}">
                <a href="{!! route('organisasis.index') !!}"><i class="fa fa-edit"></i><span>Organisasi</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('master.satuan_barang.*') ||
            Auth::user()->hasPermissionTo('master.satuan_barang.read')
        )
            <li class="{{ Request::is('satuanbarangs*') ? 'active' : '' }}">
                <a href="{!! route('satuanbarangs.index') !!}"><i class="fa fa-edit"></i><span>Satuan Barang</span></a>
            </li>
        @endif
        @if(
            Auth::user()->hasPermissionTo('master.mitra.*') ||
            Auth::user()->hasPermissionTo('master.mitra.read')
        )
            <li class="{{ Request::is('mitras*') ? 'active' : '' }}">
                <a href="{!! route('mitras.index') !!}"><i class="fa fa-edit"></i><span>Mitra</span></a>
            </li>
        @endif

        @if(
            Auth::user()->hasPermissionTo('master.penggunaan_kib_a.*') ||
            Auth::user()->hasPermissionTo('master.penggunaan_kib_a.read')
        )
            <li class="{{ Request::is('pengunaans*') ? 'active' : '' }}">
                <a href="{!! route('pengunaans.index') !!}"><i class="fa fa-edit"></i><span>Pengunaan KIB A</span></a>
            </li>
        @endif

        @if(
            Auth::user()->hasPermissionTo('master.kode_daerah.*') ||
            Auth::user()->hasPermissionTo('master.kode_daerah.read')
        )
            <li class="{{ Request::is('mKodeDaerahs*') ? 'active' : '' }}">
                <a href="{{ route('mKodeDaerahs.index') }}"><i class="fa fa-edit"></i><span>Kode Daerah</span></a>
            </li>
        @endif

    </ul>
</li>
@endif

<li class="{{ Request::is('inventaris.deleted') ? 'active' : '' }}">
    <a href="{!! route('inventaris.deleted') !!}"><i class="fa fa-trash"></i><span>Daftar Penghapusan</span></a>
</li>


@if(
    Auth::user()->hasPermissionTo('setup.*') ||
    Auth::user()->hasPermissionTo('setup.pengaturan.*') ||
    Auth::user()->hasPermissionTo('setup.pengaturan.read') ||
    Auth::user()->hasPermissionTo('setup.data_center.*') ||
    Auth::user()->hasPermissionTo('setup.data_center.read')
)
<li class="treeview {{ Request::is('users*', 'organisasis/settings', 'jabatans', 'settings')? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-envelope"></i>
        <span>Reports</span>
        <span class="pull-right-container">

            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('DaftarBarang*') ? 'active' : '' }}">
            <a href="{!! route('Report.DaftarBarang') !!}"><i class="fa fa-edit"></i><span>Daftar Barang</span></a>
        </li>

        <li class="{{ Request::is('DaftarBarangIntraKomp*') ? 'active' : '' }}">
            <a href="{!! route('Report.DaftarBarangIntraKomp') !!}"><i class="fa fa-edit"></i><span>Daftar Barang Intrakomp</span></a>
        </li>

        <li class="{{ Request::is('DaftarBarangEkstraKomp*') ? 'active' : '' }}">
            <a href="{!! route('Report.DaftarBarangEkstrakomp') !!}"><i class="fa fa-edit"></i><span>Daftar Barang Ekstrakomp</span></a>
        </li>

        <li class="{{ Request::is('DaftarMutasiTambah*') ? 'active' : '' }}">
            <a href="{!! route('Report.DaftarMutasiTambah') !!}"><i class="fa fa-edit"></i><span>Daftar Mutasi Tambah</span></a>
        </li>

        <li class="{{ Request::is('DaftarMutasiKurang*') ? 'active' : '' }}">
            <a href="{!! route('Report.DaftarMutasiKurang') !!}"><i class="fa fa-edit"></i><span>Daftar Mutasi Kurang</span></a>
        </li>

        <li class="{{ Request::is('LampiranBASTMutasi*') ? 'active' : '' }}">
            <a href="{!! route('Report.LampiranBASTMutasi') !!}"><i class="fa fa-edit"></i><span>Lampiran BAST Mutasi</span></a>
        </li>

        <li class="{{ Request::is('LampiranSuratUsulan*') ? 'active' : '' }}">
            <a href="{!! route('Report.LampiranSuratUsulan') !!}"><i class="fa fa-edit"></i><span>Lampiran Surat Usulan</span></a>
        </li>
    </ul>
</li>
@endif

@if(
    Auth::user()->hasPermissionTo('setup.data_center.*') ||
    Auth::user()->hasPermissionTo('setup.data_center.read')
)
    <li class="{{ Request::is('import*') ? 'active' : '' }}">
        <a href="{!! route('import.index') !!}"><i class="fa fa-database"></i><span>Data Center</span></a>
    </li>
@endif


@if(
    Auth::user()->hasPermissionTo('setup.*') ||
    Auth::user()->hasPermissionTo('setup.pengaturan.*') ||
    Auth::user()->hasPermissionTo('setup.pengaturan.read')
)
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
        @if(c::is('pengaturan users',['view'],[Constant::$GROUP_BPKAD_ORG]))
            <li class="{{ Request::is('users*')
            || Request::is('jabatans*')
            || Request::is('settings*')
            ? 'active' : '' }}">
                <a href="{!! route('users.index') !!}">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
        @endif
        {{-- @if(c::is('pengaturan OPD',['view'],[Constant::$GROUP_BPKAD_ORG]))
            <li class="{{ Request::is('organisasis/settings') ? 'active' : '' }}">
                <a href="{!! route('organisasis.settings') !!}"><i class="fa fa-building"></i><span>OPD</span></a>
            </li>
        @endif --}}
        {{-- @if(c::is('pengaturan jabatan',['view'],[Constant::$GROUP_BPKAD_ORG]))
            <li class="{{ Request::is('jabatans*') ? 'active' : '' }}">
                <a href="{!! route('jabatans.index') !!}"><i class="fa fa-edit"></i><span>Jabatan/Roles</span></a>
            </li>
        @endif --}}
        {{-- @if(c::is('setting',['view'],[Constant::$GROUP_BPKAD_ORG]))
            <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                <a href="{!! route('settings.index') !!}"><i class="fa fa-edit"></i><span>Setting</span></a>
            </li>
        @endif --}}

    </ul>
</li>
@endif


