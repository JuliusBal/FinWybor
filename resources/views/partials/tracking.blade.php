{{-- 🔒 Blocked until consent --}}
@env('production')
    {{-- GA4 (analytics) --}}
    <script type="text/plain" data-category="analytics"
            data-src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXX"></script>
    <script type="text/plain" data-category="analytics">
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXX', { anonymize_ip: true });
    </script>

    {{-- Awin (affiliate) --}}
    <script type="text/plain" data-category="affiliate">
        // AWIN tag(s) here – will run only after affiliate consent
        // e.g. window.AWIN = window.AWIN || {};
    </script>
@endenv
