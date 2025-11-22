<x-layout.layout>
    <x-slot name="title">Edit Booking Unit - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center gap-4">
            <x-ui.button variant="ghost" href="{{ route('booking-units.index') }}" size="sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </x-ui.button>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Booking Unit</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Edit form di bawah untuk memperbarui booking unit</p>
            </div>
        </div>

        <x-ui.card>
            <form method="POST" action="{{ route('booking-units.update', $bookingUnit) }}">
                @csrf
                @method('PUT')

                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-lg font-semibold mb-4">Data Pribadi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <!-- NIK -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK *</label>
                            <input type="text" name="nik" value="{{ old('nik', $bookingUnit->nik) }}" maxlength="16" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nik') border-red-500 @enderror">
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $bookingUnit->nama_lengkap) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama_lengkap') border-red-500 @enderror">
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tempat Lahir *</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $bookingUnit->tempat_lahir) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tempat_lahir') border-red-500 @enderror">
                            @error('tempat_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $bookingUnit->tanggal_lahir) }}" required
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
                                <option value="Laki-laki" {{ old('jenis_kelamin', $bookingUnit->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $bookingUnit->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                                <option value="A" {{ old('golongan_darah', $bookingUnit->golongan_darah) === 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah', $bookingUnit->golongan_darah) === 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah', $bookingUnit->golongan_darah) === 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah', $bookingUnit->golongan_darah) === 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>

                        <!-- Agama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Agama *</label>
                            <select name="agama" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('agama') border-red-500 @enderror">
                                <option value="">Pilih</option>
                                <option value="Islam" {{ old('agama', $bookingUnit->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $bookingUnit->agama) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama', $bookingUnit->agama) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $bookingUnit->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $bookingUnit->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama', $bookingUnit->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
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
                                <option value="Belum Kawin" {{ old('status_perkawinan', $bookingUnit->status_perkawinan) === 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan', $bookingUnit->status_perkawinan) === 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan', $bookingUnit->status_perkawinan) === 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan', $bookingUnit->status_perkawinan) === 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pekerjaan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pekerjaan *</label>
                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $bookingUnit->pekerjaan) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pekerjaan') border-red-500 @enderror">
                            @error('pekerjaan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kewarganegaraan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kewarganegaraan *</label>
                            <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $bookingUnit->kewarganegaraan) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kewarganegaraan') border-red-500 @enderror">
                            @error('kewarganegaraan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Berlaku Hingga -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Berlaku Hingga *</label>
                            <input type="text" name="berlaku_hingga" value="{{ old('berlaku_hingga', $bookingUnit->berlaku_hingga) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('berlaku_hingga') border-red-500 @enderror">
                            @error('berlaku_hingga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $bookingUnit->no_hp) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('no_hp') border-red-500 @enderror">
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $bookingUnit->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                            @error('email')
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
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('alamat') border-red-500 @enderror">{{ old('alamat', $bookingUnit->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- RT -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RT *</label>
                                <input type="text" name="rt" value="{{ old('rt', $bookingUnit->rt) }}" maxlength="3" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('rt') border-red-500 @enderror">
                                @error('rt')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- RW -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RW *</label>
                                <input type="text" name="rw" value="{{ old('rw', $bookingUnit->rw) }}" maxlength="3" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('rw') border-red-500 @enderror">
                                @error('rw')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kelurahan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa *</label>
                                <input type="text" name="kelurahan" value="{{ old('kelurahan', $bookingUnit->kelurahan) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kelurahan') border-red-500 @enderror">
                                @error('kelurahan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kecamatan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kecamatan *</label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan', $bookingUnit->kecamatan) }}" required
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
                                <input type="text" name="kabupaten_kota" value="{{ old('kabupaten_kota', $bookingUnit->kabupaten_kota) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kabupaten_kota') border-red-500 @enderror">
                                @error('kabupaten_kota')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Provinsi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Provinsi *</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', $bookingUnit->provinsi) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('provinsi') border-red-500 @enderror">
                                @error('provinsi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mb-4">Detail Booking Unit</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <!-- Jenis Unit -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Unit *</label>
                            <input type="text" name="jenis_unit" value="{{ old('jenis_unit', $bookingUnit->jenis_unit) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jenis_unit') border-red-500 @enderror">
                            @error('jenis_unit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi Unit -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lokasi Unit *</label>
                            <input type="text" name="lokasi_unit" value="{{ old('lokasi_unit', $bookingUnit->lokasi_unit) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('lokasi_unit') border-red-500 @enderror">
                            @error('lokasi_unit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga Unit -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Harga Unit *</label>
                            <input type="number" name="harga_unit" value="{{ old('harga_unit', $bookingUnit->harga_unit) }}" step="0.01" min="0" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('harga_unit') border-red-500 @enderror">
                            @error('harga_unit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Booking -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Booking *</label>
                            <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking', $bookingUnit->tanggal_booking) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_booking') border-red-500 @enderror">
                            @error('tanggal_booking')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Pembayaran DP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pembayaran DP</label>
                            <input type="date" name="tanggal_pembayaran_dp" value="{{ old('tanggal_pembayaran_dp', $bookingUnit->tanggal_pembayaran_dp) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_pembayaran_dp') border-red-500 @enderror">
                            @error('tanggal_pembayaran_dp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah DP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah DP</label>
                            <input type="number" name="jumlah_dp" value="{{ old('jumlah_dp', $bookingUnit->jumlah_dp) }}" step="0.01" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jumlah_dp') border-red-500 @enderror">
                            @error('jumlah_dp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Booking -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Booking *</label>
                            <select name="status_booking" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status_booking') border-red-500 @enderror">
                                <option value="pending" {{ old('status_booking', $bookingUnit->status_booking) === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status_booking', $bookingUnit->status_booking) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ old('status_booking', $bookingUnit->status_booking) === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status_booking', $bookingUnit->status_booking) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status_booking')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catatan</label>
                            <textarea name="catatan" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('catatan') border-red-500 @enderror">{{ old('catatan', $bookingUnit->catatan) }}</textarea>
                            @error('catatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-ui.button type="submit" variant="primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Booking
                        </x-ui.button>
                        <x-ui.button variant="outline" href="{{ route('booking-units.index') }}">
                            Batal
                        </x-ui.button>
                    </div>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-layout.layout>