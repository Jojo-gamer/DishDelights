@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm dark:text-gray-500']) }}>
    {{ $value ?? $slot }}
</label>
