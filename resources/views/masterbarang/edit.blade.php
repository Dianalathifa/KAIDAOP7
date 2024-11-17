<!-- resources/views/mastercatalog/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Master Catalog</h1>

    <form action="{{ route('mastercatalog.update', $catalog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="{{ old('kode_barang', $catalog->kode_barang) }}" required>
            @error('kode_barang')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang', $catalog->nama_barang) }}" required>
            @error('nama_barang')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="barang_masuk">Barang Masuk</label>
            <input type="number" name="barang_masuk" id="barang_masuk" class="form-control" value="{{ old('barang_masuk', $catalog->barang_masuk) }}" required>
            @error('barang_masuk')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="barang_keluar">Barang Keluar</label>
            <input type="number" name="barang_keluar" id="barang_keluar" class="form-control" value="{{ old('barang_keluar', $catalog->barang_keluar) }}" required>
            @error('barang_keluar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="total_stok">Total Stok</label>
            <input type="number" name="total_stok" id="total_stok" class="form-control" value="{{ old('total_stok', $catalog->total_stok) }}" required>
            @error('total_stok')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
