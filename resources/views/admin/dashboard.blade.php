<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 bg-yellow-500 text-black text-sm font-bold rounded-full">ADMIN</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Products Stats -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-xl shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Products</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['total_products'] }}</p>
                            <p class="text-blue-200 text-xs mt-1">{{ $stats['active_products'] }} active</p>
                        </div>
                        <div class="text-blue-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Courses Stats -->
                <div class="bg-gradient-to-br from-green-600 to-green-700 p-6 rounded-xl shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Total Courses</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['total_courses'] }}</p>
                            <p class="text-green-200 text-xs mt-1">{{ $stats['active_courses'] }} active</p>
                        </div>
                        <div class="text-green-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Bookings Stats -->
                <div class="bg-gradient-to-br from-purple-600 to-purple-700 p-6 rounded-xl shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Bookings</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['total_bookings'] }}</p>
                            <p class="text-purple-200 text-xs mt-1">{{ $stats['pending_bookings'] }} pending</p>
                        </div>
                        <div class="text-purple-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Users Stats -->
                <div class="bg-gradient-to-br from-orange-600 to-orange-700 p-6 rounded-xl shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">Total Users</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['total_users'] }}</p>
                            <p class="text-orange-200 text-xs mt-1">customers</p>
                        </div>
                        <div class="text-orange-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gray-800/50 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-xl mb-8 border border-gray-700">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-6">Quick Actions</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('admin.products.create') }}" class="flex items-center p-4 bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors group">
                            <div class="text-2xl mr-3">➕</div>
                            <div>
                                <p class="text-white font-medium">Add Product</p>
                                <p class="text-blue-100 text-sm">Create new drone product</p>
                            </div>
                            <div class="ml-auto text-blue-200 group-hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="{{ route('admin.courses.create') }}" class="flex items-center p-4 bg-green-600 hover:bg-green-700 rounded-lg transition-colors group">
                            <div class="text-2xl mr-3">📚</div>
                            <div>
                                <p class="text-white font-medium">Add Course</p>
                                <p class="text-green-100 text-sm">Create new racing course</p>
                            </div>
                            <div class="ml-auto text-green-200 group-hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="{{ route('admin.bookings.index') }}" class="flex items-center p-4 bg-purple-600 hover:bg-purple-700 rounded-lg transition-colors group">
                            <div class="text-2xl mr-3">📋</div>
                            <div>
                                <p class="text-white font-medium">View Bookings</p>
                                <p class="text-purple-100 text-sm">Manage all bookings</p>
                            </div>
                            <div class="ml-auto text-purple-200 group-hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Bookings -->
                <div class="bg-gray-800/50 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-xl border border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-white">Recent Bookings</h3>
                            <a href="{{ route('admin.bookings.index') }}" class="text-blue-400 hover:text-blue-300 text-sm">View All →</a>
                        </div>
                        
                        @if($stats['recent_bookings']->count() > 0)
                            <div class="space-y-4">
                                @foreach($stats['recent_bookings'] as $booking)
                                    <div class="flex items-center justify-between p-4 bg-gray-700/50 rounded-lg">
                                        <div class="flex-1">
                                            <p class="text-white font-medium">{{ $booking->course->name }}</p>
                                            <p class="text-gray-300 text-sm">{{ $booking->user->name }} • {{ $booking->student_name }}</p>
                                            <p class="text-gray-400 text-xs">{{ $booking->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="px-2 py-1 text-xs rounded-full font-medium
                                                @if($booking->status === 'confirmed') bg-green-500 text-white
                                                @elseif($booking->status === 'pending') bg-yellow-500 text-black
                                                @else bg-gray-500 text-white @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="text-gray-400 text-lg mb-2">No recent bookings</div>
                                <p class="text-gray-500 text-sm">New bookings will appear here</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Management Links -->
                <div class="bg-gray-800/50 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-xl border border-gray-700">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-6">Management</h3>
                        <div class="space-y-4">
                            <a href="{{ route('admin.products.index') }}" class="flex items-center justify-between p-4 bg-gray-700/50 hover:bg-gray-700 rounded-lg transition-colors group">
                                <div class="flex items-center">
                                    <div class="text-2xl mr-4">📦</div>
                                    <div>
                                        <p class="text-white font-medium">Products</p>
                                        <p class="text-gray-400 text-sm">Manage drone inventory</p>
                                    </div>
                                </div>
                                <div class="text-gray-400 group-hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </a>

                            <a href="{{ route('admin.courses.index') }}" class="flex items-center justify-between p-4 bg-gray-700/50 hover:bg-gray-700 rounded-lg transition-colors group">
                                <div class="flex items-center">
                                    <div class="text-2xl mr-4">🎓</div>
                                    <div>
                                        <p class="text-white font-medium">Courses</p>
                                        <p class="text-gray-400 text-sm">Manage racing courses</p>
                                    </div>
                                </div>
                                <div class="text-gray-400 group-hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </a>

                            <a href="{{ route('admin.bookings.index') }}" class="flex items-center justify-between p-4 bg-gray-700/50 hover:bg-gray-700 rounded-lg transition-colors group">
                                <div class="flex items-center">
                                    <div class="text-2xl mr-4">📅</div>
                                    <div>
                                        <p class="text-white font-medium">Bookings</p>
                                        <p class="text-gray-400 text-sm">View and manage bookings</p>
                                    </div>
                                </div>
                                <div class="text-gray-400 group-hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 