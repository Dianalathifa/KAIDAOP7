<!-- keluarbarang/show.blade.php -->
<h1>Detail Barang Keluar</h1>
<p>Kode Barang: {{ $keluarBarang->kode_barang }}</p>
<p>Jumlah Keluar: {{ $keluarBarang->jumlah_keluar }}</p>
<p>Tanggal Keluar: {{ $keluarBarang->tanggal_keluar }}</p>
<p>Catatan: {{ $keluarBarang->catatan }}</p>
<a href="{{ route('keluarbarang.index') }}">Kembali</a>
