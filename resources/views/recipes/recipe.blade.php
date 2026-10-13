<x-app-layout title="{{ $recipe['name'] }}">
    <h2>{{ $recipe['name'] }}</h2>
    <p>instructies</p>
    <ul>
        @foreach($recipe['instructions'] as $instruction)
        <li>{{ $instruction }}</li>
        @endforeach
    </ul>
    <p>GEPOST DOOR {{ $user->name }}</p>
</x-app-layout>
