@props([
    'name' => '',
    'id' => '',
    'label' => '',
    'helper' => '',
    'required' => false,
    'disabled' => false,
    'error' => '',
    'accept' => '',
    'multiple' => false,
    'showPreview' => false, // Show image preview
    'maxSize' => null, // in MB
])

@php
    $inputId = $id ?: $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?: ($errors->has($name) ? $errors->first($name) : '');
@endphp

<div
    class="w-full"
    x-data="{
        fileName: '',
        fileSize: '',
        preview: null,
        handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.fileName = file.name;
                this.fileSize = this.formatFileSize(file.size);

                {{ $showPreview ? "
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.preview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.preview = null;
                }
                " : '' }}
            } else {
                this.reset();
            }
        },
        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        },
        reset() {
            this.fileName = '';
            this.fileSize = '';
            this.preview = null;
        },
        removeFile() {
            this.reset();
            document.getElementById('{{ $inputId }}').value = '';
        }
    }"
>
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="mt-1">
        <label
            for="{{ $inputId }}"
            class="flex items-center justify-center w-full px-4 py-6 border-2 border-dashed rounded-lg cursor-pointer transition-colors duration-200
                {{ $hasError ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-600' }}
                hover:border-indigo-500 dark:hover:border-indigo-500 bg-white dark:bg-gray-800
                {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
        >
            <div class="space-y-2 text-center">
                <!-- Icon -->
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-medium text-indigo-600 dark:text-indigo-400">Click to upload</span>
                    <span> or drag and drop</span>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400">
                    @if($accept)
                        {{ strtoupper(str_replace(['.', 'image/', 'application/'], '', $accept)) }}
                    @else
                        Any file type
                    @endif
                    @if($maxSize)
                        (Max {{ $maxSize }}MB)
                    @endif
                </p>
            </div>

            <input
                type="file"
                name="{{ $name }}{{ $multiple ? '[]' : '' }}"
                id="{{ $inputId }}"
                class="sr-only"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $accept ? 'accept=' . $accept : '' }}
                {{ $multiple ? 'multiple' : '' }}
                @change="handleFileChange($event)"
            />
        </label>

        <!-- File Info -->
        <div x-show="fileName" x-cloak class="mt-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="fileName"></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="fileSize"></p>
                    </div>
                </div>

                <button
                    type="button"
                    @click="removeFile()"
                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Image Preview -->
        @if($showPreview)
            <div x-show="preview" x-cloak class="mt-3">
                <img :src="preview" class="h-32 w-32 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-700" alt="Preview" />
            </div>
        @endif
    </div>

    @if($helper && !$hasError)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $helper }}</p>
    @endif

    @if($hasError)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errorMessage }}</p>
    @endif
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
