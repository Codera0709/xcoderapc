<x-layout.layout>
    <x-slot name="title">Detail Data Pra-Sales - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <x-ui.button variant="ghost" href="{{ route('presales.index') }}" size="sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </x-ui.button>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Data Pra-Sales</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $presale->nama_lengkap }}</p>
                </div>
            </div>
            <div class="flex gap-2">
                <x-ui.button variant="warning" href="{{ route('presales.edit', $presale) }}">
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
                    <p class="mt-1 text-gray-900">{{ $presale->nik }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                    <p class="mt-1 text-gray-900">{{ $presale->nama_lengkap }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                    <p class="mt-1 text-gray-900">{{ $presale->tempat_lahir }}, {{ $presale->tanggal_lahir->format('d F Y') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                    <p class="mt-1 text-gray-900">{{ $presale->jenis_kelamin }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Golongan Darah</label>
                    <p class="mt-1 text-gray-900">{{ $presale->golongan_darah ?: '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Agama</label>
                    <p class="mt-1 text-gray-900">{{ $presale->agama }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Status Perkawinan</label>
                    <p class="mt-1 text-gray-900">{{ $presale->status_perkawinan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Pekerjaan</label>
                    <p class="mt-1 text-gray-900">{{ $presale->pekerjaan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Kewarganegaraan</label>
                    <p class="mt-1 text-gray-900">{{ $presale->kewarganegaraan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Berlaku Hingga</label>
                    <p class="mt-1 text-gray-900">{{ $presale->berlaku_hingga }}</p>
                </div>
            </div>

            <h3 class="text-lg font-semibold mb-4">Alamat</h3>

            <div class="grid grid-cols-1 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Alamat Lengkap</label>
                    <p class="mt-1 text-gray-900">{{ $presale->alamat }}</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">RT/RW</label>
                        <p class="mt-1 text-gray-900">{{ $presale->rt }}/{{ $presale->rw }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kelurahan/Desa</label>
                        <p class="mt-1 text-gray-900">{{ $presale->kelurahan }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kecamatan</label>
                        <p class="mt-1 text-gray-900">{{ $presale->kecamatan }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kabupaten/Kota</label>
                        <p class="mt-1 text-gray-900">{{ $presale->kabupaten_kota }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Provinsi</label>
                    <p class="mt-1 text-gray-900">{{ $presale->provinsi }}</p>
                </div>
            </div>
        </x-ui.card>

        <!-- Data Spouse Card -->
        @if($presale->spouse)
        <x-ui.card>
            <h3 class="text-lg font-semibold mb-4">Data Pasangan</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">NIK</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->nik }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->nama_lengkap }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->tempat_lahir }}, {{ $presale->spouse->tanggal_lahir->format('d F Y') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->jenis_kelamin }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Golongan Darah</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->golongan_darah ?: '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Agama</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->agama }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Status Perkawinan</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->status_perkawinan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Pekerjaan</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->pekerjaan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Kewarganegaraan</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->kewarganegaraan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Berlaku Hingga</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->berlaku_hingga }}</p>
                </div>
            </div>

            <h3 class="text-lg font-semibold mb-4">Alamat</h3>

            <div class="grid grid-cols-1 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Alamat Lengkap</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->alamat }}</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">RT/RW</label>
                        <p class="mt-1 text-gray-900">{{ $presale->spouse->rt }}/{{ $presale->spouse->rw }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kelurahan/Desa</label>
                        <p class="mt-1 text-gray-900">{{ $presale->spouse->kelurahan }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kecamatan</label>
                        <p class="mt-1 text-gray-900">{{ $presale->spouse->kecamatan }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kabupaten/Kota</label>
                        <p class="mt-1 text-gray-900">{{ $presale->spouse->kabupaten_kota }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Provinsi</label>
                    <p class="mt-1 text-gray-900">{{ $presale->spouse->provinsi }}</p>
                </div>
            </div>
        </x-ui.card>
        @endif
    </div>
</x-layout.layout>