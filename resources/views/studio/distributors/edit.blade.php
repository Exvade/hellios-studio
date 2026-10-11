@extends('layouts.studio')

@section('title', __('hellios.studio.edit_distributor').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading"><div><p class="studio-kicker">03 / {{ __('hellios.studio.distributor_update') }}</p><h1>{{ __('hellios.studio.edit_distributor') }}<br><em>{{ $distributor->name }}</em></h1></div><p>{{ __('hellios.studio.logo_help') }}</p></section>
    @include('studio.distributors.form')
@endsection
