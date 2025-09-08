@extends('errors.layout')

@section('title', 'Dostęp zabroniony — 403')
@section('code', '403')

@section('icon')
    {{-- Lock --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path d="M17 8h-1V6a4 4 0 10-8 0v2H7a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-8a2 2 0 00-2-2zm-7-2a2 2 0 114 0v2H10V6zm7 12H7v-8h10v8z"/>
    </svg>
@endsection

@section('heading', 'Dostęp zabroniony')
@section('message')
    Nie masz uprawnień do wyświetlenia tej strony lub zasobu.
@endsection
