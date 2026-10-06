@props([
    'product' => null,
    'image' => null,
    'alt' => '',
    'loadingLazy' => true,
    'specs' => null,
])

<a href="{{ route('products.show', $product->slug) }}" class="product-card group block">
    <div class="product-card-image">
        <img src="{{ $product->coverUrl() }}" alt="{{ $product->name }}" loading="lazy" />
    </div>
    <div class="product-card-body">
        <span class="product-card-category">{{ $product->category->name ?? '' }}</span>
        <h3 class="product-card-name">{{ $product->name }}</h3>
        @php
            $specParts = [];
            if(($product->size ?? '') !== '' && ($product->size ?? '') !== null) $specParts[] = $product->size;
            if(($product->dimensions_display ?? '') !== '' && ($product->dimensions_display ?? '') !== null) $specParts[] = $product->dimensions_display;
            $specText = implode(' · ', $specParts);
        @endphp
        @if($specText)
            <p class="product-card-specs">{{ $specText }}</p>
        @endif
        <span class="product-card-price-link">Enquire for price <span aria-hidden="true">&nbsp;&rarr;</span></span>
    </div>
</a>
