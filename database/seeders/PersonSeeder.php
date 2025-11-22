<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        // Data Person Belum Kawin
        Person::create([
            'nik' => '3201012001950001',
            'nama_lengkap' => 'Budi Santoso',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1995-01-20',
            'jenis_kelamin' => 'Laki-laki',
            'golongan_darah' => 'A',
            'alamat' => 'Jl. Merdeka No. 123',
            'rt' => '001',
            'rw' => '005',
            'kelurahan' => 'Menteng',
            'kecamatan' => 'Menteng',
            'kabupaten_kota' => 'Jakarta Pusat',
            'provinsi' => 'DKI Jakarta',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Karyawan Swasta',
            'kewarganegaraan' => 'WNI',
            'berlaku_hingga' => 'SEUMUR HIDUP',
        ]);

        // Data Person Kawin dengan Spouse
        $suami = Person::create([
            'nik' => '3201012001900001',
            'nama_lengkap' => 'Ahmad Wijaya',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1990-01-20',
            'jenis_kelamin' => 'Laki-laki',
            'golongan_darah' => 'B',
            'alamat' => 'Jl. Sudirman No. 456',
            'rt' => '002',
            'rw' => '003',
            'kelurahan' => 'Kebayoran Baru',
            'kecamatan' => 'Kebayoran Baru',
            'kabupaten_kota' => 'Jakarta Selatan',
            'provinsi' => 'DKI Jakarta',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Wiraswasta',
            'kewarganegaraan' => 'WNI',
            'berlaku_hingga' => 'SEUMUR HIDUP',
        ]);

        $istri = Person::create([
            'nik' => '3201012001920001',
            'nama_lengkap' => 'Siti Nurhaliza',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1992-05-15',
            'jenis_kelamin' => 'Perempuan',
            'golongan_darah' => 'O',
            'alamat' => 'Jl. Sudirman No. 456',
            'rt' => '002',
            'rw' => '003',
            'kelurahan' => 'Kebayoran Baru',
            'kecamatan' => 'Kebayoran Baru',
            'kabupaten_kota' => 'Jakarta Selatan',
            'provinsi' => 'DKI Jakarta',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'kewarganegaraan' => 'WNI',
            'berlaku_hingga' => 'SEUMUR HIDUP',
            'spouse_id' => $suami->id,
        ]);

        $suami->update(['spouse_id' => $istri->id]);

        // Data Person Cerai Hidup
        Person::create([
            'nik' => '3201012001880001',
            'nama_lengkap' => 'Dewi Lestari',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '1988-03-10',
            'jenis_kelamin' => 'Perempuan',
            'golongan_darah' => 'AB',
            'alamat' => 'Jl. Gatot Subroto No. 789',
            'rt' => '003',
            'rw' => '007',
            'kelurahan' => 'Kuningan',
            'kecamatan' => 'Setiabudi',
            'kabupaten_kota' => 'Jakarta Selatan',
            'provinsi' => 'DKI Jakarta',
            'agama' => 'Kristen',
            'status_perkawinan' => 'Cerai Hidup',
            'pekerjaan' => 'Pegawai Negeri Sipil',
            'kewarganegaraan' => 'WNI',
            'berlaku_hingga' => 'SEUMUR HIDUP',
        ]);
    }
}
