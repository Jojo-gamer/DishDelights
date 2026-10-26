@props([
    'submitText',
    'page' => ''
])

<div>
    <x-input-label for="name" :value="__('Name')"/>
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                  :value="old('name', $recipe->name ?? '')" autofocus/>
    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
</div>

<div>
    <x-input-label for="description" :value="__('Description')"/>
    <textarea id="description" name="description" rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-300 dark:text-black"
    >{{ old('description', $recipe->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
</div>

<div>
    <x-input-label for="prep_time" :value="__('Preparation time (minutes)')"/>
    <x-text-input id="prep_time" name="prep_time" type="number" min="1"
                  class="mt-1 block w-full" :value="old('prep_time', $recipe->prep_time ?? '')"/>
    <x-input-error :messages="$errors->get('prep_time')" class="mt-2"/>
</div>

@include('recipes.partials.ingredients-form')

<div class="grid gap-1">
    <x-input-label for="categories" :value="__('Categories')" />

    <div class="grid gap-3 rounded-xl border border-gray-300 bg-gray-50 p-1">
        <select
            id="categories"
            multiple
            class="block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-300 dark:text-black"
        >
            <option value="" disabled>-- Kies een categorie --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" class="p-0.5">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div>
    <x-input-label for="instructions" :value="__('Instructions')"/>
    <textarea id="instructions" name="instructions" rows="8"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-300 dark:text-black"
    >{{ old('instructions', $recipe->instructions ?? '') }}</textarea>
    <x-form-instructions>Zet elke stap op een nieuwe regel.</x-form-instructions>
    <x-input-error :messages="$errors->get('instructions')" class="mt-2"/>
</div>

<div>
    <x-input-label for="image" :value="__('Image')"/>
    @isset($recipe->image_path)
        <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="{{ $recipe->name }}" class="max-h-40">
    @endisset
    <x-text-input id="image" name="image" type="file"
                  accept="image/*" class="mt-1 block w-full"/>
    @if($page === "edit")
        <x-form-instructions>Laat leeg om de huidige afbeelding te behouden.</x-form-instructions>
    @endif
    <x-input-error :messages="$errors->get('image')" class="mt-2"/>
</div>

<div class="flex justify-end">
    <x-primary-button>{{ $submitText }}</x-primary-button>
</div>
