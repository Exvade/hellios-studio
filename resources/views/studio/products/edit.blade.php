@extends('layouts.studio')

@section('title', __('hellios.studio.edit_wheel').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading"><div><p class="studio-kicker">01 / {{ __('hellios.studio.catalog_update') }}</p><h1>{{ __('hellios.studio.edit_wheel') }}<br><em>{{ $product->name }}</em></h1></div><p>{{ __('hellios.studio.add_wheel_help') }}</p></section>
    @include('studio.products.form')
@endsection
