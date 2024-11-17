<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Lokasi Penyimpanan</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
    <style>
        .table thead th, .table tbody td {
            white-space: nowrap;
            border-right: 1px solid #dee2e6;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            width: auto;
        }
        body {
            padding-top: 60px;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body class="bg-light">
@include('layout.partial.header')

<main class="container">
    <h1>Daftar Lokasi Penyimpanan</h1>
    @if (Session::has('success'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="brand">
            <img src="assets/img/kai.png" width="60px" height="50px" alt="logo" style="float: right;">
        </div>

        <div class="pb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLokasiModal">
                + Tambah Lokasi
            </button>
        </div>

        <!-- FORM PENCARIAN -->
        <div class="pb-3">
            <form action="{{ url('lokasi') }}" method="get">
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
                    <!-- <th class="col-md-2">ID Lokasi</th> -->
                    <th class="col-md-3">Nama Lokasi</th>
                    <th class="col-md-4">Deskripsi Lokasi</th>
                    <th class="col-md-2">Tanggal Ditambahkan</th>
                    <th class="col-md-2">Terakhir Diperbarui</th> <!-- Kolom baru -->
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <!-- <td>{{ $item->lokasi_id }}</td> -->
                    <td>{{ $item->lokasi_penyimpanan }}</td>
                    <td>{{ $item->lokasi_deskripsi }}</td>
                    <td>{{ $item->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                    <td>{{ $item->updated_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                    <td>
                    <!-- Tombol Edit -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLokasiModal" data-id="{{ $item->lokasi_id }}" data-penyimpanan="{{ $item->lokasi_penyimpanan }}" data-deskripsi="{{ $item->lokasi_deskripsi }}">
                        <i class="fas fa-edit"></i> <!-- Ikon edit -->
                    </button>

                    <!-- Tombol Delete -->
                    <form action="{{ url('lokasi/' . $item->lokasi_id) }}" method="POST" class="d-inline">
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

        <!-- Modal Tambah Lokasi -->
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
                                <label for="lokasi_penyimpanan" class="form-label">Nama Lokasi</label>
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

        <!-- Modal Edit Lokasi -->
        <div class="modal fade" id="editLokasiModal" tabindex="-1" aria-labelledby="editLokasiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLokasiModalLabel">Edit Lokasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editLokasiForm" action="" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_lokasi_id" class="form-label">ID Lokasi</label>
                                <input type="number" class="form-control" name="lokasi_id" id="edit_lokasi_id" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_lokasi_penyimpanan" class="form-label">Nama Lokasi</label>
                                <input type="text" class="form-control" name="lokasi_penyimpanan" id="edit_lokasi_penyimpanan" required>
                                <div class="text-danger" id="edit_lokasi_penyimpanan_error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="edit_lokasi_deskripsi" class="form-label">Deskripsi Lokasi</label>
                                <input type="text" class="form-control" name="lokasi_deskripsi" id="edit_lokasi_deskripsi">
                                <div class="text-danger" id="edit_lokasi_deskripsi_error"></div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editLokasiModal = document.getElementById('editLokasiModal');
        editLokasiModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var lokasiId = button.getAttribute('data-id');
            var lokasiPenyimpanan = button.getAttribute('data-penyimpanan');
            var lokasiDeskripsi = button.getAttribute('data-deskripsi');
            
            var modalTitle = editLokasiModal.querySelector('.modal-title');
            var modalBodyInputId = editLokasiModal.querySelector('#edit_lokasi_id');
            var modalBodyInputPenyimpanan = editLokasiModal.querySelector('#edit_lokasi_penyimpanan');
            var modalBodyInputDeskripsi = editLokasiModal.querySelector('#edit_lokasi_deskripsi');
            
            modalTitle.textContent = 'Edit Lokasi: ' + lokasiPenyimpanan;
            modalBodyInputId.value = lokasiId;
            modalBodyInputPenyimpanan.value = lokasiPenyimpanan;
            modalBodyInputDeskripsi.value = lokasiDeskripsi;
            
            document.getElementById('editLokasiForm').action = "/lokasi/" + lokasiId;
        });
    });
</script>

</body>
</html>
