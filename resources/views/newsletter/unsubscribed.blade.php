@extends('layouts.app')

@section('content')
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
        <div class="max-w-3xl mx-auto px-4 md:px-6 py-12">
            <h1 class="text-3xl md:text-4xl font-bold">Zmieniliśmy Twoje ustawienia</h1>
            <p class="mt-2 text-white/85">Adres <strong>{{ $email }}</strong> został wypisany z newslettera FinWybor.</p>
        </div>
    </section>

    <div class="max-w-3xl mx-auto px-4 md:px-6 py-8">
        <div class="rounded-2xl bg-white shadow-card border border-slate-200/60 p-6">
            <p class="text-slate-700">
                Szkoda, że się rozstajemy. Jeśli to była pomyłka albo zmienisz zdanie,
                zawsze możesz ponownie zapisać się na newsletter na naszej stronie.
            </p>

            <div class="mt-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-400 hover:bg-brand-500 text-white font-semibold px-5 py-3">
                    Wróć na stronę główną
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                </a>
            </div>
        </div>
    </div>
@endsection
