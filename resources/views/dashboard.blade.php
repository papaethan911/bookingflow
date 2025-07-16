<x-app-layout>
    <div class="min-h-screen flex flex-col glass shadow-2xl rounded-3xl mx-auto my-8 p-8">
        <!-- Header Section -->
        <div class="glass border-b border-gray-200 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-[#1877f2] mb-2">
                            Hello {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-lg text-black">Here's what's happening with your bookings today</p>
                    </div>
                    <div class="hidden md:flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm text-black">Today is</p>
                            <p class="text-lg font-semibold text-black">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2" style="font-family: 'Inter', sans-serif;">Dashboard</h1>
            <p class="text-black mb-8">Welcome back, {{ Auth::user()->name }}!</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="glass shadow-xl rounded-2xl p-6 flex flex-col items-center">
                    <div class="text-2xl font-bold text-gradient">{{ $totalBookings }}</div>
                    <div class="text-black mt-1">Total Bookings</div>
                </div>
                <div class="glass shadow-xl rounded-2xl p-6 flex flex-col items-center">
                    <div class="text-2xl font-bold text-gradient">{{ $upcomingBookings }}</div>
                    <div class="text-black mt-1">Upcoming</div>
                </div>
                <div class="glass shadow-xl rounded-2xl p-6 flex flex-col items-center">
                    <div class="text-2xl font-bold text-gradient">{{ $totalUsers }}</div>
                    <div class="text-black mt-1">Total Users</div>
                </div>
            </div>
            <!-- Recent Bookings Section -->
            <div class="glass shadow-xl rounded-2xl p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Recent Bookings</h2>
                @if($recentBookings->count() > 0)
                    <ul class="divide-y divide-gray-100">
                        @foreach($recentBookings as $booking)
                            <li class="py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                <div>
                                    <div class="font-semibold text-[#1877f2] text-lg">{{ $booking->title }}</div>
                                    <div class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y - h:i A') }}</div>
                                    @if($booking->description)
                                        <div class="text-gray-600 text-sm mt-1">{{ $booking->description }}</div>
                                    @endif
                                </div>
                                <div class="mt-2 md:mt-0 flex gap-2">
                                    <a href="{{ route('bookings.edit', $booking) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#1877f2] text-white text-sm font-medium rounded-lg hover:bg-[#145db2] transition shadow">Edit</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-8">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">No bookings found!</h3>
                        <p class="text-black mb-4">Start by creating your first booking.</p>
                        <a href="{{ route('bookings.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#1877f2] text-white font-semibold rounded-lg hover:bg-[#145db2] transition shadow">Create New Booking</a>
                    </div>
                @endif
            </div>
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('bookings.index') }}" class="inline-block px-6 py-2 rounded-lg bg-[#1877f2] text-white font-semibold shadow hover:bg-[#145db2] transition">View Bookings</a>
                <a href="{{ route('bookings.create') }}" class="inline-block px-6 py-2 rounded-lg bg-white border border-[#1877f2] text-[#1877f2] font-semibold shadow hover:bg-[#f0f2f5] transition">New Booking</a>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
{{-- Calendar script removed as requested --}}
@endpush
