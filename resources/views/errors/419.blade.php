@extends('errors.layout')

@section('title', 'Sesja wygasła — 419')
@section('code', '419')

@section('icon')
    {{-- Timer / session --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path d="M15 1H9v2h6V1zM12 8a1 1 0 00-1 1v4h4a1 1 0 000-2h-2V9a1 1 0 00-1-1z"/>
        <path d="M12 4a9 9 0 109 9 9.01 9.01 0 00-9-9zm0 16a7 7 0 117-7 7.008 7.008 0 01-7 7z"/>
    </svg>
@endsection

@section('heading', 'Sesja wygasła')
@section('message')
    Twoja sesja wygasła lub token CSRF jest nieprawidłowy. Odśwież stronę i spróbuj ponownie.
@endsection
