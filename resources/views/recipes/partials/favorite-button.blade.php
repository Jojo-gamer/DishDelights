@auth
    <form
        action="{{ route('recipes.favorite', $recipe) }}"
        method="POST"
        class="absolute right-3 top-3 z-10"
    >
        @csrf
        <button
            type="submit"
            aria-label="{{ auth()->user()->hasFavorited($recipe) ? 'Verwijder uit favorieten' : 'Voeg toe aan favorieten' }}"
            aria-pressed="{{ auth()->user()->hasFavorited($recipe) ? 'true' : 'false' }}"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-white/70 bg-slate-900/35 text-white shadow-lg backdrop-blur-sm transition hover:scale-105 hover:bg-slate-900/45"
        >
            <svg
                viewBox="0 0 24 24"
                class="h-5 w-5 {{ auth()->user()->hasFavorited($recipe) ? 'fill-rose-500 text-rose-500' : 'fill-none stroke-current text-white' }}"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </button>
    </form>
@endauth
