<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;


class CategoryStatsController extends Controller
{
    public function index(){
    $categories = Category::withCount('products')
                            ->withSum('products','stock')
                            ->withAvg('products', 'price')
                            ->get();

    $rows = DB::table('categories')
        ->join('products', 'products.category_id', '=', 'categories.id')
        ->join('product_tag', 'product_tag.product_id', '=', 'products.id')
        ->join('tags', 'tags.id', '=', 'product_tag.tag_id')
        ->groupBy('categories.id', 'categories.name', 'tags.id', 'tags.name')
        ->select(
            'categories.id as category_id',
            'categories.name as category_name',
            'tags.id as tag_id',
            'tags.name as tag_name',
            DB::raw('COUNT(*) as total')
        )
        ->orderBy('tags.name')
        ->get();

    $tagsPerCategory = $rows
        ->groupBy('category_id')
        ->map(fn ($items) => $items->take(5));

    return view("categories-stats.index",compact("categories", 'tagsPerCategory'));
    }
}
