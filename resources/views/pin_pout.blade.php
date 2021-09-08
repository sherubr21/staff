<!doctype html>
<html class="no-js" lang="en">
@include('link.css')


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
                                            <span class="caption-subject"><b><?php $staffname=DB::table('tblStaff')
                                                            ->where('StaffNum',$staffnum)
                                                            ->first();
                                                            echo $staffname->StaffName;
                                          ?></b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                       
                                        
                                        </div>
                                    </div>
                                </div>
                                </div>
                                
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                
                                            
                                                
                                                <th>Date</th>
                                                
                                                <th>Punch In</th>
                                             
                                                <th>Punch Out</th>
                                                <th>Location In</th>
                                                <th>Location Out</th>
                                             
                                                
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <div class="modal-bootstrap shadow-inner mg-tb-30 responsive-mg-b-0">
                                        @foreach($getmonthlypinpout as $Exception )
                                          
                                          
                                       
                                        
                                            <tr>
                                                
                                                
                                                
                                                <td><?php echo $Exception ->Day."-".$Exception ->Month."-".$Exception ->Year;?></td>
                                               
                                                <td>{{$Exception ->PunchIn}}</td>
                                                
                                                <td>
                                                {{$Exception ->PunchOut}}
                                                </td>
                                                <td><?php 
                                                        if($Exception ->LocationIn=='1')
                                                        {
                                                            echo"In-Campus";
                                                        }
                                                        else
                                                        {
                                                            echo"Out-Campus";
                                                        }
                                                
                                                
                                                ?></td>
                                                <td>
                                                <?php 
                                                        if($Exception ->LocationIn=='1')
                                                        {
                                                            echo"In-Campus";
                                                        }
                                                        else
                                                        {
                                                            echo"Out-Campus";
                                                        }
                                                
                                                
                                                ?>
                                                </td>
                                                
                                               
                                               
                                                      
                                               
                                           
                                                
                                            </tr>
                                            
                                                    
                                            
                                            
                                            @endforeach
                                                    
                                            
                                            </tbody>
                                            </div>
                                     </table>
                            
                                     <a href="{{ URL::previous() }}">Back</a>
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