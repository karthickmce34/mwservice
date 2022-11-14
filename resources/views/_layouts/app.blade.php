<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Home') - Megawin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <?php
    $base_material_path = "/material_admin_v-1.5-2/Template/jquery";
    ?>

    @section('css')
        <link rel="shortcut icon" href="{{asset("")}}favicon.ico" />
        <!-- Vendor CSS -->

        <link rel="stylesheet" type="text/css" href="{{asset('/')}}jquery-ui-1.11.4.custom/jquery-ui.min.css" />

        <link rel="stylesheet" href="{{asset('/')}}Bootstrap-Admin/dist/assets/lib/bootstrap/dist/css/bootstrap.min.css" />
        
        <link rel="stylesheet" type="text/css" href="{{asset('/')}}bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" />
        
        <link rel="stylesheet" href="{{asset('/')}}static/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="{{asset('/')}}static/css/dataTables.bootstrap.css" />
        <link rel="stylesheet" href="{{asset('/')}}static/css/buttons.dataTables.min.css" />
        
        <link rel="stylesheet" type="text/css" href="{{asset('/')}}font-awesome-4.5.0/css/font-awesome.min.css" />        

        <link rel="stylesheet" href="{{asset('/')}}Bootstrap-Admin/dist/assets/css/main.css">
        
        <!-- Vendor CSS -->
        <link href="{{asset($base_material_path)}}/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">        
        
        <link href="{{asset($base_material_path)}}/vendors/bootgrid/jquery.bootgrid.min.css" rel="stylesheet">
        
        
        <link href="{{asset($base_material_path)}}/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/nouislider/distribute/jquery.nouislider.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/farbtastic/farbtastic.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/chosen/chosen.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/summernote/dist/summernote.css" rel="stylesheet">

        <!-- CSS 
        <link href="css/app.min.1.css" rel="stylesheet">
        <link href="css/app.min.2.css" rel="stylesheet">
        -->
        
        <!-- Material CSS -->
        <link href="{{asset($base_material_path)}}/css/app.min.1.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/css/app.min.2.css" rel="stylesheet">
               
        <link href="{{asset('/')}}/c3/c3.css" rel="stylesheet">

        
        @show
        
        <!-- OUR CSS -->
        

        @section('style')
        <style>
            .Footer, #footer {
                border-top: 0px;
            }
            /*input[required],select[required] {
                background-image: url('../static/images/required.png');
                background-repeat: no-repeat;
            }*/
            
            form label.required:after
            {
                    color: red;
                    content: " *";
            }
            
            table.dataTable.no-footer {
                border-bottom: 1px solid #ccc;
            }
            
            #blankModal .card {
                /* position: relative; */
                /* background: #fff; */
                box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.15);
                /* margin-bottom: 30px; */
            }
            select.form-control{
                appearance: menulist !important;
                -webkit-appearance: menulist !important;
                -moz-appearance: menulist !important;
            }
            .form-control:not(.fc-alt){
                padding:5px 7px 5px 7px;
            }
            .bootstrap-select.btn-group .dropdown-menu li a:hover {
                color: whitesmoke !important;
                background: #bf5279 !important;
            }
            
            .modal { overflow-y: auto !important; }
            
            .ui-datepicker select.ui-datepicker-month,
            .ui-datepicker select.ui-datepicker-year {
                color:black!important;
            }
            
            /*.watermark {
                position: absolute;
                color: lightgray;
                opacity: 0.25;
                font-size: 3em;
                width: 100%;
                top: 8%;    
                text-align: center;
                z-index: 0;
            }*/
            
            modal-header .btnGrp{
            position: absolute;
            top: 8px;
            right: 10px;
          } 


          .min{
              width: 250px; 
              height: 35px;
              overflow: hidden !important;
              padding: 0px !important;
              margin: 0px;    

              float: left;  
              position: static !important; 
            }

          .min .modal-dialog, .min .modal-content{
              height: 100%;
              width: 100%;
              margin: 0px !important;
              padding: 0px !important; 
            }

          .min .modal-header{
              height: 100%;
              width: 100%;
              margin: 0px !important;
              padding: 3px 5px !important; 
            }

          .display-none{display: none;}

          button .fa{
              font-size: 16px;
              margin-left: 10px;
            }

          .min .fa{
              font-size: 14px; 
            }

          .min .menuTab{display: none;}

          button:focus { outline: none; }

          .minmaxCon{
            height: 35px;
            bottom: 1px;
            left: 1px;
            position: fixed;
            right: 1px;
            z-index: 9999;
          }
        </style>      

        @show
</head>
<body>
        <header id="header" class="clearfix" data-current-skin="blue">
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="logo hidden-xs">
                    <a href="{{ route('home.index') }}"><!--img width="30px" height="30px" src="{{url('static/images/logo.jpg')}}" alt=""--> 
                        Megawin Switchgear Pvt Ltd</a>
                </li>

                <li class="pull-right">
                    <ul class="top-menu">
                        
                        <li id="toggle-width">
                            <div class="toggle-switch">
                                <input id="tw-switch" type="checkbox" hidden="hidden">
                                
                                <label for="tw-switch" class="ts-helper" style="background-color:#5b5b69" title="Left Menu Toggle"></label>
                            </div>
                        </li>
                        @if(session()->get('user_type') == 0)
                        <li class="dropdown" >
                            <a href="" data-model-name="Register" data-target="#blankModal" data-toggle="modal" title="Register" data-placement="bottom"  data-backdrop="static" data-keyboard="false">
                               
                                <i class="tm-icon zmdi zmdi-account-box-phone"></i>
                            </a>
                            
                        </li>
                        <li class="dropdown" >
                            <a href="" data-model-name="Spares" data-target="#blankSpares" data-toggle="modal" title="Spares" data-placement="bottom"  data-backdrop="static" data-keyboard="false">
                               
                                <i class="tm-icon zmdi zmdi-puzzle-piece sparesbtn"></i>
                            </a>
                        </li>
                        @else
                            
                            @if(session()->get('user_type') == 1)
                                <li class="dropdown" >
                                    <a href="" data-model-name="Ticket" data-target="#blankTicket" data-toggle="modal" title="Ticket" data-placement="bottom"  data-backdrop="static" data-keyboard="false">
                                        <i class="tm-icon zmdi zmdi-puzzle-piece ticketbtn"></i>
                                    </a>
                                </li>
                                <li class="dropdown" >
                                    <a href="" data-model-name="Spares" data-target="#blankSpares" data-toggle="modal" title="Spares" data-placement="bottom"  data-backdrop="static" data-keyboard="false">

                                        <i class="tm-icon zmdi zmdi-puzzle-piece sparesbtn"></i>
                                    </a>
                                </li>
                            @else 
                                @if(session()->get('user_type') == 2)
                                    <li class="dropdown" >
                                        <a href="" data-model-name="Ticket" data-target="#blankTicket" data-toggle="modal" title="Ticket" data-placement="bottom"  data-backdrop="static" data-keyboard="false">
                                            <i class="tm-icon zmdi zmdi-puzzle-piece ticketbtn"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown" >
                                        <a href="" data-model-name="Register" data-target="#blankModal" data-toggle="modal" title="Register" data-placement="bottom"  data-backdrop="static" data-keyboard="false">

                                            <i class="tm-icon zmdi zmdi-account-box-phone"></i>
                                        </a>

                                    </li>
                                @else
                                    @if(session()->get('user_type') == 4)
                                        <li class="dropdown" >
                                            <a href="" data-model-name="Ticket" data-target="#blankTicket" data-toggle="modal" title="Ticket" data-placement="bottom"  data-backdrop="static" data-keyboard="false">
                                                <i class="tm-icon zmdi zmdi-puzzle-piece ticketbtn"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @endif
                        @endif
                        @if(session()->get('user_type') == 2 || session()->get('user_type') == 1)
                        <li id="top-search">
                            <a href=""><i class="tm-icon zmdi zmdi-search"></i></a>
                        </li>
                        <li class="dropdown" >
                            <a href="" data-model-name="Attendance" data-target="#blankAttend" data-toggle="modal" title="Attendance" data-placement="bottom"  data-backdrop="static" data-keyboard="false">
                                <i class="tm-icon zmdi zmdi-account"></i>
                            </a>
                        </li>
                        
                        <li class="dropdown" id="email-message">
                            <a data-toggle="dropdown" href="">
                                <i class="tm-icon zmdi zmdi-email"></i>
                                <i class="tmn-counts">0</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg pull-right">
                                <div class="listview">
                                    <div class="lv-header">
                                        Messages
                                    </div>
                                    <div class="lv-body">
                                        <!--a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/1.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">David Belle</div>
                                                    <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/2.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Jonathan Morris</div>
                                                    <small class="lv-small">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/3.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Fredric Mitchell Jr.</div>
                                                    <small class="lv-small">Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/4.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Glenn Jecobs</div>
                                                    <small class="lv-small">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</small>
                                                </div>
                                            </div>
                                        </a-->
                                        
                                    </div>
                                    <a class="lv-footer" href="{{ route('email.index') }}">View All</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        <li class="dropdown" id="tk-notification">
                            <a data-toggle="dropdown" href="">
                                <i class="tm-icon zmdi zmdi-notifications"></i>
                                <i class="tmn-counts">0</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg pull-right">
                                <div class="listview" id="notifications">
                                    <div class="lv-header">
                                        Ticket

                                        <!--ul class="actions">
                                            <li class="dropdown">
                                                <a href="" data-clear="notification">
                                                    <i class="zmdi zmdi-check-all"></i>
                                                </a>
                                            </li>
                                        </ul-->
                                    </div>
                                    <div class="lv-body">
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/1.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">David Belle</div>
                                                    <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/2.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Jonathan Morris</div>
                                                    <small class="lv-small">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/3.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Fredric Mitchell Jr.</div>
                                                    <small class="lv-small">Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/4.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Glenn Jecobs</div>
                                                    <small class="lv-small">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/4.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Bill Phillips</div>
                                                    <small class="lv-small">Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <a class="lv-footer" href="">View Previous</a>
                                </div>

                            </div>
                        </li>
                        <!--li class="dropdown hidden-xs">
                            <a data-toggle="dropdown" href="">
                                <i class="tm-icon zmdi zmdi-view-list-alt"></i>
                                <i class="tmn-counts">2</i>
                            </a>
                            <div class="dropdown-menu pull-right dropdown-menu-lg">
                                <div class="listview">
                                    <div class="lv-header">
                                        Tasks
                                    </div>
                                    <div class="lv-body">
                                        <div class="lv-item">
                                            <div class="lv-title m-b-5">HTML5 Validation Report</div>

                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                                                    <span class="sr-only">95% Complete (success)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lv-item">
                                            <div class="lv-title m-b-5">Google Chrome Extension</div>

                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                    <span class="sr-only">80% Complete (success)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lv-item">
                                            <div class="lv-title m-b-5">Social Intranet Projects</div>

                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lv-item">
                                            <div class="lv-title m-b-5">Bootstrap Admin Template</div>

                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                    <span class="sr-only">60% Complete (warning)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lv-item">
                                            <div class="lv-title m-b-5">Youtube Client App</div>

                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="lv-footer" href="">View All</a>
                                </div>
                            </div>
                        </li-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" href=""><i class="tm-icon zmdi zmdi-more-vert"></i></a>
                            <ul class="dropdown-menu dm-icon pull-right">
                                <li class="skin-switch hidden-xs">
                                    <span class="ss-skin bgm-lightblue" data-skin="lightblue"></span>
                                    <span class="ss-skin bgm-bluegray" data-skin="bluegray"></span>
                                    <span class="ss-skin bgm-cyan" data-skin="cyan"></span>
                                    <span class="ss-skin bgm-teal" data-skin="teal"></span>
                                    <span class="ss-skin bgm-orange" data-skin="orange"></span>
                                    <span class="ss-skin bgm-blue" data-skin="blue"></span>
                                </li>
                                <li class="divider hidden-xs"></li>
                                <li class="hidden-xs">
                                    <a data-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                                </li>
                                <li>
                                    <a data-action="clear-localstorage" href=""><i class="zmdi zmdi-delete"></i> Clear Local Storage</a>
                                </li>
                                <li>
                                    <a href=""><i class="zmdi zmdi-face"></i> Privacy Settings</a>
                                </li>
                                <li>
                                    <a href=""><i class="zmdi zmdi-settings"></i> Other Settings</a>
                                </li>
                            </ul>
                        </li>
                        <li class="hidden-xs" id="chat-trigger" data-trigger="#chat">
                            <a href=""><i class="tm-icon zmdi zmdi-comment-alt-text"></i></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!------- mail message template ---------->
            <div class="mail-t" style="display:none;">
                <a class="lv-item" href="">
                    <div class="media">
                        <div class="pull-left">
                            <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/4.jpg" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Bill Phillips</div>
                            <small class="lv-small">Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</small>
                        </div>
                    </div>
                </a>
            </div>
            

            <!-- Top Search Content -->
            <div id="top-search-wrap">
                <div class="tsw-inner">
                    <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
                    <input type="text" id="mwsearch">
                    
                    
                        
                </div>
                
            </div>
        </header>
        
        <section id="main" data-layout="layout-1">
            <aside id="sidebar" class="sidebar c-overflow">
                <div class="profile-menu">
                    <a href="">
                        <div class="profile-pic">
                            
                            <img src="{{asset($base_material_path)}}/img/profile-pics/1.jpg" alt="">
                            <!--img src="{{url('static/images/home.jpg')}}" alt=""-->
                            
                        </div>
                        <div class="profile-info">
                            {{ strtoupper(session()->get('name')) }}
                            <input type="hidden" id="user_type" value="{{session()->get('user_type')}}">                                        

                            <i class="zmdi zmdi-caret-down"></i>
                        </div>
                        
                    </a>

                    <ul class="main-menu">
                        <!--li>
                            <a href="profile-about.html"><i class="zmdi zmdi-account"></i> View Profile</a>
                        </li>
                        <li>
                            <a href=""><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                        </li>
                        <li>
                            <a href=""><i class="zmdi zmdi-settings"></i> Settings</a>
                        </li-->
                        <li>
                            <a href="#" id='logout'><i class="zmdi zmdi-time-restore"></i> Logout</a>
                        </li>
                    </ul>
                </div>

                @include('_layouts._partials.left_menu')
            </aside>
            
            <aside id="chat" class="sidebar c-overflow">
            
                <div class="chat-search">
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="Search People">
                    </div>
                </div>

                <div class="listview">
                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left p-relative">
                                <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/2.jpg" alt="">
                                <i class="chat-status-busy"></i>
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Jonathan Morris</div>
                                <small class="lv-small">Available</small>
                            </div>
                        </div>
                    </a>

                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left">
                                <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/1.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lv-title">David Belle</div>
                                <small class="lv-small">Last seen 3 hours ago</small>
                            </div>
                        </div>
                    </a>

                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left p-relative">
                                <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/3.jpg" alt="">
                                <i class="chat-status-online"></i>
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Fredric Mitchell Jr.</div>
                                <small class="lv-small">Availble</small>
                            </div>
                        </div>
                    </a>

                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left p-relative">
                                <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/4.jpg" alt="">
                                <i class="chat-status-online"></i>
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Glenn Jecobs</div>
                                <small class="lv-small">Availble</small>
                            </div>
                        </div>
                    </a>

                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left">
                                <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/5.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Bill Phillips</div>
                                <small class="lv-small">Last seen 3 days ago</small>
                            </div>
                        </div>
                    </a>

                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left">
                                <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/6.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Wendy Mitchell</div>
                                <small class="lv-small">Last seen 2 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left p-relative">
                                <img class="lv-img-sm" src="{{asset($base_material_path)}}/img/profile-pics/7.jpg" alt="">
                                <i class="chat-status-busy"></i>
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Teena Bell Ann</div>
                                <small class="lv-small">Busy</small>
                            </div>
                        </div>
                    </a>
                </div>
            </aside>
            
            
            <section id="content">
                <div class="container">
                    @yield('content')

                </div>
            </section>
        </section>
        <div class="minmaxCon"></div>
        <footer id="footer">
            Copyright &copy; 2022 Megawin
            
            <!--ul class="f-menu">
                <li><a href="">Home</a></li>
                <li><a href="">Dashboard</a></li>
                <li><a href="">Reports</a></li>
                <li><a href="">Support</a></li>
                <li><a href="">Contact</a></li>
            </ul-->
        </footer>

        <!-- Page Loader -->
        <div class="page-loader">
            <div class="preloader pls-blue">
                <svg class="pl-circular" viewBox="25 25 50 50">
                    <circle class="plc-path" cx="50" cy="50" r="20" />
                </svg>

                <p>Please wait...</p>
            </div>
        </div>
        
        <div class="sales-loader" style="display: none;">
            <div class="preloader pls-blue">
                <svg class="pl-circular" viewBox="25 25 50 50">
                    <circle class="plc-path" cx="50" cy="50" r="20" />
                </svg>

                <p>Please wait...</p>
            </div>
        </div>
        
        <div id="blankModal" class="modal fade mysrmodal">
            
            <div class="modal-dialog modal-lg" style="width:90%;">
                <div class="modal-content">
                    <div class="modal-header bgm-cyan m-b-20">
                        <!--button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button-->
                        <button class="close modalSrMinimize"> <i class='fa fa-minus'></i> </button> 

                        <h4 class="modal-title">Service Request</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="card-body card-padding">
                            <div class="row">
                                <?php $currentdate =date('Y-m-d'); 
                                       $timestamp = date('Y-m-d H:i:s');?>
                                
                                <form autocomplete="off">
                                    <div class="row">    

                                        <div class="form-group col-sm-6">
                                            <label for="mode_of_complaint" class="control-label col-sm-4 required">Mode of Request</label>
                                            <div class="col-sm-8">
                                                <div class="fg-line">
                                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1"  data-validation="required" id="modeofcomplaint" name="mode_of_complaint">
                                                        <option value="0">Phone</option>
                                                        <option value="1">Email</option>
                                                    </select>                                        
                                                </div>
                                            </div>
                                        </div>
                                        <!--div class="form-group col-sm-6">
                                            <label for="complaint_type" class="control-label col-sm-4 required">Complaint Type</label>
                                            <div class="col-sm-8">
                                                <div class="fg-line">
                                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1"   id="complaint_type" name="complaint_type">
                                                        <option value="0">Service</option>
                                                        <option value="1">Spares</option>
                                                        <option value="2">Service & Spares</option>
                                                    </select>                                        
                                                </div>
                                            </div>
                                        </div-->
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="docseq" class="control-label col-sm-4">Document No</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm docno " readonly placeholder="Document No" name="seqno" type="text" id="ser_docseq_no">                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <input type='hidden' class="form-control input-sm" id="complaint_date" name="complaint_date" value="{{$currentdate}}">
                                        <div class="form-group col-sm-6">
                                            <label for="customer_name" class="control-label col-sm-4 required">Customer</label>
                                            <div class="col-sm-8">
                                                <div class="fg-line">
                                                    <input type="hidden" name="bp_id" id="bp_id" value="">
                                                    <input class="form-control input-sm" placeholder="Customer" required name="customer_name" type="text" id="customer_name" autocomplete="off" >                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="salesorder_no" class="control-label col-sm-4 required" >Sales Order No</label>
                                            <div class="col-sm-8 col-xs-8">
                                                <div class="input-group">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm salno1" placeholder="Order No" required name="salesorder_no" type="text" id="salesorder_no">                                        
                                                    </div>
                                                    <span class="input-group-addon last salno"><i class="btn btn-xs zmdi zmdi-search"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="salesload"  class="col-sm-12 text-center">
                                            <div class="preloader pls-blue ">
                                                <svg class="pl-circular" viewBox="25 25 50 50">
                                                    <circle class="plc-path" cx="50" cy="50" r="20" />
                                                </svg>
                                            </div>
                                        </div>
                                            
                                        <div class="saldata">
                                            
                                            
                                            
                                            <div class="form-group col-sm-6">
                                                <label for="address1" class="control-label col-sm-4">Bill Address</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address1" required  name="address1" id="address1" autocomplete="off" ></textarea>                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="address2" class="control-label col-sm-4 ">Delivery Address</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address2" required name="address2" id="address2" autocomplete="off" ></textarea>                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <!--div class="form-group col-sm-6">
                                                <label for="city" class="control-label col-sm-4">City</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="City" name="city" type="text" id="city"  >                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="pincode" class="control-label col-sm-4">Pincode</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Pincode" name="pincode" type="text" id="pincode"  >                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="state" class="control-label col-sm-4">State</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="State" name="state" type="text" id="state"  >                                        
                                                    </div>
                                                </div>
                                            </div-->
                                            <div class="form-group col-sm-6">
                                                <label for="gstin" class="control-label col-sm-4">GSTin</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="GStin"  name="gstin" type="text" id="gstin" autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!--div class="form-group col-sm-6">
                                                <label for="panno" class="control-label col-sm-4">PAN No</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="PAN No"  name="panno" type="text" id="panno">                                        
                                                    </div>
                                                </div>
                                            </div-->
                                            <div class="form-group col-sm-6">
                                                <label for="mobileno" class="control-label col-sm-4 required">Mobile no</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Mobile Number" name="mobileno" required type="text" id="mobileno"  autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!--div class="form-group col-sm-6">
                                                <label for="phoneno" class="control-label col-sm-4">Phone no</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Phone Number" name="phoneno" type="text" id="phoneno" autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div-->

                                            <div class="form-group col-sm-6">
                                                <label for="emailid" class="control-label col-sm-4 required">Email</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Email" required name="emailid" type="text" id="emailid"  autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="contact_person" class="control-label col-sm-4 required">Contact Person</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Contact Person" required name="contact_person" type="text" id="contact_person"  autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="site_location" class="control-label col-sm-4 required">Site Location</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Site Location" required name="site_location" id="site_location"  ></textarea>                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="order_type" class="control-label col-sm-4 required">Order Type</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <select class="form-control input-sm" placeholder="Order Type" aria-describedby="basic-addon1" required   id="order_type" name="order_type">
                                                            <option value="">=== Select Order Type ===</option>
                                                            <option value="0">Standard</option>
                                                            <option value="1">Industry</option>
                                                            <option value="2">Utility</option>
                                                            <option value="3">Projects</option>
                                                            <option value="4">Railway</option>
                                                        </select>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="warrenty" class="control-label col-sm-4 required">Warranty</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <select class="form-control input-sm" placeholder="Warranty" aria-describedby="basic-addon1" required   id="warranty" name="warrenty">
                                                            <option value="">=== Select Warranty ===</option>
                                                            <option value="0">WithIn Warranty</option>
                                                            <option value="1">Out of Warranty</option>
                                                        </select>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="region_id" class="control-label col-sm-4 required">Region</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <div class="serviceregionselect0">
                                                            <div class="serviceregionselect1">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="complaint_nature" class="control-label col-sm-4 required">Customer Complaint</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Complaint Nature" required name="complaint_nature" id="complaint_nature"  ></textarea>                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="panel_descrption" class="control-label col-sm-4 required">Product Description</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Panel Description" name="panel_descrption" required type="text" id="panel_descrption" autocomplete="off">                                        
                                                        <input class="form-control input-sm" placeholder="invoiceid" name="invoiceid"  type="hidden" id="invoiceid" autocomplete="off">                                        
                                                        <input class="form-control input-sm" placeholder="invoiceno" name="invoiceno"  type="hidden" id="invoiceno" autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="date_supply" class="control-label col-sm-4">Date of Dispatch</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input type='text' class="form-control input-sm" id="date_supply" name="date_supply" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="commissioned_date" class="control-label col-sm-4">Commissioned Date</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input type='text' class="form-control input-sm" id="commissioned_date" name="commissioned_date" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-sm-6">
                                                <label for="outgoing_load" class="control-label col-sm-4">Outgoing Load</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Outgoing Load" name="outgoing_load" type="text" id="outgoing_load" autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="relay_make_type" class="control-label col-sm-4">Relay Make&Type</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Relay Make&Type" name="relay_make_type" type="text" id="relay_make_type" autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cable_length" class="control-label col-sm-4">Cable Length (load)</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Cable Length (load)" name="cable_length" type="text" id="cable_length" autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="fault_current" class="control-label col-sm-4">Fault Current</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Fault Current" name="fault_current" type="text" id="fault_current" autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="vcb_interlock" class="control-label col-sm-4">VCB Interlock Condition</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="VCB Interlock" name="vcb_interlock" type="text" id="vcb_interlock" autocomplete="off">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="after_commissioned" class="control-label col-sm-4">Modification After Commissioning</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="After Commissioned" name="after_commissioned" type="text" id="after_commissioned" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="event_before_failure" class="control-label col-sm-4">Event Before Failure</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Event Before Failure" name="event_before_failure" type="text" id="event_before_failure" autocomplete="off">                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="serial_no" class="control-label col-sm-4">VCB Serial No</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <input class="form-control input-sm" placeholder="Serial No" name="serial_no" type="text" id="serial_no">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <!--div class="form-group col-sm-6">
                                                <label for="status" class="control-label col-sm-4 required">Status</label>
                                                <div class="col-sm-8">
                                                    <div class="fg-line">
                                                        <select class="form-control input-sm " placeholder="Status" aria-describedby="basic-addon1"   id="status" name="status">
                                                            <option value="">=== Select Status ===</option>
                                                            <option value="0">InActive</option>
                                                            <option value="1" selected="selected">Active</option>
                                                        </select>                                                                                    
                                                    </div>
                                                </div>
                                            </div-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary app_save">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        
        <div id="blankSpares" class="modal fade myspmodal">
            
            <div class="modal-dialog modal-lg" style="width:95%;">
                <div class="modal-content">
                    <div class="modal-header bgm-cyan m-b-20">
                        <!--button type="button" class="close" data-dismiss="modal"> <i class='fa fa-times'></i> </button-->
                        <button class="close modalSpMinimize"> <i class='fa fa-minus'></i> </button> 

                        <h4 class="modal-title">Spare Request</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="card-body card-padding">
                            <div class="row">
                                <?php $currentdate =date('Y-m-d'); 
                                       $timestamp = date('Y-m-d H:i:s');?>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <h4>Details</h4>
                                            </div>
                                        </div>
                                <form autocomplete="off">
                                    <div class="row ">
                                        <div class="bs-item z-depth-5-bottom">    
                                            <div class="row ">
                                                <div class="form-group col-sm-6">
                                                    <label for="mode_of_complaint" class="control-label col-sm-4 required">Mode of Request</label>
                                                    <div class="col-sm-8">
                                                        <div class="fg-line">
                                                            <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1"  data-validation="required" id="mode_of_complaint" name="mode_of_complaint">
                                                                <option value="0">Phone</option>
                                                                <option value="1">Email</option>
                                                            </select>                                        
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label for="docseq" class="control-label col-sm-4">Document No</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm docno " readonly placeholder="Document No" name="seqno" type="text" id="sp_docseq_no">                                        
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <input type='hidden' class="form-control input-sm" id="complaint_date2" name="complaint_date" value="{{$currentdate}}">
                                                <div class="form-group col-sm-6">
                                                    <label for="customer_name" class="control-label col-sm-4 required">Customer</label>
                                                    <div class="col-sm-8">
                                                        <div class="fg-line">
                                                            <input class="form-control input-sm" placeholder="Customer" required name="customer_name" type="text" id="sp_customer_name"  autocomplete="off">                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="salesorder_no" class="control-label col-sm-4">Sales Order No</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm spnol" placeholder="Spare Order No" name="spareorder_no" type="text" id="sp_salesorder_no" autocomplete="off">                                        
                                                            </div>
                                                            <span class="input-group-addon last spno"><i class="btn zmdi zmdi-search"></i></span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div id="sparesload"  class="col-sm-12 text-center hide" >
                                                    <div class="preloader pls-blue ">
                                                        <svg class="pl-circular" viewBox="25 25 50 50">
                                                            <circle class="plc-path" cx="50" cy="50" r="20" />
                                                        </svg>
                                                    </div>
                                                </div>

                                                <div class="spdata">
                                                    <!--div class="form-group col-sm-6">
                                                        <label for="customer_name" class="control-label col-sm-4 required">Customer</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm" placeholder="Customer" required name="customer_name" type="text" id="sp_customer_name"  autocomplete="off">                                        
                                                            </div>
                                                        </div>
                                                    </div-->
                                                </div> 
                                            </div>
                                            <div class="row m-t-25">
                                                <div class="spdata">  
                                                    <div class="form-group col-sm-6">
                                                        <label for="address1" class="control-label col-sm-4">Bill Address</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <textarea class="form-control" rows="3" placeholder="Address1" required name="address1" id="sp_address1"  ></textarea>                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="address2" class="control-label col-sm-4 ">Delivery Address</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <textarea class="form-control input-sm" cols="20" rows="3" required placeholder="Address2" name="address2" id="sp_address2"  ></textarea>                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="gstin" class="control-label col-sm-4">GSTin</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm" placeholder="GStin"  name="gstin" type="text" id="sp_gstin" autocomplete="off">                                        
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="mobileno" class="control-label col-sm-4 required">Mobile no</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm" placeholder="Mobile Number" required name="mobileno" type="text" id="sp_mobileno"  autocomplete="off">                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="phoneno" class="control-label col-sm-4">Phone no</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm" placeholder="Phone Number" name="phoneno" type="text" id="sp_phoneno" autocomplete="off">                                        
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="emailid" class="control-label col-sm-4 required">Email</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm" placeholder="Email" required name="emailid" type="text" id="sp_emailid" autocomplete="off" >                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="contact_person" class="control-label col-sm-4 required">Contact Person</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm" placeholder="Contact Person" required name="contact_person" type="text" id="sp_contact_person" autocomplete="off" >                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="things_to_do" class="control-label col-sm-4">Clarification</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Clarification" name="things_to_do" id="things_to_do"  ></textarea>                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="sp_reference" class="control-label col-sm-4">Reference</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm"  placeholder="Reference" name="reference" id="sp_reference"  >                                       
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="region_id" class="control-label col-sm-4">Region</label>
                                                        <div class="col-sm-8">
                                                            <div class="fg-line">
                                                                <div class="spareregionselect0">
                                                                    <div class="spareregionselect1">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <h4>Product</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 m-l-20 text-center">
                                                <div class="col-sm-3">
                                                    <div class="form-group fg-line">
                                                        <label >Product</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-3">
                                                    <div class="form-group fg-line">
                                                        <label >Description</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="col-sm-3">
                                                        <div class="form-group fg-line">
                                                            <label >Qty & UOM</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group fg-line">
                                                            <label >Price</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group fg-line">
                                                            <label >Dis %</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group fg-line">
                                                            <label >Tax</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-sm-1">
                                                    <div class="form-group fg-line">
                                                        <label >Total</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="appprdsecond" >
                                            
                                            
                                        </div>
                                        <div class="form-row m-t-25 pull-right">
                                            <button type="button" class="addline btn bgm-green"><i class="zmdi zmdi-plus"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="appprdfirst" >
                            <div class="row m-l-10" role="form">
                                <div class="col-sm-3">
                                    <div class="input-group form-group fg-line">
                                        <label class="sr-only" for="product">Product</label>
                                        <input type="hidden" class="frm_product_id" name="product_id" />
                                        <input type="text" class="form-control input-sm frm_product" name="product" placeholder="Product" autocomplete="off">
                                        <span class="input-group-addon last "><i class="zmdi zmdi-search"></i></span>                                                                    
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group fg-line">
                                        <label class="sr-only" for="description">Description</label>
                                        <input type="text" class="form-control input-sm frm_description" name="description" placeholder="Description" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="col-sm-3">
                                        <div class="input-group form-group fg-line">
                                            <label class="sr-only" for="qty">Qty & UOM</label>
                                            <input type="text" class="form-control input-sm frm_qty" placeholder="Qty" autocomplete="off">
                                            <span class="last f-10 frm_uomname"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group fg-line">
                                            <label class="sr-only" for="unit_price">Price</label>
                                            <input type="text" class="form-control input-sm frm_unit_price" placeholder="Price" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group fg-line">
                                            <label class="sr-only" for="discount">Discount</label>
                                            <input type="text" class="form-control input-sm frm_discount" placeholder="Discount" autocomplete="off" value="0">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group fg-line">
                                            <label class="sr-only" for="tax">Tax</label>
                                            <select class="form-control input-sm f-10 frm_tax_id" placeholder="Tax" >
                                                <option value="3">No Tax</option>
                                                <option value="1">GST 18%</option>
                                                <option value="2">CGST9% + SGST9%</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="col-sm-9">
                                        <div class="form-group fg-line">
                                            <label class="sr-only" for="total">Total</label>
                                            <input type="hidden" class="form-control input-sm frm_tax_amt" name="tax_amt" >
                                            <input type="text" class="form-control input-sm frm_total" readonly placeholder="Total">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-primary btn-sm m-t-5 waves-effect frm_prdclose"><i class="zmdi zmdi-close"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary spare_save">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        
        
        <div id="blankAttend" class="modal fade">
            <input type="hidden" id='usertype' value="{{session()->get('user_type')}}">

            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                        <h2 class="modal-title">Attendance Detail</h2>
                    </div>
                    <div class="modal-body">
                        <div class="card-body card-padding">
                            <div class="row" id="attendrow">
                                <h5 class="text-center c-red text-uppercase m-b-25">Attendance logged</h5>
                                
                            </div>
                            <hr>
                            <div class="row" id="noattendrow">
                                <h5 class="text-center c-green text-uppercase m-b-25">Attendance not logged</h5>

                            </div>
                        </div>
                        
                    </div>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        
        <!----------------For Attendance Div------------------->
        <div class="togswitch hide">
            <div class="normalswitch col-sm-6 m-b-20">
                <div class="toggle-switch" data-ts-color="blue">
                    <label for="ts3" class="ts-label">Ashik</label>
                    <input id="nts" type="checkbox" hidden="hidden">
                    <label for="ts3" class="ts-helper"></label>
                </div>
            </div> 
            <div class="disableswitch col-sm-6 m-b-20">
                <div class="toggle-switch disabled" data-ts-color="blue">
                    <label for="tsd" class="ts-label">Tamil</label>
                    <input id="tsd" type="checkbox" hidden="hidden" checked="checked" disabled="disabled">
                    <label for="tsd" class="ts-helper"></label>
                </div>
            </div>
        </div>
        
        
        <div id="searchmodal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="row m-20" id="testrow">
                        

                    </div>
                    
            </div><!-- /.modal-dialog -->
        </div>
        
        <div class="cusdet">
            <div class="cusdet2 col-sm-4">
                <div class="card">
                    <div class="card-header bgm-bluegray m-b-20">
                        <h2>Some Title</h2>
                        <a href="" target="_self" class="btn bgm-lightblue btn-float waves-effect"><i class="zmdi zmdi-mail-send"></i></a>
                        <!--button type="button" class="btn bgm-blue btn-float waves-effect"><i class="zmdi zmdi-mail-send"></i></button-->
                    </div>

                    <div class="card-body card-padding cardcusdet">
                    </div>
                </div>
            </div>
        </div>
        
        <div id="modalselectprd">
            <div id="modalselectprd2">
                <div class="modal fade" id="selproductform" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4>Search Product</h4>
                            </div>
                            <div class="modal-body">
                                <table id="data-table-command" class="table table-striped table-vmiddle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                            <th data-column-id="radiob"></th>  
                                            <th data-column-id="name">Name</th>
                                            <th data-column-id="code" >Code</th>
                                            <th data-column-id="uom" >UOM</th>
                                            <th data-column-id="price" >Price</th>     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>                 
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--- Ticket--->
        <div id="blankTicket" class="modal fade myticketmodal">
            
            <div class="modal-dialog modal-lg" style="width:95%;">
                <div class="modal-content">
                    <div class="modal-header bgm-cyan m-b-20">
                        <!--button type="button" class="close" data-dismiss="modal"> <i class='fa fa-times'></i> </button-->
                        <button class="close modalTicketMinimize"> <i class='fa fa-minus'></i> </button> 

                        <h4 class="modal-title">Raise Ticket</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="card-body card-padding">
                            <div class="row">
                                <?php $currentdate =date('Y-m-d'); 
                                       $timestamp = date('Y-m-d H:i:s');?>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <h4>Details</h4>
                                            </div>
                                        </div>
                                <form autocomplete="off">
                                    <div class="row ">
                                        <div class="bs-item z-depth-5-bottom">    
                                            <div class="row ">
                                                <div class="form-group col-sm-6">
                                                    <label for="mode_of_complaint" class="control-label col-sm-4 required">Mode of Request</label>
                                                    <div class="col-sm-8">
                                                        <div class="fg-line">
                                                            <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1"  data-validation="required" id="mode_of_complaint" name="mode_of_complaint">
                                                                <option value="0">Phone</option>
                                                            </select>                                        
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label for="docseq" class="control-label col-sm-4">Document No</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm docno " readonly placeholder="Document No" name="seqno" type="text" id="tk_docseq_no">                                        
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label for="customer_name" class="control-label col-sm-4 required">Customer</label>
                                                    <div class="col-sm-8">
                                                        <div class="fg-line">
                                                            <input class="form-control input-sm" placeholder="Customer" required name="customer_name" type="text" id="tk_customer_name"  autocomplete="off">                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="job_id" class="control-label col-sm-4">Job Id</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <div class="fg-line">
                                                                <input class="form-control input-sm spnol" placeholder="Job Id" name="job_id" type="text" id="tk_job_id" autocomplete="off">                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="mobileno" class="control-label col-sm-4 required">Mobile no</label>
                                                    <div class="col-sm-8">
                                                        <div class="fg-line">
                                                            <input class="form-control input-sm" placeholder="Mobile Number" required name="mobileno" type="text" id="tk_mobileno"  autocomplete="off">                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="emailid" class="control-label col-sm-4 ">Email</label>
                                                    <div class="col-sm-8">
                                                        <div class="fg-line">
                                                            <input class="form-control input-sm" placeholder="Email"  name="emailid" type="text" id="tk_emailid" autocomplete="off" >                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="contact_person" class="control-label col-sm-4 required">Contact Person</label>
                                                    <div class="col-sm-8">
                                                        <div class="fg-line">
                                                            <input class="form-control input-sm" placeholder="Contact Person" required name="contact_person" type="text" id="tk_contact_person" autocomplete="off" >                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="form-group col-sm-12 sow">
                                                    <label for="scope_of_work" class="control-label col-sm-3">Scope Of Work</label>
                                                    <div class="col-sm-2">
                                                        <div class="fg-line">
                                                            <div class="checkbox pull-left">
                                                                <label>
                                                                    <input type="checkbox" name="scope_of_work[]" value="General Service">
                                                                    <i class="input-helper">General Service</i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="fg-line">
                                                            <div class="checkbox pull-left">
                                                                <label>
                                                                    <input type="checkbox" name="scope_of_work[]" value="Assessment">
                                                                    <i class="input-helper">Assessment</i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="fg-line">
                                                            <div class="checkbox pull-left">
                                                                <label>
                                                                    <input type="checkbox" name="scope_of_work[]" id="amc" value="AMC">
                                                                    <i class="input-helper">AMC</i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="fg-line">
                                                            <div class="checkbox  pull-left">
                                                                <label>
                                                                    <input type="checkbox" name="scope_of_work[]" value="Commissioning">
                                                                    <i class="input-helper">Commissioning</i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="fg-line">
                                                            <div class="checkbox pull-left">
                                                                 <label>
                                                                    <input type="checkbox" name="scope_of_work[]" value="Spares Fixing">
                                                                    <i class="input-helper">Spares Fixing</i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="fg-line">
                                                            <div class="checkbox pull-left">
                                                                <label>
                                                                    <input type="checkbox" name="scope_of_work[]" value="Fault Rectification">
                                                                    <i class="input-helper">Fault Rectification</i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="fg-line">
                                                            <div class="checkbox  pull-left">
                                                                <label>
                                                                    <input type="hidden" id="othrval" value='0'>
                                                                    <input type="checkbox" name="scope_of_work[]" id="othersscope"  value="Others">
                                                                    <i class="input-helper">Others</i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="fg-line">
                                                                <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Scope Of Work" name="scope_of_work_o" readonly="true" id="scope_of_work"  ></textarea>                                        
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary ticket_save">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        
        <!-------- for sales order details ------>
        <div class="blanksoline">
            <div id="blankSales" class="modal fade mysalesmodal">

                <div class="modal-dialog modal-lg" style="width:60%;">
                    <div class="modal-content">
                        <div class="modal-header bgm-cyan m-b-20">
                            <!--button type="button" class="close" data-dismiss="modal"> <i class='fa fa-times'></i> </button-->

                            <h4 class="modal-title">Sales</h4>
                        </div>
                        <div class="modal-body">

                            <div class="card-body card-padding">
                                <div class="row">
                                    <?php $currentdate =date('Y-m-d'); 
                                           $timestamp = date('Y-m-d H:i:s');?>
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <h4>Details</h4>
                                                </div>
                                            </div>
                                    <form autocomplete="off">
                                        <div class="row p-10">
                                            <table id="data-table-command" class="table table-striped table-vmiddle" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th data-column-id="radiobtn"></th>  
                                                    <th data-column-id="invoiceno">Inv No</th>
                                                    <th data-column-id="invoicedate" >Inv Date</th>
                                                    <th data-column-id="name" >Name</th>     
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
            
        
        <div id="modalselect5">

        </div>
 
@section('js')

         <script type="text/javascript" src="{{asset('/')}}static/js/jquery-1.12.0.js"></script>
         
        <!--jQuery UI-->
        <script type="text/javascript" src="{{asset('/')}}jquery-ui-1.11.4/jquery-ui.js" ></script>
        
        <script type="text/javascript" src="{{asset('/')}}static/js/jquery.dataTables.min.js"></script>
<!--        <script type="text/javascript" src="{{asset('/')}}static/js/dataTables.editor.min.js"></script>-->
        <script type="text/javascript" src="{{asset('/')}}static/js/dataTables.keyTable.min.js"></script>
        <script type="text/javascript" src="{{asset('/')}}bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="{{asset('/')}}static/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="{{asset('/')}}static/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="{{asset('/')}}static/js/jszip.min.js"></script>
        <script type="text/javascript" src="{{asset('/')}}static/js/vfs_fonts.js"></script>
        <script type="text/javascript" src="{{asset('/')}}static/js/buttons.html5.min.js"></script>
     
        <!--
        <script src="{{asset($base_material_path)}}/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        -->
        <script src="{{asset($base_material_path)}}/vendors/bower_components/flot/jquery.flot.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/sparklines/jquery.sparkline.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        
        <script src="{{asset($base_material_path)}}/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/autosize/dist/autosize.min.js"></script>

        <script src="{{asset($base_material_path)}}/vendors/bootgrid/jquery.bootgrid.updated.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>    
        
        
        <script src="{{asset($base_material_path)}}/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/typeahead.js/dist/typeahead.bundle.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/summernote/dist/summernote-updated.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        
        
        <script src="{{asset($base_material_path)}}/vendors/bower_components/chosen/chosen.jquery.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/fileinput/fileinput.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/input-mask/input-mask.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/farbtastic/farbtastic.min.js"></script>

        
        <script src="{{asset($base_material_path)}}/js/flot-charts/curved-line-chart.js"></script>
        <script src="{{asset($base_material_path)}}/js/flot-charts/line-chart.js"></script>
        <script src="{{asset($base_material_path)}}/js/charts.js"></script>
        
        <script src="{{asset($base_material_path)}}/js/functions.js"></script>
        <!--<script src="{{asset($base_material_path)}}/js/demo.js">-->
        
         

        
        <!--<script type="text/javascript" src="{{asset('static/js/jquery.sgbz.mvrck232.js')}}"></script>-->
        <!--<script type="text/javascript" src="{{asset('static/js/jquery.sgbz.pqpg.dc232.js')}}"></script>-->
        
        <!-- Metis core scripts -->
        <!-- -->
        <script type="text/javascript" src="{{asset('static/js/metisMenu.min.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('static/js/screenfull.min.js')}}"></script>
        
        <script src="{{asset('/')}}Bootstrap-Admin/dist/assets/js/core.min.js"></script>
        
        <script src="{{asset('/')}}Bootstrap-Admin/dist/assets/js/app.min.js"></script>
        
        
        
        <!--script type="text/javascript" src="{{asset('static/js/jquery.form-validator.js')}}"></script>
        <script type="text/javascript" src="{{asset('/')}}jquery-form/jquery.form.min.js"></script-->        
                
           

        
        
        
        
        
        @show
        
        <script>
            
           
            $(window).load(function(){
                
                        
                
                        //$(this).find('form').trigger('reset');
                        $(".appprdfirst").hide();
                        $(".cusdet").hide();
                        var _site_url = "{{url('/')}}/";
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        product();
                        productreset();
                        $('#blankSpares').on('shown.bs.modal', function () {
                                $('#blankSpares').find('.spare_save').show();
                                $('body').css('overflow', 'hidden');
                                
                                /********************************************************/
                                var $content, $modal, $apnData, $modalCon; 

                                $content = $(".min");

                                $(".modalSpMinimize").on("click", function()
                                {
                                    $modalCon = $(this).closest(".myspmodal").attr("id");  
                                    $apnData = $(this).closest(".myspmodal");
                                    $modal = "#" + $modalCon;
                                    $(".modal-backdrop").addClass("display-none");   
                                    $($modal).toggleClass("min");  
                                    if ( $($modal).hasClass("min") )
                                    { 
                                        $(".minmaxCon").append($apnData);  
                                        $(this).find("i").toggleClass( 'fa-minus').toggleClass( 'fa-clone');
                                        $('body').css('overflow', 'auto');
                                    } 
                                    else 
                                    { 
                                        $(".container").append($apnData); 
                                        $(this).find("i").toggleClass( 'fa-clone').toggleClass( 'fa-minus');
                                        $('body').css('overflow', 'hidden');
                                    };

                                });

                                

                                /*******************************************************/
                                
                                
                                
                                var controller = 'home/';
                                var dataConfig = {isspares:1};
                                $.ajax({
                                    method: "GET",
                                    url: _site_url + controller + "docseq",
                                    data : dataConfig,
                                }).done(function (data, textStatus, jqXHR) {
                                        if(data.status==1)
                                        {
                                            if(parseInt(data.seqdata.seqno)<10)
                                        {
                                            var seq='00'+data.seqdata.seqno;
                                        }
                                        else 
                                        {
                                            if(parseInt(data.seqdata.seqno)>9 && parseInt(data.seqdata.seqno)<99)
                                            {
                                               var seq='0'+data.seqdata.seqno;
                                            }
                                            else
                                            {
                                                var seq=data.seqdata.seqno;
                                            }
                                        }
                                        var seqno=data.seqdata.prefix+' '+data.seqdata.year.substring(2, 4)+data.seqdata.month+seq;
                                    
                                        $('#blankSpares').find('#sp_docseq_no').val(seqno);
                                        
                                        $(".spareregionselect0").find(".spareregionselect1").remove();
                                        $(".spareregionselect0").append("<div class='spareregionselect1'><select class='selectpicker' title='Select Region' name='region_id' id='sp_region_id'></select></div>");
                                        var splen = data.regiondata.length;
                                            //$(".spareregionselect0").find(".spareregionselect1 select").append("<option value=''></option>");
                                        for(var i=0;i<splen;i++)
                                        {
                                            $(".spareregionselect0").find(".spareregionselect1 select").append("<option value='"+data.regiondata[i].id+"'>"+data.regiondata[i].region_name+"</option>");
                                        }
                                        $(".spareregionselect0").find(".spareregionselect1 select").selectpicker();
                                    }
                                    else
                                    {
                                        swal("Warning","Document sequence is no created","warning");
                                        $('#blankSpares').find('.spare_save').hide();
                                    }
                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                          }).on('hidden.bs.modal', function () {
                                
                                $(this).find('form').trigger('reset');
                                $('body').css('overflow', 'auto');
                                $(".appprdsecond").find('div').remove();
                                product();
                                productreset();
                                
                            });
                        $("#blankTicket").find("#othersscope").click(function(){
                            var othrval = $("#blankTicket").find("#othrval").val();
                            if(othrval == 1)
                            {
                                $("#blankTicket").find("#othrval").val(0);
                                $("#blankTicket").find("#scope_of_work").val('');
                                $("#blankTicket").find("#scope_of_work").attr('readonly','true');
                            }
                            else
                            {
                                $("#blankTicket").find("#othrval").val(1);
                                $("#blankTicket").find("#scope_of_work").removeAttr('readonly');
                            }
                         });
                        $('#blankAttend').on('shown.bs.modal', function () {
                                $('#blankAttend').find('#attendrow div').remove();
                                $('#blankAttend').find('#noattendrow div').remove();
                                $('body').css('overflow', 'hidden');
                                
                                
                                
                                var usertype = $("#blankAttend").find("#usertype").val();
                                var controller = 'home/';
                                var dataConfig = {usertype:usertype};
                                $.ajax({
                                    method: "GET",
                                    url: _site_url + controller + "attend_detail",
                                    data : dataConfig,
                                }).done(function (data, textStatus, jqXHR) {
                                    if(data.status==1)  
                                    {
                                        $(".togswitch").show();
                                        var usrlen = data.userdata.length;
                                        var attendlen = data.attenddata.length;
                                        var attendid = [];
                                        $('#blankAttend').find('#attendrow div').remove();
                                        $('#blankAttend').find('#noattendrow div').remove();
                                        for(var i =0;i<usrlen;i++)
                                        {
                                            for(var j=0;j<attendlen;j++)
                                            {
                                                if(data.userdata[i].id == data.attenddata[j].user_id)
                                                {
                                                    $('#blankAttend').find('#attendrow').append('<div class="normalswitch col-sm-6 m-b-20"><div class="toggle-switch" data-ts-color="green">\n\
                                                                                            <label for="nts'+j+'" class="ts-label f-16 text-uppercase">'+data.userdata[i].name+'</label>\n\
                                                                                            <input id="nts'+j+'" name="chk'+j+'" type="checkbox" hidden="hidden" checked="checked" disabled="disabled">\n\
                                                                                           <label for="nts'+j+'" class="ts-helper"></label></div></div>');
                                                    attendid.push(data.attenddata[j].user_id);
                                                }
                                                
                                            }
                                            console.log(attendid);
                                            if($.inArray(data.userdata[i].id,attendid) == -1)
                                            {
                                                $('#blankAttend').find('#noattendrow').append('<div class="normalswitch col-sm-6 m-b-20"><div class="toggle-switch" data-ts-color="blue">\n\
                                                                                        <label for="nts'+i+'" class="ts-label c-green f-16 text-uppercase">'+data.userdata[i].name+'</label>\n\
                                                                                        <input id="nts'+i+'" data-id="'+data.userdata[i].id+'" name="adchk'+j+'" class="adchk" type="checkbox" hidden="hidden">\n\
                                                                                        <label for="nts'+i+'" class="ts-helper"></label></div></div>');
                                            } 
                                        }
                                        
                                        $(".togswitch").hide();
                                        
                                        $(".adchk").change(function(){
                                            if($(this).is(':checked'))
                                            {
                                                var id = $(this).data('id');
                                                var controller = 'home/';
                                                var dataConfig = {id:id};
                                                $.ajax({
                                                    method: "GET",
                                                    url: _site_url + controller + "attendadd",
                                                    data : dataConfig,
                                                }).done(function (data, textStatus, jqXHR) {
                                                    var adswitch = $(this).closest('.normalswitch').clone();
                                                    $('#blankAttend').find('#attendrow').append(adswitch);
                                                    $(this).closest('.normalswitch').remove();
                                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                                    console.log(" ajax fail ");
                                                    //console.log(jqXHR, textStatus, errorThrown);
                                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                                    console.log(" ajax always ");
                                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                                });
                                            }
                                        });
                                    }
                                    else
                                    {
                                        swal("Warning","Document sequence is no created","warning");
                                    }
                                    
                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                                
                          }).on('hidden.bs.modal',function(){
                            
                                    //$(this).find('#address1').trigger('reset');
                                    //$(this).find('form').trigger('reset');
                                    //$(this).find('form textarea').val("");
                                    $(this).find('form').trigger('reset');
                                    $('body').css('overflow', 'auto');
                                    $(".appprdsecond").find('div').remove();
                                    product();
                                    productreset();
                                });
                        $("#blankModal").on('shown.bs.modal', function () {
                                $('body').css('overflow', 'hidden');
                                
                                /********************************************************/
                                var $content, $modal, $apnData, $modalCon; 
                                $content = $(".min");
                                $(".modalSrMinimize").on("click", function(){
                                    $modalCon = $(this).closest(".mysrmodal").attr("id");  
                                    $apnData = $(this).closest(".mysrmodal");
                                    $modal = "#" + $modalCon;
                                    $(".modal-backdrop").addClass("display-none");   
                                    $($modal).toggleClass("min");  
                                    if ( $($modal).hasClass("min") )
                                    { 
                                        $(".minmaxCon").append($apnData);  
                                        $(this).find("i").toggleClass( 'fa-minus').toggleClass( 'fa-clone');
                                        $('body').css('overflow', 'auto');
                                    } 
                                    else 
                                    { 
                                        $(".container").append($apnData); 
                                        $(this).find("i").toggleClass( 'fa-clone').toggleClass( 'fa-minus');
                                        $('body').css('overflow', 'hidden');
                                    };

                                });

                                $("button[data-dismiss='modal']").click(function(){   
                                    $(this).closest(".mysrmodal").removeClass("min");
                                    $(".container").removeClass($apnData);   
                                    $(this).next('.modalSrMinimize').find("i").removeClass('fa fa-clone').addClass( 'fa fa-minus');
                                  }); 

                                /*******************************************************/
                                
                                var controller = 'home/';
                                var dataConfig = {isspares:0};
                                $.ajax({
                                    method: "GET",
                                    url: _site_url + controller + "docseq",
                                    data : dataConfig,
                                }).done(function (data, textStatus, jqXHR) {
                                        $('#blankModal').find('.app_save').show();
                                        if(data.status==1)
                                        {
                                            if(parseInt(data.seqdata.seqno)<10)
                                        {
                                            var seq='00'+data.seqdata.seqno;
                                        }
                                        else 
                                        {
                                            if(parseInt(data.seqdata.seqno)>9 && parseInt(data.seqdata.seqno)<99)
                                            {
                                               var seq='0'+data.seqdata.seqno;
                                            }
                                            else
                                            {
                                                var seq=data.seqdata.seqno;
                                            }
                                        }
                                        var seqno=data.seqdata.prefix+' '+data.seqdata.year.substring(2, 4)+data.seqdata.month+seq;
                                    
                                        $('#blankModal').find('#ser_docseq_no').val(seqno);
                                        
                                        $(".serviceregionselect0").find(".serviceregionselect1").remove();
                                        $(".serviceregionselect0").append("<div class='serviceregionselect1'><select class='selectpicker' title='Select Region' name='region_id' id='sp_region_id'></select></div>");
                                        var splen = data.regiondata.length;
                                            //$(".spareregionselect0").find(".spareregionselect1 select").append("<option value=''></option>");
                                        for(var i=0;i<splen;i++)
                                        {
                                            $(".serviceregionselect0").find(".serviceregionselect1 select").append("<option value='"+data.regiondata[i].id+"'>"+data.regiondata[i].region_name+"</option>");
                                        }
                                        $(".serviceregionselect0").find(".serviceregionselect1 select").selectpicker();

                                    }
                                    else
                                    {
                                        swal("Warning","Document sequence is no created","warning");
                                        $('#blankModal').find('.app_save').hide();
                                    }
                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                          }).on('hidden.bs.modal',function(){
                            $(this).find(".spare_save").show();
                            //$(this).find('#address1').trigger('reset');
                            //$(this).find('form').trigger('reset');
                            //$(this).find('form textarea').val("");
                            $(this).find('form').trigger('reset');
                            $('body').css('overflow', 'auto');
                            $(".appprdsecond").find('div').remove();
                            product();
                            productreset();
                        });
                        $('#blankTicket').on('shown.bs.modal', function () {
                                $('#blankTicket').find('.ticket_save').show();
                                $('body').css('overflow', 'hidden');
                                
                                /********************************************************/
                                var $content, $modal, $apnData, $modalCon; 

                                $content = $(".min");

                                $(".modalTicketMinimize").on("click", function()
                                {
                                    $modalCon = $(this).closest(".myticketmodal").attr("id");  
                                    $apnData = $(this).closest(".myticketmodal");
                                    $modal = "#" + $modalCon;
                                    $(".modal-backdrop").addClass("display-none");   
                                    $($modal).toggleClass("min");  
                                    if ( $($modal).hasClass("min") )
                                    { 
                                        $(".minmaxCon").append($apnData);  
                                        $(this).find("i").toggleClass( 'fa-minus').toggleClass( 'fa-clone');
                                        $('body').css('overflow', 'auto');
                                    } 
                                    else 
                                    { 
                                        $(".container").append($apnData); 
                                        $(this).find("i").toggleClass( 'fa-clone').toggleClass( 'fa-minus');
                                        $('body').css('overflow', 'hidden');
                                    };

                                });

                                

                                /*******************************************************/
                                
                                
                                
                                var controller = 'home/';
                                var dataConfig = {isspares:2};
                                $.ajax({
                                    method: "GET",
                                    url: _site_url + controller + "docseq",
                                    data : dataConfig,
                                }).done(function (data, textStatus, jqXHR) {
                                        if(data.status==1)
                                        {
                                        
                                            var seqno=data.seqdata.prefix+'-'+data.seqdata.seqno;

                                            $('#blankTicket').find('#tk_docseq_no').val(seqno);

                                        }
                                        else
                                        {
                                            swal("Warning","Document sequence is no created","warning");
                                            $('#blankSpares').find('.spare_save').hide();
                                        }
                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                          }).on('hidden.bs.modal', function () {
                                
                                $(this).find('form').trigger('reset');
                                $('body').css('overflow', 'auto');
                                $(".appprdsecond").find('div').remove();
                                product();
                                productreset();
                                
                            });
                        
                        $("#salesload").hide();
                        $("#sparesload").hide();
                        
                        $("#logout").click(function(){
                                swal({   
                                 title: "Are you sure logout?",   
                                 text: "",   
                                 type: "warning",   
                                 showCancelButton: true,   
                                 confirmButtonText: "Yes, Loggout me!",
                                 cancelButtonText: "Cancel!",  
                                 closeOnConfirm: false
                             },function(){ 
                                        var controller = 'login/';
                                        $.ajax({
                                            method: "GET",
                                            url: _site_url + controller + "logout",
                                        }).done(function (data, textStatus, jqXHR) {
                                                window.location.reload();
                                        }).fail(function (jqXHR, textStatus, errorThrown) {
                                            console.log(" ajax fail ");
                                            //console.log(jqXHR, textStatus, errorThrown);
                                        }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                            console.log(" ajax always ");
                                            //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                        });
                             });
                        });
                        $('form').on("keypress",function(e){
                            var keyCode = e.keyCode || e.which;
                            if (keyCode === 13 && !$(e.target).is('textarea')) { 
                              e.preventDefault();
                              return false;
                            }
                        })
                        prd_details();
                        $(".app_save").click(function()
                        {
                            
                            var mode = $("#mode_of_complaint option:selected").val();
                            //var complaint_type = $("#complaint_type option:selected").val();
                            var complaint_type = 0;
                            var customer_name = $("#customer_name").val();
                            var address1 = $("#address1").val();
                            var address2 = $("#address2").val();
                            var city = $("#city").val();
                            var pincode = $("#pincode").val();
                            var state = $("#state").val();
                            var gstin = $("#gstin").val();
                            var panno = $("#panno").val();
                            var mobileno = $("#mobileno").val();
                            var emailid = $("#emailid").val();
                            var complaint_nature = $("#complaint_nature").val();
                            var contact_person = $("#contact_person").val();
                            
                            var fail = false;
                            var fail_log = '';
                            var name;
                            $( "#blankModal" ).find( 'select, textarea, input' ).each(function(){
                                if( ! $( this ).prop( 'required' )){

                                } else {
                                    if ( ! $( this ).val() ) {
                                        fail = true;
                                        name = $( this ).attr( 'placeholder' );
                                        fail_log += name + " is required \n";
                                    }

                                }
                            });

                            //submit if fail never got set to true
                            if ( ! fail ) {
                                $(this).hide();
                                
                                var data = 1;
                            } else {
                                alert( fail_log );
                                var data = 0;
                            }
                            
                            
                            if(data == 1)
                            {
                                var form_data = $("#blankModal").find('form').serializeArray();
                                var formarray={};

                                $.map(form_data, function(n, i){
                                    formarray[n['name']] = n['value'];
                                });
                                swal({   
                                 title: "Are you sure all Entries are correct?",   
                                 text: "",   
                                 type: "warning",   
                                 showCancelButton: true, 
                                 confirmButtonText: "Confirm!",
                                 cancelButtonText: "Cancel!",  
                                 closeOnConfirm: true
                             },function(){ 
                                        var controller = 'home/';
                                        var dataConfig = formarray;
                                        $.ajax({
                                            method: "GET",
                                            url: _site_url + controller + "appdata",
                                            data: dataConfig,
                                            }).done(function (data, textStatus, jqXHR) {
                                                if(data.status == 1)
                                                {
                                                    swal("Added","Your Complaint is registered","success");
                                                    $("#blankModal").modal('hide');
                                                }
                                                else
                                                {
                                                    swal("Error","Your Complaint is not registered","error");
                                                }
                                                
                                            }).fail(function (jqXHR, textStatus, errorThrown) {
                                                console.log(" ajax fail ");
                                                //console.log(jqXHR, textStatus, errorThrown);
                                            }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                                console.log(" ajax always ");
                                                //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                            });
                                        });
                            }
                                        
                        });               
                                   
                        $(".spare_save").click(function()
                        {
                            
                            var mode = $("#mode_of_complaint option:selected").val();
                            //var complaint_type = $("#complaint_type option:selected").val();
                            var complaint_type = 0;
                            var customer_name = $("#customer_name").val();
                            var address1 = $("#address1").val();
                            var address2 = $("#address2").val();
                            var city = $("#city").val();
                            var pincode = $("#pincode").val();
                            var state = $("#state").val();
                            var gstin = $("#gstin").val();
                            var panno = $("#panno").val();
                            var mobileno = $("#mobileno").val();
                            var emailid = $("#emailid").val();
                            var complaint_nature = $("#complaint_nature").val();
                            var contact_person = $("#contact_person").val();
                            
                            var fail = false;
                            var fail_log = '';
                            var name;
                            $( "#blankSpares" ).find( 'select, textarea, input' ).each(function(){
                                if( ! $( this ).prop( 'required' )){

                                } else {
                                    if ( ! $( this ).val() ) {
                                        fail = true;
                                        name = $( this ).attr( 'placeholder' );
                                        fail_log += name + " is required \n";
                                    }

                                }
                            });

                            //submit if fail never got set to true
                            if ( ! fail ) {
                                $(this).hide();
                                
                                var data = 1;
                            } else {
                                alert( fail_log );
                                var data = 0;
                            }
                            
                            if(data == 1)
                            {
                                var form_data = $("#blankSpares").find('form').serializeArray();
                                var formarray={};

                                $.map(form_data, function(n, i){
                                    formarray[n['name']] = n['value'];
                                });
                                swal({   
                                     title: "Are you sure all Entries are correct?",   
                                     text: "",   
                                     type: "warning",   
                                     showCancelButton: true, 
                                     confirmButtonText: "Confirm!",
                                     cancelButtonText: "Cancel!",  
                                     closeOnConfirm: true
                                 },function(){ 
                                            var controller = 'home/';
                                            var dataConfig = formarray;
                                            $.ajax({
                                                method: "GET",
                                                url: _site_url + controller + "spareappdata",
                                                data: dataConfig,
                                                }).done(function (data, textStatus, jqXHR) {
                                                    if(data.status == 1)
                                                    {
                                                        swal("Added","Your Spare Request is registered","success");
                                                        $("#blankSpares").modal('hide');
                                                    }
                                                    else
                                                    {
                                                        swal("Error","Your Spare Request is not registered","error");
                                                    }

                                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                                    console.log(" ajax fail ");
                                                    //console.log(jqXHR, textStatus, errorThrown);
                                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                                    console.log(" ajax always ");
                                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                                });
                                            });
                            }
                        }); 
                        
                        $(".ticket_save").click(function()
                        {
                            var mode = $("#mode_of_complaint option:selected").val();
                            //var complaint_type = $("#complaint_type option:selected").val();
                            var doc_no = $("#tk_docseq_no").val();
                            var type = 2;
                            var customer_name = $("#tk_customer_name").val();
                            var mobileno = $("#tk_mobileno").val();
                            var email_address = $("#tk_emailid").val();
                            var jobid = $("#tk_job_id").val();
                            var contact_person = $("#tk_contact_person").val();
                            
                            var chkval = [];
                            $("#blankTicket").find('.sow :checkbox:checked').each(function(i){
                              chkval[i] = $(this).val();
                            });
                            console.log(chkval);
                            var scope_of_work = $("#blankTicket").find("#scope_of_work").val();
                            
                            var fail = false;
                            var fail_log = '';
                            var name;
                            $( "#blankTicket" ).find( 'select, textarea, input' ).each(function(){
                                if( ! $( this ).prop( 'required' )){

                                } else {
                                    if ( ! $( this ).val() ) {
                                        fail = true;
                                        name = $( this ).attr( 'placeholder' );
                                        fail_log += name + " is required \n";
                                    }

                                }
                            });

                            //submit if fail never got set to true
                            if ( ! fail ) {
                                $(this).hide();
                                
                                var data = 1;
                            } else {
                                alert( fail_log );
                                var data = 0;
                            }
                            
                            if(data == 1)
                            {
                                
                                var datanew = "mode="+mode+"&type="+type+"&doc_no="+doc_no+
                                        "&email_address="+email_address+"&customer_name="+customer_name+
                                        "&contact_person="+contact_person+"&mobileno="+mobileno+
                                        "&jobid="+jobid+"&otherscope="+scope_of_work+
                                        "&chkval="+chkval;
                                swal({   
                                     title: "Are you sure all Entries are correct?",   
                                     text: "",   
                                     type: "warning",   
                                     showCancelButton: true, 
                                     confirmButtonText: "Confirm!",
                                     cancelButtonText: "Cancel!",  
                                     closeOnConfirm: true
                                 },function(){ 
                                            var controller = 'home/';
                                            var dataConfig = datanew;
                                            $.ajax({
                                                method: "GET",
                                                url: _site_url + controller + "ticketdata",
                                                data: dataConfig,
                                                }).done(function (data, textStatus, jqXHR) {
                                                    if(data.status == 1)
                                                    {
                                                        swal("Raised","Ticket Raised Successfully","success");
                                                        $("#blankTicket").modal('hide');
                                                    }
                                                    else
                                                    {
                                                        swal("Error","Ticket is not Raised","error");
                                                    }

                                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                                    console.log(" ajax fail ");
                                                    //console.log(jqXHR, textStatus, errorThrown);
                                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                                    console.log(" ajax always ");
                                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                                });
                                            });
                            }
                        }); 
                    

					//Welcome Message (not for login page)
                    /*
					function notify(message, type){
						$.growl({
							message: message
						},{
							type: type,
							allow_dismiss: false,
							label: 'Cancel',
							className: 'btn-xs btn-inverse',
							placement: {
								from: 'top',
								align: 'right'
							},
							delay: 2500,
							animate: {
									enter: 'animated fadeIn',
									exit: 'animated fadeOut'
							},
							offset: {
								x: 20,
								y: 85
							}
						});
					};
					*/		
			
                        $("#top-search-close").on('click',function(){
                            $("#mwsearch").val("");
                            $("#top-search-wrap").css("height","");
                        });
                        $("#mwsearch").keyup(function(){
                            
                           var wrd = $(this).val(); 
                           var controller = 'home/';
                           var user_type = $("#user_type").val();
                           if(user_type == 1)
                           {
                               var register = 'servicespareregister/';
                           }
                           else
                           {
                               var register = 'complaintregister/';
                           }
                           if(wrd.length <= 0)
                           {
                               $("#top-search-wrap").find(".cdet").remove();
                               console.log(" No word ");
                           }
                           else
                           {
                               $.ajax({
                                method: "GET",
                                url: _site_url + controller + "cusdata",
                                data: {wrd:wrd},
                                }).done(function (data, textStatus, jqXHR) {
                                    console.log(data);
                                    
                                    $("#top-search-wrap").css("height","740px");
                                    $("#top-search-wrap").css("overflow","auto");
                                    $(".cusdet").show();
                                    var len = data.length;
                                    $("#top-search-wrap").find(".cdet").remove();
                                    for(var i=0;i<len;i++)
                                    {
                                        var cusdet = $(".cusdet .cusdet2").clone();
                                        var div = "<div class='cdet' id='cdet"+i+"'></div>";
                                        $("#top-search-wrap").append(div);
                                        
                                        $("#top-search-wrap").find("#cdet"+i).append(cusdet);
                                        $("#top-search-wrap").find("#cdet"+i+" h2").html(data[i].customer_name);
                                        var status = data[i].ordstatus;
                                        
                                        var newUrl = _site_url+register+data[i].id;
                                        if(status == 2)
                                        {
                                            var clr = 'bgm-bluegray';
                                        }else if (status == 1)
                                        {
                                            var clr = 'bgm-orange';
                                        }else if (status == 4)
                                        {
                                            var clr = 'bgm-green';
                                        }else if (status == 6)
                                        {
                                            var clr = 'bgm-red';
                                        }else if (status == 3)
                                        {
                                            var clr = 'bgm-teal';
                                        }
                                        
                                        
                                        if(user_type == 2)
                                        {
                                            var divdata = "<div class='pmb-block'><div class='pmbb-body p-l-30'>\n\
                                            <div class='pmbb-view'><dl class='dl-horizontal'><dt>Reg No</dt><dd>"+data[i].seqno+"</dd><dt>Reg Date</dt><dd>"+data[i].complaint_date+"</dd>\n\
                                            <dt>Compalint Nature</dt><dd>"+data[i].complaint_nature+"</dd><dt>Compalint Status</dt><dd>"+data[i].orderstatus+"</dd></dl></div></div></div>";
                                        }
                                        else
                                        {
                                            var divdata = "<div class='pmb-block'><div class='pmbb-body p-l-30'>\n\
                                            <div class='pmbb-view'><dl class='dl-horizontal'><dt>Reg Date</dt><dd>"+data[i].complaint_date+"</dd></dl></div></div></div>";
                                        }
                                            
                                        $("#top-search-wrap").find("#cdet"+i+" .card-header").removeClass('bgm-bluegray');
                                        $("#top-search-wrap").find("#cdet"+i+" .card-header").addClass(clr);
                                        $("#top-search-wrap").find("#cdet"+i+" a").attr("href", newUrl);
                                        $("#top-search-wrap").find("#cdet"+i+" .cardcusdet").append(divdata);
                                        
                                        
                                    }
                                        
                                    $(".cusdet").hide();

                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                           }
                                
                        });
                        
                        $(".salno").click(function(){
                            var salno = $(".salno1").val();
                            var len = salno.length;
                            if(len >4)
                            {
                                $("#salesload").show();
                                $(".saldata").hide();
                                cusdetails(salno);
                            }
                        });

                        /*$(".salno1").keyup(function(){
                            var salno = $(this).val();
                            var len = salno.length;
                            if(len >4)
                            {
                                $("#salesload").show();
                                $(".saldata").hide();
                                cusdetails(salno);
                            }

                        });
                        $(".spnol").click(function(){
                            var salno = $(".salno1").val();
                            var len = salno.length;
                            alert(len);
                            if(len >4)
                            {
                                $("#sparesload").show();
                                $(".spdata").hide();
                                bpdetails(salno);
                            }
                        });*/

                        /*$(".spnol").keyup(function(){
                            var salno = $(this).val();
                            var len = salno.length;
                            if(len >4)
                            {
                                $("#sparesload").show();
                                $(".spdata").hide();
                                bpdetails(salno);
                            }

                        });/*/
                        
                        $(".spno").click(function(){
                            var salno = $(this).val();
                            var len = salno.length;
                            if(len >4)
                            {
                                $("#sparesload").show();
                                $(".spdata").hide();
                                bpdetails(salno);
                            }

                        });

                        function cusdetails(salno){
                            $("#customer_name").val("");
                            $("#address1").val("");
                            $("#address2").val("");
                            $("#city").val("");
                            $("#state").val("");
                            $("#pincode").val("");
                            $("#emailid").val("");
                            $("#gstin").val("");
                            $("#phoneno").val("");

                            var controller = 'home/';
                            $.ajax({
                                method: "GET",
                                url: _site_url + controller + "cusdetail",
                                data: {wrd:salno},
                                }).done(function (data, textStatus, jqXHR) {
                                    //$("#searchmodal").modal();
                                    console.log(data.salesdetails);
                                    if(data.salesdetails.length > 0)
                                    {
                                        $("#customer_name").val(data.salesdetails[0].bpname);
                                        $("#bp_id").val(data.salesdetails[0].bp_id);
                                        $("#address1").val(data.salesdetails[0].address1);
                                        $("#address2").val(data.salesdetails[0].address2);
                                        $("#city").val(data.salesdetails[0].city);
                                        $("#state").val(data.salesdetails[0].regionid);
                                        $("#pincode").val(data.salesdetails[0].pincode);
                                        $("#emailid").val(data.salesdetails[0].em_ms_email);
                                        $("#gstin").val(data.salesdetails[0].em_ms_customergstin);
                                        $("#phoneno").val(data.salesdetails[0].phoneno);

                                        $('#mobileno').focus();
                                    }
                                    if(data.orderdetails.length > 0)
                                    {
                                        $("#modalselect5").find("#blankSales").remove();
                                        $("#modalselect5").append($(".blanksoline div").clone());
                                        for(var k=0;k<data.orderdetails.length;k++)
                                        {
                                            $("#modalselect5").find("#blankSales tbody").append("<tr><td><input class='frm_salidradio' type='radio' name='salesid' data-docno='"+data.orderdetails[k].documentno+"' data-invid='"+data.orderdetails[k].invid+"' data-docdate='"+data.orderdetails[k].dateinvoiced+"' data-prdname='"+data.orderdetails[k].name+"'></td><td>"+data.orderdetails[k].documentno+"</td><td>"+data.orderdetails[k].dateinvoiced+"</td><td>"+data.orderdetails[k].name+"</td></tr>");
                                        }
                                        $("#modalselect5").find("#blankSales").modal();
                                        $("#modalselect5").find(".frm_salidradio").click(function()
                                        {
                                            var docno = $(this).data("docno");
                                            var invid = $(this).data("invid");
                                            var dateinv = $(this).data("docdate");
                                            var name = $(this).data("prdname");
                                            $("#panel_descrption").val(name);
                                            $("#date_supply").val(dateinv);
                                            $("#invoiceno").val(docno);
                                            $("#invoiceid").val(invid);
                                            $("#modalselect5").find("#blankSales").modal('hide');
                                        });
                                    }

                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    $(".saldata").show();
                                    $("#salesload").hide();
                                    $('#mobileno').focus();
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                        }
                    
                        function bpdetails(salno){
                            $("#sp_customer_name").val("");
                            $("#sp_address1").val("");
                            $("#sp_address2").val("");
                            $("#sp_city").val("");
                            $("#sp_state").val("");
                            $("#sp_pincode").val("");
                            $("#sp_emailid").val("");
                            $("#sp_gstin").val("");
                            $("#sp_phoneno").val("");

                            var controller = 'home/';
                            $.ajax({
                                method: "GET",
                                url: _site_url + controller + "cusdetail",
                                data: {wrd:salno},
                                }).done(function (data, textStatus, jqXHR) {
                                    //$("#searchmodal").modal();
                                    if(data.salesdetails.length > 0)
                                    {
                                        $("#sp_customer_name").val(data.salesdetails[0].bpname);
                                        $("#sp_address1").val(data.salesdetails[0].address1);
                                        $("#sp_address2").val(data.salesdetails[0].address2);
                                        $("#sp_city").val(data.salesdetails[0].city);
                                        $("#sp_state").val(data.salesdetails[0].regionid);
                                        $("#sp_pincode").val(data.salesdetails[0].pincode);
                                        $("#sp_emailid").val(data.salesdetails[0].em_ms_email);
                                        $("#sp_gstin").val(data.salesdetails[0].em_ms_customergstin);
                                        $("#sp_phoneno").val(data.salesdetails[0].phoneno);
                                        $('#sp_mobileno').focus();
                                    }

                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    $(".spdata").show();
                                    $("#sparesload").hide();
                                    $('#sp_mobileno').focus();
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                        }
                    
                        function product()
                        {
                            var prd = $(".appprdfirst").find(".row").clone();
                            $(".appprdsecond").append(prd);
                        }
                           
                         $("#blankSpares").on('click','.addline',function(){
                             product();
                             productreset();
                         });
                        
                        function productreset()
                        {
                            var len=$("#blankSpares").find(".appprdsecond .row").length;
                            for(var i=0;i<len;i++)
                            {
                                var j=parseInt(i)+1;
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_product_id").attr("name","product_id["+j+"]");
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_product").attr("name","product["+j+"]");
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_description").attr("name","description["+j+"]");
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_qty").attr("name","qty["+j+"]");
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_tax_id").attr("name","tax_id["+j+"]");
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_tax_amt").attr("name","tax_amt["+j+"]");
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_discount").attr("name","discount["+j+"]");
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_unit_price").attr("name","unit_price["+j+"]");
                                $("#blankSpares").find(".appprdsecond .row").eq(i).find(".frm_total").attr("name","total["+j+"]");
                            }
                        }
                         function prd_details (){
                             var controller = 'home/';
                            $.ajax({
                                method: "GET",
                                url: _site_url + controller + "productdetail",
                                data: {},
                                }).done(function (data, textStatus, jqXHR) {
                                    //console.log(data);
                                    $("#modalselectprd").find("#modalselectprd2 table tbody").append(data);
                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                         };
                         
                         function taxcalc(qty,amt,tax_id,rowno,discount)
                        {
                            var datanew = {tax_id:tax_id};

                            var controller = 'home/';

                            $.ajax({
                                method: "GET",
                                url: _site_url + controller + "taxcalc",
                                data: datanew,

                            }).done( function( data, textStatus, jqXHR ) {
                                //console.log(data);
                                if(data.status ==1)
                                {
                                    var disc = (parseFloat(qty)*parseFloat(amt)*(parseFloat(discount)/100));
                                    var netamt= ((parseFloat(qty)*parseFloat(amt))-parseFloat(disc));
                                    //alert(netamt);
                                    var taxamt = (parseFloat(netamt)*parseFloat(data.rate))/100;
                                    var tot = parseFloat(netamt)+parseFloat(taxamt);
                                    $(".appprdsecond").find(".frm_tax_amt").eq(rowno).val(taxamt.toFixed(2));
                                    $(".appprdsecond").find(".frm_total").eq(rowno).val(tot.toFixed(2));
                                }
                                else
                                {
                                    $(".appprdsecond").find(".frm_qty").eq(rowno).val(0);
                                    $(".appprdsecond").find(".frm_tax_amt").eq(rowno).val(0);
                                    $(".appprdsecond").find(".frm_total").eq(rowno).val(0);
                                }


                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                //console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            });
                        };

                        $("#blankSpares").on('focusin','.frm_product',function(){
                            var _this= this;
                            var indx = $(this).closest(".row").index();
                            $("#modalselect5").find("#modalselectprd2").remove();
                            var model2 = $("#modalselectprd").find("#modalselectprd2").clone();
                            $("#modalselect5").append(model2);
                            $("#modalselect5").find("#data-table-command").dataTable({
                                "lengthMenu": [ [100, 200], [100,200] ],
                                } );
                              $("div.dataTables_filter input").focus();
                            $("#modalselect5").find("#data-table-command").on('change','.frm_prdradio',function(){
                               var prdid = $(".frm_prdradio:checked").val();
                               var prdname = $(this).closest('tr').find(".frm_pname").text();
                               var unitprice = $(this).closest('tr').find(".frm_amount").text();
                               var uomname = $(this).closest('tr').find(".frm_uom").text();
                               //aconsole.log(unitprice);
                               $(".appprdsecond").find(".frm_product").eq(indx).val(prdname);
                               $(".appprdsecond").find(".frm_unit_price").eq(indx).val(unitprice);
                               $(".appprdsecond").find(".frm_product_id").eq(indx).val(prdid);
                               $(".appprdsecond").find(".frm_uomname").eq(indx).html(uomname);
                               $("#modalselect5").find("#selproductform").modal('toggle');
                               $(".appprdsecond").find(".frm_qty").eq(indx).focus();
                            });
                            $("#modalselect5").find("#selproductform").modal().on('hidden.bs.modal',function(){
                                

                            });
                            $(".appprdsecond").on('change','.frm_discount',function(e){
                                
                                var indx = $(this).closest(".row").index();
                                var discount = $(this).val();
                                var tax_id = $(".appprdsecond").find(".frm_tax_id").eq(indx).val();
                                var price = $(".appprdsecond").find(".frm_unit_price").eq(indx).val();
                                var quantity = $(".appprdsecond").find(".frm_qty").eq(indx).val();
                                var tot = parseFloat(price)*parseFloat(quantity);
                                if(tax_id !="")
                                taxcalc(quantity,price,tax_id,indx,discount);
                            });
                            
                            
                            $(".appprdsecond").on('change','.frm_tax_id',function(e){
                                
                                var indx = $(this).closest(".row").index();
                                var tax_id = $(this).val();
                                var discount = $(".appprdsecond").find(".frm_discount").eq(indx).val();
                                var price = $(".appprdsecond").find(".frm_unit_price").eq(indx).val();
                                var quantity = $(".appprdsecond").find(".frm_qty").eq(indx).val();
                                var tot = parseFloat(price)*parseFloat(quantity);
                                //$(".appprdsecond").find(".frm_total").eq(indx).val(tot);
                                taxcalc(quantity,price,tax_id,indx,discount);
                            });
                            
                            $(".appprdsecond").on('change','.frm_unit_price',function(){
                                var indx = $(this).closest(".row").index();
                                var price = $(this).val();
                                var discount = $(".appprdsecond").find(".frm_discount").eq(indx).val();
                                var tax_id = $(".appprdsecond").find(".frm_tax_id").eq(indx).val();
                                var quantity = $(".appprdsecond").find(".frm_qty").eq(indx).val();
                                var tot = parseFloat(price)*parseFloat(quantity);
                                $(".appprdsecond").find(".frm_total").eq(indx).val(tot);
                                if(tax_id !="")
                                taxcalc(quantity,price,tax_id,indx,discount);
                            });

                            $(".appprdsecond").on('change','.frm_qty',function(){
                                var indx = $(this).closest(".row").index();
                                var price = $(".appprdsecond").find(".frm_unit_price").eq(indx).val();
                                var quantity = $(this).val();
                                var discount = $(".appprdsecond").find(".frm_discount").eq(indx).val();
                                var tax_id = $(".appprdsecond").find(".frm_tax_id").eq(indx).val();
                                var tot = parseFloat(price)*parseFloat(quantity);
                                $(".appprdsecond").find(".frm_total").eq(indx).val(tot);
                                if(tax_id !="")
                                taxcalc(quantity,price,tax_id,indx,discount);
                            });



                        });
                    });
                    
            $(document).ready(function(){
                fetchemail();
                tollfree();
                setInterval(fetchemail,300000);
                setInterval(tollfree,30000000);
                $(".mail-t").hide();
           });        
           function fetchemail()
           {
               //alert("test");
               var dt = new Date();
               var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                //document.write(time);
               console.log("function to pull email "+time);
               
               var _site_url = "{{url('/')}}/";
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               var controller = 'email/';
                $.ajax({
                    method: "POST",
                    url: _site_url + controller + "message",
                    }).done(function (data, textStatus, jqXHR) {
                        $(".mail-t").show();
                        $("#email-message").find(".lv-body a").remove();
                        var len = data.unread.length;
                        
                        $("#email-message").find(".tmn-counts").html(len);
                        $("#email-message").find(".lv-body div").remove();
                        
                        
                        if(len >= 8)
                        {
                            for(var i=0;i<8;i++)
                            {
                                var urlnew = _site_url + controller + data.unread[i].id;
                                var emailt = $(".mail-t").find(".lv-item").clone();
                                $("#email-message").find(".lv-body").append("<div id='emid"+i+"'></div>");
                                $("#email-message").find("#emid"+i).append(emailt);
                                $("#email-message").find("#emid"+i).find(".lv-item").attr('href',urlnew);
                                $("#email-message").find("#emid"+i).find(".lv-title").html(data.unread[i].name);
                                $("#email-message").find("#emid"+i).find(".lv-small").html(data.unread[i].subject);
                            }
                        }
                        else
                        {
                            for(var i=0;i<len;i++)
                            {
                                var urlnew = _site_url + controller + data.unread[i].id;
                                var emailt = $(".mail-t").find(".lv-item").clone();
                                
                                $("#email-message").find(".lv-body").append("<div id='emid"+i+"'></div>");
                                $("#email-message").find("#emid"+i).append(emailt);
                                $("#email-message").find("#emid"+i).find(".lv-item").attr('href',urlnew);
                                $("#email-message").find("#emid"+i).find(".lv-title").html(data.unread[i].name);
                                $("#email-message").find("#emid"+i).find(".lv-small").html(data.unread[i].subject);
                            }
                        }
                        
                        
                        $(".mail-t").hide();
                        console.log(" ajax success ");
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        console.log(" ajax fail ");
                        
                        //console.log(jqXHR, textStatus, errorThrown);
                    }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                        console.log(" ajax always ");
                        //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                    }); 
                 }   
            function sendemail()
            {
                //alert("test");
                var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                 //document.write(time);
                console.log("function to send email "+time);

                var _site_url = "{{url('/')}}/";
                $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                var controller = 'email/';
                 $.ajax({
                     method: "POST",
                     url: _site_url + controller + "sendmail",
                     }).done(function (data, textStatus, jqXHR) {

                         console.log(" ajax success ");
                     }).fail(function (jqXHR, textStatus, errorThrown) {
                         console.log(" ajax fail ");

                         //console.log(jqXHR, textStatus, errorThrown);
                     }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                         console.log(" ajax always ");
                         //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                     });
                 }
            function tollfree()
            {
               //alert("test");
               var dt = new Date();
               var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                //document.write(time);
               console.log("function to pull tollfree "+time);
               
               var _site_url = "{{url('/')}}/";
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               var controller = 'home/';
                $.ajax({
                    method: "GET",
                    url: _site_url + controller + "tollfree",
                    }).done(function (data, textStatus, jqXHR) {
                        
                        console.log(" ajax success ");
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        console.log(" ajax fail ");
                        
                        //console.log(jqXHR, textStatus, errorThrown);
                    }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                        console.log(" ajax always ");
                        //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                    }); 
                 }  
        </script>
</body>
</html>