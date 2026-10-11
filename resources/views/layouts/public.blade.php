<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta name="description" content="{{ __('hellios.meta.description') }}">
    <title>@yield('title', __('hellios.meta.title'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-paper font-sans text-ink antialiased">
    <header class="bg-hellios-yellow px-5 pt-5 sm:px-8 lg:px-12"><div class="mx-auto flex max-w-7xl items-center justify-between border-b border-ink/20 pb-5"><a href="{{ route('home') }}" class="flex items-center gap-2.5" aria-label="HELLIOS home"><span class="grid h-9 w-9 place-items-center rounded-full border-[3px] border-hellios-pink text-lg font-black tracking-[-0.35em] text-hellios-pink">××</span><span class="font-display text-3xl font-black uppercase tracking-[-0.09em] text-hellios-pink">HELLIOS</span><span class="hidden self-end pb-0.5 text-[10px] font-black italic tracking-tight text-ink sm:inline">#64ScaleWheels</span></a><button type="button" data-menu-toggle aria-expanded="false" class="grid h-10 w-10 place-items-center rounded-full border border-ink/25 text-xl lg:hidden" aria-label="{{ __('hellios.nav.menu') }}">≡</button><nav data-menu class="absolute left-5 right-5 top-[76px] z-20 hidden flex-col gap-4 border border-ink bg-paper p-5 text-sm font-black uppercase tracking-[0.12em] shadow-[6px_6px_0_0_#1d1e25] lg:static lg:flex lg:flex-row lg:items-center lg:gap-7 lg:border-0 lg:bg-transparent lg:p-0 lg:shadow-none"><a class="transition hover:text-hellios-pink" href="{{ route('home') }}#story">{{ __('hellios.nav.about') }}</a><a class="transition hover:text-hellios-pink" href="{{ route('catalog.index') }}">{{ __('hellios.nav.catalog') }}</a><a class="transition hover:text-hellios-pink" href="{{ route('studio.index') }}">{{ __('hellios.nav.studio') }}</a><span class="flex gap-2"><form method="POST" action="{{ route('language.update', 'en') }}">@csrf @method('PUT')<button class="{{ app()->getLocale() === 'en' ? 'text-hellios-pink' : 'text-ink/55' }}">EN</button></form><form method="POST" action="{{ route('language.update', 'id') }}">@csrf @method('PUT')<button class="{{ app()->getLocale() === 'id' ? 'text-hellios-pink' : 'text-ink/55' }}">ID</button></form></span></nav></div></header>
    <main>@yield('content')</main>
    <footer class="bg-ink px-5 py-10 text-white sm:px-8 lg:px-12"><div class="mx-auto flex max-w-7xl flex-col justify-between gap-8 sm:flex-row sm:items-end"><div><p class="font-display text-4xl font-black uppercase tracking-[-0.08em] text-hellios-pink">HELLIOS</p><p class="mt-2 text-xs font-bold uppercase tracking-[0.14em] text-white/55">{{ __('hellios.footer.motto') }}</p></div><div class="flex gap-5 text-xs font-black uppercase tracking-[0.14em] text-white/70"><a class="hover:text-hellios-yellow" href="{{ route('catalog.index') }}">{{ __('hellios.nav.catalog') }}</a><a class="hover:text-hellios-yellow" href="{{ route('studio.index') }}">{{ __('hellios.nav.studio') }}</a></div></div></footer>
</body>
</html>
