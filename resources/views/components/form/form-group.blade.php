@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'helper' => '',
    'error' => '',
    'horizontal' => false, // Horizontal layout (label on left, input on right)
])

@php
    $hasError = $error || ($name && $errors->has($name));
    $errorMessage = $error ?: ($name && $errors->has($name) ? $errors->first($name) : '');
@endphp

<div {{ $attributes->merge(['class' => 'form-group ' . ($horizontal ? 'sm:flex sm:items-start sm:gap-4' : '')]) }}>
    @if($label)
        <div class="{{ $horizontal ? 'sm:w-1/4 sm:pt-2' : 'mb-1' }}">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ $label }}
                @if($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>
        </div>
    @endif

    <div class="{{ $horizontal ? 'sm:w-3/4' : 'w-full' }}">
        {{ $slot }}

        @if($helper && !$hasError)
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $helper }}</p>
        @endif

        @if($hasError)
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errorMessage }}</p>
        @endif
    </div>
</div>
