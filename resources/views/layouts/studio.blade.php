<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta name="theme-color" content="#202126">
    <title>@yield('title', __('hellios.studio.title'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="studio-body">
    <div class="studio-shell">
        <aside class="studio-sidebar">
            <div class="studio-sidebar-head">
                <div><a href="{{ route('home') }}" aria-label="Hellios home"><x-landing-brand /></a><p class="studio-sidebar-kicker">HELLIOS / {{ __('hellios.studio.management') }}</p></div>
                <button class="studio-menu-toggle" type="button" data-studio-toggle aria-expanded="false" aria-controls="studio-drawer"><span>MENU</span><i aria-hidden="true"></i><i aria-hidden="true"></i></button>
            </div>
            <div class="studio-sidebar-drawer" id="studio-drawer" data-studio-drawer>
                <nav class="studio-sidebar-nav" aria-label="{{ __('hellios.nav.menu') }}">
                    <a href="{{ route('studio.index') }}" class="{{ request()->routeIs('studio.index') ? 'is-active' : '' }}"><span>00 /</span> {{ __('hellios.studio.overview') }}</a>
                    <a href="{{ route('studio.products.index') }}" class="{{ request()->routeIs('studio.products.*') ? 'is-active' : '' }}"><span>01 /</span> {{ __('hellios.studio.products') }}</a>
                    <a href="{{ route('studio.categories.index') }}" class="{{ request()->routeIs('studio.categories.*') ? 'is-active' : '' }}"><span>02 /</span> {{ __('hellios.studio.categories') }}</a>
                    <a href="{{ route('studio.distributors.index') }}" class="{{ request()->routeIs('studio.distributors.*') ? 'is-active' : '' }}"><span>03 /</span> {{ __('hellios.studio.distributors') }}</a>
                </nav>
                <a class="studio-sidebar-create" href="{{ route('studio.products.create') }}">+ {{ __('hellios.studio.add_wheel') }}</a>
                <div class="studio-sidebar-bottom"><div class="studio-language" aria-label="{{ __('hellios.language.label') }}">@foreach (config('locales.supported') as $locale)<form method="POST" action="{{ route('language.update', $locale) }}">@csrf @method('PUT')<button class="{{ app()->getLocale() === $locale ? 'is-active' : '' }}">{{ __('hellios.language.'.$locale) }}</button></form>@endforeach</div><a class="studio-public-link" href="{{ route('catalog.index') }}">{{ __('hellios.studio.public_catalog') }} <span aria-hidden="true">↗</span></a><form method="POST" action="{{ route('studio.logout') }}">@csrf @method('DELETE')<button class="studio-logout">{{ __('hellios.studio.logout') }}</button></form></div>
            </div>
        </aside>
        <main class="studio-main"><div class="studio-container">@if (session('status'))<div class="studio-notice" role="status"><span>✓</span>{{ session('status') }}</div>@endif @yield('content')</div></main>
    </div>
</body>
</html>
