<!doctype html>
<html class="no-js" lang="en">
@include('link.css')

<head>

<style>

.menu{
    background-color:fff;
    color:#000;
    border:1px solid #333;
    border-radius:5px;
    width:70px;
    padding:10px;
    cursor:pointer;
    margin-bottom:10px;
}
.sub_menu{

   position:absolute;
   margin-top:10px;
   left:18px;
    display:none;
}
.sub_menu a{

    display:block;
    background-color:#f2f2f2;
    width:70px;
    padding:10px;

}

.menu:hover .sub_menu{

   display:block;

}

.arrow{
    float:right;
    transform:rotate(90deg);
}
</style>


</head>

<body>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                       <!-- <div class="caption pro-sl-hd">-->
                                    <!--   <select name="year" id="year" onchange="getyear(this)">
                                       <optgroup>
                                             <option><?php echo $_GET['year']; ?></option>
                                        </optgroup>
                                         <optgroup label="_________">

                                         <option value="2019">2019</option>
                                         <option value="2018">2018</option>
                                         <option value="2017">2017</option>
                                         <option value="2016">2016</option>
                                        </select>
                                     -->
                                       <div class="menu" onmouseover="a1()" onmouseout="a2()" >

                                       <div class="arrow" id="arrow" >&#10148;</div>

                                       <?php echo $_GET['year']; ?>

                                        <div class="sub_menu" id="sub_menu">
                                            @for($i=2020;$i>=2020; $i--)
                                                @for($month=12; $month>0; $month--)
                                                    @if(strlen($month)==1)
                                                        <?php $month = "0$month"; ?>
                                                    @endif
                                                    <a id="{{$i.'-'.$month}}" onclick="s1(this)">{{$i.'-'.$month}}</a>
                                                @endfor
                                            @endfor

                                        </div>


                                       </div>


                                       <!-- </div>-->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                        <b>P</b>=Present&nbsp;|  <b>A</b>=Absent&nbsp;| <b>H</b>=Holiday&nbsp;| <b>L</b>=Leave&nbsp;| <b>--</b>=Unresolved&nbsp; 
                                        </div>
                                    </div>
                                </div>
                                </div>
                                
                            @include('partials.view Table_partial1')

                        </div>
                    </div>
                    </div>
					
					<div class="row" style="z-index:0;background:#fff;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="z-index:0;">
                        <div class="product-sales-chart" style="z-index:0;">
                            <div class="portlet-title" style="z-index:0;">
                               <form action="{{url('pages/pinpout')}}" method="post">
                               @csrf
                               <div class="form-group-inner" style="float:left;background:#fff;">
                                                       <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="background:#ffffff;">
                                                                <label class="login2 pull-right pull-right-pro">Month</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                               <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                                             
                                                                  <div class="input-group" >
                                                                  <input type="hidden" class="form-control" name="staffnum" value="{{$staffnum}}"required />
                                                                        <input type="Month" class="form-control" name="yearmonth" required />
                                                                      
                                                                   </div>
                                                                   <div class="login-horizental">
                                                                    <button class="btn btn-sm btn-primary login-submit-cs" type="submit">submit</button>
                                                                </div>
                                                               </div>

                                                            
                                                              </div>
                                                         </div>
                                                    </div>

                               </form>           
                    </div>
                    </div>
                    </div>
                        
                   </div>
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                              <?php $count=DB::table('tblStaffAttendance')
							                              ->select('Month')
							                              ->groupBy('Month')
                                           ->where('Staff',$staffnum)
										   ->where('Year',$year2)
                                           
                                           ->get();
                                          // ->get();
                                    ?>
                                    <table Border=1><tr>
                                    <td>
                                    Month
                                    </td>
                                    <td>
                                    Holiday
                                    </td>
                                    <td>
                                    Leave
                                    </td>
                                    <td>
                                    Unresolved
                                    </td>
                                    <td>
                                    Present
                                    </td>
                                    <td>
                                    Absent
                                    </td>
                                    
                                    </tr>
                                    <?php
                                     foreach($count as $c)
                                     {      
                                      $month=$c->Month;
                                       

                                       //echo $c->Month,"<br>";
                                         //echo $c->Month;  
                                       

                                     switch($month)
                                     {
                                         case 01:
                                          echo"<tr><td>Jan</td>";
                                          $count1=DB::table('tblStaffAttendance')
                                         
                                          ->where('Month',$month)
                                          ->where('Status','H')
                                          
                                          ->get();
                                          echo"<td>" .$count1->count()."</td>";

                                          $count2=DB::table('tblStaffAttendance')
                                          ->where('Staff',$staffnum)
                                          ->where('Month',$month)
                                          ->where('Status','L')
                                          
                                          ->get();
                                          echo"<td>" .$count2->count()."</td>";

                                          $count3=DB::table('tblStaffAttendance')
                                          ->where('Staff',$staffnum)
                                          ->where('Month',$month)
                                          ->where('Status','P')
                                          ->where('Punch','in')
                                          ->get();
                                          echo"<td>" .$count3->count()."</td>";
                                              $mc=DB::table('tblStaffAttendance')
                                          ->where('Month',$month)
                                          ->where('Status','P')
                                          ->where('Staff',$staffnum)
                                          ->where('Punch','out')
                                          ->get();
                                          echo"<td>" .$mc->count()."</td>";

                                          $str = '2019-01-';
                                              $z=0;
                                                for($i2=1; $i2<30; $i2++)
                                                {
  
                                                  // echo '<br>',
                                                    $ddd = $str.$i2;
                                                  // echo '',
                                                    $date = date('Y M D d', $time = strtotime($ddd) );
                                               //$z=1;
                                                  if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                  {
    
                                                    //echo '<br>' .$date;
                                                  $z++;
                                                  }
 
                                                }
                                                  $nosdays=30;
                                                  $a=$mc->count();
                                                  $b=$count1->count();
                                                  $c=$count2->count();
                                                  $d=$count3->count();
                                                   $total=$a+$b+$c+$d+$z-1;
                                                 echo"<td>",$nosdays-$total;
                                                 echo"</td></tr>";
                                          break;
                                          case 02:
                                            echo"<tr><td>Feb</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-02-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=27;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                   echo"<td>",$nosdays-$total;
                                                   echo"</td></tr>";
                                          break;
                                          case 03:
                                            echo"<tr><td>Mar</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-11-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=30;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                   echo"<td>",$nosdays-$total;
                                                   echo"</td></tr>";
                                          break;
                                          case 04:
                                            echo"<tr><td>Apr</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-04-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=29;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                   echo"<td>",$nosdays-$total;
                                                   echo"</td></tr>";
                                          break;
                                          case 05:
                                            echo"<tr><td>May</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-05-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=30;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                   echo"<td>",$nosdays-$total;
                                                   echo"</td></tr>";
                                          break;
                                          case 06:
                                            echo"<tr><td>Jun</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-06-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=29;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                   echo"<td>",$nosdays-$total;
                                                   echo"</td></tr>";
                                          break;
                                          case 07:
                                            echo"<tr><td>Jul</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-07-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=30;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                   echo"<td>",$nosdays-$total;
                                                   echo"</td></tr>";
                                          break;
                                          case 8:
                                            echo"<tr><td>Aug</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-08-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=30;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                   echo"<td>",$nosdays-$total;
                                                   echo"</td></tr>";
                                          break;
                                          case 9:
                                            echo"<tr><td>Sep</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-08-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=29;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                   echo"<td>",$nosdays-$total;
                                                   echo"</td></tr>";
                                            
                                          break;
                                          case 10:
                                            echo"<tr><td>Oct</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";
 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";
 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";
                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";
 
                                            $str = '2019-10-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=30;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                     $total=$a+$b+$c+$d+$z-1;
                                                     echo"<td>",$nosdays-$total;
                                                     echo"</td></tr>";
                                          break;
                                          case 11:
                                            echo"<tr><td>Nov</td>";

                                           $count1=DB::table('tblStaffAttendance')
                                           
                                           ->where('Month',$month)
                                           ->where('Status','H')
                                           
                                           ->get();
                                           echo"<td>" .$count1->count()."</td>";

                                           $count2=DB::table('tblStaffAttendance')
                                           ->where('Staff',$staffnum)
                                           ->where('Month',$month)
                                           ->where('Status','L')
                                           
                                           ->get();
                                           echo"<td>" .$count2->count()."</td>";


                                           $count3=DB::table('tblStaffAttendance')
                                           ->where('Staff',$staffnum)
                                           ->where('Month',$month)
                                           ->where('Status','P')
                                           ->where('Punch','in')
                                           ->get();
                                           echo"<td>" .$count3->count()."</td>";

                                               $mc=DB::table('tblStaffAttendance')
                                           ->where('Month',$month)
                                           ->where('Status','P')
                                           ->where('Staff',$staffnum)
                                           ->where('Punch','out')
                                           ->get();
                                           echo"<td>" .$mc->count()."</td>";


                                           $str = '2019-11-';
                                               $z=0;
                                                 for($i2=1; $i2<30; $i2++)
                                                 {
   
                                                   // echo '<br>',
                                                     $ddd = $str.$i2;
                                                   // echo '',
                                                     $date = date('Y M D d', $time = strtotime($ddd) );
                                                //$z=1;
                                                   if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                   {
     
                                                     //echo '<br>' .$date;
	                                                 $z++;
                                                   }
	
                                                 }
                                                   $nosdays=29;
                                                   $a=$mc->count();
                                                   $b=$count1->count();
                                                   $c=$count2->count();
                                                   $d=$count3->count();
                                                    $total=$a+$b+$c+$d+$z-1;
                                                    echo"<td>",$nosdays-$total;
                                                    echo"</td></tr>";
                                          break;
                                          case 12:
                                            echo"<tr><td>Dec</td>";
                                            $count1=DB::table('tblStaffAttendance')
                                           
                                            ->where('Month',$month)
                                            ->where('Status','H')
                                            
                                            ->get();
                                            echo"<td>" .$count1->count()."</td>";

 
                                            $count2=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','L')
                                            
                                            ->get();
                                            echo"<td>" .$count2->count()."</td>";

 
                                            $count3=DB::table('tblStaffAttendance')
                                            ->where('Staff',$staffnum)
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Punch','in')
                                            ->get();
                                            echo"<td>" .$count3->count()."</td>";

                                                $mc=DB::table('tblStaffAttendance')
                                            ->where('Month',$month)
                                            ->where('Status','P')
                                            ->where('Staff',$staffnum)
                                            ->where('Punch','out')
                                            ->get();
                                            echo"<td>" .$mc->count()."</td>";

                                            $str = '2019-12-';
                                                $z=0;
                                                  for($i2=1; $i2<30; $i2++)
                                                  {
    
                                                    // echo '<br>',
                                                      $ddd = $str.$i2;
                                                    // echo '',
                                                      $date = date('Y M D d', $time = strtotime($ddd) );
                                                 //$z=1;
                                                    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
                                                    {
      
                                                      //echo '<br>' .$date;
                                                    $z++;
                                                    }
   
                                                  }
                                                    $nosdays=30;
                                                    $a=$mc->count();
                                                    $b=$count1->count();
                                                    $c=$count2->count();
                                                    $d=$count3->count();
                                                    $total=$a+$b+$c+$d+$z-1;
                                                    echo"<td>",$nosdays-$total;
                                                    echo"</td></tr>";
                                            
                                          break;

                                     }
                                    }
                                    
                                    
                                   
                              ?>
                              </table>
                            </div>
                        </div>
                    </div>
                 </div>



                    
                </div>
            </div>
        </div>
        @include('footer')
    </div>
    @include('link.js')
    <script>

function getyear(t) {

     var select = document.getElementById('year');
     var index = select.selectedIndex;
     var year = select.options[index].value;


    // alert(given_text);
    window.location.href = "{{ route('staff.show',$staffnum) }}?year="+year;



//var baseUrl = $("body").data('baseurl');


   }

    function s1(i1)
    {

       var year1=i1.id;
        window.location.href = "{{ route('staff.show',$staffnum) }}?year="+year1;
    }

    function a1()
    {
       arrow.style.transform="rotate(-90deg)";
       arrow.style.transition="1s";
    }

    function a2()
    {
       arrow.style.transform="rotate(90deg)";
       arrow.style.transition="1s";
    }
    </script>


</body>

</html>
