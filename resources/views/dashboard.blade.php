<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            @if(Auth::user()->role === 'admin')
                {{ __('Admin Dashboard') }}
            @else
                {{ __('Customer Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->role === 'admin')
                <!-- Admin Dashboard -->
                <div class="bg-gray-800/50 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-xl mb-6 border border-gray-700">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">Welcome, Admin!</h3>
                                <p class="text-gray-300">Manage your drone business from here.</p>
                            </div>
                            <div class="text-6xl">👨‍💼</div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-xl hover:scale-105 transition-transform duration-300 group">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-3xl">📦</div>
                                    <div class="text-blue-200 group-hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-bold text-lg text-white mb-2">Products</h4>
                                <p class="text-blue-100 text-sm mb-4">Manage drone inventory</p>
                                <a href="{{ route('admin.products.index') }}" class="text-blue-100 hover:text-white text-sm font-medium transition-colors">
                                    Manage Products →
                                </a>
                            </div>
                            
                            <div class="bg-gradient-to-br from-green-600 to-green-700 p-6 rounded-xl hover:scale-105 transition-transform duration-300 group">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-3xl">🎓</div>
                                    <div class="text-green-200 group-hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-bold text-lg text-white mb-2">Courses</h4>
                                <p class="text-green-100 text-sm mb-4">Manage racing courses</p>
                                <a href="{{ route('admin.courses.index') }}" class="text-green-100 hover:text-white text-sm font-medium transition-colors">
                                    Manage Courses →
                                </a>
                            </div>
                            
                            <div class="bg-gradient-to-br from-purple-600 to-purple-700 p-6 rounded-xl hover:scale-105 transition-transform duration-300 group sm:col-span-2 lg:col-span-1">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-3xl">📅</div>
                                    <div class="text-purple-200 group-hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-bold text-lg text-white mb-2">Bookings</h4>
                                <p class="text-purple-100 text-sm mb-4">Manage student bookings</p>
                                <a href="{{ route('admin.bookings.index') }}" class="text-purple-100 hover:text-white text-sm font-medium transition-colors">
                                    View Bookings →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Customer Dashboard -->
                <div class="bg-gray-800/50 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-xl mb-6 border border-gray-700">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                                <p class="text-gray-300">Ready to explore drones and racing courses?</p>
                            </div>
                            <div class="text-6xl">🚁</div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-xl hover:scale-105 transition-transform duration-300 group">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-3xl">🛒</div>
                                    <div class="text-blue-200 group-hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-bold text-lg text-white mb-2">Shop Drones</h4>
                                <p class="text-blue-100 text-sm mb-4">Browse our latest drone collection</p>
                                <a href="{{ route('products.index') }}" class="text-blue-100 hover:text-white text-sm font-medium transition-colors">
                                    Shop Now →
                                </a>
                            </div>
                            
                            <div class="bg-gradient-to-br from-green-600 to-green-700 p-6 rounded-xl hover:scale-105 transition-transform duration-300 group">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-3xl">🏁</div>
                                    <div class="text-green-200 group-hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-bold text-lg text-white mb-2">Racing Academy</h4>
                                <p class="text-green-100 text-sm mb-4">Book block programming courses</p>
                                <a href="{{ route('courses.index') }}" class="text-green-100 hover:text-white text-sm font-medium transition-colors">
                                    View Courses →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Bookings -->
                <div class="bg-gray-800/50 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-xl border border-gray-700">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-white">Your Recent Bookings</h3>
                            <div class="text-2xl">📋</div>
                        </div>
                        
                        @if(Auth::user()->bookings && Auth::user()->bookings->count() > 0)
                            <div class="space-y-4">
                                @foreach(Auth::user()->bookings->take(3) as $booking)
                                    <div class="bg-gray-700/50 border border-gray-600 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="font-semibold text-white">{{ $booking->course->name }}</h4>
                                                <p class="text-sm text-gray-300 mt-1">
                                                    Student: {{ $booking->student_name }} | 
                                                    Date: {{ $booking->preferred_date->format('M d, Y') }}
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <span class="px-3 py-1 text-xs rounded-full font-medium
                                                    @if($booking->status === 'confirmed') bg-green-500 text-white
                                                    @elseif($booking->status === 'pending') bg-yellow-500 text-black
                                                    @else bg-gray-500 text-white @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    Book More Courses
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="text-gray-400 text-lg mb-4">No bookings yet</div>
                                <p class="text-gray-500 mb-6">Start your drone racing journey today!</p>
                                <a href="{{ route('courses.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                    Book Your First Course
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
