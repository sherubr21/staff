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
                                
                                 
                                

                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="name" data-editable="true">Name</th>
                                                <th data-field="date" data-editable="true">Date</th>
                                                <th data-field="month" data-editable="true">Month</th>
                                                <th data-field="pin" data-editable="true">Punch In</th>
                                                <th data-field="pout" data-editable="true">Punch Out</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($objemp as $e)
                                            <tr>
                                                <td></td>
                                                <td>{{$e->id}}</td>
                                                <td>{{$e->user_id}}</td>
                                                <td>{{$e->day}} </td>
                                                <td>{{$e->month}} </td>
                                                <td>{{$e->punch_in}}</td>
                                                <td>{{$e->punch_out}}</td>
                                                <td><a href="{{route('staff.show',$e->id)}}">view</a></td>
                                                
                                            </tr>
                                            @endforeach
                                            </tbody>
                                     </table>
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