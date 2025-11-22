<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'golongan_darah',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'berlaku_hingga',
        'no_hp',
        'email',
        'jenis_unit',
        'lokasi_unit',
        'harga_unit',
        'tanggal_booking',
        'tanggal_pembayaran_dp',
        'jumlah_dp',
        'status_booking',
        'catatan',
        'created_by',
        'person_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_booking' => 'date',
        'tanggal_pembayaran_dp' => 'date',
        'harga_unit' => 'decimal:2',
        'jumlah_dp' => 'decimal:2',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
