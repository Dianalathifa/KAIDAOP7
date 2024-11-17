<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Klasifikasi</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('layout.partial.link')
  </head>
  <body class="bg-light">
  <header style="position: sticky; top: 0; z-index: 1000;">
    @include('layout.partial.header')
  </header>
  <main class="container" style="padding-top: 130px;">
  @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif
      
      <!-- START DATA -->
      <div class="my-3 p-3 bg-body rounded shadow-sm">
      <div class="brand">
    <img src="assets/img/kai.png" width="60px" height="50px" alt="logo" style="float: right;">
</div>

<div class="pb-3">
    <a href="{{ url('master') }}" class="btn btn-secondary" style="background-color: orange; border-color: orange; color: white;">Kembali</a>
</div>


        <!-- FORM PENCARIAN -->
        <div class="pb-3">
        <form class="d-flex" action="{{ url('viewklasifikasi') }}" method="get">
    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
    <button class="btn btn-secondary" type="submit">Cari</button>
</form>
        </div>
        
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
          <a href="{{ route('tambahklasifikasi') }}" class="btn btn-primary">+ Tambah Klasifikasi</a>
        </div>
        
        <table class="table table-striped">
    <thead>
        <tr>
            <th class="col-md-1">No</th>
            <th class="col-md-4">Klasifikasi</th>
            <th class="col-md-4">Inisial</th>
            <th class="col-md-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($klasifikasi as $item)
        <tr>
            <td>{{ $loop->iteration + ($klasifikasi->currentPage() - 1) * $klasifikasi->perPage() }}</td>
            <td>{{ $item->klasifikasi }}</td>
            <td>{{ $item->inisial }}</td>
              
              <td>
                
               
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" onclick="editKlasifikasi({{ $item->id }})">
    Edit
</button>

<!-- Modal HTML (tetap di dalam view) -->
<div class="modal fade" id="editKlasifikasiModal" tabindex="-1" aria-labelledby="editKlasifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKlasifikasiModalLabel">Edit Klasifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit Klasifikasi -->
                <form id="editKlasifikasiForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="klasifikasi" class="form-label">Klasifikasi</label>
                        <input type="text" class="form-control" id="klasifikasi" name="klasifikasi" required>
                    </div>
                    <div class="mb-3">
                        <label for="inisial" class="form-label">Inisial</label>
                        <input type="text" class="form-control" id="inisial" name="inisial" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

           <form action="{{ route('klasifikasi.destroy', $item->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus Klasifikasi ini?')">Hapus</button>
</form>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
    {{ $klasifikasi->links() }} <!-- Tautan untuk pagination -->
</div>
      </div>
      <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<!-- Script to handle the modal -->
<script>
    function editKlasifikasi(id) {
        // Ajax untuk ambil data klasifikasi
        $.ajax({
            url: `/klasifikasi/${id}/edit`,
            method: 'GET',
            success: function(response) {
                console.log(response); // Lihat respons dari server di konsol browser
                $('#editKlasifikasiForm').attr('action', `/klasifikasi/${id}`);
                $('#klasifikasi').val(response.klasifikasi); 
                $('#inisial').val(response.inisial);         
                $('#editKlasifikasiModal').modal('show'); // Buka modal setelah data dimuat
            },
            error: function() {
                alert('Gagal memuat data.');
            }
        });
    }
</script>
</script>
  </body>
</html>
