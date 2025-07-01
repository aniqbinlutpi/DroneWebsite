<x-app-layout>
    <div class="min-h-screen bg-gray-900 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-4">Book Your Course</h1>
                <p class="text-gray-400 text-lg">Reserve your spot in our drone racing academy</p>
            </div>

            <!-- Course Info Card -->
            <div class="bg-gray-800 rounded-xl p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2">{{ $course->name }}</h2>
                        <p class="text-gray-400 mb-4">{{ $course->short_description }}</p>
                        <div class="flex flex-wrap gap-4 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-300">{{ $course->duration_hours }} hours</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="text-gray-300">Max {{ $course->max_participants }} students</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-purple-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                <span class="text-gray-300">{{ ucfirst($course->skill_level) }} Level</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <div class="text-3xl font-bold text-green-400">${{ number_format($course->price, 2) }}</div>
                        <div class="text-gray-400">per student</div>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="bg-gray-800 rounded-xl p-8">
                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <!-- Schedule Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="scheduled_date" class="block text-sm font-medium text-gray-300 mb-2">
                                Preferred Date *
                            </label>
                            <input type="date" 
                                   id="scheduled_date" 
                                   name="scheduled_date" 
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   value="{{ old('scheduled_date') }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                            @error('scheduled_date')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-300 mb-2">
                                Preferred Start Time *
                            </label>
                            <select id="start_time" 
                                    name="start_time" 
                                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                <option value="">Select time</option>
                                <option value="09:00" {{ old('start_time') == '09:00' ? 'selected' : '' }}>9:00 AM</option>
                                <option value="11:00" {{ old('start_time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                <option value="14:00" {{ old('start_time') == '14:00' ? 'selected' : '' }}>2:00 PM</option>
                                <option value="16:00" {{ old('start_time') == '16:00' ? 'selected' : '' }}>4:00 PM</option>
                            </select>
                            @error('start_time')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Student Information -->
                    <div class="border-t border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Student Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="student_name" class="block text-sm font-medium text-gray-300 mb-2">
                                    Student Name *
                                </label>
                                <input type="text" 
                                       id="student_name" 
                                       name="student_name" 
                                       value="{{ old('student_name') }}"
                                       class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Enter student's full name"
                                       required>
                                @error('student_name')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="student_age" class="block text-sm font-medium text-gray-300 mb-2">
                                    Student Age *
                                </label>
                                <select id="student_age" 
                                        name="student_age" 
                                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                    <option value="">Select age</option>
                                    @for($age = 6; $age <= 18; $age++)
                                        <option value="{{ $age }}" {{ old('student_age') == $age ? 'selected' : '' }}>
                                            {{ $age }} years old
                                        </option>
                                    @endfor
                                </select>
                                @error('student_age')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label for="participants" class="block text-sm font-medium text-gray-300 mb-2">
                                    Number of Participants *
                                </label>
                                <select id="participants" 
                                        name="participants" 
                                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                    @for($i = 1; $i <= $course->max_participants; $i++)
                                        <option value="{{ $i }}" {{ old('participants') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i == 1 ? 'student' : 'students' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('participants')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="experience_level" class="block text-sm font-medium text-gray-300 mb-2">
                                    Experience Level *
                                </label>
                                <select id="experience_level" 
                                        name="experience_level" 
                                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                    <option value="">Select experience</option>
                                    <option value="none" {{ old('experience_level') == 'none' ? 'selected' : '' }}>No experience</option>
                                    <option value="basic" {{ old('experience_level') == 'basic' ? 'selected' : '' }}>Basic (played with drones)</option>
                                    <option value="intermediate" {{ old('experience_level') == 'intermediate' ? 'selected' : '' }}>Intermediate (some programming)</option>
                                </select>
                                @error('experience_level')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="border-t border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Parent/Guardian Contact</h3>
                        
                        <div>
                            <label for="parent_phone" class="block text-sm font-medium text-gray-300 mb-2">
                                Phone Number *
                            </label>
                            <input type="tel" 
                                   id="parent_phone" 
                                   name="parent_phone" 
                                   value="{{ old('parent_phone') }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter contact phone number"
                                   required>
                            @error('parent_phone')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Special Requirements -->
                    <div class="border-t border-gray-700 pt-6">
                        <label for="special_requirements" class="block text-sm font-medium text-gray-300 mb-2">
                            Special Requirements or Notes
                        </label>
                        <textarea id="special_requirements" 
                                  name="special_requirements" 
                                  rows="3"
                                  class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Any special requirements, medical conditions, or additional information...">{{ old('special_requirements') }}</textarea>
                        @error('special_requirements')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Total Cost -->
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-white">Total Cost:</span>
                            <span class="text-2xl font-bold text-green-400" id="total-cost">${{ number_format($course->price, 2) }}</span>
                        </div>
                        <p class="text-gray-400 text-sm mt-1">Price will be calculated based on number of participants</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex space-x-4">
                        <button type="submit" 
                                class="flex-1 bg-purple-600 text-white py-3 px-6 rounded-lg hover:bg-purple-700 transition-colors font-semibold text-lg">
                            Book Course
                        </button>
                        <a href="{{ route('courses.show', $course->slug) }}" 
                           class="bg-gray-600 text-white py-3 px-6 rounded-lg hover:bg-gray-500 transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Update total cost when participants change
        document.getElementById('participants').addEventListener('change', function() {
            const participants = this.value;
            const pricePerStudent = {{ $course->price }};
            const total = participants * pricePerStudent;
            document.getElementById('total-cost').textContent = '$' + total.toFixed(2);
        });
    </script>
</x-app-layout> 