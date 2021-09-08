<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        session_start();
      return view('ListSupervisor1');
     
        
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
        session_start();
      
      
                    $leave=DB::table('tblleaves')
                   ->join('tblStaff','Staff','=','StaffNum')
                   ->join('tlkpSubdepartments','Staff','=','SubdepartmentHead')
                    ->where('Department',$id)
                    ->whereNotIn('StaffNum',[$_SESSION["staff"]])
                    ->where('Status','4')
                    //->unique('StaffNum')
                    ->get();
                   /* if($leave->unique('StaffNum')==NULL && $leave->unique('FromDate')==NULL && $leave->unique('ToDate')==NULL)
                  //  foreach($leave->unique('StaffNum','FromDate','ToDate') as $l){
                      {
                        echo "llll";
                      }else
                      {
                        foreach($leave as $l){
                            echo " ".$l->StaffNum."<br>";
                        }

                      }*/
                    

         

               return view('ListLeave1',['leave' => $leave]);
              

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
        echo  $findstaff->Staff;
       if ($findstaff->CasualLeave==!NULL){
   
           DB::table('tblStaff')->where('StaffNum',$findstaff->Staff)->decrement('CasualLeaveAccrued',$findstaff->CasualLeave);
          
       }
         if($findstaff->EarnedLeave==!NULL){
           DB::table('tblStaff')->where('StaffNum',$findstaff->Staff)->decrement('EarnedLeaveAccrued',$findstaff->EarnedLeave);
         }
   
         DB::table('tblleaves')
              ->where('LeaveNum', $id)
            ->update(['Status' => 1]);
        DB::table('tblleaves')
        ->where('LeaveNum', $id)
        ->update(['Status' => 1]);

       /* Mail::send('tickets.emails.tickets',array('ticketsCurrentNewId'=>
'hhjj','ticketsCurrentSubjectId'=>'hhjkkk','ticketsCurrentLocationsObj'=>'jjkkk'), function($message)
{
//$message->from('your@gmail.com');
$message->to('sherubrangdrel@rtc.bt', 'Amaresh')->subject(`Welcome!`);
});*/
    
    return back()->with('success', 'approved');

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
        DB::table('tblLeaves')->where('leaveNum', $id)->delete();
        return back()->with('success', 'Deleted');
    }
}
