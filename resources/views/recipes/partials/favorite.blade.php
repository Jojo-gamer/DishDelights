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
            <x-favorite-button :state="auth()->user()->hasFavorited($recipe)"/>
        </button>
    </form>
@endauth
