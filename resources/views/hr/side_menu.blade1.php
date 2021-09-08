 <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><img class="main-logo" src="{{ asset('img/logo/logo.png') }}" alt="" /></a>
                <strong><a href="index.html"><img src="{{ asset('img/logo/logosn.png') }}" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a href="{{route('pages.create')}}">
								   <span class="educate-icon educate-home icon-wrap"></span>
								   <span class="mini-click-non">Home</span>
								</a>


                           
                        </li>
                        <li>
                            <a>
								   <span class="educate-icon educate-professor icon-wrap"></span>
								   <span class="mini-click-non">Employee self service</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a  href="{{route('leave.index')}}"><span class="mini-sub-pro">Apply leave</span></a></li>
                                <li><a  href="{{route('pages.index')}}?year=<?php echo date('Y');?>"><span class="mini-sub-pro">My Attendance</span></a></li>
                                <li><a  href="{{route('Exception.index')}}"><span class="mini-sub-pro">My Exception</span></a></li>
                                       <?php 
                      
                                       $checkSupervisor=DB::table('tblstaff')
                                                ->where('StaffNum',$_SESSION["staff"])
                                                ->where('Subdepartment','20')
                                                ->first();
                                        if($checkSupervisor==!NULL){
                                        ?>
                                               <li><a  href="{{route('HR.index')}}?year=<?php echo date('Y');?>"><span class="mini-sub-pro">Monthly Attendance</span></a></li>
                                      <?php
                                            } 
                                         else
                                                {

                                                }
                                                ?>
                            </ul>
                        </li>
                        <?php 
                      
                        $checkSupervisor=DB::table('tlkpSubdepartments')
                                   ->where('SubdepartmentHead',$_SESSION["staff"])
                                   ->first();
                         if($checkSupervisor==!NULL){
                           ?>
                                    <li>
                            <a>
								   <span class="educate-icon educate-professor icon-wrap"></span>
								   <span class="mini-click-non">Supervisor service</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a  href="{{route('supervisor.show',$checkSupervisor->SubdepartmentNum)}}"><span class="mini-sub-pro">Leave Requests</span></a></li>
                                <li><a  href="{{route('supervisor.index')}}"><span class="mini-sub-pro">Employee Leave Balance</span></a></li>
                                <li><a  href="{{route('staff.index')}}"><span class="mini-sub-pro">Employee Attendance</span></a></li>
                                <li><a  href="{{route('EmployeeException.index')}}"><span class="mini-sub-pro">Employee Exception</span></a></li>
                                
                            </ul>
                        </li>
                         <?php } else{ ?>
                          
                     
                       <?php  }       
                        
                        
                        ?>
                                    
                         
                                    <?php 
                      
                      $checkDepartmentHead=DB::table('tlkpDepartments')
                                 ->where('DepartmentHead',$_SESSION["staff"])
                                 ->first();

                                
                       if($checkDepartmentHead==!NULL){
                         ?>
                                  <li>
                          <a>
                                 <span class="educate-icon educate-professor icon-wrap"></span>
                                 <span class="mini-click-non">Department service</span>
                              </a>
                          <ul class="submenu-angle" aria-expanded="true">
                              <li><a  href="{{route('Department.show',$checkDepartmentHead->DepartmentNum)}}"><span class="mini-sub-pro">Leave Requests</span></a></li>
                              <li><a  href="{{route('Department.index')}}"><span class="mini-sub-pro">Employee Leave Balance</span></a></li>
                              
                          </ul>
                      </li>
                       <?php } else{ ?>
                        
                   
                     <?php  }       
                      
                      
                      ?>
                      
                       
                    </ul>
                </nav>
            </div>
        </nav>
    </div>