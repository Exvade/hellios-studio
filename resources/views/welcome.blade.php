@extends('layouts.landing')

@section('content')
    <section class="landing-hero">
        <div class="landing-container">
            <div class="landing-hero-meta"><span><i></i> {{ __('hellios.home.hero_label') }}</span><span>{{ __('hellios.home.hero_meta') }}</span></div>
            <div class="landing-hero-grid">
                <div class="landing-hero-copy">
                    <h1>{!! __('hellios.home.hero_title') !!}<span>{{ __('hellios.home.hero_title_accent') }}</span></h1>
                    <div class="landing-hero-description"><span class="landing-cross" aria-hidden="true">✳</span><p>{!! __('hellios.home.hero_description') !!}</p></div>
                    <div class="flex flex-wrap items-center gap-6"><a class="landing-button" href="{{ route('catalog.index') }}">{{ __('hellios.home.hero_cta') }} <span aria-hidden="true">↗</span></a><a class="landing-text-link" href="#collection">{{ __('hellios.home.hero_link') }} <span aria-hidden="true">↓</span></a></div>
                </div>
                <div class="landing-hero-art" role="img" aria-label="{{ __('hellios.home.hero_art_note') }}">
                    <div class="landing-orbit landing-orbit-one"></div><div class="landing-orbit landing-orbit-two"></div>
                    <span class="landing-art-coordinate">{{ __('hellios.home.hero_art_label') }}</span><span class="landing-art-word" aria-hidden="true">HELLIOS</span>
                    <img class="landing-hero-wheel-pair" data-hero-parallax="pair" src="{{ asset('images/hellios/hero-wheels-original-cutout.png') }}" alt="{{ __('hellios.home.hero_label') }}" width="1492" height="1054" fetchpriority="high">
                    <div class="landing-scale-sticker"><span>{{ __('hellios.home.hero_sticker_top') }}</span><strong>1:64</strong><span>{{ __('hellios.home.hero_sticker_bottom') }}</span></div>
                    <span class="landing-art-note">{{ __('hellios.home.hero_art_note') }}<br><span>{{ __('hellios.home.hero_art_note_sub') }}</span></span><svg class="landing-art-arrow" viewBox="0 0 110 100" fill="none" aria-hidden="true"><path d="M4 8c80-16 111 32 60 68m-3-19 0 23 28-3" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
            <div class="landing-hero-bottom"><span>{{ __('hellios.home.hero_bottom') }}</span><a href="#collection">{{ __('hellios.home.hero_scroll') }} <span aria-hidden="true">↓</span></a></div>
        </div>
    </section>
    <div class="landing-ticker" aria-label="{{ __('hellios.home.ticker_one') }}"><div aria-hidden="true"><span>{{ __('hellios.home.ticker_one') }}</span><b>✳</b><span>{{ __('hellios.home.ticker_two') }}</span><b>✳</b><span>{{ __('hellios.home.ticker_three') }}</span><b>✳</b></div></div>

    <section id="collection" class="landing-collection landing-section">
        <div class="landing-container">
            <div class="landing-section-heading"><div><p class="landing-eyebrow"><span class="landing-section-number">01 /</span> {{ __('hellios.home.collection_label') }}</p><h2>{!! __('hellios.home.collection_title') !!}</h2></div><div class="max-w-xs"><p class="text-sm leading-6 text-ink/65">{{ __('hellios.home.collection_description') }}</p><a class="landing-text-link mt-5 inline-flex" href="{{ route('catalog.index') }}">{{ __('hellios.home.all_products') }} <span aria-hidden="true">↗</span></a></div></div>
            <div class="landing-category-links"><a class="is-current" href="{{ route('catalog.index') }}">{{ __('hellios.home.all_wheels') }} <span aria-hidden="true">↗</span></a>@foreach ($categories as $category)<a href="{{ route('catalog.index', ['category' => $category->slug]) }}">{{ $category->name }} <span aria-hidden="true">↗</span></a>@endforeach</div>
            <div class="grid gap-7 md:grid-cols-3">
                @forelse ($selectedProducts as $product)
                    <x-product-card :product="$product" :index="$loop->iteration" />
                @empty
                    <div class="border-y border-ink/20 py-12 md:col-span-3"><h3 class="text-2xl font-black">{{ __('hellios.home.empty_title') }}</h3><p class="mt-3 text-sm text-ink/60">{{ __('hellios.home.empty_description') }}</p></div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="story" class="landing-story"><div class="landing-container grid gap-12 lg:grid-cols-2 lg:gap-24"><div class="landing-story-poster" aria-label="1:64"><span class="landing-eyebrow">{{ __('hellios.home.story_label') }}</span><div class="landing-story-scale">1<span>:</span>64</div><div class="landing-poster-stamp">{{ __('hellios.home.hero_meta') }}</div><div class="flex items-end justify-between border-t border-ink/25 pt-4"><span class="text-[10px] font-bold leading-4 tracking-wider">HELLIOS<br>SCALE WHEELS</span><span class="landing-poster-cross" aria-hidden="true">××</span></div></div><div class="flex flex-col justify-center"><p class="landing-eyebrow"><span class="landing-section-number">02 /</span> {{ __('hellios.home.story_label') }}</p><h2>{!! __('hellios.home.story_title') !!}</h2><p class="mt-6 max-w-md text-base leading-7 text-white/65">{{ __('hellios.home.story_body_one') }}</p><p class="mt-4 max-w-md text-sm leading-7 text-white/65">{{ __('hellios.home.story_body_two') }}</p><a class="landing-story-link mt-8 inline-flex w-fit items-center gap-8" href="{{ route('catalog.index') }}">{{ __('hellios.home.story_cta') }} <span aria-hidden="true">↗</span></a></div></div></section>

    <section class="landing-stockists landing-section"><div class="landing-container"><div class="landing-section-heading"><div><p class="landing-eyebrow"><span class="landing-section-number">03 /</span> {{ __('hellios.home.stockists_label') }}</p><h2>{!! __('hellios.home.stockists_title') !!}</h2></div><div class="max-w-sm"><p class="text-sm leading-6 text-ink/65">{{ __('hellios.home.stockists_description') }}</p></div></div><div class="distributor-grid">@forelse ($distributors as $distributor)<article class="distributor-card">@if ($distributor->logo_path)<img src="{{ asset('storage/'.$distributor->logo_path) }}" alt="{{ $distributor->name }}" loading="lazy">@else<h3>{{ $distributor->name }}</h3>@endif</article>@empty<p class="distributor-empty">{{ __('hellios.home.distributors_empty') }}</p>@endforelse</div></div></section>

    <section id="build-guide" class="landing-guide landing-section"><div class="landing-container"><div class="landing-section-heading"><div><p class="landing-eyebrow"><span class="landing-section-number">04 /</span> {{ __('hellios.home.guide_label') }}</p><h2>{!! __('hellios.home.guide_title') !!}</h2></div><p class="max-w-xs text-sm leading-6 text-ink/65">{!! __('hellios.home.guide_description') !!}</p></div><div class="grid gap-8 md:grid-cols-3 md:gap-12"><article class="landing-guide-step"><span>01</span><h3>{{ __('hellios.home.guide_one_title') }}</h3><p>{{ __('hellios.home.guide_one_text') }}</p></article><article class="landing-guide-step"><span>02</span><h3>{{ __('hellios.home.guide_two_title') }}</h3><p>{{ __('hellios.home.guide_two_text') }}</p></article><article class="landing-guide-step"><span>03</span><h3>{{ __('hellios.home.guide_three_title') }}</h3><p>{{ __('hellios.home.guide_three_text') }}</p></article></div></div></section>
    <section class="landing-final"><div class="landing-container flex flex-col items-start justify-between gap-10 lg:flex-row lg:items-center"><div><p class="landing-eyebrow">{{ __('hellios.home.final_label') }}</p><h2>{!! __('hellios.home.final_title') !!}</h2></div><a class="landing-final-link" href="{{ route('catalog.index') }}"><span>{!! __('hellios.home.final_cta') !!}</span><span aria-hidden="true">↗</span></a></div></section>
@endsection
