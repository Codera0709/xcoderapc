@props([
    'name' => '',
    'id' => '',
    'value' => '',
    'options' => [], // ['value' => 'label'] or [['value' => 'x', 'label' => 'y']]
    'placeholder' => 'Select an option',
    'label' => '',
    'helper' => '',
    'required' => false,
    'disabled' => false,
    'error' => '',
    'multiple' => false,
])

@php
    $inputId = $id ?: $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?: ($errors->has($name) ? $errors->first($name) : '');

    $baseClasses = 'block w-full rounded-lg border transition-colors duration-200 focus:ring-2 focus:ring-offset-0 dark:bg-gray-800 dark:text-white';

    $sizeClasses = match($attributes->get('size', 'md')) {
        'sm' => 'px-3 py-1.5 text-sm',
        'lg' => 'px-4 py-3 text-base',
        default => 'px-4 py-2 text-sm',
    };

    $stateClasses = $hasError
        ? 'border-red-500 focus:border-red-500 focus:ring-red-500 dark:border-red-500'
        : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:focus:border-indigo-500';
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <select
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        id="{{ $inputId }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $multiple ? 'multiple' : '' }}
        {{ $attributes->merge(['class' => $baseClasses . ' ' . $sizeClasses . ' ' . $stateClasses]) }}
    >
        @if(!$multiple && $placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $key => $option)
            @if(is_array($option))
                <option
                    value="{{ $option['value'] }}"
                    {{ old($name, $value) == $option['value'] ? 'selected' : '' }}
                    {{ isset($option['disabled']) && $option['disabled'] ? 'disabled' : '' }}
                >
                    {{ $option['label'] }}
                </option>
            @else
                <option
                    value="{{ $key }}"
                    {{ old($name, $value) == $key ? 'selected' : '' }}
                >
                    {{ $option }}
                </option>
            @endif
        @endforeach

        {{ $slot }}
    </select>

    @if($helper && !$hasError)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $helper }}</p>
    @endif

    @if($hasError)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errorMessage }}</p>
    @endif
</div>
