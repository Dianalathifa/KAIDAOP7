<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data</title>
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
<h1>tambah data</h1>
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
    <form action="{{ route('adminhome') }}" method="post">
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
            <div class="mb-4 text-center" >
                <h1 class="text-2xl font-bold text-gray-800">Tambah data</h1>
            </div>
                <label for="title" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" id="title" value="{{ Session::get('title') }}">
                    @if ($errors->has('title'))
                        <div class="text-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>
            </div>
                    <div class="mb-3 row">
            <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description" id="description" rows="4">{{ Session::get('description') }}</textarea>
                @if ($errors->has('description'))
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
                <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" id="image">
                    @if ($errors->has('image'))
                        <div class="text-danger">{{ $errors->first('image') }}</div>
                    @endif
                </div>
            </div>
           
        </select>
        
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
