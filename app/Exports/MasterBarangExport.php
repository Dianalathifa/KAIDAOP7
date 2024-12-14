<?php

namespace App\Exports;

use App\Models\MasterBarang;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MasterBarangExport implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize, WithMapping
{
    use Exportable;

    protected $tahun;

    public function __construct(int $tahun)
    {
        $this->tahun = $tahun;
    }

    /**
     * Query data master barang berdasarkan tahun.
     */
    public function query()
    {
        return MasterBarang::query()->whereYear('created_at', $this->tahun);
    }

    /**
     * Header kolom untuk file Excel.
     */
    public function headings(): array
    {
        return [
            'No',
            'Master Barang ID',
            'Kode Barang',
            'Nama Barang',
            'Barang Masuk',
            'Barang Keluar',
            'Total Stok',
            'Tanggal Dibuat',
            'Tanggal Diperbarui',
            'ID Katalog',
        ];
    }

    /**
     * Mapping data untuk setiap baris di file Excel.
     */
    public function map($item): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $item->master_barang_id,
            $item->kode_barang,
            $item->nama_barang,
            $item->barang_masuk,
            $item->barang_keluar,
            $item->total_stok,
            $item->created_at ? $item->created_at->format('Y-m-d H:i:s') : 'N/A',
            $item->updated_at ? $item->updated_at->format('Y-m-d H:i:s') : 'N/A',
            $item->id_katalog ?? 'N/A',
        ];
    }

    /**
     * Styling untuk worksheet Excel.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Header tebal
            'A1:J1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E9ECEF'],
                ],
            ],
        ];
    }
}
