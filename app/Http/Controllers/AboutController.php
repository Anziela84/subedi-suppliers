<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        $categories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->withCount('products')
            ->get();

        return view('about', [
            'about' => config('about'),
            'categories' => $categories,
        ]);
    }
}
