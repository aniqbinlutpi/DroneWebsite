<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index(): View
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display products by category
     */
    public function category($slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $products = Product::with('category')
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('products.category', compact('products', 'categories', 'category'));
    }

    /**
     * Display the specified product
     */
    public function show($slug): View
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Add product to cart (requires authentication)
     */
    public function addToCart(Request $request, Product $product)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('message', 'Please login to purchase products');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        // Check stock availability
        if ($product->stock_quantity < $request->quantity) {
            return back()->with('error', 'Insufficient stock available');
        }

        // Add to cart logic (you can implement cart session or database)
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->sale_price ?? $product->price,
                'quantity' => $request->quantity,
                'image' => $product->featured_image
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Show cart
     */
    public function cart(): View
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('products.cart', compact('cart', 'total'));
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed from cart');
    }
}
