<x-app-layout title="Recipes">
    <div class="bg-slate-200 px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <h1 class="mb-8 text-3xl font-bold text-slate-900">Recepten</h1>
{{--            <x-slot name="header">--}}
{{--                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--                    {{ __('Recepten') }}--}}
{{--                </h2>--}}
{{--            </x-slot>--}}

            @isset($recipes)
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($recipes as $recipe)
                        <a
                            href="{{ route('recipes.show', $recipe['id']) }}"
                            class="flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-md transition hover:-translate-y-1 hover:shadow-xl"
                        >
                            <div class="aspect-video w-full bg-slate-100">
                                <img
                                    src=""
                                    alt="{{ $recipe['name'] }}"
                                    class="h-full w-full object-cover"
                                >
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <h3 class="text-xl font-bold text-slate-900">{{ $recipe['name'] }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $recipe['description'] }}</p>
                                <span class="mt-auto pt-6 text-sm font-semibold text-emerald-600">
                                    {{ $recipe['prep-time'] }} min
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endisset
            @empty($recipes)
                <p class="text-slate-600">Geen recepten beschikbaar.</p>
            @endempty
        </div>
    </div>
</x-app-layout>
