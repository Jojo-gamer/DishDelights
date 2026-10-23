@props([
    'username',
    'profilePicture'
])
@unless($profilePicture == null || $profilePicture == "")
    <div class="h-12 w-12 overflow-hidden rounded-full bg-gray-200">
            <img
                src="{{ asset('storage/' . $profilePicture) }}"
                alt="{{ $username }}"
                class="h-full w-full object-cover"
            >
    </div>
@else
    <div
        class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-600 text-lg font-bold text-white">
        {{ strtoupper(substr($username, 0, 1)) }}
    </div>
@endunless
<div>
    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Gemaakt door</p>
    <p class="font-semibold text-slate-900">{{ $slot }}</p>
</div>
