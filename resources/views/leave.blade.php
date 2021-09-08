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
															 
                                                              
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Reason</label>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Reason" name="reason" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group-inner">
                                                       <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">From</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                               <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                                             
                                                                  <div class="input-group"  >
                                                                        <input type="date" class="form-control" name="start" id="start" required />
                                                                      
                                                                   </div>
                                                               </div>

                                                            
                                                              </div>
                                                              <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" id="sDivCheck" style="display:none;">
                                                                <div class="row">
                                                                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2 pull-right pull-right-pro">If you are applying for half day. tick the checkbox </label>
                                                                   </div>
                                                                   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                    <input type="checkbox" class="form-control" name="shalfday" value="1" />
                                                                   </div>
                                                                </div>
                                                            </div>
                                                         </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                       <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">To</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                               <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                                             
                                                                  <div class="input-group" >
                                                                        <input type="date" class="form-control" name="end" id="end" required />
                                                                      
                                                                   </div>
                                                               </div>

                                                            
                                                              </div>
                                                              <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" id="sDivCheck1" style="display:none;">
                                                              <div class="row">
                                                                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2 pull-right pull-right-pro">If you are applying for half day. tick the checkbox</label>
                                                                   </div>
                                                                   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                    <input type="checkbox" class="form-control" name="ehalfday" value="1" />
                                                                   </div>
                                                                </div>
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

       document.getElementById("end").onchange = function (e) {
          var a=document.getElementById("end").value;
          var b=document.getElementById("start").value;
          //alert(a);
          var d = new Date(a);
          var c = new Date(b);
          var n = d.getDay();
          var m = c.getDay();
         

            if(n!=6){
                   // alert(n);
                    document.getElementById("sDivCheck1").style.display="";
                }
                if(m!=6){
                   // alert(n);
                  // alert(m);
                    document.getElementById("sDivCheck").style.display="";
                }
				if(a==b){
                   // alert(n);
                  // alert(m);
                    document.getElementById("sDivCheck").style.display="none";
                }


          
     };
        </script>

        
        @include('footer')
        
    </div>
    @include('link.js')
    
    
</body>
<script>

</script>

</html>