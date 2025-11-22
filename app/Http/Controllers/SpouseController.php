<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpouseController extends Controller
{
    public function create($personId)
    {
        $person = Person::findOrFail($personId);
        return view('spouses.create', compact('person'));
    }

    public function store(Request $request, $personId)
    {
        $person = Person::findOrFail($personId);
        
        $validated = $request->validate([
            'spouse_nik' => 'required|digits:16|unique:persons,nik',
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
        ]);

        // Prepare spouse data by removing the 'spouse_' prefix
        $spouseData = [];
        foreach ($validated as $key => $value) {
            $spouseData[str_replace('spouse_', '', $key)] = $value;
        }
        
        // Set status_perkawinan to 'Kawin' for spouse
        $spouseData['status_perkawinan'] = 'Kawin';
        
        // Create the spouse
        $spouse = Person::create($spouseData);
        
        // Update the original person to link to the spouse
        $person->update(['spouse_id' => $spouse->id]);
        
        // Update the spouse to reference back to the person
        $spouse->update(['spouse_id' => $person->id]);

        return redirect()->route('presales.index')->with('success', 'Data spouse berhasil ditambahkan');
    }

    public function edit($personId)
    {
        $person = Person::with('spouse')->findOrFail($personId);
        if (!$person->spouse) {
            return redirect()->route('spouses.create', $personId)->with('error', 'Spouse data not found');
        }
        
        return view('spouses.edit', compact('person'));
    }

    public function update(Request $request, $personId)
    {
        $person = Person::with('spouse')->findOrFail($personId);
        if (!$person->spouse) {
            return redirect()->route('spouses.create', $personId)->with('error', 'Spouse data not found');
        }
        
        $validated = $request->validate([
            'spouse_nik' => ['required', 'digits:16', Rule::unique('persons')->ignore($person->spouse->id)],
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
        ]);

        // Prepare spouse data by removing the 'spouse_' prefix
        $spouseData = [];
        foreach ($validated as $key => $value) {
            $spouseData[str_replace('spouse_', '', $key)] = $value;
        }
        
        // Update the spouse
        $person->spouse->update($spouseData);

        return redirect()->route('presales.index')->with('success', 'Data spouse berhasil diperbarui');
    }
}