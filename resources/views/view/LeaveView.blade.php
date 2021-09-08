<div>
 <?php 
      $getname=DB::table('tblStaff')->where('StaffNum',$_SESSION['staff'])->first();

    echo "Leave request from ".$getname->StaffName;
 ?>


</div>