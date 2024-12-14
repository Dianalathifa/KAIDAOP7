<?php

namespace App\Imports;

use App\Models\Katalog;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KatalogImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Memetakan data dari file Excel ke model `Katalog`.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Katalog([
            'klasifikasi' => $row['klasifikasi'] ?? null,
            'kode_barang' => $row['kode_barang'],
            'nama' => $row['nama'],
            'detail_spesifikasi' => $row['detail_spesifikasi'] ?? null,
            'brand' => $row['brand'] ?? null,
            'type' => $row['type'] ?? null,
            'harga_asli_offline' => $this->processNumericValue($row['harga_asli_offline']),
            'harga_asli_online' => $this->processNumericValue($row['harga_asli_online']),
            'harga_rab_persen' => $row['harga_rab_persen'] ?? null,
            'harga_rab_wajar' => $row['harga_rab_wajar'] ?? null,
            'tanggal_update' => isset($row['tanggal_update']) && is_numeric($row['tanggal_update']) 
                ? Date::excelToDateTimeObject((float) $row['tanggal_update'])
                : now(), // Gunakan tanggal saat ini jika kosong
            'vendor' => $row['vendor'] ?? null,
            'satuan' => $row['satuan'] ?? null,
            'keterangan' => $row['keterangan'] ?? null,
            'gambar_perangkat' => $row['gambar_perangkat'] ?? null,
            'link' => $row['link'] ?? null,
        ]);
    }

    /**
     * Validasi dan proses nilai numerik secara aman.
     *
     * @param mixed $value
     * @return float
     */
    private function processNumericValue($value)
    {
        // Jika nilai bukan numerik, kembalikan 0 sebagai default
        if (!is_numeric($value)) {
            return 0;
        }

        // Konversi nilai ke float dan gunakan floor()
        return floor((float) $value);
    }

    /**
     * Aturan validasi untuk data yang diimpor.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'kode_barang' => [
                'required',
                Rule::unique('katalogs', 'kode_barang')
            ],
            'nama' => 'required|string|max:255',
            'harga_asli_offline' => 'required|numeric|min:0',
            'harga_asli_online' => 'required|numeric|min:0',
            'tanggal_update' => 'required|date',
            'link' => 'nullable|url', // Validasi untuk kolom URL
        ];
    }

    /**
     * Pesan khusus untuk validasi.
     *
     * @return array
     */
    public function customValidationMessages(): array
    {
        return [
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah ada di database.',
            'nama.required' => 'Nama barang wajib diisi.',
            'nama.max' => 'Nama barang tidak boleh lebih dari 255 karakter.',
            'harga_asli_offline.required' => 'Harga asli offline wajib diisi.',
            'harga_asli_online.required' => 'Harga asli online wajib diisi.',
            'harga_asli_offline.numeric' => 'Harga asli offline harus berupa angka.',
            'harga_asli_online.numeric' => 'Harga asli online harus berupa angka.',
            'harga_asli_offline.min' => 'Harga asli offline tidak boleh kurang dari 0.',
            'harga_asli_online.min' => 'Harga asli online tidak boleh kurang dari 0.',
            'tanggal_update.required' => 'Tanggal update wajib diisi.',
            'tanggal_update.date' => 'Tanggal update harus berupa format tanggal yang valid.',
            'link.url' => 'Link harus berupa URL yang valid.',
        ];
    }
}
