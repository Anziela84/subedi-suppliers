@props([
    'product' => null,
    'image' => null,
    'alt' => '',
    'loadingLazy' => true,
    'specs' => null,
])

<a href="{{ route('products.show', $product->slug) }}" class="product-card group block">
    <div class="product-card-image">
        @if($image)
            <img src="{{ $image }}" alt="{{ $alt }}" @if($loadingLazy)loading="lazy"@endif />
        @else
            <x-media-placeholder :name="$product->name" :category="$product->category" class="w-full h-full" />
        @endif
        <div class="product-card-hover-overlay" aria-hidden="true">
            <span class="product-card-hover-label">View product &rarr;</span>
        </div>
    </div>
    <div class="product-card-body">
        <span class="product-card-category">{{ $product->category->name ?? '' }}</span>
        <h3 class="product-card-name">{{ $product->name }}</h3>
        @if($specs)
            <p class="product-card-specs">{{ $specs }}</p>
        @endif
        <div class="product-card-footer">
            <span class="product-card-price">
                @if($product->price !== null && $product->price !== '')
                    Rs {{ number_format((float) $product->price, 0) }}
                @else
                    <span class="price-muted">Enquire for price</span>
                @endif
            </span>
            @if($product->is_featured)
                <span class="product-card-featured" aria-label="Featured">Featured</span>
            @endif
        </div>
    </div>
</a>
