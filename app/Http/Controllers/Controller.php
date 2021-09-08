<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // function __construct(){
        //CHECK IF SESSION EXIST
        //IF NOT EXIST, REDIRECT TO LOGIN PAGE
        // if(!isset($_SESSION['staff'])){
        //     return redirect('/');
        // }
    // }
}
