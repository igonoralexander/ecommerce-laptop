<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class bookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Booking::with('client', 'package')->get();
        return view('admin.bookings.index', compact('bookings'))->with([
            'title' => 'All Bookings',
            'breadcrumbs' => [
                ['url' => route('admin.bookings.index'), 'label' => 'Bookings'],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $packages = Package::all();
        $clients = User::where('role', 'user')->get();
        return view('admin.bookings.create', [
            'title' => 'Bookings',
            'packages' => $packages,
            'clients' => $clients,
            'breadcrumbs' => [
                ['url' => route('admin.bookings.index'), 'label' => 'Bookings'],
                ['url' => null, 'label' => 'Create Bookings'],
            ],   
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'date' => 'required|date',
            'time' => 'required',
            'client_id' => 'nullable|exists:users,id', // For registered clients
            'client_name' => 'nullable|string', // For guests
            'client_email' => 'nullable|email',
            'client_phone' => 'nullable|string',
        ]);

        // Determine who is making the booking
        $bookedBy = Auth::id(); // Logged-in user (admin or client)
        
        $existingBooking = Booking::where('date', $request->date)
            ->where('time', $request->time)
            ->where('status', '!=', 'canceled') // Ignore canceled bookings
            ->first();

        if ($existingBooking) {
            return response()->json(['success' => true, 'message' => 'This slot is already booked.']);
        }

        $booking = new Booking();
        
        $booking->booked_by = $bookedBy;
        $booking->client_id = $request->client_id;
        $booking->client_name = $request->client_name;
        $booking->client_email = $request->client_email;
        $booking->client_phone = $request->client_phone;
        $booking->package_id = $request->package_id;
        $booking->date = $request->date;
        $booking->time = $request->time;
        $booking->status = 'confirmed';

        $booking->save();

        return response()->json(['success' => true, 'message' => 'Booking successful!']);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $booking = Booking::findOrFail($id);
        $packages = Package::all();
        $clients = User::where('role', 'user')->get();

        return view('admin.bookings.edit', [
            'booking' => $booking,
            'packages' => $packages,
            'client' => $clients,
            'title' => 'Edit Booking',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Bookings'],
                ['url' => '#', 'label' => 'Edit Booking'],
            ],   
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'package_id' => 'required|exists:packages,id',
            'status' => 'required|in:pending,confirmed,canceled'
        ]);

        $booking->update($request->all());
    
        return response()->json(['success' => true, 'message' => 'Booking updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json(['success' => true, 'message' => 'Booking has been deleted successfully']);
    }
}
