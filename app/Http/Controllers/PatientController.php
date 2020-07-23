<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class PatientController extends Controller
{
    public function index() {

        $data = User::where('parent_id', auth()->user()->id)->get();

        return response()->json($data, 200);
    }


    public function store(Request $request) {

        $data = $request->validate([
            'role_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'phone_no' => 'required',
            'address' => 'required',

        ]);

        $data['parent_id'] = auth()->user()->id;

        $users = User::create($data);

        return response()->json($users, 200);
    }
}
