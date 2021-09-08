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
                                           <strong>{{ $message }}</strong>
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
                                                
                                                
                                                <form action="{{route('leave.store')}}" method="post" enctype="multipart/form-data">

                                                @csrf
                                                
                                                 <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Type of Leave</label>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <select id="getFname" name="leave" class="form-control">
                                                              <option value="cl">Casual Leave</option>
                                                              <option value="el">Earned Leave</option>
                                                              <option  value="comp">Comp leave</option>
															  <option value="1">Paternity Leave</option>
															  <option value="2">Maternity Leave</option>
                                                              
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Reason</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Reason" name="reason" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                       <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Date</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                               <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                                             
                                                                  <div class="input-group" >
                                                                        <input type="date" class="form-control" name="start" required />
                                                                       <span class="input-group-addon">to</span>
                                                                       <input type="date" class="form-control" name="end" required />
                                                                   </div>
                                                               </div>

                                                            
                                                              </div>
                                                         </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">No. of days</label>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <input type="number" step="0.1"class="form-control" placeholder="No. of days" name="nod" />
                                                            </div>
                                                        </div>
                                                    </div>
													 <div class="row" id="admDivCheck"style="display:none;">
                                                              <div class="col-md-4"></div>
                                                              <div class="form-group col-md-4">
                                                                <input type="file" name="file">    
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
		
		
        <script>
       document.getElementById("getFname").onchange = function (e) {
       if (this.value == 1) {
         document.getElementById("admDivCheck").style.display="";
       }
        else if (this.value == 2) {
         document.getElementById("admDivCheck").style.display="";
       }
	   else {
         document.getElementById("admDivCheck").style.display="none";
      }
     };
        </script>
        @include('footer')
        
    </div>
    @include('link.js')
    
    
</body>

</html>