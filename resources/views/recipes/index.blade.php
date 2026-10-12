<x-app-layout title="Recipes">
    <h1>index van recepten</h1>

    @isset($recipes)
        @foreach($recipes as $recipe)
            <a href="{{route('recipes.show', $recipe['id'])}}">{{ $recipe['name'] }}</a>
        @endforeach
    @endisset
    @empty($recipes)
        <p>geen recepten beschikbaar</p>
    @endempty
</x-app-layout>
