<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class ExternalFormController extends Controller
{
    public function store()
    {
        try {
            if (!empty(request()->all())) {

                $booking = Booking::create([
                    'is_patient' => request()->is_patient,
                    'you_received_care' => request()->you_received_care,
                    'patient_relationship' => request()->patient_relationship,
                    'first_name' => request()->first_name,
                    'last_name' => request()->last_name,
                    'contact_number' => request()->contact_number,
                    'email' => request()->email,
                    'patient_received_care' => request()->patient_received_care,
                    'patient_legal_first_name' => request()->patient_legal_first_name,
                    'patient_legal_middle_name' => request()->patient_legal_middle_name,
                    'patient_legal_last_name' => request()->patient_legal_last_name,
                    'main_clinic_number' => request()->main_clinic_number,
                    'your_legal_first_name' => request()->your_legal_first_name,
                    'your_legal_middle_name' => request()->your_legal_middle_name,
                    'your_legal_last_name' => request()->your_legal_last_name,
                    'patient_birthdate' => request()->patient_birthdate,
                    'patient_contact_number' => request()->patient_contact_number,
                    'patient_email2' => request()->patient_email2,
                    'patient_gender' => request()->patient_gender,
                    'patient_street_address' => request()->patient_street_address,
                    'patient_city' => request()->patient_city,
                    'patient_state' => request()->patient_state,
                    'patient_home_number' => request()->patient_home_number,
                    'patient_primary_concern' => request()->patient_primary_concern,
                    'patient_medical_concern' => request()->patient_medical_concern,
                    'schedule_date' => request()->schedule_date,
                    'schedule_time' => request()->schedule_time,
                    'OHIP_number' => request()->OHIP_number,
                    'patient_time' => request()->patient_time
                ]);
            }

            return redirect()->to('https://doctorassist.buzzooka.ca/thank-you');
        } catch (Exception $e) {
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
