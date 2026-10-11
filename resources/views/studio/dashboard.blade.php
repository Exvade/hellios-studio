@extends('layouts.studio')

@section('title', __('hellios.studio.overview').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading studio-dashboard-heading">
        <div>
            <p class="studio-kicker">00 / {{ __('hellios.studio.dashboard') }}</p>
            <h1>{{ __('hellios.studio.overview') }}<br><em>{{ __('hellios.studio.dashboard') }}</em></h1>
        </div>
        <div>
            <p>{{ __('hellios.studio.dashboard_copy') }}</p>
            <a href="{{ route('studio.products.create') }}" class="studio-button mt-5">{{ __('hellios.studio.add_wheel') }} <span aria-hidden="true">↗</span></a>
        </div>
    </section>

    <section class="studio-stats" aria-label="{{ __('hellios.studio.overview') }}">
        <article class="studio-stat-card"><span>01 /</span><strong>{{ $productCount }}</strong><p>{{ __('hellios.studio.total_wheels') }}</p></article>
        <article class="studio-stat-card"><span>02 /</span><strong>{{ $visibleCount }}</strong><p>{{ __('hellios.studio.visible_wheels') }}</p></article>
        <article class="studio-stat-card"><span>03 /</span><strong>{{ $featuredCount }}</strong><p>{{ __('hellios.studio.featured_wheels') }}</p></article>
        <article class="studio-stat-card"><span>04 /</span><strong>{{ $categoryCount }}</strong><p>{{ __('hellios.studio.total_categories') }}</p></article>
    </section>

    <section class="studio-dashboard-grid">
        <article class="studio-latest-panel">
            <div class="studio-panel-heading">
                <div><p class="studio-kicker">01 / {{ __('hellios.studio.inventory') }}</p><h2>{{ __('hellios.studio.latest_wheels') }}</h2></div>
                <a href="{{ route('studio.products.index') }}">{{ __('hellios.studio.manage_products') }} <span aria-hidden="true">↗</span></a>
            </div>
            <div class="studio-latest-list">
                @forelse ($latestProducts as $product)
                    <a href="{{ route('studio.products.edit', $product) }}" class="studio-latest-row">
                        <span class="studio-latest-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span><strong>{{ $product->name }}</strong><small>{{ $product->category->name }}</small></span>
                        <span aria-hidden="true">↗</span>
                    </a>
                @empty
                    <div class="studio-empty-state"><p>{{ __('hellios.studio.empty_products') }}</p><a href="{{ route('studio.products.create') }}">+ {{ __('hellios.studio.add_wheel') }}</a></div>
                @endforelse
            </div>
        </article>
        <aside class="studio-quick-panel">
            <p class="studio-kicker">02 / {{ __('hellios.studio.quick_actions') }}</p>
            <h2>{{ __('hellios.studio.manage_products') }}<br><em>&amp; {{ __('hellios.studio.categories') }}</em></h2>
            <div>
                <a href="{{ route('studio.products.index') }}">{{ __('hellios.studio.manage_products') }} <span aria-hidden="true">↗</span></a>
                <a href="{{ route('studio.categories.index') }}">{{ __('hellios.studio.manage_categories') }} <span aria-hidden="true">↗</span></a>
            </div>
        </aside>
    </section>
@endsection
