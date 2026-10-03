<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredProducts = Product::with(['category' => function ($query) {
            $query->active();
        }])
            ->active()
            ->featured()
            ->ordered()
            ->take(10)
            ->get();

        if ($featuredProducts->count() < 4) {
            $featuredProducts = Product::with(['category' => function ($query) {
                $query->active();
            }])
                ->active()
                ->ordered()
                ->take(10)
                ->get();
        }

        $categories = Category::active()
            ->ordered()
            ->withCount('products')
            ->get();

        return view('home', compact('featuredProducts', 'categories'));
    }
}
