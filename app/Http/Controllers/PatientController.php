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

    public function newRecords($id)
    {
        $patient = Patient::findOrfail($id);
        request()->validate([
            'title' => 'required',

        ]);

        //dd(request()->user());

        $records = $patient
                         ->records()
                         ->create(request()->all());

        return response()->json($records, 200);
    }


    public function deletePatient($id) {
        $patient = Patient::findOrfail($id);
        $patient->delete();
        return response()->json($patient, 204);
    }

    public function deleteRecord($id) {
        $records = Patient::findorFail($id);
        $records->delete();
        return response()->json($records, 204);
    }

}
