<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Merk</title>
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

<main class="container mt-5">
    <h1>Daftar Merk</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMerkModal">
        Tambah Merk
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addMerkModal" tabindex="-1" aria-labelledby="addMerkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMerkModalLabel">Tambah Merk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="merk_id" class="form-label">ID Merk</label>
                            <input type="number" class="form-control" name="merk_id" id="merk_id">
                            @if ($errors->has('merk_id'))
                                <div class="text-danger">{{ $errors->first('merk_id') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="merk_nama" class="form-label">Nama Merk</label>
                            <input type="text" class="form-control" name="merk_nama" id="merk_nama">
                            @if ($errors->has('merk_nama'))
                                <div class="text-danger">{{ $errors->first('merk_nama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="merk_keterangan" class="form-label">Keterangan Merk</label>
                            <input type="text" class="form-control" name="merk_keterangan" id="merk_keterangan">
                            @if ($errors->has('merk_keterangan'))
                                <div class="text-danger">{{ $errors->first('merk_keterangan') }}</div>
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
