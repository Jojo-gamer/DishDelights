@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 text-black bg-gray-100 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm']) }}>
