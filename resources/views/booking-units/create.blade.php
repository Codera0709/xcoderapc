<x-layout.layout>
    <x-slot name="title">Booking Unit - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center gap-4">
            <x-ui.button variant="ghost" href="{{ route('booking-units.index') }}" size="sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </x-ui.button>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Booking Unit</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Isi form di bawah untuk melakukan booking unit</p>
            </div>
        </div>

        <x-ui.card>
            <form method="POST" action="{{ route('booking-units.store') }}" id="bookingForm">
                @csrf

                <!-- Search Existing Data -->
                <div class="mb-6">
                    <div class="flex items-center gap-2 mb-2">
                        <h3 class="text-lg font-semibold">Cari Data dari Pra-Sales</h3>
                        <span class="text-sm text-gray-500">(Opsional)</span>
                    </div>
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari NIK atau Nama dari Pra-Sales..." 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <div id="searchResults" class="absolute z-10 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-lg max-h-60 overflow-auto hidden">
                            <!-- Search results will appear here -->
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Ketik minimal 3 karakter untuk mencari data dari Pra-Sales. Jika data ditemukan, klik untuk mengisi form otomatis.</p>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-lg font-semibold mb-4">Data Pribadi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <!-- NIK -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK *</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" maxlength="16" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nik') border-red-500 @enderror">
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama_lengkap') border-red-500 @enderror">
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tempat Lahir *</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tempat_lahir') border-red-500 @enderror">
                            @error('tempat_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_lahir') border-red-500 @enderror">
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin *</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jenis_kelamin') border-red-500 @enderror">
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Golongan Darah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                            <select name="golongan_darah" id="golongan_darah"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih</option>
                                <option value="A" {{ old('golongan_darah') === 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah') === 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah') === 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah') === 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>

                        <!-- Agama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Agama *</label>
                            <select name="agama" id="agama" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('agama') border-red-500 @enderror">
                                <option value="">Pilih</option>
                                <option value="Islam" {{ old('agama') === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Perkawinan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Perkawinan *</label>
                            <select name="status_perkawinan" id="status_perkawinan" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status_perkawinan') border-red-500 @enderror">
                                <option value="">Pilih</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Kawin">Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pekerjaan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pekerjaan *</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pekerjaan') border-red-500 @enderror">
                            @error('pekerjaan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kewarganegaraan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kewarganegaraan *</label>
                            <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="{{ old('kewarganegaraan', 'WNI') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kewarganegaraan') border-red-500 @enderror">
                            @error('kewarganegaraan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Berlaku Hingga -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Berlaku Hingga *</label>
                            <input type="text" name="berlaku_hingga" id="berlaku_hingga" value="{{ old('berlaku_hingga', 'SEUMUR HIDUP') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('berlaku_hingga') border-red-500 @enderror">
                            @error('berlaku_hingga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No HP</label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('no_hp') border-red-500 @enderror">
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
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
                            <textarea name="alamat" id="alamat" rows="2" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- RT -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RT *</label>
                                <input type="text" name="rt" id="rt" value="{{ old('rt') }}" maxlength="3" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('rt') border-red-500 @enderror">
                                @error('rt')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- RW -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RW *</label>
                                <input type="text" name="rw" id="rw" value="{{ old('rw') }}" maxlength="3" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('rw') border-red-500 @enderror">
                                @error('rw')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kelurahan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa *</label>
                                <input type="text" name="kelurahan" id="kelurahan" value="{{ old('kelurahan') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kelurahan') border-red-500 @enderror">
                                @error('kelurahan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kecamatan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kecamatan *</label>
                                <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}" required
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
                                <input type="text" name="kabupaten_kota" id="kabupaten_kota" value="{{ old('kabupaten_kota') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kabupaten_kota') border-red-500 @enderror">
                                @error('kabupaten_kota')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Provinsi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Provinsi *</label>
                                <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi') }}" required
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
                            <input type="text" name="jenis_unit" value="{{ old('jenis_unit') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jenis_unit') border-red-500 @enderror">
                            @error('jenis_unit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi Unit -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lokasi Unit *</label>
                            <input type="text" name="lokasi_unit" value="{{ old('lokasi_unit') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('lokasi_unit') border-red-500 @enderror">
                            @error('lokasi_unit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga Unit -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Harga Unit *</label>
                            <input type="number" name="harga_unit" value="{{ old('harga_unit') }}" step="0.01" min="0" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('harga_unit') border-red-500 @enderror">
                            @error('harga_unit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Booking -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Booking *</label>
                            <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking', date('Y-m-d')) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_booking') border-red-500 @enderror">
                            @error('tanggal_booking')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Pembayaran DP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pembayaran DP</label>
                            <input type="date" name="tanggal_pembayaran_dp" value="{{ old('tanggal_pembayaran_dp') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_pembayaran_dp') border-red-500 @enderror">
                            @error('tanggal_pembayaran_dp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah DP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah DP</label>
                            <input type="number" name="jumlah_dp" value="{{ old('jumlah_dp') }}" step="0.01" min="0"
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
                                <option value="pending" {{ old('status_booking') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status_booking') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ old('status_booking') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status_booking') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status_booking')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catatan</label>
                            <textarea name="catatan" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('catatan') border-red-500 @enderror">{{ old('catatan') }}</textarea>
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
                            Simpan Booking
                        </x-ui.button>
                        <x-ui.button variant="outline" href="{{ route('booking-units.index') }}">
                            Batal
                        </x-ui.button>
                    </div>
                </div>
            </form>
        </x-ui.card>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            
            // Debounce function to limit API calls
            let debounceTimer;
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                const query = this.value.trim();
                
                if (query.length < 3) {
                    searchResults.classList.add('hidden');
                    return;
                }
                
                debounceTimer = setTimeout(() => {
                    searchPersons(query);
                }, 300); // Wait 300ms after user stops typing
            });
            
            async function searchPersons(query) {
                try {
                    const response = await fetch(`{{ route('booking-units.search.person') }}?query=${encodeURIComponent(query)}`);
                    const persons = await response.json();
                    
                    if (persons.length === 0) {
                        searchResults.innerHTML = '<div class="p-2 text-gray-500 text-center">Data tidak ditemukan</div>';
                        searchResults.classList.remove('hidden');
                        return;
                    }
                    
                    let html = '';
                    persons.forEach(person => {
                        html += `
                            <div class="p-3 border-b border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 search-result-item" 
                                data-person='${JSON.stringify(person)}'>
                                <div class="font-medium">${person.nama_lengkap}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">${person.nik}</div>
                                <div class="text-xs text-gray-500">${person.tempat_lahir}, ${new Date(person.tanggal_lahir).toLocaleDateString()}</div>
                            </div>
                        `;
                    });
                    
                    searchResults.innerHTML = html;
                    searchResults.classList.remove('hidden');
                    
                    // Add click event to each result
                    document.querySelectorAll('.search-result-item').forEach(item => {
                        item.addEventListener('click', function() {
                            const person = JSON.parse(this.getAttribute('data-person'));
                            fillForm(person);
                            searchResults.classList.add('hidden');
                        });
                    });
                } catch (error) {
                    console.error('Error searching persons:', error);
                    searchResults.innerHTML = '<div class="p-2 text-red-500 text-center">Error saat mencari data</div>';
                    searchResults.classList.remove('hidden');
                }
            }
            
            function fillForm(person) {
                // Fill personal data fields
                document.getElementById('nik').value = person.nik || '';
                document.getElementById('nama_lengkap').value = person.nama_lengkap || '';
                document.getElementById('tempat_lahir').value = person.tempat_lahir || '';
                document.getElementById('tanggal_lahir').value = person.tanggal_lahir || '';
                document.getElementById('jenis_kelamin').value = person.jenis_kelamin || '';
                document.getElementById('golongan_darah').value = person.golongan_darah || '';
                document.getElementById('agama').value = person.agama || '';
                document.getElementById('status_perkawinan').value = person.status_perkawinan || '';
                document.getElementById('pekerjaan').value = person.pekerjaan || '';
                document.getElementById('kewarganegaraan').value = person.kewarganegaraan || '';
                document.getElementById('berlaku_hingga').value = person.berlaku_hingga || '';
                
                // Fill address fields
                document.getElementById('alamat').value = person.alamat || '';
                document.getElementById('rt').value = person.rt || '';
                document.getElementById('rw').value = person.rw || '';
                document.getElementById('kelurahan').value = person.kelurahan || '';
                document.getElementById('kecamatan').value = person.kecamatan || '';
                document.getElementById('kabupaten_kota').value = person.kabupaten_kota || '';
                document.getElementById('provinsi').value = person.provinsi || '';
                
                // Scroll to filled form
                document.getElementById('bookingForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            
            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });
        });
    </script>
    @endpush
</x-layout.layout>