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
                                                <th data-field="state" data-checkbox="true"></th>
                                            
                                                
                                                <th>Name</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Reason</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <?php  //session_start();
                                               $leave=DB::table('tblleaves')
                                               ->join('tblStaff','Staff','=','StaffNum')
                                               ->join('tlkpDepartments','Staff','=','DepartmentHead')
                                             
                                               ->whereNotIn('StaffNum',[$_SESSION["staff"]])
                                               ->where('Status','4')
                                               ->get();
                                               ?>
                                        <tbody>
                                         <div class="modal-bootstrap shadow-inner mg-tb-30 responsive-mg-b-0">
                                        @foreach($leave as $l)


                                        
                                            <tr>
                                                <td></td>
                                                
                                                
                                                <td>{{$l->StaffName}}</td>
                                                <td><?php echo date("F-j-Y",strtotime($l->FromDate));?></td>
                                                <td><?php echo date("F-j-Y",strtotime($l->ToDate));?></td>
                                                <td>{{$l->Reason}}</td>
                                                <td>
                                               <?php 
                                                     $typeLeave=DB::table('tblLeaves')->get();
                                                                       if($l->CasualLeave!=NULL){
                                                                           echo"Casual Leave";

                                                                       }
                                                                       elseif($l->EarnedLeave!=NULL ){
                                                                           echo"Earned Leave";
                                                                       }
                                                                       elseif($l->CompLeave!=NULL ){
                                                                            echo "Comp Leave";
                                                                       }else
                                                                       {
                                                                             echo"Other Leave";
                                                                       }

                                                                
                                               ?>
                                               </td>
                                                
                                                <td>
                                                
                                                               
                                                           <form action="{{ route('supervisor.destroy',$l->LeaveNum) }}" method="POST">
   
                                                            

                                                             <a class="btn btn-primary" href="{{ route('supervisor.edit',$l->LeaveNum) }}">Approvd</a>
                                                            
                                                                                                                        @csrf
                                                                @method('DELETE')
                                                            
                                                                <button type="submit" class="btn btn-danger">Rejected</button>
                                                            </form>
                                                        
                                                         
                                                           
</form>
                                                           
                                               
                                                 </td>
                                                
                                                
                                            </tr>
                                            
                                            @endforeach
                                                    
                                            
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