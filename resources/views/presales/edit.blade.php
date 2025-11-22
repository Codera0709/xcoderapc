<x-layout.layout>
    <x-slot name="title">Edit Data Pra-Sales - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center gap-4">
            <x-ui.button variant="ghost" href="{{ route('presales.index') }}" size="sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </x-ui.button>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Data Pra-Sales</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Update Data Pra-Sales {{ $presale->nama_lengkap }}</p>
            </div>
        </div>

        <x-ui.card>
                    <form method="POST" action="{{ route('presales.update', $presale) }}">
                        @csrf
                        @method('PUT')

                        <h3 class="text-lg font-semibold mb-4">Data Pribadi</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <!-- NIK -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIK *</label>
                                <input type="text" name="nik" value="{{ old('nik', $presale->nik) }}" maxlength="16" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nik') border-red-500 @enderror">
                                @error('nik')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $presale->nama_lengkap) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama_lengkap') border-red-500 @enderror">
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tempat Lahir *</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $presale->tempat_lahir) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tempat_lahir') border-red-500 @enderror">
                                @error('tempat_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir *</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $presale->tanggal_lahir->format('Y-m-d')) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_lahir') border-red-500 @enderror">
                                @error('tanggal_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jenis_kelamin') border-red-500 @enderror">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $presale->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $presale->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Golongan Darah -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                                <select name="golongan_darah"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Pilih</option>
                                    <option value="A" {{ old('golongan_darah', $presale->golongan_darah) === 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('golongan_darah', $presale->golongan_darah) === 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('golongan_darah', $presale->golongan_darah) === 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('golongan_darah', $presale->golongan_darah) === 'O' ? 'selected' : '' }}>O</option>
                                </select>
                            </div>

                            <!-- Agama -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Agama *</label>
                                <select name="agama" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('agama') border-red-500 @enderror">
                                    <option value="">Pilih</option>
                                    <option value="Islam" {{ old('agama', $presale->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $presale->agama) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $presale->agama) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $presale->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $presale->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $presale->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Perkawinan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status Perkawinan *</label>
                                <select name="status_perkawinan" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status_perkawinan') border-red-500 @enderror">
                                    <option value="">Pilih</option>
                                    <option value="Belum Kawin" {{ old('status_perkawinan', $presale->status_perkawinan) === 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_perkawinan', $presale->status_perkawinan) === 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('status_perkawinan', $presale->status_perkawinan) === 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('status_perkawinan', $presale->status_perkawinan) === 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('status_perkawinan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pekerjaan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pekerjaan *</label>
                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $presale->pekerjaan) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pekerjaan') border-red-500 @enderror">
                                @error('pekerjaan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kewarganegaraan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kewarganegaraan *</label>
                                <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $presale->kewarganegaraan) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kewarganegaraan') border-red-500 @enderror">
                                @error('kewarganegaraan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Berlaku Hingga -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Berlaku Hingga *</label>
                                <input type="text" name="berlaku_hingga" value="{{ old('berlaku_hingga', $presale->berlaku_hingga) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('berlaku_hingga') border-red-500 @enderror">
                                @error('berlaku_hingga')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <h3 class="text-lg font-semibold mb-4">Alamat</h3>
                        
                        <div class="grid grid-cols-1 gap-4 mb-6">
                            <!-- Alamat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alamat Lengkap *</label>
                                <textarea name="alamat" rows="2" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('alamat') border-red-500 @enderror">{{ old('alamat', $presale->alamat) }}</textarea>
                                @error('alamat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <!-- RT -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">RT *</label>
                                    <input type="text" name="rt" value="{{ old('rt', $presale->rt) }}" maxlength="3" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('rt') border-red-500 @enderror">
                                    @error('rt')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- RW -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">RW *</label>
                                    <input type="text" name="rw" value="{{ old('rw', $presale->rw) }}" maxlength="3" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('rw') border-red-500 @enderror">
                                    @error('rw')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kelurahan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa *</label>
                                    <input type="text" name="kelurahan" value="{{ old('kelurahan', $presale->kelurahan) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kelurahan') border-red-500 @enderror">
                                    @error('kelurahan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kecamatan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kecamatan *</label>
                                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $presale->kecamatan) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kecamatan') border-red-500 @enderror">
                                    @error('kecamatan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Kabupaten/Kota -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota *</label>
                                    <input type="text" name="kabupaten_kota" value="{{ old('kabupaten_kota', $presale->kabupaten_kota) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kabupaten_kota') border-red-500 @enderror">
                                    @error('kabupaten_kota')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Provinsi -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Provinsi *</label>
                                    <input type="text" name="provinsi" value="{{ old('provinsi', $presale->provinsi) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('provinsi') border-red-500 @enderror">
                                    @error('provinsi')
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
                        Update
                    </x-ui.button>
                    <x-ui.button variant="outline" href="{{ route('presales.index') }}">
                        Batal
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-layout.layout>
