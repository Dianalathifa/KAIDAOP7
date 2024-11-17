<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Merk</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
    <style>
        .table thead th, .table tbody td {
            white-space: nowrap;
            border-right: 1px solid #dee2e6; /* Menambahkan garis pembatas samping */
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            width: auto;
        }
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
            margin-top: 50px; /* Adjust based on the height of your header */
        }
    </style>
</head>
<body class="bg-light">
@include('layout.partial.header')

<main class="container">
    <h1>Daftar Merk</h1>
   

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="brand">
            <img src="assets/img/kai.png" width="60px" height="50px" alt="logo" style="float: right;">
        </div>

        <div class="pb-3">
            <!-- Button to trigger the modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMerkModal">
                + Tambah Data
            </button>
        </div>

        <!-- FORM PENCARIAN -->
        <div class="pb-3">
            <form action="{{ url('merk') }}" method="get">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <input class="form-control form-control-sm" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari...">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <!-- <th class="col-md-2">ID Merk</th> -->
                    <th class="col-md-3">Nama Merk</th>
                    <th class="col-md-4">Keterangan Merk</th>
                    <th class="col-md-2">Tanggal Ditambahkan</th>
                    <th class="col-md-2">Terakhir Diperbarui</th> <!-- Kolom baru -->
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <!-- <td>{{ $item->merk_id }}</td> -->
                    <td>{{ $item->merk_nama }}</td>
                    <td>{{ $item->merk_keterangan }}</td>
                    <td>{{ $item->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                    <td>{{ $item->updated_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                    <td>
                    <!-- Tombol Edit -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMerkModal" data-id="{{ $item->merk_id }}" data-nama="{{ $item->merk_nama }}" data-keterangan="{{ $item->merk_keterangan }}">
                        <i class="fas fa-edit"></i> <!-- Ikon edit -->
                    </button>

                    <!-- Tombol Delete -->
                    <form action="{{ url('merk/' . $item->merk_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash"></i> <!-- Ikon delete -->
                        </button>
                    </form>
                </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $Data->links() }}
        </div>

        <!-- Add Modal -->
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
                                <label for="merk_nama" class="form-label">Nama Merk</label>
                                <input type="text" class="form-control" name="merk_nama" id="merk_nama" required>
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

       <!-- Edit Modal -->
<div class="modal fade" id="editMerkModal" tabindex="-1" aria-labelledby="editMerkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMerkModalLabel">Edit Merk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMerkForm" action="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_merk_id" class="form-label">ID Merk</label>
                        <input type="number" class="form-control" name="merk_id" id="edit_merk_id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_merk_nama" class="form-label">Nama Merk</label>
                        <input type="text" class="form-control" name="merk_nama" id="edit_merk_nama" required>
                        <div class="text-danger" id="edit_merk_nama_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_merk_keterangan" class="form-label">Keterangan Merk</label>
                        <input type="text" class="form-control" name="merk_keterangan" id="edit_merk_keterangan">
                        <div class="text-danger" id="edit_merk_keterangan_error"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editMerkModal = document.getElementById('editMerkModal');
        editMerkModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button yang memicu modal
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var keterangan = button.getAttribute('data-keterangan');

            var form = document.getElementById('editMerkForm');
            form.action = '/merk/' + id; // Set action form ke rute yang benar

            document.getElementById('edit_merk_id').value = id;
            document.getElementById('edit_merk_nama').value = nama;
            document.getElementById('edit_merk_keterangan').value = keterangan;
        });
    });
    @if (Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ Session::get('success') }}',
            showConfirmButton: true
        });
    @endif
</script>

</body>
</html>
