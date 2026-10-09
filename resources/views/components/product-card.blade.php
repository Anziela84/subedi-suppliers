@props([
    'product' => null,
    'image' => null,
    'alt' => '',
    'loadingLazy' => true,
    'specs' => null,
])

<a href="{{ route('products.show', $product->slug) }}" class="product-card group block">
    <div class="product-card-image">
        @php
            $coverUrl = $product->coverUrl();
            $coverSize = @getimagesize(public_path(parse_url($coverUrl, PHP_URL_PATH)));
        @endphp
        <img src="{{ $coverUrl }}" alt="{{ $product->name }}" loading="lazy" decoding="async" @if($coverSize) width="{{ $coverSize[0] }}" height="{{ $coverSize[1] }}" @endif />
    </div>
    <div class="product-card-body">
        <span class="product-card-category">{{ $product->category->name ?? '' }}</span>
        <h3 class="product-card-name">{{ $product->name }}</h3>
        @php
            $specParts = [];
            if(($product->size ?? '') !== '' && ($product->size ?? '') !== null) $specParts[] = $product->size;
            $specText = implode(' · ', $specParts);
        @endphp
        @if($specText)
            <p class="product-card-specs">{{ $specText }}</p>
        @endif
        @if($product->price !== null && $product->price !== '')
            <span class="product-card-price">Rs {{ number_format((float) $product->price, 0) }}</span>
        @else
            <span class="product-card-price-link">Enquire for price <span aria-hidden="true">&nbsp;&rarr;</span></span>
        @endif
    </div>
</a>
