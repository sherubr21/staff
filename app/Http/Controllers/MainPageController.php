<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tblstaffattendance;

class MainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();

        $date1 = date('m');
        $date2 = date('d');
        $season=0;
 


	      if($date1==2){
     		      if($date2>14){
				    //  echo "sum";
			      }else{
                      //echo "win";
                      $season=1;
			      }
	      }elseif($date1==12){
		
		      if($date2>8){
                     // echo "win";
                     $season=1;
			      }else{
				     // echo "sum";
			      }
		
	      }elseif($date1==1){
    //	echo "win";
           $season=1;
	      }
	      else{
		    //  echo "sum";
		
	      }
	
        $year=DB::table('tlkpSemesters')
                                                   
        ->where('StartDate','<',date('Y-m-d'))
        ->where('EndDate','>',date('Y-m-d'))
        
        ->get();
       // echo $year->FallSpring;
       $fallspring=0;
        foreach($year as $l){
            $fallspring=$l->FallSpring;
           // $fallspring=0;
        }           if($season==1)
                       {
                                             $getOfficetiming=DB::table('tlkpOfficeTimings')
                                                               ->where('TimingNum','3')
                                                               ->first();

                                              $epecttime =  date('H:i:s', strtotime("15 minutes", strtotime($getOfficetiming->StartTime)));
                   
                                              $timingIn = str_replace(':', '', $epecttime);
                                              $epecttime1 = date('H:i:s', strtotime("-15 minutes", strtotime($getOfficetiming->EndTime)));
                                              $timingOut = str_replace(':', '', $epecttime1);
                    
                      
                   
                                              $currentTime = date('H:i:s');
                                              $now=str_replace(':', '', $currentTime);
         
                                                  if($timingIn > $now)
                                                    $t=1;
                                                  else
                                                   $t=0;

                                                     if($timingOut < $now)
                                                      $t1=1;
                                                        else
                                                       $t1=0;

                       }
                        else{ 
                             if($fallspring=='Fall'||$fallspring=='Spring'||$fallspring==0){

       
                                          if($_SESSION["officetiming"]==1)
                                          {
                                             $getOfficetiming=DB::table('tlkpOfficeTimings')
                                                               ->where('TimingNum',$_SESSION["officetiming"])
                                                               ->first();

                                              $epecttime =  date('H:i:s', strtotime("15 minutes", strtotime($getOfficetiming->StartTime)));
                   
                                             $timingIn = str_replace(':', '', $epecttime);
                                              $epecttime1 = date('H:i:s', strtotime("-15 minutes", strtotime($getOfficetiming->EndTime)));
                                             $timingOut = str_replace(':', '', $epecttime1);
                    
                      
                   
                                             $currentTime = date('H:i:s');
                                              $now=str_replace(':', '', $currentTime);
                                              $day=date("D");
                                              if($day=='Sat'){

                                                $getOfficetiming=DB::table('tlkpOfficeTimings')
                                                   ->where('TimingNum','4')
                                                   ->first();

                                                    $epecttime =  date('H:i:s', strtotime("+15 minutes", strtotime($getOfficetiming->StartTime)));

                                                    $timingIn = str_replace(':', '', $epecttime);
                                                    $epecttime1 = date('H:i:s', strtotime("-15 minutes", strtotime($getOfficetiming->EndTime)));
                                                    $timingOut = str_replace(':', '', $epecttime1);

                                              }
         
                                                  if($timingIn > $now)
                                                    $t=1;
													
												else
                                                    $t=0;

                                                     if($timingOut < $now)
                                                     $t1=1;
                                                 else
                                                      $t1=0;

                          

                                              }if($_SESSION["officetiming"]==2){

                                                  $getOfficetiming=DB::table('tlkpOfficeTimings')
                                                  ->where('TimingNum',$_SESSION["officetiming"])
                                                  ->first();

                                                   $epecttime =  date('H:i:s', strtotime("+15 minutes", strtotime($getOfficetiming->StartTime)));
      
                                                    $timingIn = str_replace(':', '', $epecttime);
                                                    $epecttime1 = date('H:i:s', strtotime("-15 minutes", strtotime($getOfficetiming->EndTime)));
                                                       $timingOut = str_replace(':', '', $epecttime1);
                                                 
      
                                                    $currentTime = date("H:i:s");
                                                    $now=str_replace(':', '', $currentTime);
                                                    $day=date("D");
                                                    if($day=='Sat'){

                                                      $getOfficetiming=DB::table('tlkpOfficeTimings')
                                                         ->where('TimingNum','4')
                                                         ->first();

                                                          $epecttime =  date('H:i:s', strtotime("+15 minutes", strtotime($getOfficetiming->StartTime)));
      
                                                          $timingIn = str_replace(':', '', $epecttime);
                                                          $epecttime1 = date('H:i:s', strtotime("-15 minutes", strtotime($getOfficetiming->EndTime)));
                                                          $timingOut = str_replace(':', '', $epecttime1);

                                                    }
         
                                                  if($timingIn > $now)
                                                     $t=1;
                                                  else
                                                     $t=0;

                                                     if($timingOut < $now)
                                                    $t1=1;
                                                  else
                                                    $t1=0;

                                              }
                    
                    
                    
                         
                               } 
                               else{

                                  $falspr=0;
                                        echo"sss";
                               }
                            }

     /*$loc=$_SESSION['ip'];


     $checklocationIn=DB::table('tlkpLocations')->where('IpRange',$loc)->first();
     
                               if($checklocationIn->Locations=='In-Campus'){
                                  $success = 1;
                                  //echo "ss";
                                  103.197.178.22
								  103.197.177.61
                                }else{
                                     $success = 0;
                                  //echo "ff";
                                }*/
								if($_SESSION['ip']=='103.197.178.22'){
								             $success = 1;
								}else{
								          $success = 0;
								}
                        
       
  
    return view('main')->with('t',$t)->with('t1',$t1)->with('success',$success);
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
	
	public function presidentPage(){
      session_start();
      
      return view('MainPresidentPage');
    }
    public function executivePage(){
      session_start();
      return view('MainExecutivePage');
    }
	public function associatePage(){
      session_start();
      
      return view('MainAssociateDeanPage');
    }
	 public function deanPage(){
      session_start();
      return view('MainDeanPage');
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
