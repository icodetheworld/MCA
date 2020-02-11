@if(Auth::user()->role=='admin')
<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
    </div>
     <div class="sidebar-menu-content">
         <ul class="nav nav-sidebar-menu sidebar-toggle-view">
             <li class="nav-item">
                    <a href="{{url('/index')}}" class="nav-link"><i
                            class="flaticon-dashboard"></i><span>Dashboard</span></a>
             </li>
            <li class="nav-item">
                 <a href="{{url("/notice")}}" class="nav-link"><i
                         class="flaticon-script"></i><span>Notice</span></a>
            </li>
            <li class="nav-item">
                 <a href="{{url("/messages")}}" class="nav-link"><i
                         class="flaticon-mail"></i><span>Messages</span></a>
            </li>
            <li class="nav-item">
                    <a href="{{url('/all_students')}}" class="nav-link"><i
                            class="flaticon-classmates"></i><span>All Students</span></a>
            </li>
            <li class="nav-item">
                    <a href="{{url('/admission')}}" class="nav-link"><i
                            class="flaticon-user"></i><span>Admission</span></a>
            </li>
            <li class="nav-item">
                    <a href="{{url('/all_teachers')}}" class="nav-link"><i
                            class="flaticon-multiple-users-silhouette"></i><span>Teachers</span></a>
            </li>
            <li class="nav-item">
                    <a href="{{url('/all_parents')}}" class="nav-link"><i
                            class="flaticon-couple"></i><span>Parents</span></a>
            </li>
             <li class="nav-item">
                 <a href="{{url('/subjects')}}" class="nav-link"><i
                         class="flaticon-open-book"></i><span>Subject</span></a>
             </li>

             <li class="nav-item">
                    <a href="{{url('/classes')}}" class="nav-link"><i
                            class="flaticon-open-book"></i><span>Classes</span></a>
                </li>

                <li class="nav-item">
                        <a href="{{('/promotion')}}" class="nav-link"><i
                                class="flaticon-checklist"></i><span>Class Promotion</span></a>
                    </li>
            <li class="nav-item">
                    <a href="{{url('/student/transport/view')}}" class="nav-link"><i
                            class="flaticon-dashboard"></i><span>Transport</span></a>
            </li>
             <li class="nav-item">
                 <a href="{{url('/timetable')}}" class="nav-link"><i class="flaticon-calendar"></i><span>Class
                         Routine</span></a>
             </li>
             <li class="nav-item">
                 <a href="{{('/attendance')}}" class="nav-link"><i
                         class="flaticon-checklist"></i><span>Attendence</span></a>
             </li>
             <li class="nav-item">
                 <a href="{{('/attendance_all')}}" class="nav-link"><i
                         class="flaticon-checklist"></i><span>Take Attendence</span></a>
             </li>
             <li class="nav-item sidebar-nav-item">
                 <a href="#" class="nav-link"><i class="flaticon-shopping-list"></i><span>Exam</span></a>
                 <ul class="nav sub-group-menu">
                     <li class="nav-item">
                         <a href="{{('/exam')}}" class="nav-link"><i class="fas fa-angle-right"></i>Exam
                             Schedule</a>
                     </li>
                     <li class="nav-item">
                         <a href="{{url('/marks')}}" class="nav-link"><i class="fas fa-angle-right"></i>Marks</a>
                     </li>
                     <li class="nav-item">
                         <a href="{{url('/result')}}" class="nav-link"><i class="fas fa-angle-right"></i>Result</a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item">
                 <a href="{{url('/settings')}}" class="nav-link"><i
                         class="flaticon-settings"></i><span>Account</span></a>
             </li>
         </ul>
     </div>
 </div>
 @elseif(Auth::user()->role=='parent')
 <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
        <div class="mobile-sidebar-header d-md-none">
        </div>
         <div class="sidebar-menu-content">
             <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                 <li class="nav-item">
                        <a href="{{url('/dashboard')}}" class="nav-link"><i
                                class="flaticon-dashboard"></i><span>Dashboard</span></a>
                 </li>
                 <li class="nav-item">
                      <a href="{{url("/notice")}}" class="nav-link"><i
                              class="flaticon-script"></i><span>Notice</span></a>
                 </li>
             </ul>
        </div><div style="height:500px; overflow:hidden"></div>
    </div>    

 @elseif(Auth::user()->role=='teacher')
 <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
        <div class="mobile-sidebar-header d-md-none">
        </div>
         <div class="sidebar-menu-content">
             <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                 <li class="nav-item">
                        <a href="{{url('/homepage')}}" class="nav-link"><i
                                class="flaticon-dashboard"></i><span>Dashboard</span></a>
                 </li>
                 <li class="nav-item">
                      <a href="{{url("/notice")}}" class="nav-link"><i
                              class="flaticon-script"></i><span>Notice</span></a>
                 </li>
                 <li class="nav-item">
                    <a href="{{('/attendance_view')}}" class="nav-link"><i
                            class="flaticon-checklist"></i><span>Attendence</span></a>
                </li>
                <li class="nav-item">
                   <a href="{{('/student/room/view')}}" class="nav-link"><i
                           class="flaticon-checklist"></i><span>Students List</span></a>
               </li>
                <li class="nav-item">
                    <a href="{{('/take_attendance')}}" class="nav-link"><i
                            class="flaticon-checklist"></i><span>Take Attendence</span></a>
                </li>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-shopping-list"></i><span>Exam</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="{{url('/add_marks')}}" class="nav-link"><i class="fas fa-angle-right"></i>Marks</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/results')}}" class="nav-link"><i class="fas fa-angle-right"></i>Results</a>
                        </li>
                    </ul>
                </li>
             </ul>
        </div><div style="height:500px; overflow:hidden"></div>
    </div>    
 @endif