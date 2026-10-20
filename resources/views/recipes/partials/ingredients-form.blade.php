<div
    x-data="{
        selected: @js(collect(old('ingredients', []))->map(fn ($id) => (string) $id)->values()),
        selectedNames: @js(collect(old('ingredients', []))->mapWithKeys(fn ($id) => [(string) $id => $ingredients->firstWhere('id', $id)?->name])->filter()),
        newIngredients: [],
        amounts: @js(old('amounts', [])),
        choice: '',
        newName: '',
        newAmount: '',
        addIngredient() {
            if (this.choice === '__new__') {
                this.newName = '';
                return;
            }

            if (this.choice && ! this.selected.includes(this.choice)) {
                this.selected.push(this.choice);
                this.selectedNames[this.choice] = this.$refs.ingredientSelect.selectedOptions[0].text;
                this.amounts[this.choice] = '';
            }

            this.choice = '';
        },
        addNewIngredient() {
            const name = this.newName.trim();

            if (name && ! this.newIngredients.some((ingredient) => ingredient.name === name)) {
                this.newIngredients.push({
                    name: name,
                    amount: this.newAmount
                });
            }

            this.newName = '';
            this.newAmount = '';
            this.choice = '';
        },
        removeIngredient(id) {
            this.selected = this.selected.filter((ingredientId) => ingredientId !== id);
            delete this.selectedNames[id];
            delete this.amounts[id];
        },
        removeNewIngredient(name) {
            this.newIngredients = this.newIngredients.filter((ingredient) => ingredient.name !== name);
        }
    }"
    class="grid gap-4"
>
    <x-input-label for="ingredients" :value="__('Ingredients')" />

    <div class="grid gap-3 rounded-xl border border-gray-300 bg-gray-50 p-1">
        <div class="flex flex-col gap-3 sm:flex-row">
            <select
                id="ingredients"
                x-ref="ingredientSelect"
                x-model="choice"
                @change="addIngredient"
                class="block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-300 dark:text-black"
            >
                <option value="">Kies een ingredient...</option>
                @foreach($ingredients as $ingredient)
                    <option
                        value="{{ $ingredient->id }}"
                        :disabled="selected.includes('{{ $ingredient->id }}')"
                    >
                        {{ $ingredient->name }}
                    </option>
                @endforeach
                <option value="__new__">+ Nieuw ingredient toevoegen</option>
            </select>
        </div>

        <div x-show="choice === '__new__'" x-cloak class="grid gap-2 sm:grid-cols-[minmax(0,1fr)_10rem_auto]">
            <input x-model="newName" @keydown.enter.prevent="addNewIngredient" type="text" placeholder="Nieuw ingredient" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-300 dark:text-black">
            <input x-model="newAmount" type="text" placeholder="Bijv. 200ml" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-300 dark:text-black">
            <button type="button" @click="addNewIngredient" class="inline-flex items-center justify-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                Toevoegen
            </button>
        </div>

        <div x-show="selected.length || newIngredients.length" x-cloak class="flex flex-wrap gap-2">
            <template x-for="id in selected" :key="id">
                <div class="grid w-full gap-2 rounded-lg bg-indigo-50 p-3 sm:grid-cols-[minmax(0,1fr)_10rem_auto] sm:items-center">
                    <span class="text-sm font-medium text-indigo-700" x-text="selectedNames[id]"></span>
                    <input type="hidden" name="ingredients[]" :value="id">
                    <input x-model="amounts[id]" :name="`amounts[${id}]`" type="text" placeholder="Bijv. 200ml" class="w-full rounded-md border-indigo-200 bg-white text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <button type="button" @click="removeIngredient(id)" class="text-left text-sm font-semibold text-indigo-500 transition hover:text-indigo-800 sm:text-center" aria-label="Verwijder ingredient">
                        Verwijder
                    </button>
                </div>
            </template>

            <template x-for="(ingredient, index) in newIngredients" :key="ingredient.name">
                <div class="grid w-full gap-2 rounded-lg bg-emerald-50 p-3 sm:grid-cols-[minmax(0,1fr)_10rem_auto] sm:items-center">
                    <span class="text-sm font-medium text-emerald-700" x-text="ingredient.name"></span>
                    <input type="hidden" name="new_ingredients[]" :value="ingredient.name">
                    <input x-model="ingredient.amount" :name="`new_amounts[${index}]`" type="text" placeholder="Bijv. 200ml" class="w-full rounded-md border-emerald-200 bg-white text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <button type="button" @click="removeNewIngredient(ingredient.name)" class="text-left text-sm font-semibold text-emerald-500 transition hover:text-emerald-800 sm:text-center" aria-label="Verwijder nieuw ingredient">
                        Verwijder
                    </button>
                </div>
            </template>
        </div>
    </div>

    <x-form-instructions>Kies een bestaand ingredient of voeg een nieuwe naam toe.</x-form-instructions>
    <x-input-error :messages="$errors->get('ingredients')" class="mt-2" />
</div>
