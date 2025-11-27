<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Person;

class UpdateSpouseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $personId = $this->route('personId');
        $person = Person::with('spouse')->findOrFail($personId);
        $spouseId = $person->spouse ? $person->spouse->id : null;

        return [
            'spouse_nik' => ['required', 'digits:16', Rule::unique('persons', 'nik')->ignore($spouseId)],
            'spouse_nama_lengkap' => 'required|string|max:255',
            'spouse_tempat_lahir' => 'required|string|max:255',
            'spouse_tanggal_lahir' => 'required|date',
            'spouse_jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'spouse_golongan_darah' => 'nullable|string|max:3',
            'spouse_alamat' => 'required|string',
            'spouse_rt' => 'required|string|max:3',
            'spouse_rw' => 'required|string|max:3',
            'spouse_kelurahan' => 'required|string|max:255',
            'spouse_kecamatan' => 'required|string|max:255',
            'spouse_kabupaten_kota' => 'required|string|max:255',
            'spouse_provinsi' => 'required|string|max:255',
            'spouse_agama' => 'required|string|max:255',
            'spouse_pekerjaan' => 'required|string|max:255',
            'spouse_kewarganegaraan' => 'required|string|max:255',
            'spouse_berlaku_hingga' => 'required|string|max:255',
        ];
    }
}
