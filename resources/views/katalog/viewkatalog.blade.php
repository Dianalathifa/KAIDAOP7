<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Daftar Katalog Barang</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
    @include('layout.partial.link')

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        .table thead th, .table tbody td {
            white-space: nowrap;
            border-right: 1px solid #dee2e6;
            border-top: 1px solid #dee2e6;
        }
        .col-no { width: 50px; }
        .col-id { width: 100px; }
        .col-nama { width: 200px; }
        .col-detail { width: 300px; max-width: 300px; }
        td.col-detail {
            white-space: normal;
            word-wrap: break-word;
            vertical-align: top;
        }
        .col-klasifikasi { width: 100px; }
        .col-brand { width: 150px; }
        .col-type { width: 150px; }
        .col-harga { width: 400px; }
        .col-tanggal { width: 150px; }
        .col-vendor { width: 150px; }
        .col-satuan { width: 100px; }
        .col-keterangan { width: 300px; }
        .col-gambar { width: 200px; }
        .col-link { width: 200px; }
        .col-aksi { width: 150px; }

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
        <h1>View Katalog</h1>

        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="brand">
                <img src="assets/img/kai.png" width="60" height="50" alt="logo" style="float: right;">
            </div>

            <div class="pb-3">
                <a href="{{ url('tambahbarang') }}" class="btn btn-secondary" style="background-color: orange; border-color: orange; color: white;">Kembali</a>
            </div>

            <!-- FORM PENCARIAN DAN FILTER -->
           <div class="pb-3">
    <form action="{{ url('viewkatalog') }}" method="get">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <input class="form-control" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari...">
            </div>
            <div class="col-auto">
                <select class="form-select" name="tahun">
                    <option value="">Tahun</option>
                    @foreach($tahunOptions as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select class="form-select" name="klasifikasi">
                    <option value="">Klasifikasi</option>
                    @foreach($klasifikasiOptions as $klasifikasi)
                        <option value="{{ $klasifikasi }}" {{ request('klasifikasi') == $klasifikasi ? 'selected' : '' }}>{{ $klasifikasi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
            </div>
            <div class="col-auto">
                <button type="submit" formaction="{{ route('export.excel') }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Unduh Excel</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('tambahbarang') }}" class="btn btn-primary">+ Tambah Data</a>
            </div>
        </div>
    </form>
    
    <!-- Form untuk Import Excel -->
    <form action="{{ route('katalog.import') }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <input type="file" name="file" class="form-control" id="file" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
    </form>
</div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-klasifikasi">Klasifikasi</th>
                            <th class="col-id">Kode Barang</th>
                            <th class="col-nama">Nama</th>
                            <th class="col-detail">Detail Spesifikasi</th>
                            <th class="col-brand">Brand</th>
                            <th class="col-type">Type</th>
                            <th class="col-harga">Harga Asli OFF</th>
                            <th class="col-harga">Harga Asli ON</th>
                            <th class="col-harga">Harga RAB+20%</th>
                            <th class="col-harga">Harga RAB Wajar</th>
                            <th class="col-tanggal">Tanggal Ditambahkan</th>
                            <th class="col-vendor">Vendor</th>
                            <th class="col-satuan">Satuan</th>
                            <th class="col-keterangan">Keterangan</th>
                            <th class="col-gambar">Gambar</th>
                            <th class="col-link">Link</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($katalog as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->klasifikasiRelasi->klasifikasi ?? $item->klasifikasi }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="col-detail" style="white-space: pre-line;">{{ $item->detail_spesifikasi }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ number_format($item->harga_asli_offline, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->harga_asli_online, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->harga_rab_persen, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->harga_rab_wajar, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_update)->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                            <td>{{ $item->vendor }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <img src="{{ asset('images/' . $item->gambar_perangkat) }}" alt="Gambar" width="50">
                            </td>
                            <td>{{ $item->link }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('editkatalog', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                <!-- Tombol Delete -->
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->kode_barang }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $katalog->links() }}
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-" crossorigin="anonymous"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Menghapus item
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Melakukan permintaan AJAX untuk menghapus data
                            fetch(`{{ url('hapuskatalog') }}/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Dihapus!', data.message, 'success');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                } else {
                                    Swal.fire('Gagal!', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                            });
                        }
                    });
                });
            });
            
            // Notifikasi sukses menggunakan SweetAlert2
            @if (session('sukses'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('sukses') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif

            @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    </script>
@endif

        });
    </script>
</body>
</html>
