@extends('layouts.studio')

@section('title', __('hellios.studio.distributors').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading">
        <div><p class="studio-kicker">03 / {{ __('hellios.home.stockists_label') }}</p><h1>{{ __('hellios.studio.distributors') }}<br><em>{{ __('hellios.studio.distributors_accent') }}</em></h1></div>
        <div><p>{{ __('hellios.studio.distributors_help') }}</p><a href="{{ route('studio.distributors.create') }}" class="studio-button mt-5">{{ __('hellios.studio.add_distributor') }} <x-icon-arrow /></a></div>
    </section>

    <div class="studio-table-shell">
        <table class="studio-table">
            <thead><tr><th>{{ __('hellios.studio.logo') }}</th><th>{{ __('hellios.studio.distributor_name') }}</th><th>{{ __('hellios.studio.country') }}</th><th class="text-right">{{ __('hellios.studio.actions') }}</th></tr></thead>
            <tbody>
                @forelse ($distributors as $distributor)
                    <tr>
                        <td>@if ($distributor->logo_path)<img class="studio-distributor-logo" src="{{ asset('storage/'.$distributor->logo_path) }}" alt="{{ $distributor->name }}">@else<span class="studio-logo-fallback">{{ str($distributor->name)->substr(0, 2)->upper() }}</span>@endif</td>
                        <td><p class="studio-product-name">{{ $distributor->name }}</p></td>
                        <td class="text-ink/65">{{ $distributor->country }}</td>
                        <td><div class="studio-action-list"><a href="{{ route('studio.distributors.edit', $distributor) }}">{{ __('hellios.studio.edit') }}</a><form method="POST" action="{{ route('studio.distributors.destroy', $distributor) }}" onsubmit="return confirm('{{ __('hellios.studio.delete_distributor_confirm') }}')">@csrf @method('DELETE')<button>{{ __('hellios.studio.delete') }}</button></form></div></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="studio-empty">{{ __('hellios.studio.empty_distributors') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
