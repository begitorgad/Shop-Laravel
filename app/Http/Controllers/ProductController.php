<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Scopes\ActiveScope;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category','tags','image')
                             ->orderBy('name')
                             ->paginate(15);
        $inactiveProducts = Product::with('category', 'tags', 'image')
                                    ->withoutGlobalScope(ActiveScope::class)
                                    ->where('active',0)
                                    ->orderBy('name')
                                    ->paginate(15);

        return view('products.index', compact('products','inactiveProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        $data = $request->validated();
                
        $data['active'] = $request->boolean('active');

        try {

            $product = Product::create($data);

            if($request->filled('tags')) {
                $product->tags()->sync($request->input('tags'));
            }
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('products', 'public');
                $product->image()->create(['path' => $path]);
            }

            return redirect()
                ->route('products.index')
                ->with('success', 'Product created successfully.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Product creation failed.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("products.edit", compact("product","categories","tags"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $data['active'] = $request->boolean('active');

        // update product (slug handled automatically by your mutator)
        $product->update($data);

        if ($request->hasFile('image')) {
            // delete old file + old row
            if ($product->image) {
                Storage::disk('public')->delete($product->image->path);
                $product->image()->delete();
            }

            $path = $request->file('image')->store('products', 'public');
            $product->image()->create(['path' => $path]);
        }

        $product->tags()->sync($request->input('tags', []));
        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
