<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Master Barang</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
    <style>
        body {
            padding-top: 60px; /* Adjust based on the height of your header */
        }
        
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; /* Ensure header stays on top */
        }
    </style>
</head>
<body class="bg-light">
@include('layout.partial.header')

<div class="container mt-5">
    <h1>Daftar Master Barang</h1>

    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBarangModal">
        + Tambah Data
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addBarangModal" tabindex="-1" aria-labelledby="addBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBarangModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('masterbarang.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <select name="kode_barang" id="kode_barang" class="form-control" required>
                                <option value="" disabled selected>Pilih Kode Barang</option>
                                @foreach ($katalogs as $katalog)
                                    <option value="{{ $katalog->kode_barang }}">{{ $katalog->kode_barang }}</option>
                                @endforeach
                            </select>
                            @error('kode_barang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
                            @error('nama_barang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="barang_masuk">Barang Masuk</label>
                            <input type="number" name="barang_masuk" id="barang_masuk" class="form-control" value="{{ old('barang_masuk') }}" required>
                            @error('barang_masuk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="barang_keluar">Barang Keluar</label>
                            <input type="number" name="barang_keluar" id="barang_keluar" class="form-control" value="{{ old('barang_keluar') }}" required>
                            @error('barang_keluar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="total_stok">Total Stok</label>
                            <input type="number" name="total_stok" id="total_stok" class="form-control" value="{{ old('total_stok') }}" required>
                            @error('total_stok')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Existing content (e.g., table) here -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('kode_barang').addEventListener('change', function() {
        var kode_barang = this.value;
        var nama_barangField = document.getElementById('nama_barang');

        if (kode_barang) {
            fetch(`/get-item-details/${kode_barang}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.nama_barang) {
                        nama_barangField.value = data.nama_barang;
                    } else {
                        nama_barangField.value = '';
                    }
                })
                .catch(error => console.error('Error fetching item details:', error));
        } else {
            nama_barangField.value = '';
        }
    });
});
</script>
</body>
</html>
