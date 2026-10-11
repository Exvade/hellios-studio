@extends('layouts.landing')

@section('title', __('hellios.studio.login_title').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-login"><div class="landing-container"><div class="studio-login-card"><p class="studio-kicker">HELLIOS / {{ __('hellios.studio.private_workspace') }}</p><h1>{!! str(__('hellios.studio.login_title'))->replace('.', '<br>') !!}</h1>@if (! $configured)<p class="mt-8 border-l-4 border-hellios-yellow bg-hellios-yellow/20 p-4 text-sm leading-6 text-ink">{!! __('hellios.studio.configure_password') !!}</p>@else<form method="POST" action="{{ route('studio.login.store') }}" class="mt-9 max-w-md">@csrf<label class="block"><span class="form-label">{{ __('hellios.studio.password') }}</span><input type="password" name="password" class="form-input" required autofocus>@error('password')<span class="form-error">{{ $message }}</span>@enderror</label><button class="studio-button mt-7">{{ __('hellios.studio.enter') }} <span aria-hidden="true">↗</span></button></form>@endif</div></div></section>
@endsection
