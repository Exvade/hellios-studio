@extends('layouts.studio')

@section('title', __('hellios.studio.categories').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading">
        <div><p class="studio-kicker">02 / {{ __('hellios.studio.architecture') }}</p><h1>{{ __('hellios.studio.categories') }}<br><em>THE FAMILIES.</em></h1></div>
        <div><p>{{ __('hellios.studio.products_help') }}</p><a href="{{ route('studio.categories.create') }}" class="studio-button mt-5">{{ __('hellios.studio.add_category') }} <x-icon-arrow /></a></div>
    </section>
    <div class="studio-category-wall">@forelse ($categories as $category)<article class="studio-category-card"><span class="studio-category-accent {{ $category->accent === 'pink' ? 'bg-hellios-pink' : ($category->accent === 'yellow' ? 'bg-hellios-yellow' : 'bg-ink') }}"></span><p class="studio-category-count">{{ trans_choice('hellios.studio.wheel_count', $category->products_count, ['count' => $category->products_count]) }}</p><h2>{{ $category->name }}</h2><p>{{ $category->description ?: __('hellios.studio.no_description') }}</p><div class="studio-action-list mt-7 justify-start"><a href="{{ route('studio.categories.edit', $category) }}">{{ __('hellios.studio.edit') }}</a><form method="POST" action="{{ route('studio.categories.destroy', $category) }}" onsubmit="return confirm('{{ __('hellios.studio.delete_category_confirm') }}')">@csrf @method('DELETE')<button>{{ __('hellios.studio.delete') }}</button></form></div></article>@empty<p class="studio-empty col-span-full">{{ __('hellios.studio.empty_categories') }}</p>@endforelse</div>
@endsection
