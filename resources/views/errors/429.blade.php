@extends('errors.layout')

@section('title', 'Za dużo żądań — 429')
@section('code', '429')

@section('icon')
    {{-- Speed / rate limit --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path d="M4 13a8 8 0 1116 0 1 1 0 01-2 0 6 6 0 10-6 6 1 1 0 010 2 8 8 0 01-8-8z"/>
        <path d="M13.414 12l2.829-2.828-1.414-1.415L12 10.586V12h1.414z"/>
    </svg>
@endsection

@section('heading', 'Za dużo żądań')
@section('message')
    Przekroczono limit zapytań. Odczekaj chwilę i spróbuj ponownie.
@endsection
