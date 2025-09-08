@extends('layouts.app')

@section('title','Zarządzaj newsletterem | FinWybor.pl')
@section('meta_description','Zapisz się lub wypisz z newslettera.')

@section('content')
    <section class="max-w-3xl mx-auto px-4 md:px-6 py-10">
        <h1 class="text-2xl md:text-3xl font-bold text-brand-900">Zarządzaj newsletterem</h1>
        <p class="mt-2 text-slate-600">Zapisz się lub poproś o link do wypisania.</p>

        @if(session('status'))
            <div class="mt-4 text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-3 py-2">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-6 grid md:grid-cols-2 gap-4">
            <div class="rounded-2xl bg-white border border-slate-200/60 shadow-card p-5">
                <h2 class="font-semibold text-brand-900">Zapisz się</h2>
                <form method="post" action="{{ route('newsletter.subscribe') }}" class="mt-3 space-y-3">
                    @csrf
                    <input type="email" name="email" required placeholder="Twój e-mail"
                           class="w-full rounded-lg border border-black/10 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-300">
                    <button class="w-full inline-flex items-center justify-center bg-brand-400 hover:bg-brand-500 text-white font-semibold rounded-lg px-4 py-2">
                        Subskrybuj
                    </button>
                </form>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200/60 shadow-card p-5">
                <h2 class="font-semibold text-brand-900">Wypisz się</h2>
                <p class="text-sm text-slate-600">Podaj e-mail, a wyślemy Ci bezpieczny link do wypisania.</p>
                <form method="post" action="{{ route('newsletter.requestUnsubscribe') }}" class="mt-3 space-y-3">
                    @csrf
                    <input type="email" name="email" required placeholder="Twój e-mail"
                           class="w-full rounded-lg border border-black/10 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-300">
                    <button class="w-full inline-flex items-center justify-center bg-slate-800 hover:bg-slate-900 text-white font-semibold rounded-lg px-4 py-2">
                        Wyślij link do wypisania
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
