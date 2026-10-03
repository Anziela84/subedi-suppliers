@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <x-page-hero
        eyebrow="The Categories"
        title="Browse by metal."
        text="Find pieces by the metal they are made from."
    />

    <section class="py-12 md:pt-16 md:pb-24" style="background: var(--color-cream, #FAF8F3);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($categories->count())
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="cat-row" data-reveal>
                        <span class="cat-row-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="cat-row-body">
                            <h2>{{ $category->name }}</h2>
                            <p class="cat-row-desc">{{ $category->description }}</p>
                            @if($category->products->count())
                                <p class="cat-row-includes">
                                    <span>Includes</span>
                                    {{ $category->products->take(3)->pluck('name')->join(', ') }}
                                </p>
                            @endif
                            <span class="cat-row-count">{{ $category->active_products_count === 1 ? '1 product' : $category->active_products_count . ' products' }}</span>
                            <span class="cat-row-cta">Browse {{ $category->name }} &rarr;</span>
                        </div>
                        <div class="cat-row-media">
                            <div class="category-media-block">
                                @if($category->image && file_exists(storage_path('app/public/' . $category->image)))
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-media-img" loading="lazy" />
                                @else
                                    <x-media-placeholder :name="$category->name" :category="$category" class="category-media-placeholder" />
                                @endif
                            </div>
                            <span class="cat-row-arrow" aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="text-center" data-reveal>
                    <p class="mt-4 max-w-2xl mx-auto" style="color: var(--color-ink, #1E252B);">
                        Our categories are being updated. Please check back soon or <a href="{{ route('contact') }}" class="text-brand-blue hover:underline">contact us</a>.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <x-cta-band
        title="Can't find what you need?"
        text="Tell us what you are looking for and we will help you find it."
    />
@endsection
