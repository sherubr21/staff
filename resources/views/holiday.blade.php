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
                               
                                
                                 
                                @if ($message = Session::get('sucess'))
                                       <div class="alert alert-danger alert-block">
                                          <button type="button" class="close" data-dismiss="alert">×</button>
                                           <strong>{{ $message }}</strong>
                                                  </div>
                                 @endif

       
                                 <div class="col-md-3">
                                    <button class="btn btn-success" style="width:100px"><a href="#" data-toggle="modal" data-target="#PrimaryModalalert"><i class='fa fa-plus'></i></a></button>
                                </div>
       
                                 <div id="PrimaryModalalert" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-close-area modal-close-df">
                                                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                            </div>
                                            <form action="{{route('holiday.create')}}" method="put">
                                            <div class="modal-body">
                                            @csrf 
                                                <h2>Date</h2>
                                                 <input type="date" name="date" class="form-control input-lg">

                                            </div>
                                            <div class="modal-footer">
                                                
                                                <input type="submit" value="submit"  class="btn btn-primary"/>
                                            </div>
                                            </form>
                                        </div>
                                      </div>
                                     </div>
        
                                   <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                            
                                                
                                                <th data-field="date" data-editable="true">Date</th>
                                                <th data-field="month" data-editable="true">Month</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <div class="modal-bootstrap shadow-inner mg-tb-30 responsive-mg-b-0">
                                        @foreach($holiday as $h)
                                            <tr>
                                                <td></td>
                                                
                                                
                                                <td>{{$h->day}} </td>
                                                <td>{{$h->month}} </td>
                                                
                                                <td>
                                                <form method="POST" action="{{route('holiday.destroy',$h->id)}}"> 
                                                         @csrf 
                                                              {{ method_field('DELETE') }} 
                                                              &nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn-danger" style="width:100px">
                                                                            <i class="fa fa-trash"></i>
                                                                </button>
                                                           </form>
                                                           </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            </div>
                                     </table>
                                      
                                     <div id="PrimaryModalalert" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-close-area modal-close-df">
                                                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                            </div>
                                            <div class="modal-body">
                                                <i class="educate-icon educate-checked modal-check-pro"></i>
                                                <h2>Awesome!</h2>
                                                <p>The Modal plugin is a dialog box/popup window that is displayed on top of the current page</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a data-dismiss="modal" href="#">Cancel</a>
                                                <a href="#">Process</a>
                                            </div>
                                        </div>
                                      </div>
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