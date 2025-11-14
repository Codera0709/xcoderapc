@props([
    'name' => '',
    'id' => '',
    'value' => '1',
    'checked' => false,
    'label' => '',
    'description' => '',
    'disabled' => false,
    'size' => 'md', // sm, md, lg
])

@php
    $inputId = $id ?: $name;
    $isChecked = old($name) !== null ? (bool) old($name) : $checked;

    $switchSize = match($size) {
        'sm' => [
            'wrapper' => 'w-9 h-5',
            'toggle' => 'w-4 h-4',
            'translate' => 'translate-x-4'
        ],
        'lg' => [
            'wrapper' => 'w-14 h-7',
            'toggle' => 'w-6 h-6',
            'translate' => 'translate-x-7'
        ],
        default => [
            'wrapper' => 'w-11 h-6',
            'toggle' => 'w-5 h-5',
            'translate' => 'translate-x-5'
        ],
    };
@endphp

<div class="flex items-start" x-data="{ enabled: {{ $isChecked ? 'true' : 'false' }} }">
    <button
        type="button"
        @click="enabled = !enabled"
        {{ $disabled ? 'disabled' : '' }}
        :class="{ 'bg-indigo-600': enabled, 'bg-gray-200 dark:bg-gray-700': !enabled }"
        class="relative inline-flex {{ $switchSize['wrapper'] }} flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
        role="switch"
        :aria-checked="enabled.toString()"
    >
        <span class="sr-only">{{ $label ?: 'Toggle' }}</span>
        <span
            :class="{ '{{ $switchSize['translate'] }}': enabled, 'translate-x-0': !enabled }"
            class="pointer-events-none inline-block {{ $switchSize['toggle'] }} transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
        ></span>
    </button>

    <!-- Hidden input for form submission -->
    <input
        type="hidden"
        name="{{ $name }}"
        :value="enabled ? '{{ $value }}' : '0'"
    />

    @if($label || $description)
        <div class="ml-3 flex-1">
            @if($label)
                <label
                    @click="if (!{{ $disabled ? 'true' : 'false' }}) enabled = !enabled"
                    class="text-sm font-medium text-gray-900 dark:text-gray-100 {{ $disabled ? 'cursor-not-allowed opacity-50' : 'cursor-pointer' }}"
                >
                    {{ $label }}
                </label>
            @endif

            @if($description)
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
            @endif
        </div>
    @endif
</div>
