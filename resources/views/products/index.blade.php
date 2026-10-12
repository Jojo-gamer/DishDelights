<x-app-layout>
    <h1>index van products</h1>

    <?php for($i = 1 ; $i <= 5; $i++) : ?>
    <a href="{{route('products.show', $i)}}">product {{$i}}</a>
    <?php endfor ?>
</x-app-layout>
