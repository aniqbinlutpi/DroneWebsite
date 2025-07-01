<x-app-layout>
    <div class="min-h-screen bg-gray-900 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Edit Product</h1>
                        <p class="text-gray-400 mt-2">Update {{ $product->name }}</p>
                    </div>
                    <a href="{{ route('admin.products.index') }}" 
                       class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        ← Back to Products
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Product Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Product Name *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $product->name) }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter product name"
                                   required>
                            @error('name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SKU -->
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-300 mb-2">SKU *</label>
                            <input type="text" 
                                   id="sku" 
                                   name="sku" 
                                   value="{{ old('sku', $product->sku) }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g., DRONE-001"
                                   required>
                            @error('sku')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Category *</label>
                            <select id="category_id" 
                                    name="category_id" 
                                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stock Quantity -->
                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-300 mb-2">Stock Quantity *</label>
                            <input type="number" 
                                   id="stock_quantity" 
                                   name="stock_quantity" 
                                   value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                   min="0"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                            @error('stock_quantity')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Regular Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Regular Price (RM) *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-400">RM</span>
                                <input type="number" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price', $product->price) }}"
                                       step="0.01"
                                       min="0"
                                       class="w-full bg-gray-700 border border-gray-600 rounded-lg pl-12 pr-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="0.00"
                                       required>
                            </div>
                            @error('price')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sale Price -->
                        <div>
                            <label for="sale_price" class="block text-sm font-medium text-gray-300 mb-2">Sale Price (RM)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-400">RM</span>
                                <input type="number" 
                                       id="sale_price" 
                                       name="sale_price" 
                                       value="{{ old('sale_price', $product->sale_price) }}"
                                       step="0.01"
                                       min="0"
                                       class="w-full bg-gray-700 border border-gray-600 rounded-lg pl-12 pr-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="0.00">
                            </div>
                            <p class="text-gray-400 text-xs mt-1">Leave empty if no sale price</p>
                            @error('sale_price')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Current Images -->
                    @if($product->featured_image || $product->images)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-white">Current Images</h3>
                            
                            @if($product->featured_image)
                                <div class="bg-gray-700 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-gray-300">Featured Image</span>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="remove_featured_image" value="1" class="mr-2">
                                            <span class="text-sm text-red-400">Remove</span>
                                        </label>
                                    </div>
                                    <img src="{{ $product->featured_image }}" alt="Featured" class="w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif

                            @if($product->images)
                                @php $images = json_decode($product->images, true) @endphp
                                @if($images)
                                    <div class="bg-gray-700 rounded-lg p-4">
                                        <span class="text-sm text-gray-300 block mb-2">Additional Images</span>
                                        <div class="grid grid-cols-4 gap-2">
                                            @foreach($images as $image)
                                                <img src="{{ $image }}" alt="Product Image" class="w-full h-20 object-cover rounded">
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endif

                    <!-- Images -->
                    <div class="space-y-6">
                        <!-- Featured Image -->
                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-300 mb-2">New Featured Image</label>
                            <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-gray-500 transition-colors">
                                <input type="file" 
                                       id="featured_image" 
                                       name="featured_image" 
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewFeaturedImage(this)">
                                <div id="featured_preview" class="hidden mb-4">
                                    <img id="featured_preview_img" class="max-w-xs mx-auto rounded-lg shadow-lg">
                                </div>
                                <div class="text-gray-400">
                                    <svg class="mx-auto h-12 w-12 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <p class="text-sm">Click to upload new featured image</p>
                                    <p class="text-xs mt-1">PNG, JPG, GIF up to 2MB</p>
                                </div>
                                <button type="button" 
                                        onclick="document.getElementById('featured_image').click()"
                                        class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Choose File
                                </button>
                            </div>
                            @error('featured_image')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Images -->
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-300 mb-2">Add More Images</label>
                            <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-gray-500 transition-colors">
                                <input type="file" 
                                       id="images" 
                                       name="images[]" 
                                       accept="image/*"
                                       multiple
                                       class="hidden"
                                       onchange="previewImages(this)">
                                <div id="images_preview" class="hidden mb-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                                <div class="text-gray-400">
                                    <svg class="mx-auto h-12 w-12 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <p class="text-sm">Click to upload additional images</p>
                                    <p class="text-xs mt-1">Multiple files allowed • PNG, JPG, GIF up to 2MB each</p>
                                </div>
                                <button type="button" 
                                        onclick="document.getElementById('images').click()"
                                        class="mt-4 bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition-colors">
                                    Choose Files
                                </button>
                            </div>
                            @error('images.*')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Descriptions -->
                    <div class="space-y-6">
                        <!-- Short Description -->
                        <div>
                            <label for="short_description" class="block text-sm font-medium text-gray-300 mb-2">Short Description</label>
                            <textarea id="short_description" 
                                      name="short_description" 
                                      rows="3"
                                      class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Brief product description for listings">{{ old('short_description', $product->short_description) }}</textarea>
                            @error('short_description')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Full Description *</label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="6"
                                      class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Detailed product description"
                                      required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Specifications -->
                        <div>
                            <label for="specifications" class="block text-sm font-medium text-gray-300 mb-2">Technical Specifications</label>
                            <textarea id="specifications" 
                                      name="specifications" 
                                      rows="4"
                                      class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Technical specifications (one per line)">{{ old('specifications', $product->specifications) }}</textarea>
                            @error('specifications')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Technical Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Weight -->
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-300 mb-2">Weight (g)</label>
                            <input type="number" 
                                   id="weight" 
                                   name="weight" 
                                   value="{{ old('weight', $product->weight) }}"
                                   step="0.1"
                                   min="0"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0.0">
                            @error('weight')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dimensions -->
                        <div>
                            <label for="dimensions" class="block text-sm font-medium text-gray-300 mb-2">Dimensions</label>
                            <input type="text" 
                                   id="dimensions" 
                                   name="dimensions" 
                                   value="{{ old('dimensions', $product->dimensions) }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="L x W x H (cm)">
                            @error('dimensions')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Battery Life -->
                        <div>
                            <label for="battery_life" class="block text-sm font-medium text-gray-300 mb-2">Battery Life (min)</label>
                            <input type="number" 
                                   id="battery_life" 
                                   name="battery_life" 
                                   value="{{ old('battery_life', $product->battery_life) }}"
                                   min="0"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0">
                            @error('battery_life')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Camera Resolution -->
                        <div>
                            <label for="camera_resolution" class="block text-sm font-medium text-gray-300 mb-2">Camera Resolution</label>
                            <input type="text" 
                                   id="camera_resolution" 
                                   name="camera_resolution" 
                                   value="{{ old('camera_resolution', $product->camera_resolution) }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g., 4K, 1080p">
                            @error('camera_resolution')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Max Speed -->
                        <div>
                            <label for="max_speed" class="block text-sm font-medium text-gray-300 mb-2">Max Speed (km/h)</label>
                            <input type="number" 
                                   id="max_speed" 
                                   name="max_speed" 
                                   value="{{ old('max_speed', $product->max_speed) }}"
                                   min="0"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0">
                            @error('max_speed')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Max Range -->
                        <div>
                            <label for="max_range" class="block text-sm font-medium text-gray-300 mb-2">Max Range (m)</label>
                            <input type="number" 
                                   id="max_range" 
                                   name="max_range" 
                                   value="{{ old('max_range', $product->max_range) }}"
                                   min="0"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0">
                            @error('max_range')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status Options -->
                    <div class="flex flex-wrap gap-6">
                        <!-- Featured Product -->
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   value="1"
                                   {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="is_featured" class="ml-2 text-sm text-gray-300">Featured Product</label>
                        </div>

                        <!-- Active Status -->
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="is_active" class="ml-2 text-sm text-gray-300">Active (Visible to customers)</label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-700">
                        <button type="submit" 
                                class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                            Update Product
                        </button>
                        <a href="{{ route('admin.products.index') }}" 
                           class="bg-gray-600 text-white px-8 py-3 rounded-lg hover:bg-gray-500 transition-colors text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Image Previews -->
    <script>
        function previewFeaturedImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('featured_preview').classList.remove('hidden');
                    document.getElementById('featured_preview_img').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewImages(input) {
            const preview = document.getElementById('images_preview');
            preview.innerHTML = '';
            
            if (input.files) {
                preview.classList.remove('hidden');
                for (let i = 0; i < input.files.length; i++) {
                    const file = input.files[i];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-24 object-cover rounded-lg shadow-lg';
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
</x-app-layout> 