<x-layout.layout>
    <x-slot name="title">Data Pra-Sales - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Data Pra-Sales</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola Data Pra-Sales Indonesia</p>
            </div>
            <x-ui.button variant="primary" href="{{ route('presales.create') }}">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Data Pra-Sales
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

            <form method="GET" action="{{ route('presales.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cari (NIK/Nama)</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Cari NIK atau Nama">
                    </div>

                    <!-- Date From -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Date To -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex gap-2">
                    <x-ui.button type="submit" variant="primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter
                    </x-ui.button>
                    <x-ui.button variant="outline" href="{{ route('presales.index') }}">
                        Reset
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>

        <!-- Table -->
        <x-ui.card>
            <div class="mb-4 flex gap-2">
                <form id="bulkDeleteForm" method="POST" action="{{ route('presales.bulk-delete') }}" class="inline">
                    @csrf
                    <input type="hidden" name="ids" id="deleteIds">
                    <x-ui.button type="submit" id="bulkDeleteBtn" variant="danger" disabled>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Terpilih
                    </x-ui.button>
                </form>

                <form id="bulkExportForm" method="POST" action="{{ route('presales.bulk-export') }}" class="inline">
                    @csrf
                    <input type="hidden" name="ids" id="exportIds">
                    <x-ui.button type="submit" id="bulkExportBtn" variant="success" disabled>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export ke CSV
                    </x-ui.button>
                </form>
            </div>

            <form id="checkboxForm">

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left">
                                            <input type="checkbox" id="selectAll" class="rounded">
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tempat, Tgl Lahir</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($persons as $presale)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <input type="checkbox" name="ids[]" value="{{ $presale->id }}" class="row-checkbox rounded">
                                            </td>
                                            <td class="px-6 py-4 text-sm">{{ $presale->nik }}</td>
                                            <td class="px-6 py-4 text-sm">{{ $presale->nama_lengkap }}</td>
                                            <td class="px-6 py-4 text-sm">{{ $presale->tempat_lahir }}, {{ $presale->tanggal_lahir->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 text-sm">
                                                <span class="px-2 py-1 text-xs rounded-full {{ $presale->status_perkawinan === 'Kawin' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $presale->status_perkawinan }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm space-x-2 flex items-center">
                                                <a href="{{ route('presales.show', $presale) }}" class="text-blue-600 hover:text-blue-800" title="Lihat">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('presales.edit', $presale) }}" class="text-yellow-600 hover:text-yellow-800 ml-2" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('presales.destroy', $presale) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </table>
                    </div>
                </form>

                <div class="mt-4">
                    {{ $persons->links() }}
                </div>
        </x-ui.card>
    </div>

    @push('scripts')
    <script>
        // Select All Checkbox
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            toggleBulkButtons();
        });

        // Individual Checkbox
        document.querySelectorAll('.row-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', toggleBulkButtons);
        });

        function toggleBulkButtons() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const bulkExportBtn = document.getElementById('bulkExportBtn');
            const isDisabled = checkedBoxes.length === 0;

            bulkDeleteBtn.disabled = isDisabled;
            bulkExportBtn.disabled = isDisabled;

            // Update hidden inputs with selected IDs
            if (!isDisabled) {
                const ids = Array.from(checkedBoxes).map(cb => cb.value);
                document.getElementById('deleteIds').value = JSON.stringify(ids);
                document.getElementById('exportIds').value = JSON.stringify(ids);
            }
        }

        // Bulk Delete Confirmation
        document.getElementById('bulkDeleteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            if (confirm(`Yakin ingin menghapus ${checkedBoxes.length} data?`)) {
                // Collect IDs
                const ids = Array.from(checkedBoxes).map(cb => cb.value);

                // Create form data
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                ids.forEach(id => formData.append('ids[]', id));

                // Submit
                fetch('{{ route("presales.bulk-delete") }}', {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    window.location.reload();
                });
            }
        });

        // Bulk Export
        document.getElementById('bulkExportForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');

            // Collect IDs
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            // Create form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("presales.bulk-export") }}';

            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            // Add IDs
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            // Submit
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        });
    </script>
    @endpush
</x-layout.layout>
