<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Katalog Barang</title>
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
            margin-top: 50px; /* Adjust based on the height of your header */
        }
    </style>
    
    @include('layout.partial.header')

    <main class="container mt-5">
        <h1>Edit Barang</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('updatekatalog', $katalog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')  <!-- Menggunakan PUT untuk update -->

            <div class="form-group">
                <label for="klasifikasi">Klasifikasi</label>
                <input type="text" class="form-control" name="klasifikasi" value="{{ old('klasifikasi', $katalog->klasifikasi) }}" required>
            </div>

            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" class="form-control" name="kode_barang" value="{{ old('kode_barang', $katalog->kode_barang) }}" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="{{ old('nama', $katalog->nama) }}">
            </div>

            <div class="form-group">
                <label for="detail_spesifikasi">Detail Spesifikasi</label>
                <textarea class="form-control" name="detail_spesifikasi">{{ old('detail_spesifikasi', $katalog->detail_spesifikasi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <select class="form-control" name="brand" id="brand" onchange="toggleNewBrandInput()">
                    <option value="">Pilih Brand</option>
                    @foreach($merkCatalogs as $merk)
                        <option value="{{ $merk->merk_nama }}" {{ (old('brand', $katalog->brand) == $merk->merk_nama) ? 'selected' : '' }}>{{ $merk->merk_nama }}</option>
                    @endforeach
                    <option value="lainnya" {{ (old('brand', $katalog->brand) == 'lainnya') ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label for="new_brand">Brand Baru</label>
                <input type="text" class="form-control" name="new_brand" value="{{ old('new_brand') }}" id="new_brand" {{ $katalog->brand !== 'lainnya' ? 'disabled' : '' }}>
            </div>

            <div class="form-group">
                <label for="gambar_perangkat">Gambar Perangkat</label>
                <input type="file" class="form-control" name="gambar_perangkat">
                @if($katalog->gambar_perangkat)
                    <img src="{{ asset('images/' . $katalog->gambar_perangkat) }}" alt="Gambar Perangkat" style="max-width: 100px; margin-top: 10px;">
                @endif
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input type="url" class="form-control" name="link" value="{{ old('link', $katalog->link) }}">
            </div>

            <!-- Additional fields as per your validation rules -->
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" name="type" value="{{ old('type', $katalog->type) }}">
            </div>

            <div class="form-group">
                <label for="harga_asli_offline">Harga Asli Offline</label>
                <input type="number" class="form-control" name="harga_asli_offline" value="{{ old('harga_asli_offline', $katalog->harga_asli_offline) }}">
            </div>

            <div class="form-group">
                <label for="harga_asli_online">Harga Asli Online</label>
                <input type="number" class="form-control" name="harga_asli_online" value="{{ old('harga_asli_online', $katalog->harga_asli_online) }}">
            </div>

            <div class="form-group">
                <label for="harga_rab_persen">Harga RAB Persen</label>
                <input type="number" class="form-control" name="harga_rab_persen" value="{{ old('harga_rab_persen', $katalog->harga_rab_persen) }}">
            </div>

            <div class="form-group">
                <label for="harga_rab_wajar">Harga RAB Wajar</label>
                <input type="number" class="form-control" name="harga_rab_wajar" value="{{ old('harga_rab_wajar', $katalog->harga_rab_wajar) }}">
            </div>

            <div class="form-group">
                <label for="tanggal_update">Tanggal Update</label>
                <input type="date" class="form-control" name="tanggal_update" value="{{ old('tanggal_update', $katalog->tanggal_update) }}">
            </div>

            <div class="form-group">
                <label for="vendor">Vendor</label>
                <input type="text" class="form-control" name="vendor" value="{{ old('vendor', $katalog->vendor) }}">
            </div>

            <div class="form-group">
                <label for="jumlah_kebutuhan">Jumlah Kebutuhan</label>
                <input type="number" class="form-control" name="jumlah_kebutuhan" value="{{ old('jumlah_kebutuhan', $katalog->jumlah_kebutuhan) }}">
            </div>

            <div class="form-group">
                <label for="jumlah_ketersediaan">Jumlah Ketersediaan</label>
                <input type="number" class="form-control" name="jumlah_ketersediaan" value="{{ old('jumlah_ketersediaan', $katalog->jumlah_ketersediaan) }}">
            </div>

            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" class="form-control" name="satuan" value="{{ old('satuan', $katalog->satuan) }}">
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" name="keterangan">{{ old('keterangan', $katalog->keterangan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Katalog</button>
        </form>
    </main>

    @section('scripts')
    <script>
        function toggleNewBrandInput() {
            const brandSelect = document.getElementById('brand');
            const newBrandInput = document.getElementById('new_brand');
            newBrandInput.disabled = brandSelect.value !== 'lainnya';
        }

        // Panggil fungsi ini saat halaman dimuat untuk mengatur keadaan awal input brand baru
        document.addEventListener('DOMContentLoaded', function() {
            toggleNewBrandInput();
            
        });
    </script>
    @endsection
</body>
</html>
