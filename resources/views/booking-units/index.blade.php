<x-layout.layout>
    <x-slot name="title">Booking Unit - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Booking Unit</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola Booking Unit</p>
            </div>
            <x-ui.button variant="primary" href="{{ route('booking-units.create') }}">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Booking Unit
            </x-ui.button>
        </div>

        @if(session('success'))
            <x-ui.alert type="success" :dismissible="true">
                {{ session('success') }}
            </x-ui.alert>
        @endif

        <!-- Search & Filter -->
        <x-ui.card>
            <x-slot name="header">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Filter & Pencarian</h3>
            </x-slot>

            <form method="GET" action="{{ route('booking-units.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2 md:gap-4 items-end">
                    <!-- Search -->
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Cari (NIK/Nama)</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs md:text-sm"
                            placeholder="Cari NIK atau Nama">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Status Booking</label>
                        <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs md:text-sm">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Date From -->
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Dari</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs md:text-sm">
                    </div>

                    <!-- Date To -->
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Sampai</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs md:text-sm">
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col gap-2">
                        <x-ui.button type="submit" variant="primary" class="w-full">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filter
                        </x-ui.button>
                        <x-ui.button variant="outline" href="{{ route('booking-units.index') }}" class="w-full">
                            Reset
                        </x-ui.button>
                    </div>
                </div>
            </form>
        </x-ui.card>

        <!-- Table -->
        <x-ui.card>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Unit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi Unit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Unit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Booking</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bookingUnits as $bookingUnit)
                            <tr>
                                <td class="px-6 py-4 text-sm">{{ $bookingUnit->nik }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="font-medium">{{ $bookingUnit->nama_lengkap }}</div>
                                    <div class="text-xs text-gray-500">{{ $bookingUnit->tempat_lahir }}, {{ $bookingUnit->tanggal_lahir?->format('d/m/Y') }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $bookingUnit->jenis_unit }}</td>
                                <td class="px-6 py-4 text-sm">{{ $bookingUnit->lokasi_unit }}</td>
                                <td class="px-6 py-4 text-sm">Rp {{ number_format($bookingUnit->harga_unit, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm">{{ $bookingUnit->tanggal_booking?->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $bookingUnit->status_booking === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $bookingUnit->status_booking === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $bookingUnit->status_booking === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $bookingUnit->status_booking === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($bookingUnit->status_booking) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm space-x-2 flex items-center">
                                    <a href="{{ route('booking-units.show', $bookingUnit) }}" class="text-blue-600 hover:text-blue-800" title="Lihat">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('booking-units.edit', $bookingUnit) }}" class="text-yellow-600 hover:text-yellow-800 ml-2" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('booking-units.destroy', $bookingUnit) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $bookingUnits->links() }}
            </div>
        </x-ui.card>
    </div>
</x-layout.layout>