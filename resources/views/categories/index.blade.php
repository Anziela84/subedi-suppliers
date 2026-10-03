@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <section class="page-banner section-dark">
        <h1>Categories</h1>
        <div class="ornament"><span></span></div>
        <p>Browse our product categories: Copper, Brass, Kasa, Steel, and Aluminium.</p>
    </section>
    <section class="py-16 md:py-24" style="background: var(--color-cream, #FAF8F3);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($categories->count())
                <div class="categories-stacked">
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="category-row" data-reveal>
                            <div class="category-row-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="category-row-content">
                                <h2 class="font-heading text-2xl md:text-3xl font-bold transition-colors" style="color: var(--color-ink, #1E252B);">{{ $category->name }}</h2>
                                <p class="mt-1 line-clamp-2" style="color: var(--color-muted, #68717A);">{{ $category->description }}</p>
                                <span class="mt-2 inline-block text-sm font-medium" style="color: var(--color-brand-blue, #0047AB);">
                                    {{ $category->active_products_count === 1 ? '1 product' : $category->active_products_count . ' products' }}
                                </span>
                            </div>
                            <div class="category-row-media">
                                <div class="category-media-block">
                                    @if($category->image && file_exists(storage_path('app/public/' . $category->image)))
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-media-img" loading="lazy" />
                                    @else
                                        <x-media-placeholder :name="$category->name" :category="$category" class="category-media-placeholder" />
                                    @endif
                                </div>
                                <div class="category-row-arrow">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center" data-reveal>
                    <p class="mt-4 max-w-2xl mx-auto" style="color: var(--color-ink, #1E252B);">
                        Our categories are being updated. Please check back soon or <a href="{{ route('contact') }}" class="text-brand-blue hover:underline">contact us</a>.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
