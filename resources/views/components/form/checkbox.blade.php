@props([
    'name' => '',
    'id' => '',
    'value' => '1',
    'checked' => false,
    'label' => '',
    'description' => '',
    'required' => false,
    'disabled' => false,
    'error' => '',
])

@php
    $inputId = $id ?: $name;
    $isChecked = old($name) !== null ? (bool) old($name) : $checked;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?: ($errors->has($name) ? $errors->first($name) : '');

    $baseClasses = 'rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:ring-offset-gray-900 transition-colors duration-200';

    $sizeClasses = match($attributes->get('size', 'md')) {
        'sm' => 'h-4 w-4',
        'lg' => 'h-6 w-6',
        default => 'h-5 w-5',
    };

    $stateClasses = $hasError
        ? 'border-red-500 focus:border-red-500 focus:ring-red-500 dark:border-red-500'
        : '';
@endphp

<div class="w-full">
    <div class="flex items-start">
        <div class="flex items-center h-5">
            <input
                type="checkbox"
                name="{{ $name }}"
                id="{{ $inputId }}"
                value="{{ $value }}"
                {{ $isChecked ? 'checked' : '' }}
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->merge(['class' => $baseClasses . ' ' . $sizeClasses . ' ' . $stateClasses]) }}
            />
        </div>

        @if($label || $description)
            <div class="ml-3 flex-1">
                @if($label)
                    <label for="{{ $inputId }}" class="text-sm font-medium text-gray-900 dark:text-gray-100 {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}">
                        {{ $label }}
                        @if($required)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>
                @endif

                @if($description)
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
                @endif
            </div>
        @endif
    </div>

    @if($hasError)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errorMessage }}</p>
    @endif
</div>
