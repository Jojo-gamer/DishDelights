<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-6">
            <div class="flex justify-between align-center">
                <div class="grid gap-2">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900">Mijn uploads</h2>
                    <p class="text-sm text-slate-600">Beheer hier je ingezonden recepten.</p>
                </div>

                @include('recipes.partials.create-recipe-button')
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Recept</th>
                            <th scope="col" class="px-6 py-4">Bewerken</th>
                            <th scope="col" class="px-6 py-4">Actief</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                        @forelse($recipes as $recipe)
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-6 py-5">
                                    <x-status-pill
                                        class="inline-flex rounded-full px-3 py-1 text-xs font-semibold capitalize">
                                        {{ $recipe->status }}
                                    </x-status-pill>
                                </td>
                                <td class="min-w-72 px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <img
                                            src="{{ asset('storage/' . $recipe->image_path) }}"
                                            alt="{{ $recipe->name }}"
                                            class="h-14 w-20 rounded-lg object-cover ring-1 ring-slate-200"
                                        >
                                        <a
                                            href="{{ route('recipes.show', $recipe->id) }}"
                                            class="font-semibold text-slate-900 transition hover:text-emerald-600"
                                        >
                                            {{ $recipe->name }}
                                        </a>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <a
                                            href="{{ route('recipes.edit', $recipe->id) }}"
                                            class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2"
                                        >
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}"
                                              onsubmit="return confirm('Weet je zeker dat je dit wilt verwijderen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="rounded-lg bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-5">
                                    <form method="POST" action="{{ route('recipes.active', $recipe->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <label class="relative inline-flex cursor-pointer items-center">
                                            <input
                                                type="checkbox"
                                                name="is_active"
                                                class="peer sr-only"
{{--                                                value="1"--}}
                                                @checked($recipe->is_active)
                                                onchange="this.form.submit()"
                                            >
                                            <span
                                                class="h-6 w-11 rounded-full bg-slate-300 transition peer-checked:bg-emerald-500 peer-focus:ring-2 peer-focus:ring-emerald-500 peer-focus:ring-offset-2"></span>
                                            <span
                                                class="absolute left-1 h-4 w-4 rounded-full bg-white shadow-sm transition peer-checked:translate-x-5"></span>
                                        </label>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm text-slate-500">
                                    Je hebt nog geen recepten geüpload.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
