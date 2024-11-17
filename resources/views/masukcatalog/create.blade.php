<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Barang</title>
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
    <h1>Masuk Barang</h1>

    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBarangMasukModal">
        + Tambah Barang Masuk
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addBarangMasukModal" tabindex="-1" aria-labelledby="addBarangMasukModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBarangMasukModalLabel">Tambah Barang Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('masukcatalog.store') }}" method="POST">
    @csrf

    <!-- Kode Barang -->
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

    <!-- Barang -->
    <div class="form-group">
        <label for="nama">Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
                            @error('nama_barang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
    </div>

    <!-- Customer -->
    <div class="form-group">
        <label for="customer">Customer</label>
        <select name="customer" id="customer" class="form-control" required>
            <option value="" disabled selected>Pilih Customer</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->Nama_Unit }}">{{ $unit->Nama_Unit }} - {{ $unit->DAOP }}</option>
            @endforeach
        </select>
        @error('customer')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Jumlah Masuk -->
    <div class="form-group">
        <label for="jumlah_masuk">Jumlah Masuk</label>
        <input type="number" name="jumlah_masuk" id="jumlah_masuk" class="form-control" value="{{ old('jumlah_masuk') }}" required>
        @error('jumlah_masuk')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

                </div>
            </div>
        </div>
    </div>

    <!-- Existing content (e.g., table of masuk barang) here -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kodeBarangSelect = document.getElementById('kode_barang');
        const barangInput = document.getElementById('barang');

        kodeBarangSelect.addEventListener('change', function () {
            const selectedOption = kodeBarangSelect.options[kodeBarangSelect.selectedIndex];
            barangInput.value = selectedOption.text.split(' - ')[1];
        });
    });
</script>

</body>
</html>
