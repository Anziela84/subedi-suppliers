<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with(['category' => function ($query) {
            $query->active();
        }])->active();

        if ($request->filled('category')) {
            $category = Category::where('slug', $request->query('category'))->active()->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->filled('q')) {
            $search = trim($request->query('q'));
            $search = mb_substr($search, 0, 80);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->query('sort', 'featured');
        if ($sort === 'newest') {
            $query->orderByDesc('created_at');
        } elseif ($sort === 'name') {
            $query->orderBy('name');
        } else {
            $query->orderByDesc('is_featured')
                  ->orderBy('sort_order')
                  ->orderByDesc('created_at');
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::active()->ordered()->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(string $slug): View
    {
        $product = Product::with('category')->where('slug', $slug)->first();

        if (! $product || ! $product->is_active || ! $product->category || ! $product->category->is_active) {
            abort(404);
        }

        $related = Product::with('category')
            ->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->ordered()
            ->limit(4)
            ->get();

        if ($related->count() < 4) {
            $existingIds = $related->pluck('id')->push($product->id)->all();

            $topup = Product::with('category')
                ->active()
                ->whereHas('category', function ($q) {
                    $q->active();
                })
                ->whereNotIn('id', $existingIds)
                ->orderByDesc('is_featured')
                ->ordered()
                ->limit(4 - $related->count())
                ->get();

            $related = $related->concat($topup);
        }

        return view('products.show', compact('product', 'related'));
    }
}
