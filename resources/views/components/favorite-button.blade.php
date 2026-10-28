@props([
    "state" => false,
])
<svg
    viewBox="0 0 24 24"
    class="h-5 w-5 {{ $state ? 'fill-rose-500 text-rose-500' : 'fill-none stroke-current' }}"
    aria-hidden="true"
    xmlns="http://www.w3.org/2000/svg"
>
    <path
        d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"
        stroke-width="1.8"
        stroke-linecap="round"
        stroke-linejoin="round"
    />
</svg>
