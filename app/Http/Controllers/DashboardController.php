<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $now = Carbon::now();
        
        // User-specific stats
        $userBookings = Booking::where('user_id', $user->id)->count();
        $upcomingBookings = Booking::where('user_id', $user->id)
            ->where('booking_date', '>=', $now)
            ->count();
        $pastBookings = Booking::where('user_id', $user->id)
            ->where('booking_date', '<', $now)
            ->count();
        $thisMonthBookings = Booking::where('user_id', $user->id)
            ->whereMonth('booking_date', $now->month)
            ->whereYear('booking_date', $now->year)
            ->count();
        
        // System-wide stats (for admin overview)
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $systemUpcomingBookings = Booking::where('booking_date', '>=', $now)->count();
        
        // Recent bookings for the current user
        $recentBookings = Booking::where('user_id', $user->id)
            ->orderBy('booking_date', 'desc')
            ->take(5)
            ->get();
        
        // Upcoming bookings for the current user
        $nextBookings = Booking::where('user_id', $user->id)
            ->where('booking_date', '>=', $now)
            ->orderBy('booking_date', 'asc')
            ->take(3)
            ->get();
        
        // Monthly booking trend (last 6 months)
        $monthlyTrend = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $count = Booking::where('user_id', $user->id)
                ->whereMonth('booking_date', $date->month)
                ->whereYear('booking_date', $date->year)
                ->count();
            $monthlyTrend->push([
                'month' => $date->format('M'),
                'count' => $count
            ]);
        }

        return view('dashboard', compact(
            'userBookings',
            'upcomingBookings', 
            'pastBookings',
            'thisMonthBookings',
            'totalBookings',
            'totalUsers',
            'systemUpcomingBookings',
            'recentBookings',
            'nextBookings',
            'monthlyTrend'
        ));
    }

    public function getBookingDates()
    {
        $bookings = Booking::select('booking_date', 'title')
            ->where('user_id', auth()->id())
            ->get()
            ->map(function ($booking) {
                return [
                    'date' => $booking->booking_date->format('Y-m-d'),
                    'title' => $booking->title,
                    'formatted_date' => $booking->booking_date->format('F d, Y - h:i A')
                ];
            });

        return response()->json($bookings);
    }

    public function bookingsJson()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->get()
            ->map(function ($booking) {
                $time = $booking->booking_date->format('g:i A');
                return [
                    'title' => $booking->title . ' (' . $time . ')',
                    'start' => $booking->booking_date->format('Y-m-d\TH:i:s'),
                    'url' => route('bookings.edit', $booking),
                    'color' => '#f87171', // Tailwind red-400 for example
                ];
            });
        return response()->json($bookings);
    }
} 