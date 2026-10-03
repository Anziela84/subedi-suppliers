@props([
    'name',
    'category' => null,
    'class' => '',
])

@php
    $slug = $category ? strtolower($category->slug) : null;
    $gradients = [
        'copper' => 'linear-gradient(135deg, #b87333 0%, #e07b39 100%)',
        'brass' => 'linear-gradient(135deg, #b5a642 0%, #f0c75e 100%)',
        'kasa' => 'linear-gradient(135deg, #7a5c3a 0%, #a67c52 100%)',
        'steel' => 'linear-gradient(135deg, #71797E 0%, #a0a7ac 100%)',
        'aluminium' => 'linear-gradient(135deg, #b8b8b8 0%, #e8e8e8 100%)',
    ];
    $gradient = $gradients[$slug] ?? 'linear-gradient(135deg, var(--color-deep-navy, #102A43), var(--color-brand-blue, #0047AB))';
    $initial = strtoupper(mb_substr($name, 0, 1));
    $alt = $category ? $category->name . ' - ' . $name : $name;
@endphp

<div class="media-placeholder {{ $class }}" style="background: {{ $gradient }};" aria-label="{{ $alt }}">
    <span class="media-placeholder-letter">{{ $initial }}</span>
</div>
