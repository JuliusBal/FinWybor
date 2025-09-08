@extends('errors.layout')

@section('title', 'Wewnętrzny błąd serwera — 500')
@section('code', '500')

@section('icon')
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path d="M11 21h2v-2h-2v2zM11 3h2v10h-2V3z"/><path d="M5.07 6.34L3.66 7.75A9 9 0 1020.34 7.75l-1.41-1.41A7 7 0 115.07 6.34z"/>
    </svg>
@endsection

@section('heading', 'Wewnętrzny błąd serwera')
@section('message')
    Wystąpił błąd po naszej stronie. Spróbuj ponownie za chwilę. Jeśli problem się powtarza,
    skontaktuj się z nami przez formularz „Kontakt”.
@endsection

@section('extra')
    @if(app()->bound('sentry-last-event-id') && $id = app('sentry-last-event-id'))
        <div class="mt-4 text-xs text-slate-500">
            Identyfikator błędu: <span class="font-mono">{{ $id }}</span>
        </div>
    @endif
@endsection
