<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user's bookings
     */
    public function index(): View
    {
        $bookings = Booking::with('course')
            ->where('user_id', Auth::id())
            ->orderBy('scheduled_date', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking
     */
    public function create(Course $course): View
    {
        // Check if course is available for booking
        if (!$course->is_active) {
            abort(404, 'Course not available');
        }

        return view('bookings.create', compact('course'));
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'scheduled_date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i',
            'participants' => 'required|integer|min:1|max:6',
            'student_name' => 'required|string|max:255',
            'student_age' => 'required|integer|min:6|max:18',
            'parent_phone' => 'required|string|max:20',
            'experience_level' => 'required|in:none,basic,intermediate',
            'special_requirements' => 'nullable|string|max:500'
        ]);

        $course = Course::findOrFail($request->course_id);

        // Check if the requested number of participants exceeds course limit
        if ($request->participants > $course->max_participants) {
            return back()->withErrors([
                'participants' => "Maximum {$course->max_participants} participants allowed for this course"
            ]);
        }

        // Calculate end time
        $startTime = Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = $startTime->copy()->addHours($course->duration_hours);

        // Generate booking number
        $bookingNumber = 'DRB-' . date('Y') . '-' . str_pad(Booking::count() + 1, 4, '0', STR_PAD_LEFT);

        $booking = Booking::create([
            'booking_number' => $bookingNumber,
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'scheduled_date' => $request->scheduled_date,
            'start_time' => $request->start_time,
            'end_time' => $endTime->format('H:i:s'),
            'participants' => $request->participants,
            'total_amount' => $course->price * $request->participants,
            'student_name' => $request->student_name,
            'student_age' => $request->student_age,
            'parent_phone' => $request->parent_phone,
            'experience_level' => $request->experience_level,
            'special_requirements' => $request->special_requirements,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully! Booking number: ' . $bookingNumber);
    }

    /**
     * Display the specified booking
     */
    public function show(Booking $booking): View
    {
        // Ensure user can only view their own bookings
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('bookings.show', compact('booking'));
    }

    /**
     * Cancel a booking
     */
    public function cancel(Booking $booking)
    {
        // Ensure user can only cancel their own bookings
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if booking can be cancelled (e.g., at least 24 hours before)
        $scheduledDateTime = Carbon::parse($booking->scheduled_date . ' ' . $booking->start_time);
        
        if ($scheduledDateTime->diffInHours(now()) < 24) {
            return back()->with('error', 'Bookings can only be cancelled at least 24 hours in advance');
        }

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking is already cancelled');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully');
    }
}
