<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExternalFormController extends Controller
{
    public function store()
    {
        dd(request()->all());
    }
}
