@extends('layouts.app')

@section('title', 'Products')

@section('content')
    @php
        $heroImage = asset('images/copper.png'); // swap this later for a real photo
    @endphp
    <section class="products-hero">
        <div class="products-hero-media" aria-hidden="true" style="background-image: url('{{ $heroImage }}');"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="products-hero-eyebrow">The Collection</span>
            <h1 class="products-hero-heading">Objects made to last.</h1>
            <p class="products-hero-desc">
                Explore our collection of copper, brass, kasa, steel, and aluminium products — selected for everyday use, lasting quality, and timeless appeal.
            </p>
        </div>
    </section>

    <section class="products-filter-bar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-3">
                <span class="products-filter-label">Filter by material</span>
                @if(request()->query('category') || request()->query('q') || request()->query('sort'))
                    <a href="{{ route('products.index') }}" class="products-clear">Clear filters</a>
                @endif
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto md:ml-auto items-start sm:items-center">
                <div class="category-nav" role="tablist" aria-label="Product categories">
                    <a href="{{ route('products.index') }}"
                       role="tab"
                       aria-selected="{{ !request()->query('category') ? 'true' : 'false' }}"
                       class="category-nav-link {{ (!request()->query('category') && !request()->query('q') && !request()->query('sort')) ? 'active' : '' }}">
                        All
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           role="tab"
                           aria-selected="{{ request()->query('category') === $category->slug ? 'true' : 'false' }}"
                           class="category-nav-link {{ request()->query('category') === $category->slug ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <form method="GET" action="{{ route('products.index') }}" class="products-toolbar">
                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <div class="products-search">
                            <svg class="products-search-icon w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                            <input
                                type="text"
                                name="q"
                                value="{{ old('q', request()->query('q')) }}"
                                placeholder="Search products..."
                                maxlength="80"
                                class="products-search-input"
                            />
                        </div>

                        <select name="sort" onchange="this.form.submit()" class="products-sort">
                            <option value="featured" {{ request()->query('sort') === 'featured' ? 'selected' : '' }}>Sort by: Featured</option>
                            <option value="newest" {{ request()->query('sort') === 'newest' ? 'selected' : '' }}>Sort by: Newest</option>
                            <option value="name" {{ request()->query('sort') === 'name' ? 'selected' : '' }}>Sort by: Name A–Z</option>
                        </select>

                        <input type="hidden" name="category" value="{{ request()->query('category') }}" />
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section style="background: var(--color-cream, #FAF8F3);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($products->count())
                <div class="products-grid">
                    @foreach ($products as $product)
                        <div class="stagger-item" style="animation-delay: {{ $loop->index * 0.06 }}s;">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>

                <div class="products-pagination">
                    {{ $products->links('pagination.products') }}
                </div>
            @else
                <div class="products-empty">
                    <svg class="products-empty-icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3>No products found</h3>
                    <p>Try adjusting your filters or search terms.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ route('products.index') }}" class="btn-primary text-sm font-medium">
                            Clear filters
                        </a>
                        @if(config('site.whatsapp'))
                            <a href="https://wa.me/{{ config('site.whatsapp') }}?text={{ urlencode('Hello, I could not find the product I am looking for. Could you help?') }}" target="_blank" rel="noopener" class="btn-whatsapp text-sm font-medium">
                                WhatsApp enquiry
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
