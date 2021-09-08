<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HolidayController extends Controller
{
    public function index(){

        session_start();
      
        $holiday=App\Emp_record::where('status','H')
                                  ->get();
    


            return view('holiday',['holiday' => $holiday]);

        }

        public function create(Request $req){
            //echo $req->input('date');
            $employe = new App\Emp_record;

            $date = $req ->input('date');

            $time  = strtotime($date);
            $day   = date('d',$time);
            $month = date('m',$time);
            $year  = date('Y',$time);

            $employe->user_id = "0000";
            $employe->day = $day;
            $employe->month = $month;
            $employe->year = $year;
    
            $employe->status = 'H';

            $employe->save();

            return redirect()->route('holiday.index')->with('sucess', 'inserted');
           
    
            
        
        
        
        
        
        
        
        
          }

          public function show($id){
           

         
            }

          public function destroy($id){
          
          $employe =App\Emp_record::find($id);
          $employe->delete();
          return redirect()->route('holiday.index')->with('sucess', 'deleleted');

          }
}
