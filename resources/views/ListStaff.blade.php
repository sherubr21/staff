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
                            
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                             
                                            
                                                
                                                <th>Staff Num</th>
                                                <th>Staff Name</th>
                                                <th>Action</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <div class="modal-bootstrap shadow-inner mg-tb-30 responsive-mg-b-0">
                                        <?php $checkEmpleavebal=DB::table('tblStaff')
                                                                ->where('Subdepartment',$_SESSION["subdepartment"])
                                                                ->whereNotIn('StaffNum',[$_SESSION["staff"]])
                                                                ->join('tblStaffContracts', 'tblStaff.StaffNum', '=', 'tblStaffContracts.Staff')
                                                                ->where('ContractStatus','1')
                                                                ->get();

                                              foreach($checkEmpleavebal as $lbal) 
                                              {

                                                               
                                        
                                        ?>
                                        
                                            <tr>  
                                    
                                            <td>{{$lbal->StaffNum}}</td>
                                            <td>{{$lbal->StaffName}}</td>
                                            <td> <a class="btn btn-primary" href="{{ route('staff.show',$lbal->StaffNum) }}?year=<?php echo date('Y');?>">View</a></td>
                                            
                                                             
                                            </tr>

                                              <?php } ?>
                                            </tbody>
                                            </div>
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