<x-app-layout>
    <div class="min-h-screen flex flex-col glass shadow-2xl rounded-3xl mx-auto my-8 p-8">
        <!-- Header Section -->
        <div class="glass shadow mb-8 rounded-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gradient mb-2">My Bookings</h1>
                    <p class="text-lg text-gray-500">Manage and view all your bookings</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="text-3xl font-bold text-gray-800 mb-2" style="font-family: 'Inter', sans-serif;">My Bookings</h1>
            <p class="text-black mb-8">Manage and view all your bookings</p>
            <!-- Statistics Bar -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="glass shadow rounded-2xl flex flex-col items-center">
                    <div class="text-2xl font-bold text-gradient">{{ $totalBookings }}</div>
                    <div class="text-black mt-1">Total Bookings</div>
                </div>
                <div class="glass shadow rounded-2xl flex flex-col items-center">
                    <div class="text-2xl font-bold text-gradient">{{ $upcomingBookings }}</div>
                    <div class="text-black mt-1">Upcoming</div>
                </div>
                <div class="glass shadow rounded-2xl flex flex-col items-center">
                    <div class="text-2xl font-bold text-gradient">{{ $pastBookings }}</div>
                    <div class="text-black mt-1">Past</div>
                </div>
            </div>
            <!-- View Toggle -->
            <div class="flex gap-4 mb-8">
                <button id="list-btn" onclick="showView('list')" class="btn-gradient bg-gradient-to-r from-gradient1 to-gradient2 text-white font-semibold shadow">List View</button>
                <button id="calendar-btn" onclick="showView('calendar')" class="btn-gradient">Calendar View</button>
            </div>
            <div id="list-view" class="view-section">
                <div class="glass shadow p-4 rounded-2xl w-full">
                @if($bookings->count() > 0)
                    <div class="space-y-4">
                        @foreach($bookings as $booking)
                            <div class="glass shadow-xl border border-gray-200 p-6 rounded-2xl hover-lift transition-all duration-300">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $booking->title }}</h3>
                                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                                                <svg class="w-4 h-4 text-[#1877f2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y - h:i A') }}
                                            </div>
                                            @if($booking->description)
                                                <p class="text-gray-700">{{ $booking->description }}</p>
                                            @endif
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('bookings.edit', $booking) }}" class="btn-gradient hover-lift text-sm">Edit</a>
                                            <form method="POST" action="{{ route('bookings.destroy', $booking) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-400 transition shadow" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 glass flex items-center justify-center mx-auto mb-4 rounded-full">
                                <svg class="w-8 h-8 text-[#B86B4B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-[#4B3F2B] mb-2">No bookings found!</h3>
                            <p class="text-black mb-6">Start by creating your first booking.</p>
                            <a href="{{ route('bookings.create') }}" class="btn-gradient hover-lift">Create New Booking</a>
                        </div>
                    @endif
                </div>
            </div>
            <div id="calendar-view" class="view-section hidden">
                <div class="glass shadow p-4 rounded-2xl">
                    <div id="calendar"></div>
                </div>
            </div>
            @if($bookings->count() > 0)
            <div class="flex justify-center mt-8">
                <a href="{{ route('bookings.create') }}" class="btn-gradient hover-lift">Create New Booking</a>
            </div>
            @endif
        </div>
    </div>

    <script>
        function showView(view) {
            // Hide all views
            document.querySelectorAll('.view-section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('button').forEach(btn => {
                btn.classList.remove('bg-[#1877f2]', 'text-white', 'border-[#1877f2]', 'bg-white', 'text-[#1877f2]', 'bg-gradient-to-r', 'from-gradient1', 'to-gradient2');
            });
            
            // Show selected view
            document.getElementById(view + '-view').classList.remove('hidden');
            
            // Add active class to selected button
            const activeBtn = document.getElementById(view + '-btn');
            if (activeBtn) {
                if (view === 'calendar') {
                    activeBtn.classList.add('bg-gradient-to-r', 'from-gradient1', 'to-gradient2', 'text-white');
                } else {
                    activeBtn.classList.add('bg-gradient-to-r', 'from-gradient1', 'to-gradient2', 'text-white');
                }
            }

            // If calendar view, initialize FullCalendar if not already done
            if(view === 'calendar' && !window.bookingsCalendarInitialized) {
                fetch('/dashboard/bookings-json')
                    .then(response => response.json())
                    .then(events => {
                        const calendar = new window.FullCalendar.Calendar(document.getElementById('calendar'), {
                            plugins: [window.FullCalendar.dayGridPlugin, window.FullCalendar.timeGridPlugin, window.FullCalendar.interactionPlugin],
                            initialView: 'dayGridMonth',
                            height: 500,
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            events: events,
                            eventClick: function(info) {
                                if (info.event.url) {
                                    window.open(info.event.url, '_blank');
                                    info.jsEvent.preventDefault();
                                }
                            },
                            themeSystem: 'bootstrap5',
                            dayMaxEvents: true,
                            moreLinkClick: 'popover',
                            eventDisplay: 'block',
                            eventColor: '#1877f2',
                            eventTextColor: '#fff',
                            dayCellContent: function(arg) {
                                return arg.dayNumberText;
                            }
                        });
                        calendar.render();
                        window.bookingsCalendarInitialized = true;
                    });
            }
        }
    </script>
</x-app-layout>
