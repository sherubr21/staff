<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tblstaffattendance;
use App\Tbllocation;
use DB;

class AttendenceController extends Controller
{
    public function index(Request $req){
        
       // $year1 = date('y');
       session_start();
 
      $year1 = $req->get('year');
      if($req->get('year')==date('Y')){
        $year1 = date('Y');
         $month = (int)date('m');
         $day11=(int)date('d');
        
      }else{
        $year1 = $req->get('year');
        $month = 12;
        $day11=31;
      }
      


       // $month = (int)date('m');
        $attend = array();
        $durationattend = array();
        for($i=1;$i<13;$i++) {
            for($j=1;$j<32;$j++) {


                    $attend[$i][$j] = ' ';


            }
        }
        for($i=0;$i<12;$i++) {
            for($j=0;$j<31;$j++) {

                $durationattend[$i][$j] = 0;


            }
        }

       //echo $_SESSION["staff"];
       $findSatwrk=DB::table('tblStaff')->where('StaffNum',$_SESSION["staff"])->first();
       $sw=$findSatwrk->WorksOnSaturday;


       if($findSatwrk->WorksOnSaturday==1){

        for($i=1;$i<=$month;$i++) {
            //
                       $number = cal_days_in_month(CAL_GREGORIAN, $i, $year1); // 31
                       $dayys = $number;
                       $dd = $dayys;
                       //
                       if($i == $month){
                //$dd = (int)date('d');
                           $dd=$day11;
                       }
                       for($j=1;$j<=$dd;$j++) {
                       
                           
                           $string = "$year1-$i-$j";
                           $timestamp = strtotime($string);
                            $dayy = date("D", $timestamp);

                           //if($dayy == "Sun" || $dayy == "Sat"){
                            if($dayy == "Sun"){
                               $attend[$i][$j] = $dayy;
                           }else{
                               $attend[$i][$j] = 'A';
                           }
                          
                        
                       }
                   }

       }
       else{

          for($i=1;$i<=$month;$i++) {
            //
                       $number = cal_days_in_month(CAL_GREGORIAN, $i, $year1); // 31
                       $dayys = $number;
                       $dd = $dayys;
                       //
                       if($i == $month){
                //$dd = (int)date('d');
                           $dd=$day11;
                       }
                       for($j=1;$j<=$dd;$j++) {
                       
                           
                           $string = "$year1-$i-$j";
                           $timestamp = strtotime($string);
                            $dayy = date("D", $timestamp);

                           if($dayy == "Sun" || $dayy == "Sat"){
                            
                               $attend[$i][$j] = $dayy;
                           }else{
                               $attend[$i][$j] = 'A';
                           }
                          
                        
                       }
                   }

       }
        
        $dd = 32;
        
                  
                
        
        $id = $_SESSION["staff"];
        //echo abc;
        //$newemployes = Emp_record::all();

       $year = $year1;
       $year2 = $year1;
   //  $year = 2018;
    //  $year2 = 2018;


        $newemployess = Tblstaffattendance::all();
        foreach ($newemployess as $employeee){

            if (($employeee->Staff == $id)) {
                if (($employeee->Year == $year2)){

                    for($m=1;$m<=12;$m++){
                        if (($employeee->Month == $m)) {
                            for ($d = 1; $d <= 31; $d++) {
                                if ($employeee->Day == $d) {

                                    if (  $employeee->Status == 'L' ){
                                         if($employeee->Punch == 'in'||$employeee->Punch == 'out'){
                                            $attend[$m][$d]= '1/2 L';
                                        }else{
                                            $attend[$m][$d]= 'L';
                                        }
                                    }elseif (  $employeee->Status == 'P' && $employeee->Punch == 'in'){
                                        $attend[$m][$d]= '--';

                                        //////// monthly chart
                                        $totaltime = $employeee->Duration;
                                        $totalparsed = date_parse($totaltime);
                                        $totaltime2 = $totalparsed['hour'] * 3600 + $totalparsed['minute'] * 60 + $totalparsed['second'];
                                        $totaltime2 = $totaltime2 / 3600;
                                        $totaltime2 = round($totaltime2, 2);
                                        $durationattend[$m-1][$d-1] = $totaltime2;

                                        //////////
                                    }elseif($employeee->Status == 'P' && $employeee->Punch == 'out'){
                                        $attend[$m][$d]= 'P';
                                    }


                                }
                            }
                        }
                    }

                }

            }

           if (($employeee->Year == $year1)) {
            for($m=1;$m<=12;$m++){
                if (($employeee->Month == $m)) {
                    for ($d = 1; $d <= 31; $d++) {
                        if ($employeee->Day == $d) {

                            if (  $employeee->Status == 'H' ){
                                $attend[$m][$d]= 'H';
                            }
                            if (  $employeee->Status == 'sw' ){
                                $attend[$m][$d]= 'A';
                            }
                            if (  $employeee->Status == 'W' ){
                                $attend[$m][$d]= 'Sat';
                            }
                        }
                    }
                }
            }

        }
		}

        //// new chart

        $newcharts = array();

        $monthlycharts = array();
        $daysOfMonth = array();

      $TotalDays = array();
        $monthNo = 12;
        $Thisyearis = date('Y');

        for($i = 0 ; $i < $monthNo ; $i++) {
            $TotalDays[$i] = cal_days_in_month(CAL_GREGORIAN, $i+1, $Thisyearis);
        }

        for($i = 0 ; $i < 31 ; $i++) {
            $daysOfMonth[$i] = "".($i+1)."";
        }
       $totalNoOFMonths = array("January", "February", "March" ,"April", "May", "June" ,"July", "August", "September" ,"October", "November", "December");



        for($i = 0 ; $i < 12 ; $i++) {

            $monthlycharts = array();
            $daysOfMonth = array();

            for($j = 0 ; $j < $TotalDays[$i] ; $j++) {


                $monthlycharts[$j] = 0;
                $monthlycharts[$j] = $durationattend[$i][$j];
                $daysOfMonth[$j] = "".($j+1)."";
            }

          
        }
    

        
    return view('view')->with('attendd',$attend)->with('newemployess',$newemployess)->with('year2',$year2);

       

    }

    public function create(Request $request)
    {
        session_start();
        
     
       
       if(!isset($_SESSION["whenIn"])){

            $_SESSION["whenIn"] = 0;
        }

        $abc = 0;
        $id = $_SESSION["staff"];
        $employe = new Tblstaffattendance;
        
        $employess = Tblstaffattendance::all();
        
        foreach ($employess as $employeee){

            if (($employeee->Staff == $id && $employeee->Day == date('d') && $employeee->Month == date('m') && $employeee->Year == date('Y'))) {

                if(($employeee->PunchOut == 0 || $employeee->Punch == 'in') && $_SESSION["whenIn"] == 1){

                    if(isset($request->submitted)){
                        $pinn = $employeee->PunchIn;

                    

                        $tttt = date('h').date(':i');
                        $tttt = strtotime($tttt);
                        $employeee->PunchOut = $pout = date("H:i:s");
    
    
    
                       $pdur = strtotime($pout) - strtotime($pinn);
                        //$employeee->Duration = $pdur;
                        $employeee->Punch = 'out';
                        $employeee->IPOut=$request->get('ip');
                         if($request->get('ip')=='103.197.178.22'){
                            $employeee->LocationOut='1';
                         }else{
                            $employeee->LocationOut='2';
                         }
                       
                        $employeee->ReasonOut=$request->get('reason');
                     $employeee->save();
                        $_SESSION["dddd"] = 3;
                    }
                   
                     
              return redirect('/main');
                }
                if($employeee->PunchOut != 0 && $employeee->Punch == 'out'){


                    $_SESSION["dddd"] = 3;
                    
                return redirect('/main');
                }
                $abc = 1;
            }

        }

        if($abc == 0 && $_SESSION["dddd"] == 1 ){
            
             if(isset($request->submitted)){
                $employe->Staff = $id;
          
          
                $employe->Day = date('d');
                $employe->Month = date('m');
                $employe->Year = date('Y');
                
    
                $tttt = date('h').date(':i');
                $tttt = strtotime($tttt);
                $employe->PunchIn = date("H:i:s");
    
                $employe->PunchOut = 0;
                $employe->Duration = 0;
                $employe->Status = 'P';
                $employe->Punch = 'in';
                $employe->Staff = $_SESSION["staff"];
                $employe->IPIn=$request->get('ip');
                if($request->get('ip')=='103.197.178.22'){
                    $employe->LocationIn='1';
                 }else{
                    $employe->LocationIn='2';
                 }
                $employe->ReasonIn=$request->get('reason');
    
                $employe->save();
                $_SESSION["dddd"] = 2;
           
            

           
          
           return redirect('/main');
            }
      
      
        }



       
        if($_SESSION["dddd"] == 11){
         
            foreach ($employess as $employeee2) {
                if (($employeee2->Staff == $id && $employeee2->Day == date('d') && $employeee2->Month == date('m') && $employeee2->Year == date('Y'))) {

                    

                   
                    if($employeee2->PunchOut == 0 || $employeee2->Punch == 'in') {

                        $_SESSION["dddd"] = 2;
                     
                     return redirect('/main');
                    }elseif ($employeee2->Punch == 'out'){

                        $_SESSION["dddd"] = 3;
                        
                       return redirect('/main');
                       
                    }
                }
            }



            $_SESSION["dddd"] = 1;
            
           return redirect('/main');
        
    }


    
     return redirect('/main');

       
    }

    public function show($id)
    {
        session_start();
        $record = Tblstaffattendancerecord::find($id);
        return view('show')->with("record",$record);
    }

    public function pinpout(Request $req)
    {
       session_start();
      
      $month=explode("-",$req->get('yearmonth'));

     
      $getmonthlypinpout=DB::table('tblStaffAttendance')
                              ->where('Staff',$req->get('staffnum'))
                              ->where('Month',$month[1])
                              ->where('Year',$month[0])
                              ->get();

        $staffnum=$req->get('staffnum');
      
        return view('pin_pout')->with('getmonthlypinpout',$getmonthlypinpout)->with('staffnum',$staffnum);
    }

    public function checkPunchOutValid(){
        session_start();
        $staffNum = $_SESSION["staff"];
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $punchInTime = DB::table('tblStaffAttendance')->where('Year',$year)->where('Month',$month)->where('Day',$day)->where("Staff",$staffNum)->pluck('PunchIn');
        $now = date('H:i:s');

        $fullPunchInTime = "$year-$month-$day $punchInTime[0]";
        $fullCurrentTime = "$year-$month-$day $now";


        $fullPunchInTime = date_create($fullPunchInTime);
        $fullCurrentTime = date_create($fullCurrentTime);

        $dateDiff = date_diff($fullCurrentTime,$fullPunchInTime);

        $diffInHours = $dateDiff->format('%h');
        $diffInMinutes = $dateDiff->format('%i');

        $totalDiff = ($diffInHours * 60) + $diffInMinutes;

        if($totalDiff >= 2){
            $success = 1;
        }else{
            $success = 0;
        }
        return json_encode(['success'=>$success]);

    
    }
    public function checkPunchInloction(){

        $checklocationIn=DB::table('tlkpLocations')->where('IpRange','190')->get();

        foreach($checklocationIn as $in){
        if($in->Locations=='In-Campus'){
            $success = 0;
            
        }else{
            $success = 1;
        }
       return json_encode(['success'=>$success]);
    }
      

    }

}
