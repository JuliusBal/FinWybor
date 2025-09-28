<header class="relative z-40">
    <div class="bg-brand-900/95 supports-[backdrop-filter]:bg-brand-900/80 supports-[backdrop-filter]:backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="h-16 flex items-center justify-between">
                {{-- Logo --}}
                <a href="{{ url('/') }}" aria-label="FinWybor" class="group inline-flex items-center gap-2 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-300">
                 <span class="grid h-12 w-12 place-items-center rounded-xl bg-gradient-to-br from-brand-400 to-brand-500 shadow-glow ring-1 ring-white/15 transition-transform group-hover:scale-105">
                   <svg viewBox="0 0 24 24" class="h-7 w-7 text-white" aria-hidden="true">
                     <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                       <circle cx="12" cy="12" r="8.2" opacity=".95"/>
                       <path d="M7 15.5v-2.8M11 15.5v-5M15 15.5v-7"/>
                       <path d="M6.5 12.5l3 3 8-8.5"/>
                     </g>
                   </svg>
                 </span>
                <span class="font-semibold text-white whitespace-nowrap" translate="no">
                   Fin<span class="text-brand-200">Wybor</span><span class="text-brand-400 transition-colors group-hover:text-brand-500">.pl</span>
                 </span>
                </a>

                {{-- Desktop nav --}}
                <nav class="hidden md:flex items-center gap-7 text-sm">
                    <a href="{{ route('offers.loans.landing') }}"
                       class="px-3 py-1.5 rounded-lg transition
       {{ request()->routeIs('offers.loans')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'text-white/90 hover:text-white' }}">
                        Pożyczki
                    </a>

                    <a href="{{ route('offers.cards') }}"
                       class="px-3 py-1.5 rounded-lg transition
       {{ request()->routeIs('offers.cards')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'text-white/90 hover:text-white' }}">
                        Karty
                    </a>

                    <a href="{{ route('offers.insurance') }}"
                       class="px-3 py-1.5 rounded-lg transition
       {{ request()->routeIs('offers.insurance')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'text-white/90 hover:text-white' }}">
                        Ubezpieczenia
                    </a>

                    <a href="{{ route('posts.index') }}"
                       class="px-3 py-1.5 rounded-lg transition
       {{ request()->routeIs('posts.*')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'text-white/90 hover:text-white' }}">
                        Artykuły
                    </a>

                    <a href="{{ route('contact.create') }}"
                       class="px-3 py-1.5 rounded-lg transition
       {{ request()->routeIs('contact.*')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'text-white/90 hover:text-white' }}">
                        Kontakt
                    </a>
                </nav>

                {{-- Burger --}}
                <button id="menuBtn"
                        class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg
                       hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-brand-300"
                        aria-label="Otwórz menu" aria-expanded="false" aria-controls="mobileMenu">
                    <svg id="iconOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                    <svg id="iconClose" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white hidden" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile panel (tamsus fonas) --}}
        <div id="mobileMenu" class="md:hidden hidden border-t border-white/10 bg-brand-900">
            <nav class="max-w-7xl mx-auto px-4 md:px-6 py-4 space-y-1">
                <a href="{{ route('offers.loans') }}"
                   class="block px-3 py-2 rounded-lg transition
       {{ request()->routeIs('offers.loans')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'hover:bg-white/10 text-white/90' }}">
                    Pożyczki
                </a>

                <a href="{{ route('offers.cards') }}"
                   class="block px-3 py-2 rounded-lg transition
       {{ request()->routeIs('offers.cards')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'hover:bg-white/10 text-white/90' }}">
                    Karty
                </a>

                <a href="{{ route('offers.insurance') }}"
                   class="block px-3 py-2 rounded-lg transition
       {{ request()->routeIs('offers.insurance')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'hover:bg-white/10 text-white/90' }}">
                    Ubezpieczenia
                </a>

                <a href="{{ route('posts.index') }}"
                   class="block px-3 py-2 rounded-lg transition
       {{ request()->routeIs('posts.*')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'hover:bg-white/10 text-white/90' }}">
                    Artykuły
                </a>

                <a href="{{ route('contact.create') }}"
                   class="block px-3 py-2 rounded-lg transition
       {{ request()->routeIs('contact.*')
            ? 'bg-brand-400 hover:bg-brand-500 text-white shadow-soft'
            : 'hover:bg-white/10 text-white/90' }}">
                    Kontakt
                </a>
            </nav>

        </div>
    </div>
</header>
