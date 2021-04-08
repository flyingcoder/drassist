<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class ExternalFormController extends Controller
{
    public function store()
    {
        try {
            if(!empty(request()->all()))
                $booking = Booking::create(request()->all());
            return redirect()->to('https://doctorassist.buzzooka.ca/thank-you'); 
        } catch(Exception $e) {
            return redirect()->to('https://doctorassist.buzzooka.ca/error-in-submittion'); 
        }
    }

    public function getBookings()
    {
        return response()->json(Booking::all());
    }

    public function getBooking($id)
    {
        return response()->json(Booking::findOrFail($id));
    }
}
