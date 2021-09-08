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
                                                
                                                
                                                <form action="{{url('update')}}" method="post" enctype="multipart/form-data">

                                                @csrf
                                                <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro"></label>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            {{$staff->StaffName}}
                                                            <input type="hidden" name="staff" value="{{$staff->StaffNum}}"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Office Timing</label>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <select id="getFname" name="offT" class="form-control">
                                                              <option value="{{$staff->OfficeTiming}}"><?php if($staff->OfficeTiming==1){
                                                        echo "8:30-4:30";
                                                }else{
                                                    echo "9:30-5:30";
                                                } ?></option>
                                                              
															  <option value="1">8:30 - 4:30</option>
															  <option value="2">9:30-5:30</option>
                                                              
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Saturday Worker</label>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <select id="getFname" name="satw" class="form-control">
                                                              <option value="{{$staff->WorksOnSaturday}}"><?php if($staff->WorksOnSaturday==1){
                                                        echo "Saturday worker";
                                                }else{
                                                    echo "non Saturday worker";
                                                } ?></option>
                                                              
															  <option value="1">Saturday worker</option>
															  <option value="2">non Saturday worker</option>
                                                              
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    

                                                    
                                                    
                                                    <div class="login-btn-inner">
                                                        
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="login-horizental">
                                                                    <a href="{{ url()->previous() }}"><button class="btn btn-sm btn-primary login-submit-cs" type="button">Back</button></a>
                                                                    <button class="btn btn-sm btn-success login-submit-cs" type="submit">update</button>
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