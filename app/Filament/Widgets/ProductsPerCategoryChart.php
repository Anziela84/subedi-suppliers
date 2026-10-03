<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ProductsPerCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Products per Category';
    protected ?string $description = 'Number of products in each category';
    protected string $color = 'primary';
    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Products',
                    'data' => $categories->pluck('products_count')->toArray(),
                    'backgroundColor' => '#0047AB',
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }
}
