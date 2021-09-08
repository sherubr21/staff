<!doctype html>
<html lang="en">

<meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
   
@include('link.css')
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 200px;
		width:400px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
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
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject"><b></b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                                </div>
                               
                                <b>Punch In:</b> &ensp;&ensp;&ensp;{{ $record->punch_in }}<br>
                                <b>Punch Out:</b>&ensp;&ensp;{{ $record->punch_out }}<br>
                           
                                <?php 
                                  
                                   // $date=$record->year."-".$record->month."-".$record->day;
                                    // echo $date;
                                    $findlocation=DB::table('locations')
                                                      ->where('email',$record->email)
                                                      ->where('date',$record->year."-".$record->month."-".$record->day)
                                                            ->first();
                                                            ?>
                                       
                                                            
                                       <div id="map"></div>
                                       <script>

                                         function initMap() {
                                           var myLatLng = {lat:<?php echo $findlocation->punch_in_lat;?>, lng:<?php echo $findlocation->punch_in_lon;?>};
                                           var myLatLng1 = {lat:<?php echo $findlocation->punch_out_lat;?>, lng:<?php echo $findlocation->punch_out_lon;?>};

                                           var map = new google.maps.Map(document.getElementById('map'), {
                                             zoom: 11
                                             ,
                                             center: myLatLng,
                                             mapTypeId: google.maps.MapTypeId.HYBRID
                                                                              });

                                           var marker = new google.maps.Marker({
                                             position: myLatLng,
                                             map: map,
                                             title: 'punch in location'
                                           });
                                           var marker1 = new google.maps.Marker({
                                             position: myLatLng1,
                                             map: map,
                                             title: 'punch out location'
                                           });
                                         }
                                       </script>
                                       <script async defer
                                       src="https://maps.googleapis.com/maps/api/js?callback=initMap">
                                       </script>
                                
                                
                        </div>
                       

                    </div>
                    
                      
                       
                    </div>
                </div>
            </div>
        </div>
        @include('footer')
        
    </div>
    @include('link.js')
    
    
</body>

</html>
