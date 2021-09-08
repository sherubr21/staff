<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendApproveLeaveMail;
use App\Mail\SendRejectLeaveMail;

use Request;
class TestMailController extends Controller
{
    public function mail()
          {
        
             Mail::to('sherubrangdrel@rtc.bt')->send(new SendApproveLeaveMail());
   
             return 'Email was sent';
          }
           public function mail1()
          {
        
             Mail::to('sherubrangdrel@rtc.bt')->send(new SendRejectLeaveMail());
   
             return 'Email was sent';
          }

          public function test1(){
             echo Request::get('u');
          }
}
