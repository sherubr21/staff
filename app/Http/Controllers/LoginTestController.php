<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tblstaffattendance;

class LoginTestController extends Controller
{
    public function index(Request $req)
    {
        $user=$req->get('username');
        $password=$req->get('password');
        $ip=$req->get('ip');
        $Staffnum = $user;
        if($staff=DB::table('tblStaff')->where('EMailRTC',$Staffnum)->first())
		
		{
        session_start();
        $_SESSION["staff"]=$staff->StaffNum;
        $_SESSION["officetiming"]=$staff->OfficeTiming;
        $_SESSION["CausalLeaveAccrued"]=$staff->CasualLeaveAccrued;
        $_SESSION["CompLeaveAccrued"]=$staff->CompLeaveAccrued;
		 $_SESSION["EarnedLeaveAccrued"]=$staff->EarnedLeaveAccrued;
		
		
		
       
    
    
       
                            $_SESSION["staff"]=$staff->StaffNum;
                            $_SESSION["subdepartment"]=$staff->Subdepartment;
                            $_SESSION["department"]=$staff->Department;
                            $n=$staff->StaffFullName;
                            $u=$user;
                            $_SESSION["aaa"]=$n;
                            $_SESSION["eee"]=$u;
                            $_SESSION["ip"]=$ip;
							$_SESSION["AssignmentNum"]=$staff->AssignmentNum;
                             if($staff->AssignmentNum=='87'){
                                   return redirect('/president');

                            }
                            elseif($staff->AssignmentNum=='60'||$staff->AssignmentNum=='24'||$staff->AssignmentNum=='100'||$staff->AssignmentNum=='15'){
                                   return redirect('/executive');

                                        }else{
                                                return redirect('/main');

                              }							
							} else {
			// user has no rights
            //return false;
            echo "sucess1";
		}
 
	
    }

        

        public function getLogout(){
            session_start();
            foreach($_SESSION as $key=>$value):
                unset($_SESSION[$key]);
            endforeach;
            session()->flush();
            return redirect('/');
        }
}
