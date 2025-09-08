@extends('errors.layout')

@section('title', 'Nie znaleziono — 404')
@section('code', '404')

@section('icon')
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 2a10 10 0 100 20 10 10 0 000-20zM8 11h2v2H8v-2zm6 0h2v2h-2v-2zM8 15h8v2H8v-2z"/>
    </svg>
@endsection

@section('heading', 'Nie znaleziono strony')
@section('message')
    Strona, której szukasz, mogła zostać usunięta albo link był nieprawidłowy.
@endsection
