@extends('layouts.studio')

@section('title', __('hellios.studio.add_distributor').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading"><div><p class="studio-kicker">03 / {{ __('hellios.studio.new_distributor') }}</p><h1>{{ __('hellios.studio.add_distributor') }}<br><em>{{ __('hellios.studio.join_network') }}</em></h1></div><p>{{ __('hellios.studio.distributors_help') }}</p></section>
    @include('studio.distributors.form')
@endsection
