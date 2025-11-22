@props(['role'])

@php
$colors = [
    'SuperAdmin' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
    'Admin' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
    'Employee' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
    'Public' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
    'Guest' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
];

$colorClass = $colors[$role] ?? 'bg-gray-100 text-gray-800';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {$colorClass}"]) }}>
    {{ $role }}
</span>
