<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Services\KTPOCRService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class SlikDataController extends Controller
{
    public function index()
    {
        $slikData = Person::latest()->paginate(10);
        return view('slik.index', compact('slikData'));
    }

    public function create()
    {
        return view('slik.create');
    }

    public function uploadKtp(Request $request, KTPOCRService $ocrService)
    {
        $request->validate([
            'ktp_image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        try {
            $file = $request->file('ktp_image');
            $path = $file->store('ktp_uploads', 'public');
            
            // OCR Processing menggunakan service
            $extractedData = $ocrService->extractData($file);
            
            return response()->json([
                'success' => true,
                'data' => $extractedData,
                'image_path' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses gambar KTP: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:persons,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|string|max:3',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'kewarganegaraan' => 'required|string|max:50',
            'berlaku_hingga' => 'nullable|string|max:50',
        ]);

        Person::create($validated);

        return redirect()->route('slik.index')
            ->with('success', 'Data SLIK berhasil disimpan');
    }

    public function edit(Person $slik)
    {
        return view('slik.edit', compact('slik'));
    }

    public function update(Request $request, Person $slik)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:persons,nik,' . $slik->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|string|max:3',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'kewarganegaraan' => 'required|string|max:50',
            'berlaku_hingga' => 'nullable|string|max:50',
        ]);

        $slik->update($validated);

        return redirect()->route('slik.index')
            ->with('success', 'Data SLIK berhasil diupdate');
    }

    public function destroy(Person $slik)
    {
        $slik->delete();
        return redirect()->route('slik.index')
            ->with('success', 'Data SLIK berhasil dihapus');
    }


}
