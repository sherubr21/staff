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
    width:100px;
    padding:10px;
    cursor:pointer;
    margin-bottom:10px;
}
.sub_menu{

   position:absolute;
   margin-top:10px;
   left:18px;
    display:none;
    z-index: 1;
}
.sub_menu a{

    display:block;
    background-color:#f2f2f2;
    width:100px;
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
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                       
                                       <div class="menu" onmouseover="a1()" onmouseout="a2()">

                                       <div class="arrow" id="arrow" >&#10148;</div>

                                       <?php echo $_GET['year']; ?>

                                        <div class="sub_menu" id="sub_menu">
                                            @for($i=2021;$i>=2021; $i--)
                                                @for($month=12; $month>0; $month--)
                                                    @if(strlen($month)==1)
                                                        <?php $month = "0$month"; ?>
                                                    @endif
                                                    <a id="{{$i.'-'.$month}}" onclick="s1(this)">{{$i.'-'.$month}}</a>
                                                @endfor
                                            @endfor

                                        </div>


                                       </div>


                                       <!-- </div>-->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                             <?php $getmonth=$_GET['year'];
                                              
                                                if(strlen($getmonth)=='4'){
                                                    echo "Jan";
                                                }else{

                                                       $findmonth=explode("-",$getmonth);
                                                        $findmonth[1];

                                                        switch($findmonth[1]){
                                                                  case '01':
                                                                  echo "Jan";
                                                                  break;

                                                                  case '02':
                                                                  echo "Feb";
                                                                  break;

                                                                  case '03':
                                                                  echo "Mar";
                                                                  break;

                                                                  case '04':
                                                                  echo "Apr";
                                                                  break;

                                                                  case '05':
                                                                  echo "May";
                                                                  break;

                                                                  case '06':
                                                                  echo "Jun";
                                                                  break;

                                                                  case'07':
                                                                  echo "Jul";
                                                                  break;

                                                                  case '08':
                                                                  echo "Aug";
                                                                  break;

                                                                  case '09':
                                                                  echo "Sep";
                                                                  break;
  
                                                                  case'10':
                                                                  echo "Oct";
                                                                  break;
  
                                                                  case '11':
                                                                  echo "Nov";
                                                                  break;

                                                                  case '12':
                                                                  echo "Dec";
                                                                  break;
   
                                                        }
                                                }
                                             ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <a class="btn btn-primary" href="{{Request::url()}}?year={{app('request')->input('year')}}&export=excel">Export To Excel</a>
                    
                           
                        </div>
                    </div>
                  
                    @include('partials.montehlyAtttendanceview Table_partial1')


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
    window.location.href = "{{ route('HR.index') }}?year="+year;



//var baseUrl = $("body").data('baseurl');


   }

    function s1(i1)
    {

       var year1=i1.id;
      // alert(year1);
        window.location.href = "{{ route('HR.index') }}?year="+year1;
         
         
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
