<!doctype html>
<html class="no-js" lang="en">
@include('link.css')
<style type="text/css">
textarea {
 width: 300px;
 height: 100px;

 border: 1px solid blue;
}
</style>


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
    <div class="all-content-wrapper">
    @include('hr.header')
    



        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject"><b></b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div  style="height: 356px;">
                           
                        <div id="ip"></div>
                         <div class="row">
                         
                        <div class="container">
                       
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
                                    onclick="myFunction()" >
                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Punch In&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</button>



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

                            ?>" onclick="myFunction1()">
                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Punch Out&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</button>
                      
                        </div>
                        </div>
                            <br>

                        <div class="row">
                            <p style="font-size:12px;"><b></b>&nbsp;&nbsp; If you are Punch In/Out in different time<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp; You should provide the reason<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;  for Punch In/Out timing.<br><br><br></p>
                          <div class="col-sm-4">
                          
                          
                            <div class="">
                                <label class="control-label" for="">Explanation </label>
                                <textarea rows="4" cols="50" id="reason" class="">
 
                                </textarea>
                            </div>
                           
                           
                         
                            </div>
                           </div> 
                          
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                            <h3 class="box-title">Causal Leave Balance</h3>
                           <?php echo $_SESSION["CausalLeaveAccrued"];?>
                        </div>
                        <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                            <h3 class="box-title">Earned Leave Balance</h3>
                            
                            <?php echo $_SESSION["EarnedLeaveAccrued"];?>
                      
                      
                        </div>
                      
                      
                      
                        <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                      
                      
                      
                            <h3 class="box-title"></h3>
                        

                      
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
                                        <?php// }?>



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