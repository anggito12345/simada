<?php

// Inventaris
Breadcrumbs::for('inventaris.index', function ($trail) {
    $trail->push('Inventaris', route('inventaris.index'));
});

// Inventaris > Create
Breadcrumbs::for('inventaris.create', function ($trail) {
    $trail->parent('inventaris.index');
    $trail->push('Create', route('inventaris.create'));
});

// Inventaris > Edit
Breadcrumbs::for('inventaris.edit', function ($trail,$data) {
    $trail->parent('inventaris.index', $data);
    $trail->push('Edit', route('inventaris.edit',$data));
});

Breadcrumbs::for('inventaris.show', function ($trail,$data) {
    $trail->parent('inventaris.index', $data);
    $trail->push('Show', route('inventaris.show',$data));
});

// Pemeliharaan
Breadcrumbs::for('pemeliharaans.index', function ($trail) {
    $trail->push('Pemeliharaan', route('pemeliharaans.index'));
});

// Pemeliharaan > Create
Breadcrumbs::for('pemeliharaans.create', function ($trail) {
    $trail->parent('pemeliharaans.index');
    $trail->push('Create', route('pemeliharaans.create'));
});

// Pemeliharaan > Edit
Breadcrumbs::for('pemeliharaans.edit', function ($trail,$data) {
    $trail->parent('pemeliharaans.index', $data);
    $trail->push('Edit', route('pemeliharaans.edit',$data));
});

// Pemeliaharaan > Edit
Breadcrumbs::for('pemeliharaans.show', function ($trail,$data) {
    $trail->parent('pemeliharaans.index', $data);
    $trail->push('Show', route('pemeliharaans.show',$data));
});

// Mutasi
Breadcrumbs::for('mutasis.index', function ($trail) {
    $trail->push('Mutasi', route('mutasis.index'));
});

// Mutasi > Create
Breadcrumbs::for('mutasis.create', function ($trail) {
    $trail->parent('mutasis.index');
    $trail->push('Create', route('mutasis.create'));
});

// Mutasi > Edit
Breadcrumbs::for('mutasis.edit', function ($trail,$data) {
    $trail->parent('mutasis.index', $data);
    $trail->push('Edit', route('mutasis.edit',$data));
});

// Mutasi > Show
Breadcrumbs::for('mutasis.show', function ($trail,$data) {
    $trail->parent('mutasis.index', $data);
    $trail->push('Show', route('mutasis.show',$data));
});

// RKA
Breadcrumbs::for('rkas.index', function ($trail) {
    $trail->push('RKA', route('rkas.index'));
});

// RKA > Create
Breadcrumbs::for('rkas.create', function ($trail) {
    $trail->parent('rkas.index');
    $trail->push('Create', route('rkas.create'));
});

// RKA > Edit
Breadcrumbs::for('rkas.edit', function ($trail,$data) {
    $trail->parent('rkas.index', $data);
    $trail->push('Edit', route('rkas.edit',$data));
});

// RKA > Show
Breadcrumbs::for('rkas.show', function ($trail,$data) {
    $trail->parent('rkas.index', $data);
    $trail->push('Show', route('rkas.show',$data));
});


// Master Barang
Breadcrumbs::for('barangs.index', function ($trail) {
    $trail->push('Barang', route('barangs.index'));
});

// Master Barang > Create
Breadcrumbs::for('barangs.create', function ($trail) {
    $trail->parent('barangs.index');
    $trail->push('Create', route('barangs.create'));
});

// Master Barang > Edit
Breadcrumbs::for('barangs.edit', function ($trail,$data) {
    $trail->parent('barangs.index', $data);
    $trail->push('Edit', route('barangs.edit',$data));
});

// Master Barang > Show
Breadcrumbs::for('barangs.show', function ($trail,$data) {
    $trail->parent('barangs.index', $data);
    $trail->push('Show', route('barangs.show',$data));
});

// Lokasi
Breadcrumbs::for('lokasis.index', function ($trail) {
    $trail->push('Lokasi', route('lokasis.index'));
});

// Lokasi > Create
Breadcrumbs::for('lokasis.create', function ($trail) {
    $trail->parent('lokasis.index');
    $trail->push('Create', route('lokasis.create'));
});

// Lokasi > Edit
Breadcrumbs::for('lokasis.edit', function ($trail,$data) {
    $trail->parent('lokasis.index', $data);
    $trail->push('Edit', route('lokasis.edit',$data));
});

// Lokasi > Show
Breadcrumbs::for('lokasis.show', function ($trail,$data) {
    $trail->parent('lokasis.index', $data);
    $trail->push('Show', route('lokasis.show',$data));
});

// Alamat
Breadcrumbs::for('alamats.index', function ($trail) {
    $trail->push('Alamat', route('alamats.index'));
});

// Alamat > Create
Breadcrumbs::for('alamats.create', function ($trail) {
    $trail->parent('alamats.index');
    $trail->push('Create', route('alamats.create'));
});

// Alamat > Edit
Breadcrumbs::for('alamats.edit', function ($trail,$data) {
    $trail->parent('alamats.index', $data);
    $trail->push('Edit', route('alamats.edit',$data));
});

// Alamat > Show
Breadcrumbs::for('alamats.show', function ($trail,$data) {
    $trail->parent('alamats.index', $data);
    $trail->push('Show', route('alamats.show',$data));
});

// Jenis Barang
Breadcrumbs::for('jenisbarangs.index', function ($trail) {
    $trail->push('Jenis Barang', route('jenisbarangs.index'));
});

// Jenis Barang > Create
Breadcrumbs::for('jenisbarangs.create', function ($trail) {
    $trail->parent('jenisbarangs.index');
    $trail->push('Create', route('jenisbarangs.create'));
});

// Jenis Barang > Edit
Breadcrumbs::for('jenisbarangs.edit', function ($trail,$data) {
    $trail->parent('jenisbarangs.index', $data);
    $trail->push('Edit', route('jenisbarangs.edit',$data));
});

// Jenis Barang > Show
Breadcrumbs::for('jenisbarangs.show', function ($trail,$data) {
    $trail->parent('jenisbarangs.index', $data);
    $trail->push('Show', route('jenisbarangs.show',$data));
});

// Kondisi
Breadcrumbs::for('kondisis.index', function ($trail) {
    $trail->push('Kondisi', route('kondisis.index'));
});

// Kondisi > Create
Breadcrumbs::for('kondisis.create', function ($trail) {
    $trail->parent('kondisis.index');
    $trail->push('Create', route('kondisis.create'));
});

// Kondisi > Edit
Breadcrumbs::for('kondisis.edit', function ($trail,$data) {
    $trail->parent('kondisis.index', $data);
    $trail->push('Edit', route('kondisis.edit',$data));
});

// Kondisi > Show
Breadcrumbs::for('kondisis.show', function ($trail,$data) {
    $trail->parent('kondisis.index', $data);
    $trail->push('Show', route('kondisis.show',$data));
});

// Merk Barang
Breadcrumbs::for('merkbarangs.index', function ($trail) {
    $trail->push('Merk Barang', route('merkbarangs.index'));
});

// Merk Barang > Create
Breadcrumbs::for('merkbarangs.create', function ($trail) {
    $trail->parent('merkbarangs.index');
    $trail->push('Create', route('merkbarangs.create'));
});

// Merk Barang > Edit
Breadcrumbs::for('merkbarangs.edit', function ($trail,$data) {
    $trail->parent('merkbarangs.index', $data);
    $trail->push('Edit', route('merkbarangs.edit',$data));
});

// Merk Barang > Show
Breadcrumbs::for('merkbarangs.show', function ($trail,$data) {
    $trail->parent('merkbarangs.index', $data);
    $trail->push('Show', route('merkbarangs.show',$data));
});

// Organisasi
Breadcrumbs::for('organisasis.index', function ($trail) {
    $trail->push('Organisasi', route('organisasis.index'));
});

// Organisasi > Create
Breadcrumbs::for('organisasis.create', function ($trail) {
    $trail->parent('organisasis.index');
    $trail->push('Create', route('organisasis.create'));
});

// Organisasi > Edit
Breadcrumbs::for('organisasis.edit', function ($trail,$data) {
    $trail->parent('organisasis.index', $data);
    $trail->push('Edit', route('organisasis.edit',$data));
});

// Organisasi > Show
Breadcrumbs::for('organisasis.show', function ($trail,$data) {
    $trail->parent('organisasis.index', $data);
    $trail->push('Show', route('organisasis.show',$data));
});

// Perolehan
Breadcrumbs::for('perolehans.index', function ($trail) {
    $trail->push('Perolehan', route('perolehans.index'));
});

// Perolehan > Create
Breadcrumbs::for('perolehans.create', function ($trail) {
    $trail->parent('perolehans.index');
    $trail->push('Create', route('perolehans.create'));
});

// Perolehan > Edit
Breadcrumbs::for('perolehans.edit', function ($trail,$data) {
    $trail->parent('perolehans.index', $data);
    $trail->push('Edit', route('perolehans.edit',$data));
});

// Perolehan > Show
Breadcrumbs::for('perolehans.show', function ($trail,$data) {
    $trail->parent('perolehans.index', $data);
    $trail->push('Show', route('perolehans.show',$data));
});


// Satuan Barang
Breadcrumbs::for('satuanbarangs.index', function ($trail) {
    $trail->push('Satuan Barang', route('satuanbarangs.index'));
});

// Satuan Barang > Create
Breadcrumbs::for('satuanbarangs.create', function ($trail) {
    $trail->parent('satuanbarangs.index');
    $trail->push('Create', route('satuanbarangs.create'));
});

// Satuan Barang > Edit
Breadcrumbs::for('satuanbarangs.edit', function ($trail,$data) {
    $trail->parent('satuanbarangs.index', $data);
    $trail->push('Edit', route('satuanbarangs.edit',$data));
});

// Satuan Barang > Show
Breadcrumbs::for('satuanbarangs.show', function ($trail,$data) {
    $trail->parent('satuanbarangs.index', $data);
    $trail->push('Show', route('satuanbarangs.show',$data));
});

// Status Tanah
Breadcrumbs::for('statustanahs.index', function ($trail) {
    $trail->push('Status Tanah', route('statustanahs.index'));
});

// Status Tanah > Create
Breadcrumbs::for('statustanahs.create', function ($trail) {
    $trail->parent('statustanahs.index');
    $trail->push('Create', route('statustanahs.create'));
});

// Status Tanah > Edit
Breadcrumbs::for('statustanahs.edit', function ($trail,$data) {
    $trail->parent('statustanahs.index', $data);
    $trail->push('Edit', route('statustanahs.edit',$data));
});

// Status Tanah > Show
Breadcrumbs::for('statustanahs.show', function ($trail,$data) {
    $trail->parent('statustanahs.index', $data);
    $trail->push('Show', route('statustanahs.show',$data));
});

// Mitra
Breadcrumbs::for('mitras.index', function ($trail) {
    $trail->push('Mitra', route('mitras.index'));
});

// Mitra > Create
Breadcrumbs::for('mitras.create', function ($trail) {
    $trail->parent('mitras.index');
    $trail->push('Create', route('mitras.create'));
});

// Mitra > Edit
Breadcrumbs::for('mitras.edit', function ($trail,$data) {
    $trail->parent('mitras.index', $data);
    $trail->push('Edit', route('mitras.edit',$data));
});

// Mitra > Show
Breadcrumbs::for('mitras.show', function ($trail,$data) {
    $trail->parent('mitras.index', $data);
    $trail->push('Show', route('mitras.show',$data));
});

// User
Breadcrumbs::for('users.index', function ($trail) {
    $trail->push('User', route('users.index'));
});

// User > Create
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Create', route('users.create'));
});

// User > Edit
Breadcrumbs::for('users.edit', function ($trail,$data) {
    $trail->parent('users.index', $data);
    $trail->push('Edit', route('users.edit',$data));
});

// User > Show
Breadcrumbs::for('users.show', function ($trail,$data) {
    $trail->parent('users.index', $data);
    $trail->push('Show', route('users.show',$data));
});

// Jabatan
Breadcrumbs::for('jabatans.index', function ($trail) {
    $trail->push('Jabatan', route('jabatans.index'));
});

// Jabatan > Create
Breadcrumbs::for('jabatans.create', function ($trail) {
    $trail->parent('jabatans.index');
    $trail->push('Create', route('jabatans.create'));
});

// Jabatan > Edit
Breadcrumbs::for('jabatans.edit', function ($trail,$data) {
    $trail->parent('jabatans.index', $data);
    $trail->push('Edit', route('jabatans.edit',$data));
});

// Jabatan > Show
Breadcrumbs::for('jabatans.show', function ($trail,$data) {
    $trail->parent('jabatans.index', $data);
    $trail->push('Show', route('jabatans.show',$data));
});

// Setting
Breadcrumbs::for('settings.index', function ($trail) {
    $trail->push('Setting', route('settings.index'));
});

// Setting > Create
Breadcrumbs::for('settings.create', function ($trail) {
    $trail->parent('settings.index');
    $trail->push('Create', route('settings.create'));
});

// Setting > Edit
Breadcrumbs::for('settings.edit', function ($trail,$data) {
    $trail->parent('settings.index', $data);
    $trail->push('Edit', route('settings.edit',$data));
});

// Setting > Show
Breadcrumbs::for('settings.show', function ($trail,$data) {
    $trail->parent('settings.index', $data);
    $trail->push('Show', route('settings.show',$data));
});
