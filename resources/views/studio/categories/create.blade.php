@extends('layouts.studio')

@section('title', __('hellios.studio.add_category').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading"><div><p class="studio-kicker">02 / {{ __('hellios.studio.new_family') }}</p><h1>{{ __('hellios.studio.add_category') }}<br><em>BUILD A WALL.</em></h1></div><p>{{ __('hellios.studio.category_description_placeholder') }}</p></section>
    @include('studio.categories.form')
@endsection
