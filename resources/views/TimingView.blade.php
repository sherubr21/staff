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
                               
                                

                                  <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                            
                                                
                                                <th>Staff Name</th>
                                                <th>Timing</th>
                                                <th>Saturday working</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach($staff as $st)

                                             
                                        
                                            <tr>
                                                
                                                
                                                <td></td>
                                                <td>{{$st->StaffName}}</td>
                                                
                                                <td><?php if($st->OfficeTiming==1){
                                                        echo "8:30-4:30";
                                                }else{
                                                    echo "9:30-5:30";
                                                } ?></td>
                                                <td>
                                                <?php if($st->WorksOnSaturday==1){
                                                        echo "Saturday worker";
                                                }else{
                                                    echo "non Saturday worker";
                                                } ?>
                                                </td>
                                                <td>
                                                
                                                              
                                                         
                                              
                                                              &nbsp;&nbsp;&nbsp;<a href="{{url('editview',$st->StaffNum)}}"> <button type="submit" class="btn btn-success" style="width:100px">
                                                                            <i class="fa fa-pencil"></i>
                                                                </button></a>
                                                        
                                               
                                                 </td>
                                                
                                                
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
        </div>
        @include('footer')
        
    </div>
    @include('link.js')
    
    
</body>

</html>