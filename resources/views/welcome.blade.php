<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DroneHub - Premium Drones & Racing Lessons</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="antialiased bg-black text-white overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="text-2xl font-bold text-white">
                        <span class="text-blue-500">Drone</span>Hub
                    </div>
                </div>
                
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors">Camera Drones</a>
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors">Racing Drones</a>
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors">Courses</a>
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors">Support</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
            @if (Route::has('login'))
                    @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Dashboard</a>
                    @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Login</a>
                        @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Register</a>
                        @endif
                    @endauth
                    @endif
                </div>
            </div>
        </div>
                </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 to-purple-900/20"></div>
        <div class="absolute inset-0 bg-black/40"></div>
        
        <!-- Background Video/Image Placeholder -->
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-blue-900 to-purple-900"></div>
        
        <div class="relative z-10 text-center max-w-4xl mx-auto px-4 py-20">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                Master the Sky
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl text-gray-300 mb-8 max-w-2xl mx-auto leading-relaxed">
                Premium drones for professionals and racing lessons for the next generation of pilots
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md sm:max-w-none mx-auto">
                <a href="{{ route('products.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold transition-all transform hover:scale-105">
                    Shop Drones
                </a>
                <a href="{{ route('courses.index') }}" class="border border-white/30 hover:bg-white/10 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold transition-all">
                    Book Lessons
                </a>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 sm:py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Featured Products</h2>
                <p class="text-gray-400 text-base sm:text-lg">Discover our premium drone collection</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @php
                    $featuredProducts = \App\Models\Product::where('featured', true)
                        ->where('is_active', true)
                        ->with('category')
                        ->limit(3)
                        ->get();
                @endphp
                
                @forelse($featuredProducts as $product)
                    <div class="bg-gray-800 rounded-2xl overflow-hidden hover:transform hover:scale-105 transition-all duration-300 group">
                        <div class="aspect-w-16 aspect-h-12 h-48 relative">
                            @if($product->featured_image)
                                <img src="{{ $product->featured_image }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 sm:p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs sm:text-sm text-blue-400 font-medium">{{ $product->category->name ?? 'Drone' }}</span>
                                <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full font-bold">FEATURED</span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-semibold text-white mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $product->short_description }}</p>
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                                <div>
                                    @if($product->sale_price)
                                        <span class="text-xl sm:text-2xl font-bold text-green-400">RM {{ number_format($product->sale_price, 2) }}</span>
                                        <span class="text-gray-500 line-through text-sm ml-2">RM {{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="text-xl sm:text-2xl font-bold text-white">RM {{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-blue-400 hover:text-blue-300 px-3 py-2 border border-blue-400 rounded-lg transition-colors text-center text-sm">
                                        Learn More
                                    </a>
                                    @auth
                                        @if($product->stock_quantity > 0)
                                            <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition-colors text-sm">
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="w-full bg-gray-600 text-gray-400 px-3 py-2 rounded-lg cursor-not-allowed text-sm">
                                                Out of Stock
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition-colors text-center text-sm">
                                            Login to Buy
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback products if no featured products exist -->
                    <div class="bg-gray-800 rounded-2xl overflow-hidden hover:transform hover:scale-105 transition-all duration-300 group">
                        <div class="aspect-w-16 aspect-h-12 h-48 bg-gradient-to-br from-blue-500 to-purple-600 relative">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-white text-4xl sm:text-6xl">🚁</div>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6">
                            <h3 class="text-lg sm:text-xl font-semibold text-white mb-2">AeroMax Pro 4K</h3>
                            <p class="text-gray-400 text-sm mb-4">Professional camera drone with 4K recording</p>
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                                <span class="text-xl sm:text-2xl font-bold text-blue-400">RM 1,299</span>
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('products.index') }}" class="text-blue-400 hover:text-blue-300 px-3 py-2 border border-blue-400 rounded-lg transition-colors text-center text-sm">
                                        Learn More
                                    </a>
                                    <a href="{{ route('products.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition-colors text-center text-sm">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-8 sm:mt-12">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    View All Products
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="py-20 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Drone Racing Courses</h2>
                <p class="text-gray-400 text-lg">Learn from the best instructors in the industry</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Course Card 1 -->
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-2xl p-8 hover:transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-2xl">
                            🎯
                        </div>
                        <div class="ml-4">
                            <h3 class="text-2xl font-semibold text-white">Beginner Course</h3>
                            <p class="text-gray-400">Perfect for primary school students</p>
                        </div>
                    </div>
                    <ul class="text-gray-300 space-y-2 mb-6">
                        <li>• Basic drone operation and safety</li>
                        <li>• Simple racing techniques</li>
                        <li>• 4-hour comprehensive training</li>
                        <li>• Certificate of completion</li>
                    </ul>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-blue-400">RM 149</span>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                            Book Now
                        </button>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-2xl p-8 hover:transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-2xl">
                            🏆
                        </div>
                        <div class="ml-4">
                            <h3 class="text-2xl font-semibold text-white">Advanced Racing</h3>
                            <p class="text-gray-400">For experienced young pilots</p>
                        </div>
                    </div>
                    <ul class="text-gray-300 space-y-2 mb-6">
                        <li>• Advanced racing strategies</li>
                        <li>• Competition preparation</li>
                        <li>• 6-hour intensive training</li>
                        <li>• Racing drone provided</li>
                    </ul>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-green-400">RM 249</span>
                        <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-purple-900">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white mb-4">Stay Updated</h2>
            <p class="text-blue-100 mb-8">Get the latest news about new products and course schedules</p>
            <div class="flex flex-col sm:flex-row max-w-md mx-auto">
                <input type="email" placeholder="Enter your email" 
                       class="flex-1 px-4 py-3 rounded-l-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-r-lg font-semibold transition-colors">
                    Subscribe
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="text-2xl font-bold text-white mb-4">
                        <span class="text-blue-500">Drone</span>Hub
                    </div>
                    <p class="text-gray-400">Premium drones and professional racing instruction for the next generation.</p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Products</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Camera Drones</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Racing Drones</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Accessories</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Courses</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Beginner Course</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Advanced Racing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Private Lessons</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Warranty</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 DroneHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Add smooth scrolling and interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
    </body>
</html>
