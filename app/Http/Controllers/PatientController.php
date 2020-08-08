<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;

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

    public function records()
    {
        # code...
    }
}
