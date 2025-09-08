@extends('errors.layout')

@section('title', 'Serwis niedostępny — 503')
@section('code', '503')

@section('icon')
    {{-- Maintenance / toolbox --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path d="M21 7h-6l-2-2H3a1 1 0 00-1 1v12a2 2 0 002 2h16a2 2 0 002-2V8a1 1 0 00-1-1zM4 8h5v2H4V8zm0 4h8v2H4v-2zm0 4h8v2H5a1 1 0 01-1-1v-1zm16 1h-6v-2h6v2z"/>
    </svg>
@endsection

@section('heading', 'Serwis niedostępny')
@section('message')
    Trwają prace techniczne lub wystąpiła chwilowa niedostępność. Spróbuj ponownie później.
@endsection
