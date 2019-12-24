<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\inventaris_reklas;
use Faker\Generator as Faker;

$factory->define(inventaris_reklas::class, function (Faker $faker) {

    return [
        'id' => $faker->randomDigitNotNull,
        'noreg' => $faker->word,
        'pidbarang' => $faker->randomDigitNotNull,
        'pidopd' => $faker->word,
        'pidlokasi' => $faker->randomDigitNotNull,
        'tgl_sensus' => $faker->word,
        'volume' => $faker->randomDigitNotNull,
        'pembagi' => $faker->randomDigitNotNull,
        'harga_satuan' => $faker->word,
        'perolehan' => $faker->word,
        'kondisi' => $faker->word,
        'lokasi_detil' => $faker->word,
        'keterangan' => $faker->word,
        'updated_at' => $faker->word,
        'created_at' => $faker->word,
        'tahun_perolehan' => $faker->word,
        'jumlah' => $faker->randomDigitNotNull,
        'tgl_dibukukan' => $faker->word,
        'satuan' => $faker->randomDigitNotNull,
        'deleted_at' => $faker->word,
        'pidopd_cabang' => $faker->randomDigitNotNull,
        'pidupt' => $faker->randomDigitNotNull,
        'kode_lokasi' => $faker->word,
        'alamat_propinsi' => $faker->randomDigitNotNull,
        'alamat_kota' => $faker->randomDigitNotNull,
        'alamat_kecamatan' => $faker->randomDigitNotNull,
        'alamat_kelurahan' => $faker->word,
        'idpegawai' => $faker->randomDigitNotNull,
        'pid_organisasi' => $faker->randomDigitNotNull,
        'kode_gedung' => $faker->word,
        'kode_ruang' => $faker->word,
        'penanggung_jawab' => $faker->randomDigitNotNull,
        'umur_ekonomis' => $faker->randomDigitNotNull,
        'draft' => $faker->word,
        'created_by' => $faker->randomDigitNotNull,
        'reklas_at' => $faker->word
    ];
});
