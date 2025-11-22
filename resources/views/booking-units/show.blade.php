<x-layout.layout>
    <x-slot name="title">Detail Booking Unit - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <x-ui.button variant="ghost" href="{{ route('booking-units.index') }}" size="sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </x-ui.button>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Booking Unit</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $bookingUnit->nama_lengkap }}</p>
                </div>
            </div>
            <div class="flex gap-2">
                <x-ui.button variant="warning" href="{{ route('booking-units.edit', $bookingUnit) }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </x-ui.button>
            </div>
        </div>

        <!-- Data Pribadi Card -->
        <x-ui.card>
            <h3 class="text-lg font-semibold mb-4">Data Pribadi</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">NIK</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->nik }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->nama_lengkap }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->tempat_lahir }}, {{ $bookingUnit->tanggal_lahir?->format('d F Y') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->jenis_kelamin }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Golongan Darah</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->golongan_darah ?: '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Agama</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->agama }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Status Perkawinan</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->status_perkawinan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Pekerjaan</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->pekerjaan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Kewarganegaraan</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->kewarganegaraan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Berlaku Hingga</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->berlaku_hingga }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">No HP</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->no_hp ?: '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Email</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->email ?: '-' }}</p>
                </div>
            </div>

            <h3 class="text-lg font-semibold mb-4">Alamat</h3>

            <div class="grid grid-cols-1 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Alamat Lengkap</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->alamat }}</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">RT/RW</label>
                        <p class="mt-1 text-gray-900">{{ $bookingUnit->rt }}/{{ $bookingUnit->rw }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kelurahan/Desa</label>
                        <p class="mt-1 text-gray-900">{{ $bookingUnit->kelurahan }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kecamatan</label>
                        <p class="mt-1 text-gray-900">{{ $bookingUnit->kecamatan }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kabupaten/Kota</label>
                        <p class="mt-1 text-gray-900">{{ $bookingUnit->kabupaten_kota }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Provinsi</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->provinsi }}</p>
                </div>
            </div>
        </x-ui.card>

        <!-- Detail Booking Unit Card -->
        <x-ui.card>
            <h3 class="text-lg font-semibold mb-4">Detail Booking Unit</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Jenis Unit</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->jenis_unit }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Lokasi Unit</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->lokasi_unit }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Harga Unit</label>
                    <p class="mt-1 text-gray-900">Rp {{ number_format($bookingUnit->harga_unit, 2, ',', '.') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Tanggal Booking</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->tanggal_booking?->format('d F Y') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Tanggal Pembayaran DP</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->tanggal_pembayaran_dp?->format('d F Y') ?: '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Jumlah DP</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->jumlah_dp ? 'Rp ' . number_format($bookingUnit->jumlah_dp, 2, ',', '.') : '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Status Booking</label>
                    <p class="mt-1 text-gray-900">
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $bookingUnit->status_booking === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $bookingUnit->status_booking === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $bookingUnit->status_booking === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $bookingUnit->status_booking === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($bookingUnit->status_booking) }}
                        </span>
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Dibuat oleh</label>
                    <p class="mt-1 text-gray-900">{{ $bookingUnit->createdBy?->name ?: 'Tidak diketahui' }}</p>
                </div>
            </div>

            @if($bookingUnit->catatan)
            <div>
                <label class="block text-sm font-medium text-gray-500">Catatan</label>
                <p class="mt-1 text-gray-900">{{ $bookingUnit->catatan }}</p>
            </div>
            @endif
        </x-ui.card>
    </div>
</x-layout.layout>