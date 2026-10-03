<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::active()
            ->ordered()
            ->withCount(['products as active_products_count' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();

        return view('categories.index', compact('categories'));
    }
}
