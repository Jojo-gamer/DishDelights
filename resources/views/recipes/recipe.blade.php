<x-app-layout title="{{ $recipe->name }}">
    <div class="bg-slate-200 px-4 py-12 sm:px-6 lg:px-8">
        <article class="mx-auto max-w-5xl overflow-hidden rounded-3xl bg-white shadow-lg">
            <div class="relative aspect-[16/9] w-full bg-slate-100 sm:aspect-[2/1]">
                <img
                    src="{{ asset('storage/' . $recipe->image_path) }}"
                    alt="{{ $recipe->name }}"
                    class="h-full w-full object-cover"
                >
                @include('recipes.partials.favorite')
            </div>

            <div class="p-6 sm:p-10">
                <div
                    class="flex flex-col gap-4 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                        {{ $recipe->name }}
                    </h1>

                    <div
                        x-data
                        @wheel.prevent="$el.scrollLeft += $event.deltaY"
                        class="category-scrollbar flex max-w-80 h-14 shrink-0 scroll-smooth items-center gap-2 self-center overflow-x-auto overscroll-x-contain px-1"
                    >
                        @foreach($recipe->categories as $category)
                            <a href="{{ route('recipes.index', ['f' => $category->id]) }}"
                               class="shrink-0 whitespace-nowrap rounded-xl bg-gray-800 border border-gray-700 px-3 py-1 text-sm font-medium text-gray-300">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>

                    <div class="shrink-0 rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-800">
                        {{ $recipe->prep_time }} min voorbereiding
                    </div>
                </div>

                <div class="flex justify-between items-center border-b border-slate-200 py-3">
                    <div class="flex items-center gap-3 ">
                        @isset($recipe->user)
                            <x-user-profile username="{{ $recipe->user->name }}"
                                            profilePicture="{{ $recipe->user->image_path }}">
                                {{ $recipe->user->name }} @if($recipe->user->is(auth()->user()))
                                    (Ik)
                                @endif
                            </x-user-profile>
                        @else
                            <x-user-profile username="?">
                                Onbekende gebruiker
                            </x-user-profile>
                        @endempty
                    </div>
                    <div class="self-start rounded-2xl bg-slate-100 px-5 py-3">
                        <p class="text-sm font-medium text-slate-500">Gepubliceerd op</p>
                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $recipe->created_at->format('d-m-Y') }}
                        </p>
                    </div>
                </div>


                <div class="grid gap-10 py-8 lg:grid-cols-[minmax(0,1fr)_22rem]">
                    <div class="min-w-0">
                        <h2 class="mb-3 text-2xl font-bold text-slate-900">Over dit recept</h2>
                        <p class="pb-5 text-base leading-7 text-slate-600">{{ $recipe->description }}</p>

                        <h2 class="mb-4 text-2xl font-bold text-slate-900">Ingrediënten</h2>
                        <ol class="grid gap-3">
                            @foreach($recipe->ingredients as $ingredient)
                                <li class="flex gap-3 text-slate-600">
                                        <span
                                            class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-sm font-bold text-emerald-800">
                                            {{ $loop->iteration }}
                                        </span>
                                    <span
                                        class="pt-1 leading-6">{{ $ingredient->name }}, {{ $ingredient->pivot->amount }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div>
                        <h2 class="mb-4 text-2xl font-bold text-slate-900">Bereidingswijze</h2>
                        <ol class="grid gap-3">
                            @foreach($recipe->instructions as $instruction)
                                <li class="flex gap-3 text-slate-600">
                                        <span
                                            class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-sm font-bold text-emerald-800">
                                            {{ $loop->iteration }}
                                        </span>
                                    <span class="pt-1 leading-6">{{ $instruction }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>

                </div>

                <div class="grid gap-5 border-t border-slate-200 pt-8">
                    <div class="grid gap-1">
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900">Comments</h2>
                        <p class="text-sm text-slate-500">Lees wat anderen van dit recept vinden.</p>
                    </div>

                    @forelse($recipe->comments as $comment)
                        <article
                            class="flex gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 shadow-sm transition hover:border-emerald-300 hover:shadow-md">
                            <div
                                class="flex flex-col justify-center gap-2 border-r border-slate-200 pr-3 text-xs text-slate-500">
                                <span
                                    class="flex w-fit shrink-0 items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-800">
                                    <span
                                        class="relative inline-block leading-none"
                                        role="img"
                                        aria-label="{{ $comment->rating / 2 }} van 5 sterren"
                                    >
                                        <span class="text-slate-300">★★★★★</span>
                                        <span
                                            class="absolute inset-y-0 left-0 overflow-hidden whitespace-nowrap text-amber-400"
                                            style="width: {{ $comment->rating * 10 }}%;"
                                        >★★★★★</span>
                                    </span>
                                    <span>{{ $comment->rating / 2 }} / 5</span>
                                </span>
                                <div class="flex justify-center gap-2">
                                    @isset($comment->user)
                                        <x-user-profile username="{{ $comment->user->name }}"
                                                        profilePicture="{{ $comment->user->image_path }}">
                                            {{ $comment->user->name }} @if($comment->user->is(auth()->user()))
                                                (Ik)
                                            @endif
                                        </x-user-profile>
                                    @else
                                        <x-user-profile username="?">
                                            Onbekende gebruiker
                                        </x-user-profile>
                                    @endempty
                                </div>
                            </div>
                            <div class="flex min-w-0 flex-1 flex-col justify-center gap-2">
                                <h3 class="text-lg font-semibold text-emerald-700">
                                    {{ $comment->title }}
                                </h3>
                                <p class="text-sm leading-7 text-slate-600">
                                    {{ $comment->content }}
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <time
                                    datetime="{{ $comment->created_at->toDateString() }}"
                                    class="shrink-0 text-xs font-medium text-slate-400"
                                >
                                    {{ $comment->created_at->format('d M') }}
                                </time>
                                @can('delete', $comment)
                                    <form method="post"
                                          action="{{ route('comments.destroy', [$recipe, $comment]) }}"
                                          onsubmit="return confirm('Weet je zeker dat je dit wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            aria-label="Comment verwijderen"
                                            title="Comment verwijderen"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                aria-hidden="true"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                      d="M6 7h12m-9 0V5.5A1.5 1.5 0 0 1 10.5 4h3A1.5 1.5 0 0 1 15 5.5V7m-7 0 .75 12.25A1.75 1.75 0 0 0 10.5 21h3a1.75 1.75 0 0 0 1.75-1.75L16 7m-6 4v6m4-6v6"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </article>
                    @empty
                        <div
                            class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-5 py-8 text-center">
                            <p class="text-sm text-slate-500">Er zijn nog geen comments bij dit recept.</p>
                        </div>
                    @endforelse


                    <form method="POST" action="{{ route('comments.store', $recipe) }}"
                          class="grid gap-5 rounded-2xl border border-slate-200 bg-slate-50 p-5 shadow-sm sm:p-6">
                        @csrf
                        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 pb-4">
                            <div class="grid gap-1">
                                <h3 class="text-lg font-semibold text-slate-900">Laat een comment achter</h3>
                                <p class="text-sm text-slate-500">Deel je ervaring met dit recept.</p>
                            </div>
                            <div class="flex gap-2 items-center">
                                <x-input-label for="rating" :value="__('Rating')" class="text-xl"/>
                                <div>
                                    <x-text-input id="rating" name="rating" type="number" class="w-20"
                                                  :value="old('rating', '')"/>
                                    <span>/10</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid gap-4">
                            <div>
                                <x-input-label for="title" :value="__('Titel')"/>
                                <x-text-input
                                    id="title"
                                    name="title"
                                    type="text"
                                    class="mt-1 block w-full shadow-sm transition placeholder:text-gray-400"
                                    :value="old('title', '')"
                                    placeholder="Bijv. Heerlijk en makkelijk!"
                                />
                                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="content" :value="__('Comment')"/>
                                <textarea
                                    id="content"
                                    name="content"
                                    rows="4"
                                    placeholder="Vertel wat je van dit recept vond..."
                                    class="mt-1 block w-full resize-y rounded-md bg-gray-100 border-gray-300 shadow-sm transition placeholder:text-gray-400 focus:border-emerald-500 focus:ring-emerald-500"
                                >{{ old('content', '') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 active:bg-emerald-800"
                            >
                                Comment plaatsen
                                <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </article>
    </div>
</x-app-layout>
