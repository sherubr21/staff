<!doctype html>
<html class="no-js" lang="en">
@include('link.css')

<head>

<style>

.menu{
    background-color:fff;
    color:#000;
    border:1px solid #333;
    border-radius:5px;
    width:70px;
    padding:10px;
    cursor:pointer;
    margin-bottom:10px;
}
.sub_menu{

   position:absolute;
   margin-top:10px;
   left:18px;
    display:none;
}
.sub_menu a{

    display:block;
    background-color:#f2f2f2;
    width:70px;
    padding:10px;
    
}

.menu:hover .sub_menu{

   display:block;

}

.arrow{
    float:right;
    transform:rotate(90deg);
}
</style>


</head>

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
                                       <!-- <div class="caption pro-sl-hd">-->
                                    <!--   <select name="year" id="year" onchange="getyear(this)">
                                       <optgroup>
                                             <option><?php echo $_GET['year']; ?></option>
                                        </optgroup>
                                         <optgroup label="_________">
                                        
                                         <option value="2019">2019</option>
                                         <option value="2018">2018</option>
                                         <option value="2017">2017</option>
                                         <option value="2016">2016</option>
                                        </select>
                                     -->
                                       <div class="menu" onmouseover="a1()" onmouseout="a2()" >

                                       <div class="arrow" id="arrow" >&#10148;</div>
                                      
                                       <?php echo $_GET['year']; ?>
                                        
                                        <div class="sub_menu" id="sub_menu">
                                         <a id="2020" onclick="s1(this)">2020</a>
                                       

                                        </div>


                                       </div>


                                       <!-- </div>-->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                         <b>P</b>=Present&nbsp;|  <b>A</b>=Absent&nbsp;| <b>H</b>=Holiday&nbsp;| <b>L</b>=Leave&nbsp;| <b>--</b>=Unresolved&nbsp; 
                                        </div>
                                    </div>
                                </div>
                                </div>
                            @include('partials.view Table_partial')
                           
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                             
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
    <script>

function getyear(t) {
     
     var select = document.getElementById('year');
     var index = select.selectedIndex;
     var year = select.options[index].value;
 
     
    // alert(given_text);
    window.location.href = '{{route("pages.index")}}?year='+year;
    


//var baseUrl = $("body").data('baseurl');
                                             
                                         
   }
    
    function s1(i1)
    {

       var year1=i1.id;
        window.location.href = '{{route("pages.index")}}?year='+year1;
    }

    function a1()
    {
       arrow.style.transform="rotate(-90deg)";
       arrow.style.transition="1s";
    }
  
    function a2()
    {
       arrow.style.transform="rotate(90deg)";
       arrow.style.transition="1s";
    }
    </script>
    
    
</body>

</html>