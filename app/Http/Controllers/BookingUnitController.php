<?php

namespace App\Http\Controllers;

use App\Models\BookingUnit;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookingUnitController extends Controller
{
    public function index(Request $request)
    {
        $query = BookingUnit::query()->with(['person', 'createdBy']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status_booking', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $bookingUnits = $query->latest()->paginate(10)->withQueryString();

        return view('booking-units.index', compact('bookingUnits'));
    }

    public function create()
    {
        return view('booking-units.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16',
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
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'jenis_unit' => 'required|string|max:255',
            'lokasi_unit' => 'required|string|max:255',
            'harga_unit' => 'required|numeric|min:0',
            'tanggal_booking' => 'required|date',
            'tanggal_pembayaran_dp' => 'nullable|date',
            'jumlah_dp' => 'nullable|numeric|min:0',
            'status_booking' => 'required|in:pending,confirmed,completed,cancelled',
            'catatan' => 'nullable|string',
        ]);

        $bookingUnit = BookingUnit::create(array_merge($validated, [
            'created_by' => Auth::id(),
        ]));

        return redirect()->route('booking-units.index')->with('success', 'Booking unit berhasil ditambahkan');
    }

    public function show(BookingUnit $bookingUnit)
    {
        $bookingUnit->load(['person', 'createdBy']);
        return view('booking-units.show', compact('bookingUnit'));
    }

    public function edit(BookingUnit $bookingUnit)
    {
        return view('booking-units.edit', compact('bookingUnit'));
    }

    public function update(Request $request, BookingUnit $bookingUnit)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'size:16', Rule::unique('booking_units')->ignore($bookingUnit->id)],
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
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'jenis_unit' => 'required|string|max:255',
            'lokasi_unit' => 'required|string|max:255',
            'harga_unit' => 'required|numeric|min:0',
            'tanggal_booking' => 'required|date',
            'tanggal_pembayaran_dp' => 'nullable|date',
            'jumlah_dp' => 'nullable|numeric|min:0',
            'status_booking' => 'required|in:pending,confirmed,completed,cancelled',
            'catatan' => 'nullable|string',
        ]);

        $bookingUnit->update($validated);

        return redirect()->route('booking-units.index')->with('success', 'Booking unit berhasil diperbarui');
    }

    public function destroy(BookingUnit $bookingUnit)
    {
        $bookingUnit->delete();
        return redirect()->route('booking-units.index')->with('success', 'Booking unit berhasil dihapus');
    }

    public function searchPerson(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([]);
        }

        $persons = Person::where(function($q) use ($query) {
            $q->where('nik', 'LIKE', "%{$query}%")
              ->orWhere('nama_lengkap', 'LIKE', "%{$query}%");
        })
        ->limit(10)
        ->get(['id', 'nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan', 'kabupaten_kota', 'provinsi', 'agama', 'status_perkawinan', 'pekerjaan', 'kewarganegaraan', 'berlaku_hingga']);

        return response()->json($persons);
    }
}
