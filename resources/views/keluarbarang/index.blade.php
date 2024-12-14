<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Barang Keluar</title>
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
        <h1 class="mb-4">Daftar Barang Keluar</h1>

        <!-- Button to open the "Tambah Barang Keluar" modal -->
        <div class="bg-body p-3 rounded shadow-sm my-3">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addKeluarBarangModal">
                + Tambah Barang Keluar
            </button>

            <!-- Search form -->
            <form action="{{ route('keluarbarang.index') }}" method="GET" class="mb-3">
                <div class="row g-2">
                <div class="col-auto">
                        <input class="form-control form-control-sm" type="search" name="katakunci" value="{{ request('katakunci') }}" placeholder="Cari...">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                    </div>
                </div>
            </form>

            <!-- Table to display "Barang Keluar" data -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Keluar</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Keluar</th>
                            <th>Unit Kerja</th>
                            <th>Tanggal Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keluarBarangs as $keluarBarang)
                            <tr>
                                <td>{{ $keluarBarang->kode_keluar }}</td>
                                <td>{{ $keluarBarang->kode_barang }}</td>
                                <td>{{ $keluarBarang->nama_barang }}</td>
                                <td>{{ $keluarBarang->jumlah_keluar }}</td>
                                <td>{{ $keluarBarang->unitKerja->Nama_Unit }} - {{ $keluarBarang->unitKerja->DAOP }}</td>
                                <td>{{ $keluarBarang->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editKeluarBarangModal{{ $keluarBarang->id }}">Edit</button>
                                    <form action="{{ route('keluarbarang.destroy', $keluarBarang->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal for each item -->
                            <div class="modal fade" id="editKeluarBarangModal{{ $keluarBarang->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Barang Keluar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('keluarbarang.update', $keluarBarang->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                                                    <input type="number" class="form-control" name="jumlah_keluar" value="{{ $keluarBarang->jumlah_keluar }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="unit_id" class="form-label">Unit Kerja</label>
                                                    <select name="unit_id" class="form-control" required>
                                                    <option value="">Pilih Unit</option>
                                                    @foreach($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->Nama_Unit }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $keluarBarangs->links() }}
        </div>
    </main>

    <!-- Modal for adding a new "Barang Keluar" -->
    <div class="modal fade" id="addKeluarBarangModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Barang Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('keluarbarang.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <select name="kode_barang" class="form-control" required>
                                @foreach ($katalogs as $katalog)
                                    <option value="{{ $katalog->kode_barang }}">{{ $katalog->kode_barang }} - {{ $katalog->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                            <input type="number" class="form-control" name="jumlah_keluar" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_id" class="form-label">Unit Kerja</label>
                            <select name="unit_id" class="form-control" required>
                            <option value="">Pilih Unit</option>
                            @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->Nama_Unit }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
