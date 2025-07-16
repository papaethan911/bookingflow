<x-app-layout>
    <div class="min-h-screen flex flex-col glass shadow-2xl rounded-3xl mx-auto my-8 p-8">
        <!-- Header Section -->
        <div class="glass shadow mb-8 rounded-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gradient mb-2">Edit Booking</h1>
                    <p class="text-black">Update your booking details</p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="glass shadow border border-gray-200 p-8 rounded-2xl">
                <form method="POST" action="{{ route('bookings.update', $booking) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Booking Details -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-semibold text-black flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#1877f2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Booking Details
                            </h3>
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $booking->title) }}" 
                                       class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1877f2] focus:border-[#1877f2] text-gray-900 placeholder-gray-400" required>
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea id="description" name="description" rows="4" 
                                          class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1877f2] focus:border-[#1877f2] text-gray-900 placeholder-gray-400">{{ old('description', $booking->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- Date & Time Selection -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-semibold text-black flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#1877f2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Schedule
                            </h3>
                            <div>
                                <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <input type="date" id="booking_date" name="booking_date" 
                                       value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d')) }}" 
                                       class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1877f2] focus:border-[#1877f2] text-gray-900" required>
                                @error('booking_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="booking_time" class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                                <input type="time" id="booking_time" name="booking_time" value="{{ old('booking_time', \Carbon\Carbon::parse($booking->booking_date)->format('H:i')) }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1877f2] focus:border-[#1877f2] text-gray-900" required>
                                @error('booking_time')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div class="flex gap-4">
                            <button type="submit" class="btn-gradient hover-lift">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Booking
                            </button>
                            <a href="{{ route('bookings.index') }}" class="btn-gradient hover-lift bg-white text-gradient border border-gradient2">Cancel</a>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('bookings.destroy', $booking) }}" class="inline-block mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-gradient hover-lift bg-red-500 text-white text-sm font-medium" onclick="return confirm('Are you sure you want to delete this booking?')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
