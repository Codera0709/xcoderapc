<?php

namespace App\Exports;

use App\Models\Person;

class PersonExport
{
    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function export()
    {
        $persons = Person::with('spouse')->whereIn('id', $this->ids)->get();

        // Create CSV content
        $filename = 'Data_PreSales_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($persons) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'NIK',
                'Nama Lengkap',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Jenis Kelamin',
                'Golongan Darah',
                'Alamat',
                'RT',
                'RW',
                'Kelurahan',
                'Kecamatan',
                'Kabupaten/Kota',
                'Provinsi',
                'Agama',
                'Status Perkawinan',
                'Pekerjaan',
                'Kewarganegaraan',
                'Berlaku Hingga',
                'NIK Spouse',
                'Nama Spouse',
            ]);

            // Data
            foreach ($persons as $person) {
                fputcsv($file, [
                    $person->nik,
                    $person->nama_lengkap,
                    $person->tempat_lahir,
                    $person->tanggal_lahir->format('d/m/Y'),
                    $person->jenis_kelamin,
                    $person->golongan_darah ?: '-',
                    $person->alamat,
                    $person->rt,
                    $person->rw,
                    $person->kelurahan,
                    $person->kecamatan,
                    $person->kabupaten_kota,
                    $person->provinsi,
                    $person->agama,
                    $person->status_perkawinan,
                    $person->pekerjaan,
                    $person->kewarganegaraan,
                    $person->berlaku_hingga,
                    $person->spouse ? $person->spouse->nik : '-',
                    $person->spouse ? $person->spouse->nama_lengkap : '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
