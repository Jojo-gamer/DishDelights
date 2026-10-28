<form method="get" action="{{ route('recipes.index') }}" class="flex gap-2">
    <button
        name="fav"
        value="{{ request('fav') ? '0' : '1'}}"
        type="submit"
        class="flex h-11 w-11 items-center justify-center rounded-full border border-white bg-white text-black shadow-lg backdrop-blur-sm transition hover:scale-105 hover:bg-white/15">
        <x-favorite-button state="{{ request('fav') }}"/>
    </button>
    <select
        id="f"
        name="f"
        class="category-select block w-28 rounded-md border-gray-300 bg-white p-0 pl-2 text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
    >
        <option value="" class="p-2">- NONE -</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                    @selected($category->id == request('f'))
                    class="pl-3 py-0.5">{{ $category->name }}
            </option>
        @endforeach
    </select>
    <input name="q" type="search" placeholder="Zoek op naam/omschrijving" value="{{ request('q') }}" class="w-80">
    <x-secondary-button type="submit">Zoek</x-secondary-button>
</form>
