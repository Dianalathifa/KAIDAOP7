<?php

namespace App\Exports;

use App\Models\Katalog;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class KatalogExport implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize, WithMapping
{
    use Exportable;

    protected $tahun;

    public function __construct(int $tahun)
    {
        $this->tahun = $tahun;
    }

    public function query()
    {
        return Katalog::query()->whereYear('tanggal_update', $this->tahun);
    }

    public function headings(): array
    {
        return [
            'No',
            'Klasifikasi',
            'Kode Barang',
            'Nama',
            'Detail Spesifikasi',
            'Brand',
            'Type',
            'Harga Asli OFF',
            'Harga Asli ON',
            'Harga RAB+20%',
            'Harga RAB Wajar',
            'Tanggal Update',
            'Vendor',
            'Satuan',
            'Keterangan',
            'Gambar',
            'Link',
        ];
    }

    public function map($item): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $item->klasifikasiRelasi->klasifikasi ?? $item->klasifikasi,
            $item->kode_barang,
            $item->nama,
            $item->detail_spesifikasi,
            $item->brand,
            $item->type,
            $item->harga_asli_offline,
            $item->harga_asli_online,
            $item->harga_rab_persen,
            $item->harga_rab_wajar,
            $item->tanggal_update,
            $item->vendor,
            $item->satuan,
            $item->keterangan,
            $item->gambar_perangkat,
            $item->link,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:Q1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E9ECEF']
                ],
            ],
            'A' => ['width' => 5],
            'B' => ['width' => 15],
            'C' => ['width' => 15],
            'D' => ['width' => 30],
            'E' => ['width' => 50],
        ];
    }
}