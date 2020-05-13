<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Barang/Kode Register</th>
        <th>NUP</th>  
        <th>Kode Intra/Ekstra</th>  
        <th>Nama Barang</th>
        <th>Jenis Barang</th>
        <th>Type/Merk/ Judul</th>
        <th>No.Rangka</th>
        <th>No.Mesin</th>
        <th>No.Polisi</th>
        <th>Perolehan Bulan</th>
        <th>Perolehan Tahun</th>
        <th>Jumlah Barang</th>
        <th>Kondisi (Baik/Rusak Ringan/Rusak Berat/Tidak Ditemukan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($inventaris as $inv)
        <tr>
            <td>1</td>
            <td>{{ $inv->nomor }}</td>
            <td>-</td>
            <td>{{ \App\Models\inventaris::CalculateIsIntraOrEkstra($inv->tahun_perolehan, (int) str_replace(",",".",str_replace(".", "", $inv->harga_satuan))); }}</td>
            <td>{{ $inv->nama_rek_aset }}</td>
            <td>{{ $inv->kelompok_kib }}</td>
            <td>{{ $inv->kelompok_kib }}</td>
        </tr>
    @endforeach
    </tbody>
</table>