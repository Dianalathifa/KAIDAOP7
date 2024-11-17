<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KAI DAOP 7</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

   @include('layout.partial.link')

</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
@include('layout.partial.header')
   
    <!--Container-->
    <div class="container w-full mx-auto pt-20">

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <!--Console Content-->
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('viewklasifikasi') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                            <div class="rounded p-3 bg-blue-600">
                                <i class="fas fa-cubes fa-2x fa-fw fa-inverse"></i> <!-- Changed to a box icon -->
                            </div>

                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Klasifikasi Barang</h5>
                                <h3 class="font-bold text-3xl">{{$totalKlasifikasi}} <span class="text-blue-500"><i class="fas fa-caret-up"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                        <!--Metric Card-->
                        <div class="bg-white border rounded shadow p-2" style="cursor: pointer;" onclick="window.location='{{ route('viewkatalog') }}'">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded p-3 bg-pink-600"><i class="fas fa-box fa-2x fa-fw fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h5 class="font-bold uppercase text-gray-500">Data Katalog Barang</h5>
                                    <h3 class="font-bold text-3xl">{{$totalKatalog  }} <span class="text-pink-500"><i class="fa fa-caret-up"></i></span></h3>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                </div>

                <!-- <div class="w-full md:w-1/2 xl:w-1/3 p-3"> -->
                        <!--Metric Card-->
                        <!-- <div class="bg-white border rounded shadow p-2" style="cursor: pointer;" onclick="window.location='{{ route('tambahbarang') }}'">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded p-3 bg-pink-600"><i class="fas fa-box fa-2x fa-fw fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h5 class="font-bold uppercase text-gray-500">Tambah Katalog Barang</h5>
                                    <h3 class="font-bold text-3xl">{{$totalKatalog  }} <span class="text-pink-500"><i class="fa fa-plus"></i></span></h3>
                                </div>
                            </div>
                        </div> -->
                        <!--/Metric Card-->
                <!-- </div> -->
                
                
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('satuanview') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-green-600"><i class="fas fa-clipboard-list fa-2x fa-fw fa-inverse"></i></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Satuan Barang</h5>
                                <h3 class="font-bold text-3xl">{{ $satuantotal}} <span class="text-green-600"><i class="fa fa-caret-up"></i></span></h3> 
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>  
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('merk') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-yellow-500"><i class="fas fa-tags fa-2x fa-fw fa-inverse"></i></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Merk Barang</h5>
                                <h3 class="font-bold text-3xl">{{ $merktotal}} <span class="text-yellow-500"><i class="fa fa-caret-up"></i></span></h3> 
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>  
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('lokasi') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-blue-600"><i class="fas fa-map-marker-alt fa-2x fa-fw fa-inverse"></i></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Lokasi Penyimpanan</h5>
                                <h3 class="font-bold text-3xl">{{ $totallokasi}} <span class="text-blue-500"><i class="fa fa-caret-up"></i></span></h3> 
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>  
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                     <!--Metric Card-->
                     <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('viewunit') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-yellow-500"><i class="fas fa-sitemap fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Unit Kerja</h5>
                                <h3 class="font-bold text-3xl">{{$totalUnit}} <span class="text-yellow-500"></span> </h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>  
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('masukcatalog.index') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-green-600"><i class="fas fa-arrow-down fa-2x fa-fw fa-inverse"></i></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Barang Masuk</h5>
                                <h3 class="font-bold text-3xl">{{ $totalMasukCatalog}} <span class="text-green-500"></span></h3> 
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>  
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('keluarbarang.index') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-red-600"><i class="fas fa-arrow-up fa-2x fa-fw fa-inverse"></i></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Barang Keluar</h5>
                                <h3 class="font-bold text-3xl">{{ $totalKeluarBarang}} <span class="text-red-500"></span></h3> 
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>  

                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('masterbarang.index') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-blue-600"><i class="fas fa-cubes fa-2x fa-fw fa-inverse"></i></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Stok Barang</h5>
                                <h3 class="font-bold text-3xl">{{ $totalMasterBarang}} <span class="text-blue-500"></span></h3> 
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>  
            </div>

            <!--Divider-->
            <hr class="border-b-2 border-gray-400 my-8 mx-4">

            <div class="flex flex-row flex-wrap flex-grow mt-2">

            <div class="w-full md:w-1/2 p-3">
                    <!--Graph Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Graph Klasifikasi Barang</h5>
                        </div>
                        <div class="p-5">
                            <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                        </div>
                    </div>
                    <!--/Graph Card-->
                </div>
            </div>

               

                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Graph Card-->
                    <!-- <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Graph</h5>
                        </div>
                        <div class="p-5">
                            <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                            <script>
                            new Chart(document.getElementById("chartjs-1"), {
                                "type": "bar",
                                "data": {
                                    "labels": ["January", "February", "March", "April", "May", "June", "July"],
                                    "datasets": [{
                                        "label": "Likes",
                                        "data": [65, 59, 80, 81, 56, 55, 40],
                                        "fill": false,
                                        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                                        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"],
                                        "borderWidth": 1
                                    }]
                                },
                                "options": {
                                    "scales": {
                                        "yAxes": [{
                                            "ticks": {
                                                "beginAtZero": true
                                            }
                                        }]
                                    }
                                }
                            });
                            </script>
                        </div>
                    </div> -->
                    <!--/Graph Card-->
                </div>

                
            </div>

            <!--/ Console Content-->

        </div>


    </div>
    <!--/container-->
    @yield('content')
@include('layout.partial.footer')   
</body>
@include('layout.partial.script')
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mengambil data dari API Laravel
        axios.get('/api/katalog-data')
            .then(response => {
                const data = response.data;

                // Mengambil klasifikasi dan total barang dari API response
                const klasifikasi = data.map(item => item.klasifikasi);
                const totalBarang = data.map(item => item.total);

                // Membuat chart dengan Chart.js
                const ctx = document.getElementById('chartjs-7').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: klasifikasi,  // Klasifikasi barang sebagai label
                        datasets: [
                            {
                                label: 'Banyak Barang',
                                data: totalBarang,  // Total barang sebagai data
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                type: 'bar'  // Menentukan tipe dataset sebagai bar
                            },
                            {
                                label: 'Perbandingan Barang',
                                data: totalBarang.map(value => value * 0.8),  // Contoh data untuk line chart (misalnya 80% dari totalBarang)
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderWidth: 2,
                                type: 'line',  // Menentukan tipe dataset sebagai line
                                tension: 0.1  // Mengatur kelengkungan garis
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,  // Mulai dari nol
                                ticks: {
                                    callback: function(value) {
                                        return value + ' unit';  // Menambahkan satuan "unit"
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
</script>
