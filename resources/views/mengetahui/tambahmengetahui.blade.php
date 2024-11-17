<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pejabat Mengetahui</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
</head>
@include('layout.partial.header')
<body class="bg-light">
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

    .container {
        margin-top:50px; /* Adjust based on the height of your header */
    }
</style>
@include('layout.partial.header')
<main class="container">
<h1>tambah user</h1>
    @if ($errors->any())
        <div class="pt-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <!-- START FORM -->
    <form action="{{ route('viewmengetahui') }}" method="post">
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
            <div class="mb-4 text-center" >
                <h1 class="text-2xl font-bold text-gray-800">Tambah Pejabat Mengetahui</h1>
            </div>
                <label for="NIPP" class="col-sm-2 col-form-label">NIPP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="NIPP" id="NIPP" value="{{ Session::get('NIPP') }}">
                    @if ($errors->has('NIPP'))
                        <div class="text-danger">{{ $errors->first('NIPP') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ Session::get('nama') }}">
                    @if ($errors->has('nama'))
                        <div class="text-danger">{{ $errors->first('nama') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jabatan" class="col-sm-2 col-form-label">jabatan</label>
                <div class="col-sm-10">
                    <input type="jabatan" class="form-control" name="jabatan" id="jabatan" value="{{ Session::get('jabatan') }}">
                    @if ($errors->has('jabatan'))
                        <div class="text-danger">{{ $errors->first('jabatan') }}</div>
                    @endif
                </div>
            </div>
           
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    <img src="assets/img/kai.png" width="60px" height="50px" alt="logo" style="float: right;">
                </div>
            </div>
        </div>
        
        
    </form>
    <!-- AKHIR FORM -->
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
