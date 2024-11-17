<?php

namespace App\Exports;

use App\Models\MasukCatalog;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MasukCatalogExport implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize, WithMapping
{
    use Exportable;

    protected $tahun;

    public function __construct(int $tahun)
    {
        $this->tahun = $tahun;
    }

    public function query()
    {
        return MasukCatalog::query()->whereYear('created_at', $this->tahun); // Ganti dengan kolom yang sesuai
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Masuk',
            'Kode Barang',
            'Nama Barang',
            'Jumlah Masuk',
            'Unit',
            'Gambar',
            'Tanggal Masuk',
            // Tambahkan kolom lain sesuai kebutuhan
        ];
    }

    public function map($item): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $item->kode_masuk,
            $item->kode_barang,
            $item->barang,
            $item->jumlah_masuk,
            $item->unitKerja->nama ?? 'N/A', // Asumsi 'nama' adalah kolom yang ingin ditampilkan dari unit kerja
            $item->gambar_masuk,
            $item->created_at, // Ganti jika Anda ingin menggunakan kolom lain untuk tanggal masuk
            // Tambahkan data lain sesuai kebutuhan
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:H1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E9ECEF']
                ],
            ],
            'A' => ['width' => 5],
            'B' => ['width' => 15],
            'C' => ['width' => 15],
            'D' => ['width' => 30],
            'E' => ['width' => 10],
            'F' => ['width' => 20],
            'G' => ['width' => 30],
            // Tambahkan pengaturan lebar kolom sesuai kebutuhan
        ];
    }
}
