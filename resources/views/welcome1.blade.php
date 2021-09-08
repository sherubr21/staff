<!doctype html>
<html class="no-js" lang="en">

@include('link.css_link')

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<h3> LOGIN <?php ?> </h3>
				
			</div>
            @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif
   
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="{{ URL('/testlogin') }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label class="control-label" for="username">UserName</label>
                                <input type="text" placeholder="UserName" title="Please enter you username" value="" name="username" id="username" class="form-control">
                                
                            </div>
                           <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                
                            </div>
                            <input type="hidden" id="ip" name="ip">
                            <button class="btn btn-success btn-block loginbtn">Login</button>
                           
                        </form>
                    </div>
                </div>
			</div>
			<div class="text-center login-footer">
			
			</div>
		</div>   
    </div>
   
</body>
@include('link.js_link')
<script type="text/javascript" src="https://l2.io/ip.js?var=userip"></script>
   <script>
  var ip=userip
  document.getElementById("ip").value =ip;
  //document.getElementById("ip").value =172;
   </script>
</html>