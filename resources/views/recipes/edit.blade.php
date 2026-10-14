<x-app-layout title="Edit">
    <div class="bg-slate-200 px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl rounded-2xl bg-white p-6 shadow-md sm:p-8">
            <h1 class="mb-8 text-3xl font-bold text-slate-900">Recept bewerken</h1>

            <form method="POST" action="{{ route('recipes.update', $recipe) }}" enctype="multipart/form-data" class="grid gap-6">
                @csrf
                @method('PATCH')

                @include('recipes.partials.form', ['submitText' => 'Bewerking opslaan'])
            </form>
        </div>
    </div>
</x-app-layout>
