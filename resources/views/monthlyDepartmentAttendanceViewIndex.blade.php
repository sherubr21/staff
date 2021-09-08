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

                                @if ($message = Session::get('sucess'))
                                       <div class="alert alert-danger alert-block">
                                          <button type="button" class="close" data-dismiss="alert">×</button>
                                           <strong>{{ $message }} 
                                                @if (Session::get('noOfdays')>1)
                                                 {{Session::get('noOfdays')}} &nbsp;days
                                                @elseif(Session::get('noOfdays')==1||Session::get('noOfdays')==0.5)
                                                    {{Session::get('noOfdays')}} &nbsp;day
                                                @else
                                                  
                                                @endif
                                                
                                                </strong>
                                        </div>
                                 @endif

                                 @if (count($errors) > 0)
                                     <div class="alert alert-danger">
                                     <button type="button" class="close" data-dismiss="alert">×</button>
                                      <ul>
                                      @foreach($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                      @endforeach
                                      </ul>
                                     </div>
                                    @endif
                                <div class="basic-login-inner">
                                                
                                                
                                                <form action="{{ URL('/DepartmentAttendance')}}" method="post" enctype="multipart/form-data">

                                                @csrf
                                                
                                                 <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Select the department </label>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <select  name="dprt" class="form-control">
                                                            <?php $getdep=DB::table('tlkpDepartments')->get();
                                                                           foreach($getdep as $dep){

                                                                           
                                                            ?>
                                                                                <option value="{{ $dep->DepartmentNum }}">{{ $dep->Department }}</option>
                                                              
                                                             <?php } ?> 
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    <div class="form-group-inner">
                                                       <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Month and year</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                               <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                                             
                                                                  <div class="input-group" >
                                                                        <input type="month" class="form-control" name="MonthYear" required />
                                                                      
                                                                   </div>
                                                               </div>

                                                            
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
                    </div>
                    
                        
                       
                    </div>
                </div>
            </div>
        </div>
		
		
      

        
        @include('footer')
        
    </div>
    @include('link.js')
    
    
</body>
<script>

</script>

</html>