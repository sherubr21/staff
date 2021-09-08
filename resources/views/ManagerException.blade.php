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
                            <?php 
                                  $staffname=DB::table('tblStaff')->where('StaffNum',$id)->first();
                                                echo $staffname->StaffName;                     
                            ?>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                
                                            
                                                
                                                <th>Date</th>
                                                
                                                <th>Punch In</th>
                                             
                                                <th>Punch Out</th>
                                                <th>Location In</th>
                                                <th>Location Out</th>
                                                
                                                <th>Explanation</th>
                                                <th>Supervisor Comment</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <div class="modal-bootstrap shadow-inner mg-tb-30 responsive-mg-b-0">
                                        @foreach($findException as $Exception )

                                                <?php if($Exception->ReasonIn==!NULL||$Exception->ReasonOut==!NULL){?>
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
                                                
                                                
                                                <td>
                                                <?php 
                                                       // if($Exception ->ReasonIn==!NULL){
                                                            echo $Exception->ReasonIn.",".$Exception->ReasonOut;
                                                          
                                                      //  }
                                                        
                                                      //  else{
                                                            
                                                      //  }
                                                ?>
                                                </td>
                                                     

                                                <td>
                                                     
                                                           <form action="{{ route('EmployeeException.store') }}" method="POST">
   
                                                            

                                                            
                                                           
                                                              @csrf
                                                              <input type="hidden" name="id" value="{{ $Exception->StaffAttendanceNum}}">
                                                            
                                                               <div class="form-group">
                                                                    
                                                                    <textarea style="height:30px;" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="1" name="supervisorcomment">{{ $Exception->SupervisorComment}}</textarea>
                                                                </div>
                                                               <button type="submit" class="btn btn-danger">Add</button>
                                                           </form>
                                                </td>
                                                
                                                
                                            </tr>
                                           
                                                      <?php }
                                                    /* else{
                                                        return redirect()->back();
                                                      }*/
                                                      ?>
                                            
                                            
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