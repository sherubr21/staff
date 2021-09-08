<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tblstaffattendance;

class LoginController extends Controller
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
		
		
		
        $ldap_host = "LDAP://dc1.rtc.bt";
 
	// active directory DN (base location of ldap search)
	$ldap_dn = "OU=rtcusers,DC=rtc,DC=bt";
 
	// active directory user group name
	$ldap_user_group = "rtcusers";
 
	// active directory manager group name
	$ldap_manager_group = "WebManagers";
 
	// domain, for purposes of constructing $user
	$ldap_usr_dom = '@rtc.bt';
 
	// connect to active directory
	$ldap = ldap_connect($ldap_host);
 
	// configure ldap params
	ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
	ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);
 
	// verify user and password
	if($bind = @ldap_bind($ldap, $user.$ldap_usr_dom, $password)) {
		// valid
		// check presence in groups
		$filter = "(sAMAccountName=".$user.")";
		$attr = array("memberof");
		$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);
		ldap_unbind($ldap);
 
		// check groups
		$access = 0;
		foreach($entries[0]['memberof'] as $grps) {
			// is manager, break loop
			if(strpos($grps, $ldap_manager_group)) { $access = 2; break; }
 
			// is user
			if(strpos($grps, $ldap_user_group)) $access = 1;
		}
 
		if($access != 0) {
    
    
       
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
 
	} else {
        return back()->with('error', 'Incorrect username or password');
	}
	}
	else{
		return back()->with('error', 'User does not exist');
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
