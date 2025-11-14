@props([
    'name' => '',
    'id' => '',
    'value' => '',
    'placeholder' => '',
    'label' => '',
    'helper' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => '',
    'rows' => 4,
    'maxlength' => null,
    'showCount' => false,
])

@php
    $inputId = $id ?: $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?: ($errors->has($name) ? $errors->first($name) : '');

    $baseClasses = 'block w-full rounded-lg border transition-colors duration-200 focus:ring-2 focus:ring-offset-0 resize-y dark:bg-gray-800 dark:text-white';

    $sizeClasses = match($attributes->get('size', 'md')) {
        'sm' => 'px-3 py-1.5 text-sm',
        'lg' => 'px-4 py-3 text-base',
        default => 'px-4 py-2 text-sm',
    };

    $stateClasses = $hasError
        ? 'border-red-500 focus:border-red-500 focus:ring-red-500 dark:border-red-500'
        : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:focus:border-indigo-500';

    $alpineData = $showCount && $maxlength
        ? "{ count: " . strlen(old($name, $value)) . " }"
        : null;
@endphp

<div class="w-full" {{ $alpineData ? 'x-data="' . $alpineData . '"' : '' }}>
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $inputId }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $maxlength ? 'maxlength=' . $maxlength : '' }}
        {{ $showCount && $maxlength ? '@input="count = $el.value.length"' : '' }}
        {{ $attributes->merge(['class' => $baseClasses . ' ' . $sizeClasses . ' ' . $stateClasses]) }}
    >{{ old($name, $value) }}</textarea>

    <div class="flex items-center justify-between mt-1">
        <div class="flex-1">
            @if($helper && !$hasError)
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $helper }}</p>
            @endif

            @if($hasError)
                <p class="text-sm text-red-600 dark:text-red-400">{{ $errorMessage }}</p>
            @endif
        </div>

        @if($showCount && $maxlength)
            <p class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                <span x-text="count"></span> / {{ $maxlength }}
            </p>
        @endif
    </div>
</div>
