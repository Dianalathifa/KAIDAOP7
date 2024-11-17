<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Daop</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
</head>
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
<body class="bg-light">
<main class="container">
    <h1>Tambah Klasifikasi Baru</h1>
    <main class="container">
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
      <form action="{{ url('tambahdaop/' . $Data->namadaop.'/editdaop') }}" method="post">
        @csrf
        @method('PUT')
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <div class="my-3 p-3 bg-body rounded shadow-sm container w-full mx-auto pt-20">
        <div class="mb-4 text-center" >
                <h1 class="text-2xl font-bold text-gray-800">Edit Daop</h1>
            </div>
            <div class="mb-3 row">
            <label for="namadaop" class="col-sm-2 col-form-label">Nama Daop</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" klasifikasi="namadaop" id="namadaop" value="{{ old('namadaop', $Data->namadaop) }}">
              @if ($errors->has('namadaop'))
                <div class="text-danger">{{ $errors->first('namadaop') }}</div>
              @endif
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-sm-10 offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
            </div>
          </div>
        </div>
      </form>
      <!-- AKHIR FORM -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>
