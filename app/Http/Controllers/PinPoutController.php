<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PinPoutController extends Controller
{
    public function index(){
        return view('pin_pout');
    }
}
