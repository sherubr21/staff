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
                            @if ($message = Session::get('success'))
                                       <div class="alert alert-danger alert-block">
                                          <button type="button" class="close" data-dismiss="alert">×</button>
                                           <strong>{{ $message }}</strong>
                                                  </div>
                                 @endif
                               
                                 <button data-toggle="modal" data-target="#myModal" type="submit" class="btn btn-primary " style="width:100px"><i class="fa fa-lus" ></i> Add Holiday</button>

                                 <div class="modal fade" id="myModal" role="dialog">
                                   <div class="modal-dialog">
    
      
                                     <div class="modal-content">
                                       <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         <h4 class="modal-title">Add Holiday</h4>
                                       </div>
                                                      <div class="modal-body">
                                                      <div class="basic-login-inner">
                                                
                                                
                                                <form action="{{url('/addHolidayDate')}}" method="post" enctype="multipart/form-data">

                                                @csrf
                                                
                                                 
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Date</label>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                <input type="date" class="form-control" name="date" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                   

                                                   

                                                    
                                                    <div class="login-btn-inner">
                                                        
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="login-horizental">
                                                                    <button class="btn btn-sm btn-primary login-submit-cs" type="submit">submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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

                                  <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                            
                                                
                                               
                                                <th>Date</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach($holiday as $h)

                                             
                                        
                                            <tr>
                                                <td></td>
                                                
                                                
                                                
                                                <td><?php echo $h->Year."/".$h->Month."/".$h->Day;?></td>
                                                <td>
                                                <form action="{{URL('/delete',$h->StaffAttendanceNum)}}" method="post"> 
                                                
                                                @csrf
                                                              
                                                         
                                              
                                                              &nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn-danger" style="width:100px">
                                                                            <i class="fa fa-trash"></i>
                                                                </button>
                                                           </form>
                                               
                                                 </td>
                                                
                                                
                                            </tr>
                                           
                                            @endforeach
                                                    
                                            </tbody>
                                           
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
    
    
</body>

</html>