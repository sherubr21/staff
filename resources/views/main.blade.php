<!doctype html>
<html class="no-js" lang="en">
@include('link.css')


<?php


?>
<script>





</script>


<?PHP

if(!isset($_SESSION['dddd'])){
?>

<script>window.location.href = '{{route("pages.create")}}';</script>
<?php
$_SESSION["dddd"] = 11;
}

$button1 = 0;
$button2 = 0;
?>
<body data-baseurl="{{url('/')}}">
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    @include('hr.side_menu')
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper" >
    @include('hr.header')




        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid" >
                <div class="row" >
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12" >
                        <div class="product-sales-chart">


                            <div  style="height: 556px;" >


                             <div class="row" >

                             <div class="container" style="margin-left:20%;width:50%;">

                             <input type="hidden"  id="ip1">
                              <button type="button" id="button1" class="<?php

                                          if($_SESSION["dddd"] == 1){
                                              echo "btn btn-success ";
                                              $button1 = 1;
                                          }
                                          elseif($_SESSION["dddd"] == 2){
                                              echo "btn btn-success disabled";
                                              $button1 = 2;
                                          }
                                          elseif($_SESSION["dddd"] == 3){
                                              echo "btn btn-success disabled";
                                              $button1 = 3;
                                          }

                                       ?>"
                                    onclick="myFunction()" style="line-height:45px;">
                                    &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Sign In&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</button>&ensp;



                                           <button type="button" id="button2"  class="<?php
                                           if($_SESSION["dddd"] == 1){
                                               echo "btn btn-success disabled";
                                               $button2 = 1;
                                           }
                                           elseif($_SESSION["dddd"] == 2){
                                               echo "btn btn-success ";
                                               $button2 = 2;
                                           }
                                           elseif($_SESSION["dddd"] == 3){
                                echo "btn btn-success disabled";
                                $button3 = 3;
                            }

                            ?>" onclick="myFunction1()" style="line-height:45px;">
                            
                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Sign Out&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</button>



                                <div class="row">
                                          <br>
                                         <p style="font-size:12px;top-margin:10px;">In case you Sign In / Sign Out outside of the official working hours, please provide a valid reason to enable the button above, and for regularising the attendance: 
                                    </p>
                                       <div class="col-sm-4">


                                         <div class="form-group">
                                            
                                             <textarea rows="4" cols="100" id="reason" class="form-control" style="width:300px;">

                                             </textarea>
                                         </div>



                                   </div>
                                  </div>
                             </div>
                            </div>




                               </div>
                              </div>

                            </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                            <h3 class="box-title">Casual Leave Balance</h3>
                           <?php echo $_SESSION["CausalLeaveAccrued"];?>
                        </div>
                        <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                            <h3 class="box-title">Earned Leave Balance</h3>

                            <?php echo $_SESSION["EarnedLeaveAccrued"];?>


                        </div>
						
						<div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                            <h3 class="box-title">Comp off Leave Balance</h3>

                            <?php echo $_SESSION["CompLeaveAccrued"];?>


                        </div>



 <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">



                           
                           <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">View Leave Details</button>

   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Leave History</h4>
        </div>
        <div class="modal-body">
        <table border='1' style="width:100%;">
        
        <thead>
        <tr>
            <th>
                 From (yyyy-mm-dd,  hr: min) 
            </th>
            <th>
                 TO (yyyy-mm-dd,  hr: min) 
            </th>
            <th>
                 Remarks
            </th>
        </tr>
         <?php $leaveDetails=DB::table('tblLeaves')
		         ->where('Staff',$_SESSION['staff'])
				 ->where('ToDate' ,'>','2020-03-01')
				 ->get();  
               foreach($leaveDetails as $ld){
         ?>
        <tbody>
        <tr>
            <td>
                 <?php echo date('Y-m-d H:i',strtotime($ld->FromDate));?>
            </td>
            <td>
            <?php 
			echo date('Y-m-d H:i',strtotime($ld->ToDate));
			?>
            </td>
            <td>
            <?php echo $ld->Remarks;?>
            </td>
        </tr>
        </tbody>
               <?php }?>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
                        <div class="white-box analytics-info-cs table-dis-n-pro tb-sm-res-d-n dk-res-t-d-n">
                            <h3 class="box-title"></h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('ipaddrss.js') }}"></script>
        @include('footer')

    </div>
    @include('link.js')
    <script type="text/javascript" src="https://l2.io/ip.js?var=userip"></script>
    <script>

                            function myFunction() {
                            //  alert(userip);

                              var reason=document.getElementById('reason').value;
                              var ip=userip;
                            //var ip=172;

                                <?php


                                       if($button1 == 1){
                                            ?>
                                          window.location.href = '{{route("pages.create")}}?reason='+reason+'&submitted=1&ip='+ip;
                                            <?php
                                        }
                                ?>
                                }

                            function myFunction1() {


                                var reason=document.getElementById('reason').value;
                             //   alert(userip);

                               var ip=userip;
                           //   var ip=172;
                              //   alert(reason);
                                <?php



                                        if($button2 == 2){
                                        $_SESSION["whenIn"] = 1;
                                        ?>
                                        window.location.href = '{{route("pages.create")}}?reason='+reason+'&submitted=1&ip='+ip;
                                <?php
                               }

                                ?>
                            }
                        </script>



                                        <script>
                                    <?php  if($t==0 || $success == 0){ ?>
                                      $(document).ready(function() {

                                            $("#button1").attr('disabled', true);

                                            <?php if($button1 == 1): ?>
                                            $('textarea').on('keyup',function() {
                                                var textarea_value = $("#reason").val();
                                                textarea_value = textarea_value.trim();

                                                if(textarea_value != '') {
                                                    $("#button1").attr('disabled', false);
                                                } else {
                                                    $("#button1").attr('disabled', true);
                                                }
                                            });
                                        <?php endif; ?>
                                        });
                                        </script>
                                        <?php }
                                         else{
                                             ?>
                                         <script>
                                         $(document).ready(function() {

                                         $("#button1").attr('disabled', flase);

                                         <?php// if($button1 == 1): ?>

                                         });
                                         </script>
                                    <?php } ?>




                                 <script>

                                 $(document).ready(function() {

                                          //CHECK IF PUNCH IN TIME IS BEFORE TIME PERIOD
                                      /*       var baseUrl = $("body").data('baseurl');
                                             $.ajax({
                                              url: baseUrl + "/CheckPunchOutValid",
                                              type: "GET",
                                              dataType: "JSON",
                                              success:function(data){
                                                var success = data.success;
                                                  if(success == 1){
                                                  $("#button2").attr('disabled', false);
                                                  }
                                                  else {
                                                     $("#button2").attr('disabled', true);
                                                  }
                                              }
                                           });*/






                                 });
                                 </script>


                                 <?php

                                       // if($t1==0 || $success == 0)
                                       //{?>
                                         <?php if($t1==0 || $success == 0): ?>
                                        <script>

                                       $(document).ready(function() {

                                            $("#button2").attr('disabled', true);


                                            $('textarea').on('keyup',function() {
                                                var textarea_value = $("#reason").val();
                                                textarea_value = textarea_value.trim();

                                                if(textarea_value != '') {
                                                    $("#button2").attr('disabled', false);
                                                } else {
                                                 $("#button2").attr('disabled', true);
                                                }
                                            });
                                        });
                                        </script>
                                        <?php endif; ?>
                                        <?php // }
                                        ?>



                                        <?php

if($success==0)
{?>

<script>

// $(document).ready(function() {

   // alert("ss");
//     $("#button1").attr('disabled', true);

//     $('textarea').on('keyup',function() {
//         var textarea_value = $("#reason").val();


//         if(textarea_value != '') {
//             $("#button1").attr('disabled', false);
//         } else {
//          $("#button1").attr('disabled', true);
//         }
//     });
// });
</script>

<?php }?>







</body>

</html>
