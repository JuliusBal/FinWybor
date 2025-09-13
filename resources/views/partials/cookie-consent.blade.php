<div id="cc-banner"
     class="fixed inset-x-0 bottom-0 z-50 hidden"
     role="dialog" aria-modal="true" aria-label="Zgody na pliki cookies">
    <div class="mx-auto max-w-7xl px-4 md:px-6 py-4">
        <div class="rounded-xl bg-white shadow-lg border border-black/10 p-4 md:p-5">
            <div class="md:flex md:items-start md:justify-between md:gap-6">
                <div class="md:flex-1">
                    <div class="font-semibold text-brand-900">Pliki cookies</div>
                    <p class="mt-1 text-sm text-slate-600">
                        Używamy cookies niezbędnych oraz – za Twoją zgodą – analitycznych i afiliacyjnych.
                        Zgody możesz zmienić w każdej chwili. Szczegóły w
                        <a href="{{ route('cookies') }}" class="underline">Plikach cookies</a>
                        i <a href="{{ route('privacy') }}" class="underline">Polityce prywatności</a>.
                    </p>

                    <div id="cc-settings" class="mt-3 hidden">
                        <div class="grid sm:grid-cols-3 gap-2 text-sm">
                            <label class="flex items-start gap-2 rounded-lg border border-black/10 p-3">
                                <input type="checkbox" disabled checked
                                       class="mt-0.5 rounded border-black/20 text-brand-500">
                                <span><strong>Niezbędne</strong> – wymagane do działania serwisu.</span>
                            </label>

                            <label class="flex items-start gap-2 rounded-lg border border-black/10 p-3">
                                <input id="cc-analytics" type="checkbox"
                                       class="mt-0.5 rounded border-black/20 text-brand-500">
                                <span><strong>Analityczne</strong> – pomiar ruchu i ergonomii.</span>
                            </label>

                            <label class="flex items-start gap-2 rounded-lg border border-black/10 p-3">
                                <input id="cc-affiliate" type="checkbox"
                                       class="mt-0.5 rounded border-black/20 text-brand-500">
                                <span><strong>Afiliacyjne</strong> – rozliczenia partnerskie.</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-3 md:mt-0 flex flex-col sm:flex-row gap-2">
                    <button id="cc-toggle"
                            class="px-4 py-2 rounded-lg border border-black/10 bg-white text-brand-900 hover:bg-slate-50">
                        Ustawienia
                    </button>
                    <button id="cc-reject"
                            class="px-4 py-2 rounded-lg border border-black/10 bg-white text-brand-900 hover:bg-slate-50">
                        Odrzuć zbędne
                    </button>
                    <button id="cc-accept"
                            class="px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow-glow">
                        Akceptuj wszystkie
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        const COOKIE_NAME = 'fw_consent_v1';
        const ONE_YEAR = 60*60*24*365;

        function readConsent() {
            const m = document.cookie.match(new RegExp('(?:^|; )' + COOKIE_NAME.replace(/([.$?*|{}()[]\\/+^])/g, '\\$1') + '=([^;]*)'));
            try { return m ? JSON.parse(decodeURIComponent(m[1])) : null; } catch { return null; }
        }
        function writeConsent(obj) {
            const val = encodeURIComponent(JSON.stringify(obj));
            const secure = location.protocol === 'https:' ? '; Secure' : '';
            document.cookie = `fw_consent_v1=${val}; Max-Age=${ONE_YEAR}; Path=/; SameSite=Lax${secure}`;
        }

        function hasConsent(cat) {
            const c = readConsent(); return !!(c && c.categories && c.categories[cat]);
        }

        function applyConsent() {
            document.querySelectorAll('script[type="text/plain"][data-category]').forEach(node => {
                const cat = node.dataset.category;
                if (!hasConsent(cat)) return;

                const s = document.createElement('script');

                // external file? load it async
                if (node.dataset.src) {
                    s.src = node.dataset.src;
                    s.async = true;              // ← ensure non-blocking
                }

                if (node.textContent.trim()) s.text = node.textContent;
                if (node.id) s.id = node.id;

                node.replaceWith(s);
            });

            document.querySelectorAll('iframe[data-category][data-src]').forEach(ifr => {
                const cat = ifr.dataset.category;
                if (!hasConsent(cat)) return;
                ifr.src = ifr.dataset.src;
                ifr.removeAttribute('data-src');
            });
        }

        window.CookieConsent = {
            open: () => {
                document.getElementById('cc-banner')?.classList.remove('hidden');
                document.getElementById('cc-settings')?.classList.remove('hidden');
                const c = readConsent();
                document.getElementById('cc-analytics').checked = !!(c?.categories?.analytics);
                document.getElementById('cc-affiliate').checked = !!(c?.categories?.affiliate);
            },
            has: hasConsent,
        };

        const banner   = document.getElementById('cc-banner');
        const settings = document.getElementById('cc-settings');
        const btnToggle = document.getElementById('cc-toggle');
        const btnAccept = document.getElementById('cc-accept');
        const btnReject = document.getElementById('cc-reject');
        const cbAnalytics = document.getElementById('cc-analytics');
        const cbAffiliate = document.getElementById('cc-affiliate');

        btnToggle?.addEventListener('click', () => settings.classList.toggle('hidden'));

        btnAccept?.addEventListener('click', () => {
            writeConsent({ ts: Date.now(), categories: { analytics: true, affiliate: true }});
            banner.classList.add('hidden'); applyConsent();
        });

        btnReject?.addEventListener('click', () => {
            writeConsent({ ts: Date.now(), categories: { analytics: false, affiliate: false }});
            banner.classList.add('hidden');
        });

        settings?.addEventListener('change', () => {
            if (!btnAccept.dataset._swap) {
                btnAccept.dataset._swap = '1';
                btnAccept.textContent = 'Zapisz ustawienia';
                btnAccept.onclick = () => {
                    writeConsent({ ts: Date.now(), categories: {
                            analytics: !!cbAnalytics?.checked,
                            affiliate: !!cbAffiliate?.checked
                        }});
                    banner.classList.add('hidden'); applyConsent();
                };
            }
        });

        if (!readConsent()) {
            banner?.classList.remove('hidden');
        } else {
            applyConsent();
        }
    })();
</script>
