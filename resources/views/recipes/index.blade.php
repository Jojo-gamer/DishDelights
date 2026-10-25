<x-app-layout title="Recipes">
    <div class="bg-slate-200 px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex justify-between align-center mb-12">
                <h1 class="text-3xl font-bold text-slate-900">Recepten</h1>
                @include('recipes.partials.search-form')
                @include('recipes.partials.create-recipe-button')
            </div>

            @if($recipes->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($recipes as $recipe)
                        <a
                            href="{{ route('recipes.show', $recipe->id) }}"
                            class="flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-md transition hover:-translate-y-1 hover:shadow-xl"
                        >
                            <div class="h-60 w-full bg-slate-100">
                                <img
                                    src="{{asset('storage/' . $recipe->image_path)}}"
                                    alt="{{ $recipe->name }}"
                                    class="h-full w-full object-cover"
                                >
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <h3 class="text-xl font-bold text-slate-900">{{ $recipe->name }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $recipe->description }}</p>
                                <span class="mt-auto pt-6 text-sm font-semibold text-emerald-600">
                                    {{ $recipe->prep_time }} min
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-slate-600">Geen recepten beschikbaar.</p>
            @endif
        </div>
    </div>
</x-app-layout>
