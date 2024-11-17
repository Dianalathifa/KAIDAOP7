<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Klasifikasi</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">
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
      <form action="{{ url('tambahklasifikasi/' . $item->klasifikasi.'/editklasifikasi') }}" method="post">
        @csrf
        @method('PUT')
          <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Klasifikasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" klasifikasi="klasifikasi" id="klasifikasi" value="{{ old('klasifikasi', $item->klasifikasi) }}">
              @if ($errors->has('klasifikasi'))
                <div class="text-danger">{{ $errors->first('klasifikasi') }}</div>
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
