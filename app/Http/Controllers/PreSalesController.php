<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PreSalesController extends Controller
{
    public function index(Request $request)
    {
        $query = Person::query()->with('spouse');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by month
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        $persons = $query->latest()->paginate(10)->withQueryString();

        return view('presales.index', compact('persons'));
    }

    public function create()
    {
        $persons = Person::whereNull('spouse_id')->get();
        return view('presales.create', compact('persons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:persons,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|string|max:3',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'berlaku_hingga' => 'required|string|max:255',
        ]);

        $person = Person::create($validated);

        // If status is married (Kawin) or divorced (Cerai Hidup/Cerai Mati), redirect to spouse form
        if (in_array($request->status_perkawinan, ['Kawin', 'Cerai Hidup', 'Cerai Mati'])) {
            return redirect()->route('spouses.create', $person->id)->with('success', 'Data utama berhasil ditambahkan. Silakan lengkapi data pasangan.');
        }

        return redirect()->route('presales.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Person $presale)
    {
        $presale->load('spouse');
        return view('presales.show', compact('presale'));
    }

    public function edit(Person $presale)
    {
        $presale->load('spouse');
        $persons = Person::whereNull('spouse_id')->where('id', '!=', $presale->id)->get();
        return view('presales.edit', compact('presale', 'persons'));
    }

    public function update(Request $request, Person $presale)
    {
        $validated = $request->validate([
            'nik' => ['required', 'digits:16', Rule::unique('persons')->ignore($presale->id)],
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|string|max:3',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'berlaku_hingga' => 'required|string|max:255',
        ]);

        $presale->update($validated);

        return redirect()->route('presales.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Person $presale)
    {
        $presale->delete();
        return redirect()->route('presales.index')->with('success', 'Data berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:persons,id'
        ]);

        Person::whereIn('id', $request->ids)->delete();

        return redirect()->route('presales.index')->with('success', 'Data terpilih berhasil dihapus');
    }

    public function bulkExport(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:persons,id'
        ]);

        $exporter = new \App\Exports\PersonExport($request->ids);
        return $exporter->export();
    }
}
