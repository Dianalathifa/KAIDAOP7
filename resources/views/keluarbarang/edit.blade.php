<!-- keluarbarang/edit.blade.php -->
<h1>Edit Barang Keluar</h1>
<form action="{{ route('keluarbarang.update', $keluarBarang->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Kode Barang:</label>
    <input type="text" name="kode_barang" value="{{ $keluarBarang->kode_barang }}" required>
    <label>Jumlah Keluar:</label>
    <input type="number" name="jumlah_keluar" value="{{ $keluarBarang->jumlah_keluar }}" required min="1">
    <label>Tanggal Keluar:</label>
    <input type="date" name="tanggal_keluar" value="{{ $keluarBarang->tanggal_keluar }}" required>
    <label>Catatan:</label>
    <textarea name="catatan">{{ $keluarBarang->catatan }}</textarea>
    <button type="submit">Simpan Perubahan</button>
</form>
