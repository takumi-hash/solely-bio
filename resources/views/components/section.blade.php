@props(['value'])

<div {{ $attributes->merge(['class' => 'py-8 px-4']) }}>
    {{ $value ?? $slot }}
</div>