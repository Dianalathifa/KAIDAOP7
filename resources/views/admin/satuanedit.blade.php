<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Satuan</title>
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
      <form action="{{ url('satuantambah/' . $item->id.'/satuanedit') }}" method="post">
        @csrf
        @method('PUT')
          <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="id" id="id" value="{{ old('id', $item->id) }}">
              @if ($errors->has('id'))
                <div class="text-danger">{{ $errors->first('id') }}</div>
              @endif
            </div>
          </div>
          <div class="col-sm-10">
              <input type="text" class="form-control" name="satuan" id="satuan" value="{{ old('satuan', $item->satuan) }}">
              @if ($errors->has('satuan'))
                <div class="text-danger">{{ $errors->first('satuan') }}</div>
              @endif
            </div>
          </div>
          <div class="col-sm-10">
              <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="{{ old('deskripsi', $item->deskripsi) }}">
              @if ($errors->has('deskripsi'))
                <div class="text-danger">{{ $errors->first('deskripsi') }}</div>
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
