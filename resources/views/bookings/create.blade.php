<x-app-layout>
    <div class="min-h-screen flex flex-col glass shadow-2xl rounded-3xl mx-auto my-8 p-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gradient mb-2">Create New Booking</h1>
                        <p class="text-black">Schedule your appointment with our interactive calendar</p>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="btn-gradient hover-lift">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Bookings
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Booking Form -->
                <div class="glass shadow-lg border border-gray-200 p-6 rounded-2xl">
                    <h2 class="text-xl font-semibold text-[#1877f2] mb-6">Booking Details</h2>
                    <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6" id="bookingForm">
                        @csrf
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-500 mb-2">Booking Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1877f2] focus:border-[#1877f2] text-gray-900 placeholder-gray-400" placeholder="Enter booking title" required>
                            @error('title')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Hidden Date Input -->
                        <input type="hidden" id="booking_date" name="booking_date" value="{{ old('booking_date') }}">
                        <!-- Hidden Time Input -->
                        <input type="hidden" id="booking_time" name="booking_time" value="{{ old('booking_time') }}">
                        <!-- Time Picker Modal -->
                        <div id="timePickerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm z-50 hidden">
                            <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-xs border border-gray-200">
                                <h3 class="text-lg font-semibold mb-4 text-gray-900">Select a Time</h3>
                                <input type="time" id="customTimeInput" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1877f2] focus:border-[#1877f2] text-gray-900 mb-4">
                                <div class="flex gap-2">
                                    <button type="button" id="confirmCustomTime" class="flex-1 px-4 py-2 rounded-lg bg-[#1877f2] text-white font-semibold hover:bg-[#145db2] transition">Confirm</button>
                                    <button type="button" id="closeTimePicker" class="flex-1 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition border border-gray-200">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-500 mb-2">Description</label>
                            <textarea id="description" name="description" rows="4" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1877f2] focus:border-[#1877f2] text-gray-900 placeholder-gray-400" placeholder="Tell us about your appointment needs...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4">
                            <button type="submit" class="btn-gradient hover-lift">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Create Booking
                            </button>
                            <a href="{{ route('bookings.index') }}" class="text-gray-500 hover:text-gradient text-sm transition-colors">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- Calendar Section -->
                <div class="space-y-6">
                    <div class="glass shadow-lg border border-gray-200 p-6 rounded-2xl">
                        <h2 class="text-xl font-semibold text-[#1877f2] mb-6">Select Date</h2>
                        <div id="fullcalendar" class="rounded-lg overflow-hidden"></div>
                        <div id="selectedDateDisplay" class="mt-4 text-center text-gray-500 font-semibold"></div>
                    </div>
                    <!-- Booking Information and Available Times -->
                    <div class="glass border border-gray-200 rounded-2xl p-6">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-black mb-2">Booking Tips</h3>
                                <ul class="space-y-2 text-sm text-gray-500">
                                    <li class="flex items-center">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-2"></span>
                                        Select a date from the calendar above
                                    </li>
                                    <li class="flex items-center">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-2"></span>
                                        Choose your preferred time slot
                                    </li>
                                    <li class="flex items-center">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-2"></span>
                                        Provide details about your appointment
                                    </li>
                                    <li class="flex items-center">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-2"></span>
                                        Booked dates are marked in red
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="glass shadow-lg border border-gray-200 p-6 rounded-2xl">
                        <h3 class="text-lg font-semibold text-black mb-4">Available Times</h3>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="text-center p-3 bg-gray-100 rounded-lg border border-gray-200">
                                <p class="text-sm font-medium text-gray-500">Morning</p>
                                <p class="text-xs text-gray-500">9:00 AM - 12:00 PM</p>
                            </div>
                            <div class="text-center p-3 bg-gray-100 rounded-lg border border-gray-200">
                                <p class="text-sm font-medium text-gray-500">Afternoon</p>
                                <p class="text-xs text-gray-500">1:00 PM - 4:00 PM</p>
                            </div>
                            <div class="text-center p-3 bg-gray-100 rounded-lg border border-gray-200">
                                <p class="text-sm font-medium text-gray-500">Evening</p>
                                <p class="text-xs text-gray-500">4:00 PM - 5:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedDate = null;
            let selectedTime = null;
            let bookedDates = [];
            // Fetch booked dates from API
            fetch('/api/booking-dates')
                .then(response => response.json())
                .then(data => {
                    bookedDates = (data.dates || data).map(d => d.date || d); // support both [{date:...}] and [date,...]
                    renderCalendar();
                })
                .catch(error => {
                    bookedDates = [];
                    renderCalendar();
                });
            function renderCalendar() {
                let calendarEl = document.getElementById('fullcalendar');
                calendarEl.innerHTML = '';
                let calendar = new window.FullCalendar.Calendar(calendarEl, {
                    plugins: [ window.FullCalendar.dayGridPlugin, window.FullCalendar.interactionPlugin ],
                    initialView: 'dayGridMonth',
                    selectable: true,
                    selectOverlap: false,
                    selectAllow: function(info) {
                        // Prevent selecting booked dates
                        return !bookedDates.includes(info.startStr);
                    },
                    dateClick: function(info) {
                        if (bookedDates.includes(info.dateStr)) return;
                        selectedDate = info.dateStr;
                        document.getElementById('booking_date').value = selectedDate;
                        document.getElementById('selectedDateDisplay').textContent = 'Selected: ' + new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                        // Show time picker modal
                        document.getElementById('timePickerModal').classList.remove('hidden');
                    },
                    dayCellClassNames: function(arg) {
                        if (bookedDates.includes(arg.date.toISOString().split('T')[0])) {
                            return [ 'bg-[#B86B4B]/20', 'text-[#B86B4B]', 'cursor-not-allowed', 'relative', 'font-semibold', 'border', 'border-[#B86B4B]/30' ];
                        }
                        return [];
                    },
                    // Fix: Use plain text for day numbers
                    dayCellContent: function(arg) {
                        return arg.dayNumberText;
                    },
                    themeSystem: 'bootstrap5',
                    dayMaxEvents: true,
                    moreLinkClick: 'popover',
                    eventDisplay: 'block',
                    eventColor: '#B86B4B',
                    eventTextColor: '#F5F3ED',
                });
                calendar.render();
            }
            // Time picker modal logic (custom time input)
            document.getElementById('confirmCustomTime').addEventListener('click', function() {
                const customTime = document.getElementById('customTimeInput').value;
                if (customTime) {
                    selectedTime = customTime;
                    document.getElementById('booking_time').value = selectedTime;
                    document.getElementById('timePickerModal').classList.add('hidden');
                }
            });
            document.getElementById('closeTimePicker').addEventListener('click', function() {
                document.getElementById('timePickerModal').classList.add('hidden');
            });
        });
    </script>
</x-app-layout>