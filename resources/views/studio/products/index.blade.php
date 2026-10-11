@extends('layouts.studio')

@section('title', __('hellios.studio.products').' — '.__('hellios.studio.title'))

@section('content')
    <section class="studio-page-heading">
        <div><p class="studio-kicker">01 / {{ __('hellios.studio.inventory') }}</p><h1>{{ __('hellios.studio.products') }}<br><em>WHEEL WALL.</em></h1></div>
        <div><p>{{ __('hellios.studio.products_help') }}</p><a href="{{ route('studio.products.create') }}" class="studio-button mt-5">{{ __('hellios.studio.add_wheel') }} <x-icon-arrow /></a></div>
    </section>
    <div class="studio-table-shell"><table class="studio-table"><thead><tr><th>{{ __('hellios.studio.product') }}</th><th>{{ __('hellios.studio.category') }}</th><th>{{ __('hellios.studio.visibility') }}</th><th class="text-right">{{ __('hellios.studio.actions') }}</th></tr></thead><tbody>@forelse ($products as $product)<tr><td><p class="studio-product-name">{{ $product->name }}</p><p class="studio-product-series">{{ $product->series ?? __('hellios.studio.no_series') }}</p></td><td class="text-ink/65">{{ $product->category->name }}</td><td><span class="studio-status {{ $product->is_available ? '' : 'is-hidden' }}">{{ $product->is_available ? __('hellios.studio.live') : __('hellios.studio.hidden') }}</span>@if ($product->is_featured)<span class="studio-featured"><x-icon-spark /> {{ __('hellios.studio.featured_short') }}</span>@endif</td><td><div class="studio-action-list"><a href="{{ route('catalog.show', $product) }}">{{ __('hellios.studio.view') }}</a><a href="{{ route('studio.products.edit', $product) }}">{{ __('hellios.studio.edit') }}</a><form action="{{ route('studio.products.destroy', $product) }}" method="POST" onsubmit="return confirm('{{ __('hellios.studio.delete_product_confirm') }}')">@csrf @method('DELETE')<button>{{ __('hellios.studio.delete') }}</button></form></div></td></tr>@empty<tr><td colspan="4" class="studio-empty">{{ __('hellios.studio.empty_products') }}</td></tr>@endforelse</tbody></table></div>
@endsection
