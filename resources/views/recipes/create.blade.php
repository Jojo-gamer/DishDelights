<x-app-layout title="create">
    <div class="bg-slate-200 px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl rounded-2xl bg-white p-6 shadow-md sm:p-8">
            <h1 class="mb-8 text-3xl font-bold text-slate-900">Recept toevoegen</h1>

            <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data" class="grid gap-6">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name')"  autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-300 dark:text-black"
                        >{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="prep_time" :value="__('Preparation time (minutes)')" />
                    <x-text-input id="prep_time" name="prep_time" type="number" min="1"
                        class="mt-1 block w-full" :value="old('prep_time')" />
                    <x-input-error :messages="$errors->get('prep_time')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="instructions" :value="__('Instructions')" />
                    <textarea id="instructions" name="instructions" rows="8"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-300 dark:text-black"
                        >{{ old('instructions') }}</textarea>
                    <p class="mt-1 text-sm text-slate-500">Zet elke stap op een nieuwe regel.</p>
                    <x-input-error :messages="$errors->get('instructions')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="image_path" :value="__('Image')" />
                    <x-text-input id="image" name="image" type="file"
                        accept="image/*" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button>Recept opslaan</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
