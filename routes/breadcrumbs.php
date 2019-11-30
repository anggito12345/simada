<?php

// Inventaris
Breadcrumbs::for('inventaris.index', function ($trail) {
    $trail->push('Inventaris', route('inventaris.index'));
});

// Inventaris > Buat
Breadcrumbs::for('inventaris.create', function ($trail) {
    $trail->parent('inventaris.index');
    $trail->push('Buat', route('inventaris.create'));
});

// Inventaris > Ubah
Breadcrumbs::for('inventaris.edit', function ($trail,$data) {
    $trail->parent('inventaris.index', $data);
    $trail->push('Ubah', route('inventaris.edit',$data));
});

Breadcrumbs::for('inventaris.show', function ($trail,$data) {
    $trail->parent('inventaris.index', $data);
    $trail->push('Lihat', route('inventaris.show',$data));
});

// Pemeliharaan
Breadcrumbs::for('pemeliharaans.index', function ($trail) {
    $trail->push('Pemeliharaan', route('pemeliharaans.index'));
});

// Pemeliharaan > Buat
Breadcrumbs::for('pemeliharaans.create', function ($trail) {
    $trail->parent('pemeliharaans.index');
    $trail->push('Buat', route('pemeliharaans.create'));
});

// Pemeliharaan > Ubah
Breadcrumbs::for('pemeliharaans.edit', function ($trail,$data) {
    $trail->parent('pemeliharaans.index', $data);
    $trail->push('Ubah', route('pemeliharaans.edit',$data));
});

// Pemeliaharaan > Ubah
Breadcrumbs::for('pemeliharaans.show', function ($trail,$data) {
    $trail->parent('pemeliharaans.index', $data);
    $trail->push('Lihat', route('pemeliharaans.show',$data));
});

// Mutasi
Breadcrumbs::for('mutasis.index', function ($trail) {
    $trail->push('Mutasi', route('mutasis.index'));
});

// Mutasi > Buat
Breadcrumbs::for('mutasis.create', function ($trail) {
    $trail->parent('mutasis.index');
    $trail->push('Buat', route('mutasis.create'));
});

// Mutasi > Ubah
Breadcrumbs::for('mutasis.edit', function ($trail,$data) {
    $trail->parent('mutasis.index', $data);
    $trail->push('Ubah', route('mutasis.edit',$data));
});

// Mutasi > Lihat
Breadcrumbs::for('mutasis.show', function ($trail,$data) {
    $trail->parent('mutasis.index', $data);
    $trail->push('Lihat', route('mutasis.show',$data));
});

// RKA
Breadcrumbs::for('rkas.index', function ($trail) {
    $trail->push('RKA', route('rkas.index'));
});

// RKA > Buat
Breadcrumbs::for('rkas.create', function ($trail) {
    $trail->parent('rkas.index');
    $trail->push('Buat', route('rkas.create'));
});

// RKA > Ubah
Breadcrumbs::for('rkas.edit', function ($trail,$data) {
    $trail->parent('rkas.index', $data);
    $trail->push('Ubah', route('rkas.edit',$data));
});

// RKA > Lihat
Breadcrumbs::for('rkas.show', function ($trail,$data) {
    $trail->parent('rkas.index', $data);
    $trail->push('Lihat', route('rkas.show',$data));
});


// Master Barang
Breadcrumbs::for('barangs.index', function ($trail) {
    $trail->push('Barang', route('barangs.index'));
});

// Master Barang > Buat
Breadcrumbs::for('barangs.create', function ($trail) {
    $trail->parent('barangs.index');
    $trail->push('Buat', route('barangs.create'));
});

// Master Barang > Ubah
Breadcrumbs::for('barangs.edit', function ($trail,$data) {
    $trail->parent('barangs.index', $data);
    $trail->push('Ubah', route('barangs.edit',$data));
});

// Master Barang > Lihat
Breadcrumbs::for('barangs.show', function ($trail,$data) {
    $trail->parent('barangs.index', $data);
    $trail->push('Lihat', route('barangs.show',$data));
});

// Lokasi
Breadcrumbs::for('lokasis.index', function ($trail) {
    $trail->push('Lokasi', route('lokasis.index'));
});

// Lokasi > Buat
Breadcrumbs::for('lokasis.create', function ($trail) {
    $trail->parent('lokasis.index');
    $trail->push('Buat', route('lokasis.create'));
});

// Lokasi > Ubah
Breadcrumbs::for('lokasis.edit', function ($trail,$data) {
    $trail->parent('lokasis.index', $data);
    $trail->push('Ubah', route('lokasis.edit',$data));
});

// Lokasi > Lihat
Breadcrumbs::for('lokasis.show', function ($trail,$data) {
    $trail->parent('lokasis.index', $data);
    $trail->push('Lihat', route('lokasis.show',$data));
});

// Alamat
Breadcrumbs::for('alamats.index', function ($trail) {
    $trail->push('Alamat', route('alamats.index'));
});

// Alamat > Buat
Breadcrumbs::for('alamats.create', function ($trail) {
    $trail->parent('alamats.index');
    $trail->push('Buat', route('alamats.create'));
});

// Alamat > Ubah
Breadcrumbs::for('alamats.edit', function ($trail,$data) {
    $trail->parent('alamats.index', $data);
    $trail->push('Ubah', route('alamats.edit',$data));
});

// Alamat > Lihat
Breadcrumbs::for('alamats.show', function ($trail,$data) {
    $trail->parent('alamats.index', $data);
    $trail->push('Lihat', route('alamats.show',$data));
});

// Jenis Barang
Breadcrumbs::for('jenisbarangs.index', function ($trail) {
    $trail->push('Jenis Barang', route('jenisbarangs.index'));
});

// Jenis Barang > Buat
Breadcrumbs::for('jenisbarangs.create', function ($trail) {
    $trail->parent('jenisbarangs.index');
    $trail->push('Buat', route('jenisbarangs.create'));
});

// Jenis Barang > Ubah
Breadcrumbs::for('jenisbarangs.edit', function ($trail,$data) {
    $trail->parent('jenisbarangs.index', $data);
    $trail->push('Ubah', route('jenisbarangs.edit',$data));
});

// Jenis Barang > Lihat
Breadcrumbs::for('jenisbarangs.show', function ($trail,$data) {
    $trail->parent('jenisbarangs.index', $data);
    $trail->push('Lihat', route('jenisbarangs.show',$data));
});

// Kondisi
Breadcrumbs::for('kondisis.index', function ($trail) {
    $trail->push('Kondisi', route('kondisis.index'));
});

// Kondisi > Buat
Breadcrumbs::for('kondisis.create', function ($trail) {
    $trail->parent('kondisis.index');
    $trail->push('Buat', route('kondisis.create'));
});

// Kondisi > Ubah
Breadcrumbs::for('kondisis.edit', function ($trail,$data) {
    $trail->parent('kondisis.index', $data);
    $trail->push('Ubah', route('kondisis.edit',$data));
});

// Kondisi > Lihat
Breadcrumbs::for('kondisis.show', function ($trail,$data) {
    $trail->parent('kondisis.index', $data);
    $trail->push('Lihat', route('kondisis.show',$data));
});

// Merk Barang
Breadcrumbs::for('merkbarangs.index', function ($trail) {
    $trail->push('Merk Barang', route('merkbarangs.index'));
});

// Merk Barang > Buat
Breadcrumbs::for('merkbarangs.create', function ($trail) {
    $trail->parent('merkbarangs.index');
    $trail->push('Buat', route('merkbarangs.create'));
});

// Merk Barang > Ubah
Breadcrumbs::for('merkbarangs.edit', function ($trail,$data) {
    $trail->parent('merkbarangs.index', $data);
    $trail->push('Ubah', route('merkbarangs.edit',$data));
});

// Merk Barang > Lihat
Breadcrumbs::for('merkbarangs.show', function ($trail,$data) {
    $trail->parent('merkbarangs.index', $data);
    $trail->push('Lihat', route('merkbarangs.show',$data));
});

// Organisasi
Breadcrumbs::for('organisasis.index', function ($trail) {
    $trail->push('Organisasi', route('organisasis.index'));
});

// Organisasi > Buat
Breadcrumbs::for('organisasis.create', function ($trail) {
    $trail->parent('organisasis.index');
    $trail->push('Buat', route('organisasis.create'));
});

// Organisasi > Ubah
Breadcrumbs::for('organisasis.edit', function ($trail,$data) {
    $trail->parent('organisasis.index', $data);
    $trail->push('Ubah', route('organisasis.edit',$data));
});

// Organisasi > Lihat
Breadcrumbs::for('organisasis.show', function ($trail,$data) {
    $trail->parent('organisasis.index', $data);
    $trail->push('Lihat', route('organisasis.show',$data));
});

// Perolehan
Breadcrumbs::for('perolehans.index', function ($trail) {
    $trail->push('Perolehan', route('perolehans.index'));
});

// Perolehan > Buat
Breadcrumbs::for('perolehans.create', function ($trail) {
    $trail->parent('perolehans.index');
    $trail->push('Buat', route('perolehans.create'));
});

// Perolehan > Ubah
Breadcrumbs::for('perolehans.edit', function ($trail,$data) {
    $trail->parent('perolehans.index', $data);
    $trail->push('Ubah', route('perolehans.edit',$data));
});

// Perolehan > Lihat
Breadcrumbs::for('perolehans.show', function ($trail,$data) {
    $trail->parent('perolehans.index', $data);
    $trail->push('Lihat', route('perolehans.show',$data));
});


// Satuan Barang
Breadcrumbs::for('satuanbarangs.index', function ($trail) {
    $trail->push('Satuan Barang', route('satuanbarangs.index'));
});

// Satuan Barang > Buat
Breadcrumbs::for('satuanbarangs.create', function ($trail) {
    $trail->parent('satuanbarangs.index');
    $trail->push('Buat', route('satuanbarangs.create'));
});

// Satuan Barang > Ubah
Breadcrumbs::for('satuanbarangs.edit', function ($trail,$data) {
    $trail->parent('satuanbarangs.index', $data);
    $trail->push('Ubah', route('satuanbarangs.edit',$data));
});

// Satuan Barang > Lihat
Breadcrumbs::for('satuanbarangs.show', function ($trail,$data) {
    $trail->parent('satuanbarangs.index', $data);
    $trail->push('Lihat', route('satuanbarangs.show',$data));
});

// Status Tanah
Breadcrumbs::for('statustanahs.index', function ($trail) {
    $trail->push('Status Tanah', route('statustanahs.index'));
});

// Status Tanah > Buat
Breadcrumbs::for('statustanahs.create', function ($trail) {
    $trail->parent('statustanahs.index');
    $trail->push('Buat', route('statustanahs.create'));
});

// Status Tanah > Ubah
Breadcrumbs::for('statustanahs.edit', function ($trail,$data) {
    $trail->parent('statustanahs.index', $data);
    $trail->push('Ubah', route('statustanahs.edit',$data));
});

// Status Tanah > Lihat
Breadcrumbs::for('statustanahs.show', function ($trail,$data) {
    $trail->parent('statustanahs.index', $data);
    $trail->push('Lihat', route('statustanahs.show',$data));
});

// Mitra
Breadcrumbs::for('mitras.index', function ($trail) {
    $trail->push('Mitra', route('mitras.index'));
});

// Mitra > Buat
Breadcrumbs::for('mitras.create', function ($trail) {
    $trail->parent('mitras.index');
    $trail->push('Buat', route('mitras.create'));
});

// Mitra > Ubah
Breadcrumbs::for('mitras.edit', function ($trail,$data) {
    $trail->parent('mitras.index', $data);
    $trail->push('Ubah', route('mitras.edit',$data));
});

// Mitra > Lihat
Breadcrumbs::for('mitras.show', function ($trail,$data) {
    $trail->parent('mitras.index', $data);
    $trail->push('Lihat', route('mitras.show',$data));
});

// User
Breadcrumbs::for('users.index', function ($trail) {
    $trail->push('User', route('users.index'));
});

// User > Buat
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Buat', route('users.create'));
});

// User > Ubah
Breadcrumbs::for('users.edit', function ($trail,$data) {
    $trail->parent('users.index', $data);
    $trail->push('Ubah', route('users.edit',$data));
});

// User > Lihat
Breadcrumbs::for('users.show', function ($trail,$data) {
    $trail->parent('users.index', $data);
    $trail->push('Lihat', route('users.show',$data));
});

// Jabatan
Breadcrumbs::for('jabatans.index', function ($trail) {
    $trail->push('Jabatan', route('jabatans.index'));
});

// Jabatan > Buat
Breadcrumbs::for('jabatans.create', function ($trail) {
    $trail->parent('jabatans.index');
    $trail->push('Buat', route('jabatans.create'));
});

// Jabatan > Ubah
Breadcrumbs::for('jabatans.edit', function ($trail,$data) {
    $trail->parent('jabatans.index', $data);
    $trail->push('Ubah', route('jabatans.edit',$data));
});

// Jabatan > Lihat
Breadcrumbs::for('jabatans.show', function ($trail,$data) {
    $trail->parent('jabatans.index', $data);
    $trail->push('Lihat', route('jabatans.show',$data));
});

// Setting
Breadcrumbs::for('settings.index', function ($trail) {
    $trail->push('Setting', route('settings.index'));
});

// Setting > Buat
Breadcrumbs::for('settings.create', function ($trail) {
    $trail->parent('settings.index');
    $trail->push('Buat', route('settings.create'));
});

// Setting > Ubah
Breadcrumbs::for('settings.edit', function ($trail,$data) {
    $trail->parent('settings.index', $data);
    $trail->push('Ubah', route('settings.edit',$data));
});

// Setting > Lihat
Breadcrumbs::for('settings.show', function ($trail,$data) {
    $trail->parent('settings.index', $data);
    $trail->push('Lihat', route('settings.show',$data));
});


Breadcrumbs::for('penghapusans.index', function ($trail) {
    $trail->push('Penghapusan', route('settings.index'));
});

// Setting > Buat
Breadcrumbs::for('penghapusans.create', function ($trail) {
    $trail->parent('penghapusans.index');
    $trail->push('Buat', route('settings.create'));
});

// Setting > Ubah
Breadcrumbs::for('penghapusans.edit', function ($trail,$data) {
    $trail->parent('penghapusans.index', $data);
    $trail->push('Ubah', route('settings.edit',$data));
});

// Setting > Lihat
Breadcrumbs::for('penghapusans.show', function ($trail,$data) {
    $trail->parent('penghapusans.index', $data);
    $trail->push('Lihat', route('settings.show',$data));
});
