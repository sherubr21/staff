<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DatePeriod;
use DateInterval;
use App;
use DB;
use Response;
use App\Exports\MonthlyAttendanceExport;
use Excel;

class HRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        session_start();
        $year1 = $req->get('year');
     

        $date_formatted = date_create($year1."-01");
        $startDate = date_format($date_formatted,'Y-m-d');

        if ($req->get('year') == date('Y-m')) {
            $endDate = date('Y-m-d');

        } else {
            $endDate = date_format($date_formatted,"Y-m-t");
        }
        $endDate = date_add(date_create($endDate),date_interval_create_from_date_string("1 day"));

        $interval = new DateInterval("P1D");
        $dateRange = new DatePeriod(date_create($startDate),$interval,$endDate);

         $staffs=DB::table('tblStaff')
                     ->where('Canteach','0')
                     ->whereNotNull('EMailRTC')
                     ->join('tblStaffContracts', 'tblStaff.StaffNum', '=', 'tblStaffContracts.Staff')
					  ->join('tlkpAssignments', 'tblStaff.AssignmentNum', '=', 'tlkpAssignments.AssignmentNum')
                     ->where('ContractStatus','1')
                     ->orderBy('StaffName')
                     ->get(['StaffNum','Assignment','StaffName','WorksOnSaturday','OfficeTiming']);
       
        $staffAttendance = [];
        foreach($dateRange as $date):
            $currentDate = $date->format("Y-m-d");
            $currentDay = $date->format("D");
            foreach($staffs as $staff):
                $staffNum = $staff->StaffNum;
              // $attendanceQuery = DB::select("select Status,Punch from tblStaffAttendance where CONCAT(Year,'-',CASE WHEN LENGTH(MONTH)=1 THEN CONCAT('0',MONTH) ELSE MONTH END,'-',CASE WHEN LENGTH(DAY)=1 THEN CONCAT('0',DAY) ELSE DAY END) = ? and Staff = ?",[$currentDate,$staffNum]);
                $attendanceQuery = DB::select("select a.Month,a.Day,a.Status,a.Punch,a.PunchIn,a.PunchOut,a.ReasonIn,a.ReasonOut,a.SupervisorComment,a.LocationIn,a.LocationOut from tblStaffAttendance a join tblStaff b on a.Staff = b.StaffNum  where (CAST(Year AS varchar) + '-' + CAST((CASE WHEN LEN(Month) = 1 THEN '0' + Month ELSE Month END) AS varchar)  + '-' + CAST((CASE WHEN LEN(Day) = 1 THEN '0' + Day ELSE Day END) AS varchar)) = ? and Staff = ?",[$currentDate,$staffNum]);
                $attendanceQuery1 = DB::select("select Status,Punch from tblStaffAttendance where (CAST(Year AS varchar) + '-' + CAST((CASE WHEN LEN(Month) = 1 THEN '0' + Month ELSE Month END) AS varchar)  + '-' + CAST((CASE WHEN LEN(Day) = 1 THEN '0' + Day ELSE Day END) AS varchar)) = '$currentDate' and Staff ='0'");
               
               
                  
                            if(count($attendanceQuery)>0){
                                     
                                     if($attendanceQuery[0]->Status == 'L') {
                                           if($attendanceQuery[0]->Punch == 'in'||$attendanceQuery[0]->Punch == 'out'){
                                            $attendance = '1/2 day L';
                                         } else{
                                            $attendance = 'L';
                                         }
                                      } 
                                               /* if ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut == 1 && $attendanceQuery[0]->Month == 01 ) {
                                                   // $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n unresolved    Explanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                                   $attendance="LL";
                                                }  */        
                                                if($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Month == 01 && $attendanceQuery[0]->Day<32){

                                                    if($attendanceQuery[0]->PunchIn < '9:15:59' && $attendanceQuery[0]->PunchOut > '15:45:00'){
                                                      $attendance='P';
                                                     }
                                                     else{
                                                        $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                                       //$attendance='Z';
                                                     }
                  
                                                     
                                                 }
                                                 elseif($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Month == 12 && $attendanceQuery[0]->Day>17){
                  
                                                  if($attendanceQuery[0]->PunchIn < '9:15:59' && $attendanceQuery[0]->PunchOut > '15:45:00'){
                                                      $attendance='P';
                                                     }
                                                     else{
                                                        $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                                       //$attendance='Z';
                                                     }
                                                 }
                                                 elseif($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Month == 02 && $attendanceQuery[0]->Day<15){
                  
                                                  if($attendanceQuery[0]->PunchIn < '9:15:59' && $attendanceQuery[0]->PunchOut > '15:45:00'){
                                                      $attendance='P';
                                                     }
                                                     else{
                                                        $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                                       //$attendance='Z';
                                                     }
                                                 }
                                                elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'in' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut === NULL) {
                                                    $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n unresolved    Explanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                                }
                                    
                                                elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut== 1 ) {
                                                         
                                                       
                                                               //if($staff->OfficeTiming==1 && $attendanceQuery[0]->PunchIn < '8:45:59' && $attendanceQuery[0]->PunchOut > '16:15:00'){
                                                                $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut;
                                                                 //$attendance='P';
                                                                 //$attendance=$staff->OfficeTiming;
                                                              /* }else{
                                                                $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                                               }
                                                             /*  if($staff->OfficeTiming==2 && $attendanceQuery[0]->PunchIn < '9:45:59' && $attendanceQuery[0]->PunchOut > '17:15:00'){
                                                                $attendance=$staff->OfficeTiming;
                                                               }
                                                               else{
                                                                  $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                                                 //$attendance='Z';*/
                                                               //}
                                                         

                                                   }
                                                    
                                                   elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'in' && $attendanceQuery[0]->LocationIn == 2 && $attendanceQuery[0]->LocationOut == NULL) {
                                                       $attendance ="--\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment. "  Sign In : Out Campus";
                     
                      
                                                   } 
                                                   elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut == 2) {
                                                       $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\n Supervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign Out : Out Campus";
                       
                                                   }
                                                   elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 2 &&  $attendanceQuery[0]->LocationOut == 1) {
                                                         $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus";
                            
                           
                                                    } 
                                                    elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 2 && $attendanceQuery[0]->LocationOut== 2) {
                                                         $attendance ="P ".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus  Sign Out:Out Campus";
                        
                        
                       
                    
                                                    }
                                                
                                                elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut=== NULL) {
                                                     $attendance ="P ".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus  Sign Out:Out Campus";
                    
                                                   // $attendance ="P";
                   
                
                                                }
                                                elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 2 && $attendanceQuery[0]->LocationOut=== NULL) {
                                                    $attendance ="P ".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus  Sign Out:Out Campus";
                    
                                                    //$attendance ="P";
                   
                
                                                }
                                                   
                                    
                             }
                             elseif(count($attendanceQuery1)>0){
                                
                        // $attendance = 'H';
    
                                      if ($attendanceQuery1[0]->Status == 'H') {
                                          $attendance = 'H';
                                      } elseif ($attendanceQuery1[0]->Status == 'W' ) {
                                          $attendance = '';
                                      }
                                      elseif ($attendanceQuery1[0]->Status == 'SW' ) {
                                          $attendance = 'A';
                                      }
                          
                              }
                    
                              else
                              {
                        
                                      $attendance = 'A';

                                      if($staff->WorksOnSaturday==2){

                                          if ($currentDay=="Sat"||$currentDay=="Sun") {
                                           
                                              $attendance = $currentDay;
                                          }
                                         // echo $staff->StaffName."<br>";
                           
                                      }
                                      elseif($staff->WorksOnSaturday==1){
        
                                          if ($currentDay=="Sun") {
                                              $attendance = $currentDay;
                                          }
                                         // echo $staff->StaffName."<br>";
                           
                                      }
                        
                           
                        
                        
                        
                        
                        
                       
                               }
                   
                    
                         

                //}
               $staffAttendance[$staffNum][$currentDate] = $attendance;
            endforeach;
        endforeach;
       if($req->input('export')=='excel'){
           $view = 'partials.montehlyAtttendanceview Table_partial1';
           return Excel::download(new MonthlyAttendanceExport($staffAttendance,$staffs,$dateRange), 'monthlyattendance.xls');
       }else{
           $view = 'monthlyAttendanceView1';
       }
       return view($view)->with('staffAttendance', $staffAttendance)->with('staffs',$staffs)->with('dateRange', $dateRange);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $download=DB::table('tblLeaves')
                      ->where('LeaveNum',$request->input('lnum'))
                      ->first();
        
       // return download($download->Path);    
        return Response::download($download->Path);      
    }                    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function viewMonthlyAttDprtIndex(){
       
        session_start();
        return view('monthlyDepartmentAttendanceViewIndex');



    }
    public function viewMonthlyAttDprt(Request $request){
       
        
        /*$date = explode('-', $request->input('MonthYear'));
        echo $date[1];
        echo $request->input('dprt');*/

        session_start();
        $year1 = $request->input('MonthYear');
     
        $startDate = $year1."-01";
        $endDate = date_format(date_create($startDate),"Y-m-t");

        // if ($request->input('MonthYear') == date('Y-m')) {
        //     $endDate = date('Y-m-d');

        // } else {
        //     $endDate = date_format($date_formatted,"Y-m-t");
        // }
        $endDate = date_add(date_create($endDate),date_interval_create_from_date_string("1 day"));
        //dd($startDate,$endDate);

        $interval = new DateInterval("P1D");
        $dateRange = new DatePeriod(date_create($startDate),$interval,$endDate);

         $staffs=DB::table('tblStaff')
                     ->where('Canteach','0')
                     ->where('Department',$request->input('dprt'))
                     ->whereNotNull('EMailRTC')
                    
                     ->join('tblStaffContracts', 'tblStaff.StaffNum', '=', 'tblStaffContracts.Staff')
					  ->join('tlkpAssignments', 'tblStaff.AssignmentNum', '=', 'tlkpAssignments.AssignmentNum')
                    
                     ->where('tblStaff.AssignmentNum','!=',100)->where(function($query){
                         $query->where('tblStaff.AssignmentNum','!=',60);
                     }

                     )->where(function($query){
                        $query->where('tblStaff.AssignmentNum','!=',87);
                    }

                    )->where(function($query){
                        $query->where('tblStaff.AssignmentNum','!=',107);
                    }

                    )
                      
                     ->where('ContractStatus','1')
                     ->orderBy('StaffName')
                     ->get(['StaffNum','Assignment','StaffName','WorksOnSaturday','OfficeTiming']);
       
        $staffAttendance = [];
        foreach($dateRange as $date):
            $currentDate = $date->format("Y-m-d");
            $currentDay = $date->format("D");
            foreach($staffs as $staff):
                $staffNum = $staff->StaffNum;
              // $attendanceQuery = DB::select("select Status,Punch from tblStaffAttendance where CONCAT(Year,'-',CASE WHEN LENGTH(MONTH)=1 THEN CONCAT('0',MONTH) ELSE MONTH END,'-',CASE WHEN LENGTH(DAY)=1 THEN CONCAT('0',DAY) ELSE DAY END) = ? and Staff = ?",[$currentDate,$staffNum]);
                $attendanceQuery = DB::select("select a.Month,a.Day,a.Status,a.Punch,a.PunchIn,a.PunchOut,a.ReasonIn,a.ReasonOut,a.SupervisorComment,a.LocationIn,a.LocationOut from tblStaffAttendance a join tblStaff b on a.Staff = b.StaffNum  where (CAST(Year AS varchar) + '-' + CAST((CASE WHEN LEN(Month) = 1 THEN '0' + Month ELSE Month END) AS varchar)  + '-' + CAST((CASE WHEN LEN(Day) = 1 THEN '0' + Day ELSE Day END) AS varchar)) = ? and Staff = ?",[$currentDate,$staffNum]);
                $attendanceQuery1 = DB::select("select Status,Punch from tblStaffAttendance where (CAST(Year AS varchar) + '-' + CAST((CASE WHEN LEN(Month) = 1 THEN '0' + Month ELSE Month END) AS varchar)  + '-' + CAST((CASE WHEN LEN(Day) = 1 THEN '0' + Day ELSE Day END) AS varchar)) = '$currentDate' and Staff ='0'");
               
               
                  
                    /*if(count($attendanceQuery)>0){
                        if ($attendanceQuery[0]->Status == 'L') {
                            $attendance = 'L';
                       } elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'in') {
                            $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                        } elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out') {
                            $attendance ="P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                        //}

                      } elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'in' && $attendanceQuery[0]->LocationIn == 1) {
                        $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\n Supervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : In Campus";
                       
                       } elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'in' && $attendanceQuery[0]->LocationIn == 2) {
                            $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus";
                            
                           
                    } elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut==2) {
                        $attendance ="P ".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : In Campus  Sign Out:Out Campus";
                        
                        
                       
                    
                    }
                    elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 2 && $attendanceQuery[0]->LocationOut==1) {
                        $attendance ="P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\n Supervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus Sign Out:In Campus";
                        
                        
                       
                    
                    }
                    elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 2 && $attendanceQuery[0]->LocationOut== 2) {
                        $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus Sign Out: Out Campus";
                        
                    }
                }*/
                if(count($attendanceQuery)>0){
                                     
                    if($attendanceQuery[0]->Status == 'L') {
                          if($attendanceQuery[0]->Punch == 'in'||$attendanceQuery[0]->Punch == 'out'){
                                            $attendance = '1/2 day L';
                                         } else{
                                            $attendance = 'L';
                                         }
                     } 
                              /* if ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut == 1 && $attendanceQuery[0]->Month == 01 ) {
                                  // $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n unresolved    Explanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                  $attendance="LL";
                               }  */        
                               if($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Month == 01 && $attendanceQuery[0]->Day<32){

                                  if($attendanceQuery[0]->PunchIn < '9:15:59' && $attendanceQuery[0]->PunchOut > '15:45:00'){
                                    $attendance='P';
                                   }
                                   else{
                                      $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                     //$attendance='Z';
                                   }

                                   
                               }
                               elseif($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Month == 12 && $attendanceQuery[0]->Day>17){

                                if($attendanceQuery[0]->PunchIn < '9:15:59' && $attendanceQuery[0]->PunchOut > '15:45:00'){
                                    $attendance='P';
                                   }
                                   else{
                                      $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                     //$attendance='Z';
                                   }
                               }
                               elseif($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Month == 02 && $attendanceQuery[0]->Day<15){

                                if($attendanceQuery[0]->PunchIn < '9:15:59' && $attendanceQuery[0]->PunchOut > '15:45:00'){
                                    $attendance='P';
                                   }
                                   else{
                                      $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                     //$attendance='Z';
                                   }
                               }
                               elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'in' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut === NULL) {
                                   $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n unresolved    Explanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                               }
                   
                               elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut== 1 ) {
                                        
                                      
                                             
                                               
                                               if($attendanceQuery[0]->ReasonIn ===NULL || $attendanceQuery[0]->ReasonOut===NUll){
                                                    $attendance='P';
                                                }else{
                                                    $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n unresolved    Explanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment;
                                                }       
                                             
                                        

                                  }
                                   
                                  elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'in' && $attendanceQuery[0]->LocationIn == 2 && $attendanceQuery[0]->LocationOut == NULL) {
                                      $attendance ="--\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment. "  Sign In : Out Campus";
    
     
                                  } 
                                  elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut == 2) {
                                      $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\n Supervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign Out : Out Campus";
      
                                  }
                                  elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 2 &&  $attendanceQuery[0]->LocationOut == 1) {
                                        $attendance = "P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus";
           
          
                                   } 
                                   elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 2 && $attendanceQuery[0]->LocationOut== 2) {
                                        $attendance ="P ".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus  Sign Out:Out Campus";
       
       
      
   
                                   }
                               
                               elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 1 && $attendanceQuery[0]->LocationOut=== NULL) {
                                   $attendance ="P ".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus  Sign Out:Out Campus";
   
                                   //$attendance ="P";
  

                               }
                               elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out' && $attendanceQuery[0]->LocationIn == 2 && $attendanceQuery[0]->LocationOut=== NULL) {
                                    $attendance ="P ".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut."\nExplanation:".$attendanceQuery[0]->ReasonIn." ".$attendanceQuery[0]->ReasonOut."\nSupervisor Comment:".$attendanceQuery[0]->SupervisorComment."\n Sign In : Out Campus  Sign Out:Out Campus";
   
                                   //$attendance ="P";
  

                               }
                                  
                   
            }
                    elseif(count($attendanceQuery1)>0){
                                
                        // $attendance = 'H';
    
                          if ($attendanceQuery1[0]->Status == 'H') {
                              $attendance = 'H';
                          } elseif ($attendanceQuery1[0]->Status == 'W' ) {
                              $attendance = '';
                          }
                          elseif ($attendanceQuery1[0]->Status == 'SW' ) {
                              $attendance = 'A';
                          }
                          
                      }
                    
                    else{
                        
                        $attendance = 'A';

                        if($staff->WorksOnSaturday==2){

                            if ($currentDay=="Sat"||$currentDay=="Sun") {
                                $attendance = $currentDay;
                            }
                           // echo $staff->StaffName."<br>";
                           
                        }
                        elseif($staff->WorksOnSaturday==1){
        
                            if ($currentDay=="Sun") {
                                $attendance = $currentDay;
                            }
                           // echo $staff->StaffName."<br>";
                           
                        }
                        
                           
                        
                        
                        
                        
                        
                       
                    }
                   
                    
                         

                //}
               $staffAttendance[$staffNum][$currentDate] = $attendance;
            endforeach;
        endforeach;
        $getdept=DB::table('tlkpDepartments')->where('DepartmentNum',$request->input('dprt'))->value('Department');
        if($request->input('export')=='excel'){
            $view = 'partials.montehlyAtttendanceview Table_partial';
            return Excel::download(new MonthlyAttendanceExport($staffAttendance,$staffs,$dateRange), 'monthlyattendance.xls');
        }else{
            $view = 'monthlyDepartmentAttendanceView';
        }
        if(!(bool)$getdept){
            $getdept = '';
        }

        return view($view)->with('staffAttendance', $staffAttendance)->with('staffs',$staffs)->with('dateRange', $dateRange)->with('year',$year1)->with("dprt",$getdept);




    }
	
	public function AddCalendarView(){
        session_start();
        $holiday=App\Tblstaffattendance::where('Staff','0')->where('Status','H')->orderByDesc('StaffAttendanceNum')->get();

        return view('AddCalendarView')->with('holiday',$holiday);



    }

    public function AddCalendarPost(Request $request){
      //  echo $request->input('date');
        /// echo date("Y",strtotime($request->input('date')));

       $checkDate=App\Tblstaffattendance::where('Staff','0')
                                          ->where('Status','H')
                                          ->where('Day',date("d",strtotime($request->input('date'))))
                                          ->where('Month',date("m",strtotime($request->input('date'))))
                                          ->where('Year',date("Y",strtotime($request->input('date'))))
                                           ->first();

        if($checkDate==!NULL){
            
            return redirect()->back()->with('success', 'Date Already Exist');
        }else{

            $obj=new App\Tblstaffattendance;
            $obj->Staff='0';
            $obj->Status='H';
            $obj->Day=date("d",strtotime($request->input('date')));
            $obj->Month=date("m",strtotime($request->input('date')));
            $obj->Year=date("Y",strtotime($request->input('date')));
            $obj->save();
            return redirect()->back()->with('success', 'Succesfully Added');

        }

       /* $obj=new App\Tblstaffattendance;*/


       // return view('AddCalendarView')->with('holiday',$holiday);



    }

    public function deletepost($id){

        DB::table('tblStaffAttendance')->where('StaffAttendanceNum', $id)->delete();

      
        
        return back()->with('success', 'Deleted');


    }
    public function UpdattinofficeTiming(){
        session_start();
        $staffs=DB::table('tblStaff')
                     ->where('Canteach','0')
                     //->where('Department',$request->input('dprt'))
                     ->whereNotNull('EMailRTC')
                    
                     ->join('tblStaffContracts', 'tblStaff.StaffNum', '=', 'tblStaffContracts.Staff')
					  ->join('tlkpAssignments', 'tblStaff.AssignmentNum', '=', 'tlkpAssignments.AssignmentNum')
                    
                     ->where('tblStaff.AssignmentNum','!=',100)->where(function($query){
                         $query->where('tblStaff.AssignmentNum','!=',60);
                     }

                     )->where(function($query){
                        $query->where('tblStaff.AssignmentNum','!=',87);
                    }

                    )->where(function($query){
                        $query->where('tblStaff.AssignmentNum','!=',107);
                    }

                    )
                      
                     ->where('ContractStatus','1')
                     ->orderBy('StaffName')
                     ->get();

                     return view('TimingView')->with('staff',$staffs);





    }

    public function editView($id){
        session_start();
        $getStaff=DB::table('tblStaff')->where('StaffNum',$id)->first();
        return view('EditView')->with('staff',$getStaff);

           

    }
    public function updateOfficeSatwrk(Request $request){
        //session_start();
       // $getStaff=DB::table('tblStaff')->where('StaffNum',$id)->first();
      //  return view('EditView')->with('staff',$getStaff);
       echo $request->input('staff');

       $update=DB::table('tblStaff')->where('StaffNum',$request->input('staff'))
                        ->update(['OfficeTiming'=>$request->input('offT'),'WorksOnSaturday'=>$request->input('satw')]);


               if($update==true){
                return redirect('/UpdattinofficeTiming')->with('success', 'Succesfully update');
               }       
           

    }
}
