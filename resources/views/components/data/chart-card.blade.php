@props([
    'title' => '',
    'chartId' => 'chart-' . uniqid(),
    'type' => 'line', // line, bar, pie, doughnut, radar, polarArea
    'height' => '300',
    'data' => '{}',
    'options' => '{}',
])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
    @if($title || isset($header))
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            @if(isset($header))
                {{ $header }}
            @else
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
            @endif
        </div>
    @endif

    <div class="p-6">
        <div style="position: relative; height: {{ $height }}px;">
            <canvas id="{{ $chartId }}"></canvas>
        </div>
    </div>

    @if(isset($footer))
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $footer }}
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('{{ $chartId }}');
    if (!ctx) return;

    // Parse data and options
    let chartData = {!! $data !!};
    let chartOptions = {!! $options !!};

    // Check if we're in dark mode
    const isDarkMode = document.documentElement.classList.contains('dark');

    // Default options with dark mode support
    const defaultOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    color: isDarkMode ? '#d1d5db' : '#374151',
                    font: {
                        family: "'Inter', sans-serif"
                    }
                }
            },
            tooltip: {
                backgroundColor: isDarkMode ? '#1f2937' : '#ffffff',
                titleColor: isDarkMode ? '#f3f4f6' : '#111827',
                bodyColor: isDarkMode ? '#d1d5db' : '#374151',
                borderColor: isDarkMode ? '#374151' : '#e5e7eb',
                borderWidth: 1
            }
        },
        scales: {
            x: {
                grid: {
                    color: isDarkMode ? '#374151' : '#e5e7eb'
                },
                ticks: {
                    color: isDarkMode ? '#9ca3af' : '#6b7280'
                }
            },
            y: {
                grid: {
                    color: isDarkMode ? '#374151' : '#e5e7eb'
                },
                ticks: {
                    color: isDarkMode ? '#9ca3af' : '#6b7280'
                }
            }
        }
    };

    // Merge default options with custom options
    const mergedOptions = mergeDeep(defaultOptions, chartOptions);

    // Create chart
    new Chart(ctx, {
        type: '{{ $type }}',
        data: chartData,
        options: mergedOptions
    });

    // Helper function to deep merge objects
    function mergeDeep(target, source) {
        const output = Object.assign({}, target);
        if (isObject(target) && isObject(source)) {
            Object.keys(source).forEach(key => {
                if (isObject(source[key])) {
                    if (!(key in target))
                        Object.assign(output, { [key]: source[key] });
                    else
                        output[key] = mergeDeep(target[key], source[key]);
                } else {
                    Object.assign(output, { [key]: source[key] });
                }
            });
        }
        return output;
    }

    function isObject(item) {
        return item && typeof item === 'object' && !Array.isArray(item);
    }
});
</script>
@endpush
