<x-app-layout title="Admin">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-6">
            <div class="flex justify-between align-center">
                <div class="grid gap-2">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900">Pending recipes</h2>
                    <p class="text-sm text-slate-600">Beheer hier de ingezonden recepten.</p>
                </div>

                @include('recipes.partials.create-recipe-button')
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Upload datum</th>
                            <th scope="col" class="px-6 py-4">Recept</th>
                            <th scope="col" class="px-6 py-4">User</th>
                            <th scope="col" class="px-6 py-4"></th>
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
                                <td class="whitespace-nowrap px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <a
                                            href=""
                                        >
                                            {{ $recipe->created_at->format('d-m-Y') }}
                                        </a>
                                    </div>
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
                                <td class="min-w-72 px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        @isset($recipe->user)
                                            <x-recipe-profile username="{{ $recipe->user->name }}" profilePicture="{{ $recipe->user->image_path }}">
                                                {{ $recipe->user->name }}
                                            </x-recipe-profile>
                                        @else
                                            <x-recipe-profile username="?">
                                                Onbekende gebruiker
                                            </x-recipe-profile>
                                        @endempty
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <form method="POST" action="{{ route('admin.approve', $recipe->id) }}"
                                              onsubmit="return confirm('Weet je zeker dat je dit wilt goedkeuren?');">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                type="submit"
                                                class="rounded-lg bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            >
                                                Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reject', $recipe->id) }}"
                                              onsubmit="return confirm('Weet je zeker dat je dit wilt afwijzen?');">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                type="submit"
                                                class="rounded-lg bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            >
                                                Reject
                                            </button>
                                        </form>
                                    </div>
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
