<x-app-layout>
    <div class="min-h-screen bg-gray-900">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl font-bold text-white mb-6">Premium Drones</h1>
                <p class="text-xl text-gray-300 mb-8">Professional racing drones for competition and training</p>
            </div>
        </div>

        <!-- Categories Filter -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-wrap gap-4 mb-8">
                <a href="{{ route('products.index') }}" 
                   class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                    All Products
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('products.category', $category->slug) }}" 
                       class="px-6 py-2 bg-gray-700 text-white rounded-full hover:bg-gray-600 transition-colors">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($products as $product)
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <!-- Product Image -->
                        <div class="aspect-w-16 aspect-h-12 bg-gray-700">
                            @if($product->featured_image)
                                <img src="{{ $product->featured_image }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-blue-400 font-medium">{{ $product->category->name ?? 'Drone' }}</span>
                                @if($product->is_featured)
                                    <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full font-bold">FEATURED</span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-white mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $product->short_description }}</p>
                            
                            <!-- Price -->
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    @if($product->sale_price)
                                        <span class="text-2xl font-bold text-green-400">RM {{ number_format($product->sale_price, 2) }}</span>
                                        <span class="text-gray-500 line-through ml-2">RM {{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="text-2xl font-bold text-white">RM {{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-400">Stock</div>
                                    <div class="text-white font-semibold">{{ $product->stock_quantity }}</div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-2">
                                <a href="{{ route('products.show', $product->slug) }}" 
                                   class="w-full bg-gray-700 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition-colors text-center block">
                                    View Details
                                </a>
                                
                                @auth
                                    @if($product->stock_quantity > 0)
                                        <form action="{{ route('cart.add', $product) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" 
                                                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="w-full bg-gray-600 text-gray-400 py-2 px-4 rounded-lg cursor-not-allowed">
                                            Out of Stock
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-center block font-semibold">
                                        Login to Purchase
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="text-gray-400 text-xl mb-4">No products found</div>
                        <p class="text-gray-500">Check back soon for new drone arrivals!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gray-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-white mb-4">Why Choose Our Drones?</h2>
                    <p class="text-gray-400 text-lg">Professional racing drones designed for competition and training</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">High Performance</h3>
                        <p class="text-gray-400">Optimized for speed and agility in competitive racing</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Educational Focus</h3>
                        <p class="text-gray-400">Perfect for learning block programming and STEM education</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Quality Guaranteed</h3>
                        <p class="text-gray-400">Professional-grade components with full warranty support</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 