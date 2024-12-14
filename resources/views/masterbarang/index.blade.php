<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Master Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
    @include('layout.partial.link')
    <style>
        .table thead th, .table tbody td {
            white-space: nowrap;
            border-right: 1px solid #dee2e6;
            border-top: 1px solid #dee2e6;
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
    <h1>Daftar Master Barang</h1>
    @if (Session::has('success'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <!-- Button to trigger the modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBarangModal">
                + Tambah Data
            </button>
        </div>

        <!-- FORM PENCARIAN -->
        <div class="pb-3">
            <form action="{{ route('masterbarang.index') }}" method="get">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <input class="form-control form-control-sm" type="search" name="katakunci" value="{{ request('katakunci') }}" placeholder="Cari...">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                    </div>
                    <form action="{{ route('masterbarang.export') }}" method="GET" class="row g-3 mb-3">
    <!-- Dropdown untuk Tahun -->
    <div class="col-auto">
        <select class="form-select" name="tahun" id="tahun" required>
            <option value="">Pilih Tahun</option>
            @foreach($tahunOptions as $tahun)
                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                    {{ $tahun }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Tombol Unduh Excel -->
    <div class="col-auto">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Unduh Excel
        </button>
    </div>
</form>

                </div>
             </form>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Barang Masuk</th>
                        <th>Barang Keluar</th>
                        <th>Total Stok</th>
                        <th>Tanggal Ditambahkan</th>
                        <th>Terakhir Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masterBarangs as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->barang_masuk }}</td>
                        <td>{{ $item->barang_keluar }}</td>
                        <td>{{ $item->total_stok }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBarangModal" data-id="{{ $item->id }}" data-kode="{{ $item->kode_barang }}" data-nama="{{ $item->nama_barang }}" data-barang_masuk="{{ $item->barang_masuk }}" data-barang_keluar="{{ $item->barang_keluar }}" data-total_stok="{{ $item->total_stok }}">
                                Edit
                            </button>

                            <form action="{{ route('masterbarang.index', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Hapus
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
            {{ $masterBarangs->links() }}
        </div>

      <!-- Add Modal -->
<div class="modal fade" id="addBarangModal" tabindex="-1" aria-labelledby="addBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBarangModalLabel">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('masterbarang.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <select name="kode_barang" id="kode_barang" class="form-control" required>
                            <option value="" disabled selected>Pilih Kode Barang</option>
                            @foreach ($katalogs as $katalog)
                                <option value="{{ $katalog->kode_barang }}">{{ $katalog->kode_barang }}</option>
                            @endforeach
                        </select>
                        @error('kode_barang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" readonly required>
                        @error('nama_barang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="barang_masuk" class="form-label">Barang Masuk</label>
                        <input type="number" class="form-control" name="barang_masuk" id="barang_masuk" readonly required>
                        @error('barang_masuk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="barang_keluar" class="form-label">Barang Keluar</label>
                        <input type="number" class="form-control" name="barang_keluar" id="barang_keluar" min="0">
                        @error('barang_keluar')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="total_stok" class="form-label">Total Stok</label>
                        <input type="number" class="form-control" name="total_stok" id="total_stok" readonly>
                        @error('total_stok')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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
        <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBarangModalLabel">Edit Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('masterbarang.update', 'test') }}" method="post" id="formEditBarang">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" id="edit_kode_barang" readonly required>
                                @error('kode_barang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="edit_nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="edit_nama_barang" readonly required>
                                @error('nama_barang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="edit_barang_masuk" class="form-label">Barang Masuk</label>
                                <input type="number" class="form-control" name="barang_masuk" id="edit_barang_masuk" required>
                                @error('barang_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="edit_barang_keluar" class="form-label">Barang Keluar</label>
                                <input type="number" class="form-control" name="barang_keluar" id="edit_barang_keluar" min="0">
                                @error('barang_keluar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="edit_total_stok" class="form-label">Total Stok</label>
                                <input type="number" class="form-control" name="total_stok" id="edit_total_stok" min="0">
                                @error('total_stok')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
<script>
     document.getElementById('kode_barang').addEventListener('change', function() {
    const kodeBarang = this.value;
    
    if (kodeBarang) {
        fetch(`/get-barang-masuk/${kodeBarang}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('nama_barang').value = data.nama_barang;
                    document.getElementById('barang_masuk').value = data.jumlah_masuk;
                    const barangKeluar = document.getElementById('barang_keluar').value || 0;
                    document.getElementById('total_stok').value = data.jumlah_masuk - barangKeluar;
                } else {
                    clearBarangFields();
                }
            })
            .catch(error => {
                console.error('Error fetching barang:', error);
                clearBarangFields();
            });
    } else {
        clearBarangFields();
    }
});

document.getElementById('barang_keluar').addEventListener('input', function() {
    const barangMasuk = document.getElementById('barang_masuk').value || 0;
    const barangKeluar = this.value || 0;
    document.getElementById('total_stok').value = barangMasuk - barangKeluar;
});

function clearBarangFields() {
    document.getElementById('nama_barang').value = '';
    document.getElementById('barang_masuk').value = 0;
    document.getElementById('total_stok').value = 0;
}

// Edit Modal event handler
const editBarangModal = document.getElementById('editBarangModal');
editBarangModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const kode = button.getAttribute('data-kode');
    const nama = button.getAttribute('data-nama');
    const barangMasuk = button.getAttribute('data-barang_masuk');
    const barangKeluar = button.getAttribute('data-barang_keluar');
    const totalStok = button.getAttribute('data-total_stok');
    const id = button.getAttribute('data-id');

    const formEditBarang = document.getElementById('formEditBarang');
    formEditBarang.action = `/masterbarang/${id}`;  // Adjust form action URL dynamically
    document.getElementById('edit_kode_barang').value = kode;
    document.getElementById('edit_nama_barang').value = nama;
    document.getElementById('edit_barang_masuk').value = barangMasuk;
    document.getElementById('edit_barang_keluar').value = barangKeluar;
    document.getElementById('edit_total_stok').value = totalStok - barangKeluar;
});

</script>
</body>
</html>
