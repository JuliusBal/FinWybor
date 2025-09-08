@extends('errors.layout')

@section('title', 'Wymagane logowanie — 401')
@section('code', '401')

@section('icon')
    {{-- Shield --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 2l7 4v6c0 5-3.8 9.4-7 10-3.2-.6-7-5-7-10V6l7-4z"/>
    </svg>
@endsection

@section('heading', 'Wymagane logowanie')
@section('message')
    Aby kontynuować, zaloguj się lub przejdź na stronę główną.
@endsection
