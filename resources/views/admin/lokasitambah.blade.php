<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Lokasi</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
    <style>
        body {
            padding-top: 60px; /* Sesuaikan dengan tinggi header */
        }
        
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; /* Pastikan header tetap di atas */
        }
    </style>
</head>
<body class="bg-light">
@include('layout.partial.header')

<main class="container mt-5">
    <h1>Tambah Lokasi Penyimpanan</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLokasiModal">
        Tambah Lokasi
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addLokasiModal" tabindex="-1" aria-labelledby="addLokasiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLokasiModalLabel">Tambah Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="lokasi_id" class="form-label">ID Lokasi</label>
                            <input type="number" class="form-control" name="lokasi_id" id="lokasi_id">
                            @if ($errors->has('lokasi_id'))
                                <div class="text-danger">{{ $errors->first('lokasi_id') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="penyimpanan" class="form-label">Nama Lokasi</label>
                            <input type="text" class="form-control" name="lokasi_penyimpanan" id="lokasi_penyimpanan">
                            @if ($errors->has('lokasi_penyimpanan'))
                                <div class="text-danger">{{ $errors->first('lokasi_penyimpanan') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_deskripsi" class="form-label">Keterangan Lokasi</label>
                            <input type="text" class="form-control" name="lokasi_deskripsi" id="lokasi_deskripsi">
                            @if ($errors->has('lokasi_deskripsi'))
                                <div class="text-danger">{{ $errors->first('lokasi_deskripsi') }}</div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
