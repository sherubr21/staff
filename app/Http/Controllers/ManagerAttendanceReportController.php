<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DatePeriod;
use DateInterval;
use App;
use DB;
use Response;

class ManagerAttendanceReportController extends Controller
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
                     //->join('tlkpSubdepartments','StaffNum','=','SubdepartmentHead')
                     ->where('Department',$_SESSION["department"])
                   //  ->where('CanTeach','0')
                     ->join('tblStaffContracts', 'tblStaff.StaffNum', '=', 'tblStaffContracts.Staff')
                     ->join('tlkpAssignments', 'tblStaff.AssignmentNum', '=', 'tlkpAssignments.AssignmentNum')
                     ->where('ContractStatus','1')
                     //->where('StaffNum','1065')
                     ->orderBy('StaffName')
                     ->get(['StaffNum','Assignment','StaffName','WorksOnSaturday']);
       
        $staffAttendance = [];
        foreach($dateRange as $date):
            $currentDate = $date->format("Y-m-d");
            $currentDay = $date->format("D");
            foreach($staffs as $staff):
                $staffNum = $staff->StaffNum;
              // $attendanceQuery = DB::select("select Status,Punch from tblStaffAttendance where CONCAT(Year,'-',CASE WHEN LENGTH(MONTH)=1 THEN CONCAT('0',MONTH) ELSE MONTH END,'-',CASE WHEN LENGTH(DAY)=1 THEN CONCAT('0',DAY) ELSE DAY END) = ? and Staff = ?",[$currentDate,$staffNum]);
                $attendanceQuery = DB::select("select Status,Punch,PunchIn,PunchOut from tblStaffAttendance where (CAST(Year AS varchar) + '-' + CAST((CASE WHEN LEN(Month) = 1 THEN '0' + Month ELSE Month END) AS varchar)  + '-' + CAST((CASE WHEN LEN(Day) = 1 THEN '0' + Day ELSE Day END) AS varchar)) = ? and Staff = ?",[$currentDate,$staffNum]);
                $attendanceQuery1 = DB::select("select Status,Punch from tblStaffAttendance where (CAST(Year AS varchar) + '-' + CAST((CASE WHEN LEN(Month) = 1 THEN '0' + Month ELSE Month END) AS varchar)  + '-' + CAST((CASE WHEN LEN(Day) = 1 THEN '0' + Day ELSE Day END) AS varchar)) = '$currentDate' and Staff ='0'");
               
               
                  
                    if(count($attendanceQuery)>0){
                        if ($attendanceQuery[0]->Status == 'L') {
                            $attendance = 'L';
                        } elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'in') {
                            $attendance = "--\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut;
                        } elseif ($attendanceQuery[0]->Status == 'P' && $attendanceQuery[0]->Punch == 'out') {
                            $attendance ="P\n".$attendanceQuery[0]->PunchIn."\n".$attendanceQuery[0]->PunchOut;
                        }
                    }
                    
                    elseif(count($attendanceQuery1)>0){
                                
                        // $attendance = 'H';
    
                          if ($attendanceQuery1[0]->Status == 'H') {
                              $attendance = 'H';
                          } elseif ($attendanceQuery1[0]->Status == 'W' ) {
                              $attendance = '';
                          }
                          elseif ($attendanceQuery1[0]->Status == 'sw' ) {
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

       return view('ManagerAttendanceView')->with('staffAttendance', $staffAttendance)->with('staffs',$staffs)->with('dateRange', $dateRange);
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
        //
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
    public function edit($id)
    {
        //
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
}
