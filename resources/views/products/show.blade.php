<x-app-layout>
    <div class="min-h-screen bg-gray-900">
        <!-- Product Detail Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <div class="flex items-center space-x-2 text-sm text-gray-400">
                    <a href="{{ route('products.index') }}" class="hover:text-blue-400 transition-colors duration-200">Products</a>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('products.category', $product->category->slug) }}" class="hover:text-blue-400 transition-colors duration-200">{{ $product->category->name }}</a>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-white font-medium">{{ $product->name }}</span>
                </div>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                <!-- Product Images -->
                <div class="space-y-4">
                    <!-- Main Image Container -->
                    <div class="relative bg-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                        <div class="aspect-w-1 aspect-h-1">
                            @if($product->featured_image)
                                <img id="mainImage" 
                                     src="{{ $product->featured_image }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-96 sm:h-[500px] object-cover cursor-zoom-in transition-transform duration-300 hover:scale-105"
                                     onclick="openImageModal('{{ $product->featured_image }}')">
                            @else
                                <div class="w-full h-96 sm:h-[500px] bg-gradient-to-br from-blue-500 via-purple-600 to-pink-500 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-24 h-24 text-white mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        <p class="text-white text-lg font-medium">{{ $product->name }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Image Overlay Info -->
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                            @if($product->is_featured)
                                <span class="bg-yellow-500 text-black text-xs px-3 py-1 rounded-full font-bold shadow-lg">FEATURED</span>
                            @endif
                            @if($product->sale_price)
                                <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full font-bold shadow-lg">
                                    {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                                </span>
                            @endif
                        </div>

                        <!-- Zoom Icon -->
                        @if($product->featured_image)
                            <div class="absolute top-4 right-4">
                                <button onclick="openImageModal('{{ $product->featured_image }}')" 
                                        class="bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-2 rounded-full transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Image Gallery Thumbnails -->
                    @if($product->images)
                        @php $images = json_decode($product->images, true) @endphp
                        @if($images && count($images) > 0)
                            <div class="grid grid-cols-4 sm:grid-cols-5 gap-2">
                                @if($product->featured_image)
                                    <button onclick="changeMainImage('{{ $product->featured_image }}')" 
                                            class="thumbnail-btn aspect-w-1 aspect-h-1 bg-gray-800 rounded-lg overflow-hidden border-2 border-blue-500 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                                        <img src="{{ $product->featured_image }}" alt="Featured" class="w-full h-20 object-cover">
                                    </button>
                                @endif
                                @foreach($images as $index => $image)
                                    <button onclick="changeMainImage('{{ $image }}')" 
                                            class="thumbnail-btn aspect-w-1 aspect-h-1 bg-gray-800 rounded-lg overflow-hidden border-2 border-transparent hover:border-blue-400 transition-all duration-200 hover:scale-105 shadow-lg hover:shadow-xl">
                                        <img src="{{ $image }}" alt="Product Image {{ $index + 1 }}" class="w-full h-20 object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <!-- Category Badge -->
                    <div class="flex items-center gap-3">
                        <span class="bg-blue-600 text-white text-sm px-4 py-2 rounded-full font-semibold">{{ $product->category->name }}</span>
                    </div>

                    <!-- Product Name -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">{{ $product->name }}</h1>

                    <!-- Short Description -->
                    @if($product->short_description)
                        <p class="text-xl text-gray-300 leading-relaxed">{{ $product->short_description }}</p>
                    @endif

                    <!-- Price Section -->
                    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                        <div class="flex items-center gap-4 mb-2">
                            @if($product->sale_price)
                                <span class="text-4xl font-bold text-green-400">RM {{ number_format($product->sale_price, 2) }}</span>
                                <span class="text-2xl text-gray-500 line-through">RM {{ number_format($product->price, 2) }}</span>
                            @else
                                <span class="text-4xl font-bold text-white">RM {{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        @if($product->sale_price)
                            <p class="text-green-400 text-sm font-medium">
                                You save RM {{ number_format($product->price - $product->sale_price, 2) }}
                            </p>
                        @endif
                    </div>

                    <!-- Stock Status -->
                    <div class="flex items-center gap-3 bg-gray-800 rounded-xl p-4 border border-gray-700">
                        @if($product->stock_quantity > 0)
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                <span class="text-green-400 font-semibold">In Stock</span>
                            </div>
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-300">{{ $product->stock_quantity }} available</span>
                        @else
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                <span class="text-red-400 font-semibold">Out of Stock</span>
                            </div>
                        @endif
                    </div>

                    <!-- Add to Cart Section -->
                    @auth
                        @if($product->stock_quantity > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <label for="quantity" class="text-gray-300 font-medium">Quantity:</label>
                                    <select name="quantity" id="quantity" 
                                            class="bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-4 px-8 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6H19"></path>
                                    </svg>
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-600 text-gray-400 py-4 px-8 rounded-xl cursor-not-allowed font-semibold text-lg">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Out of Stock
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-4 px-8 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl text-center block">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login to Purchase
                        </a>
                    @endauth

                    <!-- Quick Specs -->
                    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                        <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Quick Specs
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            @if($product->sku)
                                <div class="flex justify-between items-center p-3 bg-gray-700 rounded-lg">
                                    <span class="text-gray-400">SKU:</span>
                                    <span class="text-white font-medium">{{ $product->sku }}</span>
                                </div>
                            @endif
                            @if($product->weight)
                                <div class="flex justify-between items-center p-3 bg-gray-700 rounded-lg">
                                    <span class="text-gray-400">Weight:</span>
                                    <span class="text-white font-medium">{{ $product->weight }}g</span>
                                </div>
                            @endif
                            @if($product->dimensions)
                                <div class="flex justify-between items-center p-3 bg-gray-700 rounded-lg">
                                    <span class="text-gray-400">Dimensions:</span>
                                    <span class="text-white font-medium">{{ $product->dimensions }}</span>
                                </div>
                            @endif
                            @if($product->battery_life)
                                <div class="flex justify-between items-center p-3 bg-gray-700 rounded-lg">
                                    <span class="text-gray-400">Battery Life:</span>
                                    <span class="text-white font-medium">{{ $product->battery_life }} min</span>
                                </div>
                            @endif
                            @if($product->camera_resolution)
                                <div class="flex justify-between items-center p-3 bg-gray-700 rounded-lg">
                                    <span class="text-gray-400">Camera:</span>
                                    <span class="text-white font-medium">{{ $product->camera_resolution }}</span>
                                </div>
                            @endif
                            @if($product->max_speed)
                                <div class="flex justify-between items-center p-3 bg-gray-700 rounded-lg">
                                    <span class="text-gray-400">Max Speed:</span>
                                    <span class="text-white font-medium">{{ $product->max_speed }} km/h</span>
                                </div>
                            @endif
                            @if($product->max_range)
                                <div class="flex justify-between items-center p-3 bg-gray-700 rounded-lg">
                                    <span class="text-gray-400">Max Range:</span>
                                    <span class="text-white font-medium">{{ number_format($product->max_range) }}m</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabbed Content Section -->
            <div class="mb-16">
                <div class="border-b border-gray-700">
                    <nav class="-mb-px flex space-x-8">
                        <button onclick="showTab('description')" 
                                class="tab-btn active border-b-2 border-blue-500 py-4 px-1 text-blue-400 font-semibold text-lg">
                            Description
                        </button>
                        @if($product->specifications)
                            <button onclick="showTab('specifications')" 
                                    class="tab-btn border-b-2 border-transparent py-4 px-1 text-gray-400 hover:text-white font-semibold text-lg transition-colors duration-200">
                                Specifications
                            </button>
                        @endif
                    </nav>
                </div>

                <div class="mt-8">
                    <!-- Description Tab -->
                    <div id="description-tab" class="tab-content bg-gray-800 rounded-xl p-8 border border-gray-700">
                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Product Description
                        </h2>
                        <div class="text-gray-300 leading-relaxed text-lg">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    <!-- Specifications Tab -->
                    @if($product->specifications)
                        <div id="specifications-tab" class="tab-content hidden bg-gray-800 rounded-xl p-8 border border-gray-700">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h2m-2 0v-6m2 6V9a2 2 0 012-2h2a2 2 0 012 2v6a2 2 0 01-2 2h-2m-6 0V7a2 2 0 012-2h2a2 2 0 012 2v2"></path>
                                </svg>
                                Technical Specifications
                            </h2>
                            <div class="text-gray-300 leading-relaxed text-lg">
                                {!! nl2br(e($product->specifications)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-white mb-8 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Related Products
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 border border-gray-700 hover:border-blue-500">
                                <div class="aspect-w-16 aspect-h-12 bg-gray-700">
                                    @if($relatedProduct->featured_image)
                                        <img src="{{ $relatedProduct->featured_image }}" 
                                             alt="{{ $relatedProduct->name }}" 
                                             class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-white mb-3 line-clamp-2">{{ $relatedProduct->name }}</h3>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            @if($relatedProduct->sale_price)
                                                <span class="text-xl font-bold text-green-400">RM {{ number_format($relatedProduct->sale_price, 2) }}</span>
                                                <span class="text-sm text-gray-500 line-through block">RM {{ number_format($relatedProduct->price, 2) }}</span>
                                            @else
                                                <span class="text-xl font-bold text-white">RM {{ number_format($relatedProduct->price, 2) }}</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:scale-105">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()" 
                    class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Product Image" class="max-w-full max-h-full object-contain rounded-lg">
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Image gallery functionality
        function changeMainImage(imageSrc) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = imageSrc;
            
            // Update active border on thumbnails
            document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                btn.classList.remove('border-blue-500');
                btn.classList.add('border-transparent');
            });
            
            event.target.closest('button').classList.remove('border-transparent');
            event.target.closest('button').classList.add('border-blue-500');
        }

        // Image modal functionality
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Tab functionality
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-blue-500', 'text-blue-400');
                btn.classList.add('border-transparent', 'text-gray-400');
            });
            
            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.remove('hidden');
            
            // Add active class to selected tab
            event.target.classList.add('active', 'border-blue-500', 'text-blue-400');
            event.target.classList.remove('border-transparent', 'text-gray-400');
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });

        // Close modal on background click
        document.getElementById('imageModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeImageModal();
            }
        });

        // Add loading animation for images
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.classList.add('loaded');
                });
            });
        });
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        img {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        img.loaded {
            opacity: 1;
        }
        
        .tab-btn.active {
            border-color: #3b82f6 !important;
            color: #60a5fa !important;
        }
    </style>
</x-app-layout> 