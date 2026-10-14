@props([
    'profile'
])
<div
    class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-600 text-lg font-bold text-white">
    {{ $profile }}
</div>
<div>
    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Gemaakt door</p>
    <p class="font-semibold text-slate-900">{{ $slot }}</p>
</div>
