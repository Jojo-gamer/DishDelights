<x-app-layout title="About Us">
    <div class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-10">
            <section class="overflow-hidden rounded-3xl bg-slate-900 px-6 py-12 text-white shadow-xl sm:px-12 lg:flex lg:items-center lg:justify-between lg:gap-12">
                <div class="grid max-w-2xl gap-5">
                    <span class="w-fit rounded-full bg-emerald-400/15 px-3 py-1 text-sm font-semibold text-emerald-300">
                        Welkom bij DishDelights
                    </span>
                    <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">
                        Recepten delen wordt samen koken.
                    </h1>
                    <p class="text-base leading-7 text-slate-300 sm:text-lg">
                        DishDelights is een plek om lekkere recepten te ontdekken, te bewaren en met anderen te delen.
                        Van een snelle doordeweekse maaltijd tot een uitgebreid favoriet gerecht.
                    </p>
                </div>
                <div class="mt-8 hidden shrink-0 text-emerald-400 lg:mt-0 lg:block" aria-hidden="true">
                    <img src="{{ asset('storage/logo.png') }}" alt="DishDelights" class="block h-56 w-auto fill-current text-gray-800 dark:text-gray-200">
                </div>
            </section>

            <section class="grid gap-6 md:grid-cols-3">
                <div class="grid gap-3 rounded-2xl bg-white p-6 shadow-lg ring-1 ring-slate-200">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <span class="text-xl font-bold">01</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900">Ontdek</h2>
                    <p class="text-sm leading-6 text-slate-600">
                        Zoek inspiratie tussen recepten van andere thuiskoks en vind iets dat bij jouw moment past.
                    </p>
                </div>
                <div class="grid gap-3 rounded-2xl bg-white p-6 shadow-lg ring-1 ring-slate-200">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <span class="text-xl font-bold">02</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900">Maak</h2>
                    <p class="text-sm leading-6 text-slate-600">
                        Volg duidelijke stappen en maak van verse ingrediënten een gerecht waar je trots op bent.
                    </p>
                </div>
                <div class="grid gap-3 rounded-2xl bg-white p-6 shadow-lg ring-1 ring-slate-200">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <span class="text-xl font-bold">03</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900">Deel</h2>
                    <p class="text-sm leading-6 text-slate-600">
                        Upload je eigen creaties en help anderen met jouw favoriete smaakcombinaties.
                    </p>
                </div>
            </section>

            <section class="grid gap-8 rounded-3xl bg-white p-6 shadow-lg ring-1 ring-slate-200 sm:p-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                <div class="grid gap-4">
                    <span class="text-sm font-semibold uppercase tracking-wider text-emerald-600">Het verhaal achter de site</span>
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900">Een leerproject met ruimte om te groeien.</h2>
                    <p class="leading-7 text-slate-600">
                        DishDelights begon als schoolopdracht om met Laravel te leren werken. Tijdens het bouwen ontstond
                        ook het plezier om een eigen receptenplatform steeds verder uit te werken.
                    </p>
                    <p class="leading-7 text-slate-600">
                        Ik ben Joah, CMGT-student aan de Hogeschool Rotterdam. Met dit project combineer ik mijn interesse
                        in development met mijn liefde voor creatieve, lekkere ideeën.
                    </p>
                </div>
                <div class="grid gap-4 rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-100">
                    <h3 class="font-bold text-slate-900">Waar we voor staan</h3>
                    <div class="grid gap-4 text-sm text-slate-600">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 text-lg text-emerald-600">✓</span>
                            <span>Toegankelijke recepten voor ieder niveau.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 text-lg text-emerald-600">✓</span>
                            <span>Een community waarin inspiratie centraal staat.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 text-lg text-emerald-600">✓</span>
                            <span>Blijven leren, verbeteren en nieuwe smaken ontdekken.</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
