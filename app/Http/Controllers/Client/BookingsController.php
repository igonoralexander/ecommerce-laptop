<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //
         $bookings = Booking::with('package')
         ->where('client_id', auth()->id())
         ->get();
        return view('profile.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::all();
        $user = Auth::user();
        return view('profile.bookings.create', [
            'packages' => $packages,
            'user' => $user,
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
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
            'special_requests' => 'nullable|string',
            'num_people' => 'required|integer|min:1',
        ]);

        $client = Auth::user();

        $booking = Booking::create([
            'client_id' => $client->id,
            'package_id' => $request->package_id,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'special_requests' => $request->special_requests,
            'num_people' => $request->num_people,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Booking request submitted!']);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
