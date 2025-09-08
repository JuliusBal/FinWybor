@component('mail::message')
    # Zarządzanie subskrypcją

    Aby wypisać się z newslettera, kliknij poniższy przycisk:

    @component('mail::button', ['url' => $url])
        Wypisz mnie
    @endcomponent

    Jeśli to nie Ty inicjowałeś tę prośbę, zignoruj tę wiadomość.
@endcomponent
