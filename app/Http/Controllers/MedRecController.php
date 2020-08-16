<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class MedRecController extends Controller
{
    public function records($id)
    {
       $patient = Patient::findOrfail($id);

       return response()->json($patient->records, 200);
    }

    public function newRecords($id)
    {
        $patient = Patient::findOrfail($id);
        request()->validate([
            'title' => 'required',
            'category' => 'required',

        ]);

        //dd(request()->user());

        $records = $patient
                     ->records()
                     ->create(request()->all());

        return response()->json($records, 200);
    }
}
