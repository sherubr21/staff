<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tblstaffattendance;
use App;
use DB;
//use Request;

class StaffController extends Controller
{
    public function index(Request $req){
        session_start();
      
        
        return view('ListStaff');

        
         }
         public function show($id,Request $req){
          session_start();
            // echo $idd=$id;
           //  echo $yr=$req->get('year');
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
       
       
       
               $dd = 32;
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
                           $attend[$i][$j] = '';
                       }
                   }
               }
               //session_start();
              // $id = $_SESSION["staff"];
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
                                               $attend[$m][$d]= 'L';
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
           
       
               //return view('pages.view')->with('attendd',$attend)->with('newemployess',$newemployess)->with('newcharts',$newcharts)->with('year2',$year2);
               return view('view1')->with('attendd',$attend)->with('newemployess',$newemployess)->with('year2',$year2)->with('staffnum',$id);
       
        }
          

            
         }
        
