<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Manage Products') }}
            </h2>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Product
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-600 border border-green-500 text-white px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Products Table -->
            <div class="bg-gray-800/50 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-xl border border-gray-700">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">Products</h3>
                        <div class="mt-4 sm:mt-0 text-sm text-gray-400">
                            Total: {{ $products->total() }} products
                        </div>
                    </div>

                    @if($products->count() > 0)
                        <!-- Desktop Table -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Product</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Stock</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    @foreach($products as $product)
                                        <tr class="hover:bg-gray-700/30 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-12 w-12">
                                                        @if($product->featured_image)
                                                            <img class="h-12 w-12 rounded-lg object-cover" src="{{ $product->featured_image }}" alt="{{ $product->name }}">
                                                        @else
                                                            <div class="h-12 w-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-white">{{ $product->name }}</div>
                                                        <div class="text-sm text-gray-400">{{ Str::limit($product->short_description, 50) }}</div>
                                                        @if($product->featured)
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-500 text-black mt-1">
                                                                Featured
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-300">{{ $product->category->name ?? 'N/A' }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-white">
                                                    @if($product->sale_price)
                                                        <span class="text-lg font-bold text-green-400">RM {{ number_format($product->sale_price, 2) }}</span>
                                                        <span class="text-gray-500 line-through ml-2">RM {{ number_format($product->price, 2) }}</span>
                                                    @else
                                                        <span class="text-lg font-bold text-white">RM {{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm {{ $product->stock_quantity > 0 ? 'text-green-400' : 'text-red-400' }}">
                                                    {{ $product->stock_quantity }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="lg:hidden space-y-4">
                            @foreach($products as $product)
                                <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($product->featured_image)
                                                    <img class="h-10 w-10 rounded-lg object-cover" src="{{ $product->featured_image }}" alt="{{ $product->name }}">
                                                @else
                                                    <div class="h-10 w-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-white">{{ $product->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $product->category->name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if($product->featured)
                                                <span class="px-2 py-1 text-xs bg-yellow-500 text-black rounded-full font-medium">Featured</span>
                                            @endif
                                            <span class="px-2 py-1 text-xs rounded-full font-medium {{ $product->is_active ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4 mb-3">
                                        <div>
                                            <p class="text-xs text-gray-400">Price</p>
                                            <p class="text-sm text-white">
                                                @if($product->sale_price)
                                                    <span class="text-lg font-bold text-green-400">RM {{ number_format($product->sale_price, 2) }}</span>
                                                    <span class="text-gray-500 line-through ml-2">RM {{ number_format($product->price, 2) }}</span>
                                                @else
                                                    <span class="text-lg font-bold text-white">RM {{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400">Stock</p>
                                            <p class="text-sm {{ $product->stock_quantity > 0 ? 'text-green-400' : 'text-red-400' }}">
                                                {{ $product->stock_quantity }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 text-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 text-lg mb-4">No products found</div>
                            <p class="text-gray-500 mb-6">Start by adding your first drone product.</p>
                            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add First Product
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 