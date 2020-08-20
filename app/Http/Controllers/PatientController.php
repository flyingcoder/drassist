<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Patient;

class PatientController extends Controller
{
    public function index() {

        $data = request()->user()->patients;

        return response()->json($data, 200);
    }


    public function store() {

        request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'age' => 'required',
            'gender' => 'required',
        ]);

        //dd(request()->user());

        $patient = request()->user()
                         ->patients()
                         ->create(request()->all());

        return response()->json($patient, 200);
    }

    public function updatePatient($id)
    {
        $patient = Patient::findOrfail($id);

        $patient->firstname = request()->firstname;
        $patient->lastname = request()->lastname;
        $patient->age = request()->age;
        $patient->gender = request()->gender;
        $patient->certify = request()->certify;
        $patient->relationship = request()->relationship;
        $patient->health_card = request()->health_card;
        $patient->health_card_province = request()->health_card_province;

        $patient->save();

        return response()->json($patient, 200);
    }

    public function getPatient($id)
    {
        $patient = Patient::findOrfail($id);

        return response()->json($patient, 200);
    }


    public function deletePatient($id) {
        $patient = Patient::findOrfail($id);
        $patient->delete();
        return response()->json($patient, 204);
    }

}
