<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta name="theme-color" content="#eeedf0">
    <meta name="description" content="{{ __('hellios.meta.description') }}">
    <title>@yield('title', __('hellios.meta.title'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hellios-landing">
    <a class="landing-skip" href="#main-content">{{ app()->isLocale('id') ? 'Lewati ke konten' : 'Skip to content' }}</a>
    <div class="landing-topline"><span>{{ __('hellios.home.topline_left') }}</span><span>{{ __('hellios.home.topline_right') }} <span aria-hidden="true">↗</span></span></div>
    <header class="landing-header">
        <div class="landing-container flex items-center justify-between gap-5">
            <a href="{{ route('home') }}" aria-label="Hellios home"><x-landing-brand /></a>
            <div class="flex items-center gap-3">
                <div class="language-switcher" aria-label="{{ __('hellios.language.label') }}">
                    @foreach (config('locales.supported') as $locale)
                        <form method="POST" action="{{ route('language.update', $locale) }}">@csrf @method('PUT')<button type="submit" class="{{ app()->isLocale($locale) ? 'is-active' : '' }}" aria-label="{{ __('hellios.language.label') }} {{ __('hellios.language.'.$locale) }}">{{ __('hellios.language.'.$locale) }}</button></form>
                    @endforeach
                </div>
                <button class="landing-menu-button" type="button" data-landing-toggle aria-expanded="false" aria-controls="landing-navigation"><span>{{ __('hellios.nav.menu') }}</span><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 8h16M4 16h16" stroke="currentColor" stroke-width="2"/></svg></button>
            </div>
            <nav id="landing-navigation" class="landing-navigation" aria-label="{{ __('hellios.nav.menu') }}" data-landing-menu>
                <a href="{{ route('home') }}#collection">{{ __('hellios.nav.collection') }}</a>
                <a href="{{ route('home') }}#story">{{ __('hellios.nav.about') }}</a>
                <a href="{{ route('home') }}#build-guide">{{ __('hellios.nav.guide') }}</a>
                <a class="landing-nav-cta" href="{{ route('catalog.index') }}">{{ __('hellios.nav.catalog') }} <span aria-hidden="true">↗</span></a>
            </nav>
        </div>
    </header>
    <main id="main-content">@yield('content')</main>
    <footer class="landing-footer">
        <div class="landing-container">
            <div class="flex flex-col justify-between gap-8 pb-10 md:flex-row md:items-start">
                <div><a href="{{ route('home') }}" aria-label="Hellios home"><x-landing-brand /></a><p class="mt-5 max-w-xs text-sm leading-6 text-white/55">{!! __('hellios.footer.line') !!}</p></div>
                <div class="flex flex-wrap gap-x-14 gap-y-6 text-sm">
                    <div class="flex flex-col items-start gap-3"><span class="landing-eyebrow text-white/40">{{ __('hellios.footer.explore') }}</span><a href="{{ route('catalog.index') }}">{{ __('hellios.footer.catalog') }}</a><a href="{{ route('home') }}#story">{{ __('hellios.footer.about') }}</a></div>
                    <div class="flex flex-col items-start gap-3"><span class="landing-eyebrow text-white/40">{{ __('hellios.footer.garage') }}</span><a href="{{ route('home') }}#build-guide">{{ __('hellios.footer.guide') }}</a><a href="{{ route('studio.index') }}">{{ __('hellios.nav.studio') }} ↗</a></div>
                </div>
            </div>
            <div class="flex flex-wrap justify-between gap-3 border-t border-white/15 pt-6 text-[10px] uppercase tracking-[.12em] text-white/45"><span>{{ __('hellios.footer.copyright', ['year' => date('Y')]) }}</span><span>{{ __('hellios.footer.motto') }}</span><a href="#main-content">{{ __('hellios.footer.top') }}</a></div>
        </div>
    </footer>
</body>
</html>
