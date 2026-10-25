<form method="get" action="{{ route('recipes.index') }}">
    <input name="q" type="search" placeholder="Zoek op naam/omschrijving" class="w-80">
    <x-secondary-button type="submit">Zoek</x-secondary-button>
</form>
