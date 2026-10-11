@extends('layouts.studio')

@section('title', __('hellios.studio.add_product').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading"><div><p class="studio-kicker">01 / {{ __('hellios.studio.new_catalog_piece') }}</p><h1>{{ __('hellios.studio.add_wheel') }}<br><em>MAKE IT COUNT.</em></h1></div><p>{{ __('hellios.studio.add_wheel_help') }}</p></section>
    @include('studio.products.form')
@endsection
