<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class ExternalFormController extends Controller
{
    public function store()
    {
        try {
            $booking = Booking::create(request()->all());
            return redirect()->to('http://doctorassist.buzzooka.ca/thank-you'); 
        } catch(Exception $e) {
            return redirect()->to('http://doctorassist.buzzooka.ca/error-in-submittion'); 
        }
    }

    public function getBookings()
    {
        return response()->json(Booking::all());
    }
}
