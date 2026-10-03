@props([
    'eyebrow' => '',
    'title' => '',
    'text' => '',
])

<section class="page-hero section-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="page-hero-eyebrow">{{ $eyebrow }}</span>
        <h1 class="page-hero-title">{{ $title }}</h1>
        <div class="page-hero-ornament" aria-hidden="true"><span></span></div>
        <p class="page-hero-text">{{ $text }}</p>
    </div>
</section>
