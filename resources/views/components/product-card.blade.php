@props(['product', 'index' => null])

<a href="{{ route('catalog.show', $product) }}" class="landing-product group">
    <div class="landing-product-image">
        <span class="landing-product-category">{{ $product->category->name }}</span>
        @if ($index !== null)<span class="landing-product-index">{{ str_pad($index, 2, '0', STR_PAD_LEFT) }} / HSW</span>@endif
        @if ($product->image_path)
            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" loading="lazy" width="500" height="500">
        @else
            <x-landing-wheel :id="'catalog-'.$product->id" :spokes="$index && $index % 2 === 0 ? 8 : 12" />
            <span class="landing-product-placeholder">{{ __('hellios.home.photo_coming') }}</span>
        @endif
        <span class="landing-product-arrow" aria-hidden="true">↗</span>
    </div>
    <div class="flex items-center justify-between gap-3 pt-5"><span class="landing-eyebrow text-ink/50">{{ $product->series ?? $product->category->name.' '.__('hellios.home.collection_suffix') }}</span><span class="text-[10px] font-bold">1:64 SCALE</span></div>
    <h3>{{ $product->name }}</h3>
    <p class="line-clamp-2 text-sm leading-6 text-ink/65">{{ $product->description }}</p>
</a>
