<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of products for admin
     */
    public function index(): View
    {
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create(): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string',
            'battery_life' => 'nullable|integer|min:0',
            'camera_resolution' => 'nullable|string',
            'max_speed' => 'nullable|integer|min:0',
            'max_range' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image');
            $featuredImageName = time() . '_featured_' . Str::random(10) . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImagePath = $featuredImage->storeAs('products', $featuredImageName, 'public');
            $validated['featured_image'] = '/storage/' . $featuredImagePath;
        }

        // Handle multiple images upload
        $imagesPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('products', $imageName, 'public');
                $imagesPaths[] = '/storage/' . $imagePath;
            }
            $validated['images'] = json_encode($imagesPaths);
        }

        // Set stock status
        $validated['in_stock'] = $validated['stock_quantity'] > 0;
        $validated['manage_stock'] = true;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing a product
     */
    public function edit(Product $product): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string',
            'battery_life' => 'nullable|integer|min:0',
            'camera_resolution' => 'nullable|string',
            'max_speed' => 'nullable|integer|min:0',
            'max_range' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'remove_featured_image' => 'boolean',
        ]);

        // Update slug if name changed
        if ($validated['name'] !== $product->name) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Ensure unique slug
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Product::where('slug', $validated['slug'])->where('id', '!=', $product->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle featured image removal
        if ($request->has('remove_featured_image') && $request->remove_featured_image) {
            if ($product->featured_image && Storage::disk('public')->exists(str_replace('/storage/', '', $product->featured_image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->featured_image));
            }
            $validated['featured_image'] = null;
        }

        // Handle new featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($product->featured_image && Storage::disk('public')->exists(str_replace('/storage/', '', $product->featured_image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->featured_image));
            }
            
            $featuredImage = $request->file('featured_image');
            $featuredImageName = time() . '_featured_' . Str::random(10) . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImagePath = $featuredImage->storeAs('products', $featuredImageName, 'public');
            $validated['featured_image'] = '/storage/' . $featuredImagePath;
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $imagesPaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('products', $imageName, 'public');
                $imagesPaths[] = '/storage/' . $imagePath;
            }
            
            // Merge with existing images if any
            $existingImages = $product->images ? json_decode($product->images, true) : [];
            $allImages = array_merge($existingImages, $imagesPaths);
            $validated['images'] = json_encode($allImages);
        }

        // Set stock status
        $validated['in_stock'] = $validated['stock_quantity'] > 0;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Delete associated images
        if ($product->featured_image && Storage::disk('public')->exists(str_replace('/storage/', '', $product->featured_image))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->featured_image));
        }

        if ($product->images) {
            $images = json_decode($product->images, true);
            foreach ($images as $image) {
                if (Storage::disk('public')->exists(str_replace('/storage/', '', $image))) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $image));
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
} 