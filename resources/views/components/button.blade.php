@php
    $class = $class ?? '';
    $slot = $slot ?? '';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type, 'class' => $class]) }}>
        {{ $slot }}
    </button>
@endif