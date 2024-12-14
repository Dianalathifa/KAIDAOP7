<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('layout.partial.link')
    <style>
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

        .table thead th {
            background-color: #f8f9fa;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
            vertical-align: middle;
        }

        .modal-dialog {
            max-width: 600px;
        }
    </style>
</head>

<body class="bg-light">
    @include('layout.partial.header')

    <main class="container">
        <h1 class="mb-4">Daftar Barang Masuk</h1>

      

        <div class="bg-body p-3 rounded shadow-sm my-3">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMasukBarangModal">
                + Tambah Barang Masuk
            </button>

            <form action="{{ route('masukcatalog.index') }}" method="GET" class="mb-3">
                <div class="row g-2">
                <div class="col-auto">
                        <input class="form-control form-control-sm" type="search" name="katakunci" value="{{ request('katakunci') }}" placeholder="Cari...">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Masuk</th>
                        <th>Kode Barang</th>
                        <th>Jumlah Masuk</th>
                        <th>Penerima</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($masukCatalogs as $masukCatalog)
                        <tr>
                            <td>{{ $loop->iteration + ($masukCatalogs->currentPage() - 1) * $masukCatalogs->perPage() }}</td>
                            <td>{{ $masukCatalog->kode_masuk }}</td>
                            <td>{{ $masukCatalog->kode_barang }}</td>
                            <td>{{ $masukCatalog->jumlah_masuk }}</td>
                            <td>
                                @if($masukCatalog->unitKerja)
                                    {{ $masukCatalog->unitKerja->Nama_Unit }} - {{ $masukCatalog->unitKerja->DAOP }}
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMasukBarangModal" 
                                        data-id="{{ $masukCatalog->masuk_barang_id }}"
                                        data-kode_barang="{{ $masukCatalog->kode_barang }}"
                                        data-jumlah_masuk="{{ $masukCatalog->jumlah_masuk }}"
                                        data-unit_id="{{ $masukCatalog->unitKerja ? $masukCatalog->unitKerja->id : '' }}">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $masukCatalog->masuk_barang_id }}')">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data barang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $masukCatalogs->links() }}
            </div>
        </div>
    </main>

    <!-- Modal Tambah Barang Masuk -->
    <div class="modal fade" id="addMasukBarangModal" tabindex="-1" aria-labelledby="addMasukBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('masukcatalog.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMasukBarangModalLabel">Tambah Barang Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <select class="form-select" id="kode_barang" name="kode_barang" required>
                                <option value="">Pilih Kode Barang</option>
                                @foreach($katalogs as $kode)
                                    <option value="{{ $kode->kode_barang }}">{{ $kode->kode_barang }} - {{ $kode->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_masuk" class="form-label">Jumlah Masuk</label>
                            <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="unit_id" class="form-label">Unit</label>
                            <select class="form-select" id="unit_id" name="unit_id" required>
                                <option value="">Pilih Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->Nama_Unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Barang Masuk -->
    <div class="modal fade" id="editMasukBarangModal" tabindex="-1" aria-labelledby="editMasukBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('masukcatalog.update', 0) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMasukBarangModalLabel">Edit Barang Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_kode_barang" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" id="edit_kode_barang" name="kode_barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_jumlah_masuk" class="form-label">Jumlah Masuk</label>
                            <input type="number" class="form-control" id="edit_jumlah_masuk" name="jumlah_masuk" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="edit_unit_id" class="form-label">Unit</label>
                            <select class="form-select" id="edit_unit_id" name="unit_id" required>
                                <option value="">Pilih Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->Nama_Unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fungsi untuk konfirmasi penghapusan
        function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Data akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/masukcatalog/${id}/delete`; // Pastikan action mengarah ke URL yang benar
            
            // Menambahkan token CSRF
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}'; // Pastikan ini ada dalam tampilan
            
            // Menambahkan input untuk metode DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(csrfInput);
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit(); // Kirim formulir
        }
    });
}


        // Fungsi untuk menampilkan modal edit dengan data
        document.getElementById('editMasukBarangModal').addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const kode_barang = button.getAttribute('data-kode_barang');
            const jumlah_masuk = button.getAttribute('data-jumlah_masuk');
            const unit_id = button.getAttribute('data-unit_id');

            const form = document.getElementById('editForm');
            form.action = `/masukcatalog/${id}`;
            document.getElementById('edit_kode_barang').value = kode_barang;
            document.getElementById('edit_jumlah_masuk').value = jumlah_masuk;
            document.getElementById('edit_unit_id').value = unit_id;
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
