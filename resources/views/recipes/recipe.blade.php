<x-app-layout title="{{ $recipe->name }}">
    <div class="bg-slate-200 px-4 py-12 sm:px-6 lg:px-8">
        <article class="mx-auto max-w-5xl overflow-hidden rounded-3xl bg-white shadow-lg">
            <div class="aspect-[16/9] w-full bg-slate-100 sm:aspect-[2/1]">
                <img
                    src="{{ asset('storage/' . $recipe->image_path) }}"
                    alt="{{ $recipe->name }}"
                    class="h-full w-full object-cover"
                >
            </div>

            <div class="p-6 sm:p-10">
                <div
                    class="flex flex-col gap-4 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                        {{ $recipe->name }}
                    </h1>

                    <div class="shrink-0 rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-800">
                        {{ $recipe->prep_time }} min voorbereiding
                    </div>
                </div>

                <div class="flex justify-between items-center border-b border-slate-200 py-3">
                    <div class="flex items-center gap-3 ">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-600 text-lg font-bold text-white">
                            {{ strtoupper(substr($recipe->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Gemaakt door</p>
                            <p class="font-semibold text-slate-900">{{ $recipe->user->name }}</p>
                        </div>
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
                        <p class="text-base leading-7 text-slate-600">{{ $recipe->description }}</p>

{{--                        ingredients--}}
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
            </div>
        </article>
    </div>
</x-app-layout>
