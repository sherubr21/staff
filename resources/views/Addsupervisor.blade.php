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
                                            
                                                
                                                <th data-field="date" data-editable="true">Name</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <div class="modal-bootstrap shadow-inner mg-tb-30 responsive-mg-b-0">
                                         <?php 

                                                    $pw = '@d@dm1n';
                                                    $un = 'adadmin';

                                                    $mail="millansubba@rtc.bt";
                                                    $dn = "OU=staff,OU=rtcusers,DC=rtc,DC=bt";

                                                    $attributes = array("displayname", "l");

                                                    //$filter = "(mail=$mail)";
                                                    $filter = "(cn=*)";

                                                    $ad = @ldap_connect("LDAP://dc1.rtc.bt")
                                                      or die("Couldn't connect to AD!");


                                                    @ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
                                                    ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);

                                                    $bd = @ldap_bind($ad,$un,$pw)
                                                          or die("Couldn't bind to AD!");
	  
	                                                        $attributes = array("userPassword");
                                                    //echo $bd;
                                                    $result = ldap_search($ad, $dn, $filter);
                                                    //echo $result;
                                                    $entries = ldap_get_entries($ad, $result);
                                                    //echo $entries;
                                                     $count=ldap_count_entries($ad,$result);


                                                     if($count>0){

                                                    for ($i=0; $i<$entries["count"]; $i++)
                                                    {?>
                                            <tr>
                                                <td></td>
                                                
                                                
                                                <td><?php echo $entries[$i]["displayname"][0]; ?> </td>
                                                <td>
                                                <form method="POST" action="{{route('supervisor.store')}}"> 
                                                         @csrf 
                                                              <input type="hidden" value="<?php echo $entries[$i]["mail"][0]; ?>" name="mail">
                                                              &nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn-primary" style="width:100px">
                                                                            <i class="fa fa-plus"></i>
                                                                </button>
                                                           </form>
                                                 </td>
                                                
                                                
                                            </tr>
                                                    <?php      }ldap_unbind($ad);
                                                     }
                                                     else{

                                                        echo "usre doest exist";
                                                     }?>
                                            
                                            </tbody>
                                            </div>
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