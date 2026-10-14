@if($slot == "pending")
    <span {{ $attributes->merge(['class' => 'bg-amber-100 text-amber-700']) }}>
        {{ $slot }}
    </span>
@elseif($slot == "approved")
    <span {{ $attributes->merge(['class' => 'bg-emerald-200 text-emerald-700']) }}>
        {{ $slot }}
    </span>
@else
    <span {{ $attributes->merge(['class' => 'bg-red-200 text-red-700']) }}>
        {{ $slot }}
    </span>
@endif
