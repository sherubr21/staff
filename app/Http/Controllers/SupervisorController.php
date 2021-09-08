<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendApproveLeaveMail;
use App\Mail\SendRejectLeaveMail;


use App;
Use DB;
//use Mail;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();
      
        
        return view('ListSupervisor');
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();

       /* $listsupervisor = App\Supervisor::all();
        return view('ListSupervisor',['listsupervisor' => $listsupervisor]);*/
       
       return view('Addsupervisor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // echo $request->input('mail');
       session_start();

       $user = App\Supervisor::where('email',$request->input('mail'))->first();
       if($user==!NULL)
       {
            $message="Aready add as supervisor";     
       
      
        
      
       }
       else{
        $message="inserted";    
        $supervisor=new App\Supervisor;
      
        $supervisor->email=$request->input('mail');
        $supervisor->save();

       
        
      
       }

       return redirect()->route('supervisor.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        session_start();
        $leave=DB::table('tblleaves')
                   ->join('tblStaff','Staff','=','StaffNum')
                    ->where('Subdepartment',$id)
                    ->whereNotIn('StaffNum',[$_SESSION["staff"]])
                    ->where('Status','4')
                    ->get();

         

                return view('ListLeave',['leave' => $leave]);



        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
      $findstaff=DB::table('tblLeaves')->where('LeaveNum',$id)->first();

     $findemail=DB::table('tblStaff')->where('StaffNum',$findstaff->Staff)->first();
   //  echo $findemail->CasualLeaveAccrued;
     if($findstaff->CasualLeave==!NULL){
      
         if ($findemail->CasualLeaveAccrued>=$findstaff->CasualLeave){

                DB::table('tblStaff')->where('StaffNum',$findstaff->Staff)->decrement('CasualLeaveAccrued',$findstaff->CasualLeave);
                DB::table('tblleaves')
                 ->where('LeaveNum', $id)
                 ->update(['Status' => 1,'Remarks'=>'Approved']);
                }
      
        else{
          return back()->with('success', 'No casual leave');
            }
    }
    if($findstaff->EarnedLeave==!NULL){
      
      
          if($findemail->EarnedLeaveAccrued>$findstaff->EarnedLeave){
          DB::table('tblStaff')->where('StaffNum',$findstaff->Staff)->decrement('EarnedLeaveAccrued',$findstaff->EarnedLeave);
          DB::table('tblleaves')
          ->where('LeaveNum', $id)
          ->update(['Status' => 1,'Remarks'=>'Approved']);
        // }  
        }
         else{
          return back()->with('success', 'No Eearn leave');
          }
 }
 
 if($findstaff->CompLeave==!NULL){
      
      
      if($findemail->CompLeaveAccrued>=$findstaff->CompLeave){
      DB::table('tblStaff')->where('StaffNum',$findstaff->Staff)->decrement('CompLeaveAccrued',$findstaff->CompLeave);
      DB::table('tblleaves')
      ->where('LeaveNum', $id)
      ->update(['Status' => 1,'Remarks'=>'Approved']);
    // }  
    }
     else{
      return back()->with('success', 'No Comp leave');
      }
 }

      
		 
		 
		                              $date_from = $findstaff->FromDate;  
                                  $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
  
                                  // Specify the end date. This date can be any English textual format  
                                  $date_to = $findstaff->ToDate;  
                                  $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
                                     
                                  // Loop from the start date to end date and output all dates inbetween  
                                  for ($i=$date_from; $i<=$date_to; $i+=86400) {
                                                 $holiday=DB::table('tblStaffAttendance')
                                                     ->where('Status','H')
                                                     ->where('Year',date('Y',$i ))
                                                     ->where('Month',date('m',$i ))
                                                     ->where('Day',date('d',$i ))
													 
                                                     ->get();
                                          if(count($holiday)==0){  
                                        if(date("w",$i)!=0){
                                      
                                          $findaddleave=App\Tblstaffattendance::where('Staff',$findstaff->Staff)
                                                                      ->where('Day',date("d", $i))                                   
                                                                      ->where('Month',date("m", $i))
                                                                      ->where('Year',date("Y", $i))
																	  ->where('Status','L')
                                                                      ->first();

                                          if($findaddleave==!Null){
                                               $ms="alredy add to leave";
                                          }   
                                          else{   
                                              $ms="approved";                   
                                          $updateleave=App\Tblstaffattendance::where('Staff',$findstaff->Staff)
                                              ->where('Day',date("d", $i))                                   
                                              ->where('Month',date("m", $i))
                                              ->where('Year',date("Y", $i))
                                             
                                              ->first();
                                                         if($updateleave==!Null){
                                                               
                                                                
                                                                DB::table('tblStaffAttendance')
                                                                ->where('Staff',$findstaff->Staff)
                                                                ->where('Day',date("d", $i))                                   
                                                                ->where('Month',date("m", $i))
                                                                ->where('Year',date("Y", $i))
                                                                ->update(['Status' =>'L']);
                                                              
                                                              } 
                                                              else{
                                                                $addleave=new App\Tblstaffattendance;
                                                                 $addleave->Staff=$findstaff->Staff;
                                                                $addleave->Day=date("d", $i);
                                                                $addleave->Month=date("m", $i);
                                                                $addleave->Year=date("Y", $i);

                                                                $addleave->Status="L";
                                                                $addleave->save();
                                                               
                                                              }
                                          }
                                        }
                                  }  
                                }
 
      Mail::to($findemail->EMailRTC.'@rtc.bt')->send(new SendApproveLeaveMail());
      return back()->with('success', 'approved');

       

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        echo $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
      $findstaff=DB::table('tblLeaves')->where('LeaveNum',$id)->first();

      
        $findemail=DB::table('tblStaff')->where('StaffNum',$findstaff->Staff)->first();
        DB::table('tblLeaves')->where('leaveNum', $id)->delete();
        Mail::to($findemail->EMailRTC.'@rtc.bt')->send(new SendRejectLeaveMail());
        return back()->with('success', 'Deleted');
    }
}
