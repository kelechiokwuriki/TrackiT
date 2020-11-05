<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OneRepMaxController extends Controller
{
    public function calculateOneRepMax()
    {
        return view('onerepmax.onerepmaxcalculator');
    }
}
