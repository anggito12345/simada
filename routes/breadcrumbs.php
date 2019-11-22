<?php


Breadcrumbs::macro('resource', function ($name, $title) {
    // Home > Blog
    Breadcrumbs::for("$name.index", function ($trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route("$name.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("$name.create", function ($trail) use ($name) {
        $trail->parent("$name.index");
        $trail->push('New', route("$name.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("$name.show", function ($trail, $model) use ($name) {
        $trail->parent("$name.index");
        $trail->push($model->title, route("$name.show", $model));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("$name.edit", function ($trail, $model) use ($name) {
        $trail->parent("$name.show", $model);
        $trail->push('Edit', route("$name.edit", $model));
    });
});


Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::resource('users', 'User');

Breadcrumbs::resource('inventaris', 'Inventaris');

Breadcrumbs::resource('pemeliharaans', 'Pemeliharaan');

Breadcrumbs::resource('penghapusans', 'Penghapusan');

Breadcrumbs::resource('barangs', 'Barang');

Breadcrumbs::resource('alamats', 'Alamat');

Breadcrumbs::resource('jenisbarangs', 'Jenis Barang');

Breadcrumbs::resource('kondisis', 'Kondisi');

Breadcrumbs::resource('lokasis', 'Lokasi');

Breadcrumbs::resource('merkbarangs', 'Merk Barang');

Breadcrumbs::resource('organisasis', 'Organisasi');

Breadcrumbs::resource('perolehans', 'perolehan');

Breadcrumbs::resource('satuanbarangs', 'Satuan Barang');

Breadcrumbs::resource('jenisopds', 'jenisopd');

Breadcrumbs::resource('detiltanahs', 'detiltanah');

Breadcrumbs::resource('detilmesins', 'detilmesin');

Breadcrumbs::resource('detilbangunans', 'detilbangunan');

Breadcrumbs::resource('statustanahs', 'statustanah');

Breadcrumbs::resource('detiljalans', 'detiljalan');

Breadcrumbs::resource('systemUploads', 'system_upload');

Breadcrumbs::resource('detilasets', 'detilaset');

Breadcrumbs::resource('detilkonstruksis', 'detilkonstruksi');

Breadcrumbs::resource('roles', 'role');

Breadcrumbs::resource('pemanfaatans', 'pemanfaatan');

Breadcrumbs::resource('mitras', 'Mitra');

Breadcrumbs::resource('jabatans', 'Jabatan');

Breadcrumbs::resource('settings', 'Setting');

// Breadcrumbs::get('/settings/environment', 'setting@environment');

Breadcrumbs::resource('mutasis', 'mutasi');

Breadcrumbs::resource('mutasiDetils', 'mutasi_detil');

Breadcrumbs::resource('rkas', 'rka');

Breadcrumbs::resource('rkaDetils', 'rka_detil');

Breadcrumbs::resource('modules', 'modules');

Breadcrumbs::resource('moduleAccesses', 'module_access');