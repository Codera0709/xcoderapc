<x-layout.layout>
    <x-slot name="title">Edit Data Spouse - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center gap-4">
            <x-ui.button variant="ghost" href="{{ route('presales.index') }}" size="sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </x-ui.button>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Data Spouse</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Edit form di bawah untuk memperbarui data spouse untuk {{ $person->nama_lengkap }}</p>
            </div>
        </div>

        <x-ui.card>
            <form method="POST" action="{{ route('spouses.update', $person->id) }}">
                @csrf
                @method('PUT')

                <h3 class="text-lg font-semibold mb-4">Data Spouse</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded">
                    <!-- NIK Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIK Spouse *</label>
                        <input type="text" name="spouse_nik" value="{{ old('spouse_nik', $person->spouse->nik) }}" maxlength="16" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_nik') border-red-500 @enderror">
                        @error('spouse_nik')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap Spouse *</label>
                        <input type="text" name="spouse_nama_lengkap" value="{{ old('spouse_nama_lengkap', $person->spouse->nama_lengkap) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_nama_lengkap') border-red-500 @enderror">
                        @error('spouse_nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tempat Lahir Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tempat Lahir Spouse *</label>
                        <input type="text" name="spouse_tempat_lahir" value="{{ old('spouse_tempat_lahir', $person->spouse->tempat_lahir) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_tempat_lahir') border-red-500 @enderror">
                        @error('spouse_tempat_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir Spouse *</label>
                        <input type="date" name="spouse_tanggal_lahir" value="{{ old('spouse_tanggal_lahir', $person->spouse->tanggal_lahir) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_tanggal_lahir') border-red-500 @enderror">
                        @error('spouse_tanggal_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin Spouse *</label>
                        <select name="spouse_jenis_kelamin" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_jenis_kelamin') border-red-500 @enderror">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('spouse_jenis_kelamin', $person->spouse->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('spouse_jenis_kelamin', $person->spouse->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('spouse_jenis_kelamin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Golongan Darah Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Golongan Darah Spouse</label>
                        <select name="spouse_golongan_darah"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih</option>
                            <option value="A" {{ old('spouse_golongan_darah', $person->spouse->golongan_darah) === 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('spouse_golongan_darah', $person->spouse->golongan_darah) === 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('spouse_golongan_darah', $person->spouse->golongan_darah) === 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('spouse_golongan_darah', $person->spouse->golongan_darah) === 'O' ? 'selected' : '' }}>O</option>
                        </select>
                    </div>

                    <!-- Agama Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Agama Spouse *</label>
                        <select name="spouse_agama" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_agama') border-red-500 @enderror">
                            <option value="">Pilih</option>
                            <option value="Islam" {{ old('spouse_agama', $person->spouse->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('spouse_agama', $person->spouse->agama) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('spouse_agama', $person->spouse->agama) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('spouse_agama', $person->spouse->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('spouse_agama', $person->spouse->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('spouse_agama', $person->spouse->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('spouse_agama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pekerjaan Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pekerjaan Spouse *</label>
                        <input type="text" name="spouse_pekerjaan" value="{{ old('spouse_pekerjaan', $person->spouse->pekerjaan) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_pekerjaan') border-red-500 @enderror">
                        @error('spouse_pekerjaan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kewarganegaraan Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kewarganegaraan Spouse *</label>
                        <input type="text" name="spouse_kewarganegaraan" value="{{ old('spouse_kewarganegaraan', $person->spouse->kewarganegaraan) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_kewarganegaraan') border-red-500 @enderror">
                        @error('spouse_kewarganegaraan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Berlaku Hingga Spouse -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Berlaku Hingga Spouse *</label>
                        <input type="text" name="spouse_berlaku_hingga" value="{{ old('spouse_berlaku_hingga', $person->spouse->berlaku_hingga) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_berlaku_hingga') border-red-500 @enderror">
                        @error('spouse_berlaku_hingga')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Spouse -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Alamat Lengkap Spouse *</label>
                        <textarea name="spouse_alamat" rows="2" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_alamat') border-red-500 @enderror">{{ old('spouse_alamat', $person->spouse->alamat) }}</textarea>
                        @error('spouse_alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- RT Spouse -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">RT Spouse *</label>
                            <input type="text" name="spouse_rt" value="{{ old('spouse_rt', $person->spouse->rt) }}" maxlength="3" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_rt') border-red-500 @enderror">
                            @error('spouse_rt')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- RW Spouse -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">RW Spouse *</label>
                            <input type="text" name="spouse_rw" value="{{ old('spouse_rw', $person->spouse->rw) }}" maxlength="3" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_rw') border-red-500 @enderror">
                            @error('spouse_rw')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kelurahan Spouse -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa Spouse *</label>
                            <input type="text" name="spouse_kelurahan" value="{{ old('spouse_kelurahan', $person->spouse->kelurahan) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_kelurahan') border-red-500 @enderror">
                            @error('spouse_kelurahan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kecamatan Spouse -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kecamatan Spouse *</label>
                            <input type="text" name="spouse_kecamatan" value="{{ old('spouse_kecamatan', $person->spouse->kecamatan) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_kecamatan') border-red-500 @enderror">
                            @error('spouse_kecamatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Kabupaten/Kota Spouse -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota Spouse *</label>
                            <input type="text" name="spouse_kabupaten_kota" value="{{ old('spouse_kabupaten_kota', $person->spouse->kabupaten_kota) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_kabupaten_kota') border-red-500 @enderror">
                            @error('spouse_kabupaten_kota')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provinsi Spouse -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi Spouse *</label>
                            <input type="text" name="spouse_provinsi" value="{{ old('spouse_provinsi', $person->spouse->provinsi) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spouse_provinsi') border-red-500 @enderror">
                            @error('spouse_provinsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <x-ui.button type="submit" variant="primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Spouse
                    </x-ui.button>
                    <x-ui.button variant="outline" href="{{ route('presales.index') }}">
                        Batal
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-layout.layout>