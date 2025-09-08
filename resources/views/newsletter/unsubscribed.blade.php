@extends('layouts.app')

@section('title','Wypisano z newslettera | FinWybor.pl')
@section('content')
    <div class="max-w-xl mx-auto px-4 md:px-6 py-10">
        <div class="rounded-2xl bg-white border border-slate-200/60 shadow-card p-6">
            <h1 class="text-xl font-semibold text-brand-900">Zostałeś wypisany</h1>
            <p class="mt-2 text-slate-700">Adres <strong>{{ $email }}</strong> został usunięty z listy newslettera.</p>
            <p class="mt-2 text-slate-600 text-sm">Zmienisz zdanie? Zawsze możesz zapisać się ponownie.</p>
            <a href="{{ route('posts.index') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-brand-400 hover:bg-brand-500 text-white">
                Wróć na blog
            </a>
        </div>
    </div>
@endsection
