<x-app-layout title="Contact">
    <div class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-10">
            <section class="grid gap-4 text-center">
                <span class="text-sm font-semibold uppercase tracking-wider text-emerald-600">Neem contact op</span>
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">We horen graag van je.</h1>
                <p class="mx-auto max-w-2xl text-base leading-7 text-slate-600">
                    Heb je een vraag, een goed idee of feedback over een recept? Stuur gerust een bericht.
                    We helpen je graag verder.
                </p>
            </section>

            <section class="grid gap-6 lg:grid-cols-[0.8fr_1.2fr]">
                <div class="grid gap-5 rounded-3xl bg-slate-900 p-6 text-white shadow-xl sm:p-8">
                    <div class="grid gap-2">
                        <h2 class="text-2xl font-bold">Contactgegevens</h2>
                        <p class="text-sm leading-6 text-slate-300">
                            Kies de manier die het beste bij je vraag past.
                        </p>
                    </div>
                    <div class="grid gap-4">
                        <a href="mailto:email@gmail.com" class="flex items-center gap-4 rounded-2xl bg-white/10 p-4 transition hover:bg-white/15">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/20 text-emerald-300">✉</span>
                            <span class="grid gap-1">
                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">E-mail</span>
                                <span class="font-medium">email@gmail.com</span>
                            </span>
                        </a>
                        <a href="tel:+31612345678" class="flex items-center gap-4 rounded-2xl bg-white/10 p-4 transition hover:bg-white/15">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/20 text-emerald-300">☎</span>
                            <span class="grid gap-1">
                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Telefoon</span>
                                <span class="font-medium">06 12345678</span>
                            </span>
                        </a>
                    </div>
                    <p class="border-t border-white/10 pt-5 text-sm leading-6 text-slate-400">
                        Voor vragen over een recept kun je ook direct de maker ervan aanspreken.
                    </p>
                </div>

                <div class="grid gap-6 rounded-3xl bg-white p-6 shadow-lg ring-1 ring-slate-200 sm:p-8">
                    <div class="grid gap-2">
                        <h2 class="text-2xl font-bold text-slate-900">Waar kunnen we mee helpen?</h2>
                        <p class="text-sm leading-6 text-slate-600">
                            Een paar voorbeelden van onderwerpen waarover je contact kunt opnemen.
                        </p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2 rounded-2xl bg-slate-50 p-5">
                            <h3 class="font-bold text-slate-900">Feedback</h3>
                            <p class="text-sm leading-6 text-slate-600">Laat weten hoe we DishDelights nog beter kunnen maken.</p>
                        </div>
                        <div class="grid gap-2 rounded-2xl bg-slate-50 p-5">
                            <h3 class="font-bold text-slate-900">Recepten</h3>
                            <p class="text-sm leading-6 text-slate-600">Heb je hulp nodig bij het uploaden of aanpassen van een recept?</p>
                        </div>
                        <div class="grid gap-2 rounded-2xl bg-slate-50 p-5">
                            <h3 class="font-bold text-slate-900">Samenwerken</h3>
                            <p class="text-sm leading-6 text-slate-600">Een idee voor een nieuwe functie of een leuke samenwerking?</p>
                        </div>
                        <div class="grid gap-2 rounded-2xl bg-slate-50 p-5">
                            <h3 class="font-bold text-slate-900">Overig</h3>
                            <p class="text-sm leading-6 text-slate-600">Ook met andere vragen ben je van harte welkom.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
