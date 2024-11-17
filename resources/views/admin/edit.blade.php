<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pengguna</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
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
    <h1>Tambah Barang</h1>
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
      <form action="{{ url('adduser/' . $Data->NIPP.'/edit') }}" method="post">
        @csrf
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <a href="{{ url('adduser') }}" class="btn btn-secondary">Kembali</a>  
          <div class="mb-3 row">
            <label for="NIPP" class="col-sm-2 col-form-label">NIPP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="NIPP" id="NIPP" value="{{ old('NIPP', $Data->NIPP) }}">
              @if ($errors->has('NIPP'))
                <div class="text-danger">{{ $errors->first('NIPP') }}</div>
              @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $Data->name) }}">
              @if ($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
              @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $Data->email) }}">
              @if ($errors->has('email'))
                <div class="text-danger">{{ $errors->first('email') }}</div>
              @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" id="password" placeholder="Isi jika ingin mengubah password">
              @if ($errors->has('password'))
                <div class="text-danger">{{ $errors->first('password') }}</div>
              @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="role" id="role" value="{{ old('role', $Data->role) }}">
              @if ($errors->has('role'))
                <div class="text-danger">{{ $errors->first('role') }}</div>
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
