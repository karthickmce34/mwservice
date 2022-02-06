@extends('_layouts.app')

@section('title', 'Home')
@section('page_title', 'Home')
@section('page_icon_cls', 'fa-building')

@section('page_home_li_cls', 'active')

@section('style')
@parent
<style>
    #calendar-widget1 .fc-toolbar {
        background: #009688;
      }
      #calendar-widget1 .fc-day-header {
        color: #fff;
        background: #007d71;
        padding: 5px 0;
        border-width: 0;
      }
      #calendar-widget1 .fc-day-number {
        text-align: center;
        color: #ADADAD;
        padding: 5px 0;
      }
      #calendar-widget1 .fc-day-grid-event {
        margin: 1px 3px 1px;
      }
      #calendar-widget1 .ui-widget-header th,
      #calendar-widget1 .ui-widget-header {
        bord
</style> 
@stop
@section('menu')
    @parent

@stop
@section('content')
    @parent
    
        <div class="card">
            <div class="card-header card-padding text-center">
                    <h3>Home</h3>
                    <h2 class="c-black f-500">Welcome {{ strtoupper(session()->get('name')) }}</h2>
            </div>
            <div class="card-body card-padding" >
                <div class="mini-charts">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="mini-charts-item bgm-cyan">
                                    <div class="clearfix">
                                        <div class="chart stats-bar"></div>
                                        <div class="count">
                                            <small>Total Enquiry</small>
                                            <!--h2>₹ 200</h2-->
                                            <h2>{{$phone}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="mini-charts-item bgm-lightgreen">
                                    <div class="clearfix">
                                        <div class="chart stats-bar-2"></div>
                                        <div class="count">
                                            <small>Total Offer</small>
                                            <h2>{{$email}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="mini-charts-item bgm-orange">
                                    <div class="clearfix">
                                        <div class="chart stats-line"></div>
                                        <div class="count">
                                            <small>Service Pending</small>
                                            <h2>{{$pending}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="mini-charts-item bgm-bluegray">
                                    <div class="clearfix">
                                        <div class="chart stats-line-2"></div>
                                        <div class="count">
                                            <small>Solved</small>
                                            <h2>{{$completed}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dash-widgets">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div id="site-visits" class="dash-widget-item bgm-teal">
                                    <div class="dash-widget-header">
                                        <div class="p-20">
                                            <div class="dash-widget-visits"></div>
                                        </div>

                                        <div class="dash-widget-title">For the past 30 days</div>

                                        <ul class="actions actions-alt">
                                            <li class="dropdown">
                                                <a href="" data-toggle="dropdown">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="">Refresh</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Manage Widgets</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Widgets Settings</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="p-20">

                                        <small>Spares</small>
                                        <h3 class="m-0 f-400">{{$spare}}</h3>

                                        <br/>

                                        <small>Service</small>
                                        <h3 class="m-0 f-400">{{$service}}</h3>

                                        <br/>

                                        <small>Spares & Service</small>
                                        <h3 class="m-0 f-400">{{$serviceandspares}}</h3>

                                        <br/>


                                    </div>
                                </div>
                            </div>
                            <!--a href="" data-model-name="Register" data-target="#blankModal" data-toggle="modal" title="Register" data-placement="bottom"  data-backdrop="static" data-keyboard="false">

                                <i class="tm-icon zmdi zmdi-account-box-phone"></i>
                            </a-->
                            <!--div class="col-md-3 col-sm-6">
                                <div id="site-visits" class="dash-widget-item bgm-teal">
                                    <div class="dash-widget-header">


                                        <div class="dash-widget-title"><small>Outstanding on Suppliers and Customer</small></div>

                                        <ul class="actions actions-alt">
                                            <li class="dropdown">
                                                <a href="" data-toggle="dropdown">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="">Refresh</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Manage Widgets</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Widgets Settings</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="p-20">

                                        <small>Vendor Outstading</small>
                                        <h3 class="m-0 f-400">600</h3>

                                        <br/>

                                        <small>Customer Outstanding</small>
                                        <h3 class="m-0 f-400">800</h3>

                                        <br/>


                                    </div>
                                </div>
                            </div-->

                            <!-- Recent Items -->
                            <div class="col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h2>Recent Visits <small>Recently Visited</small></h2>
                                        <ul class="actions">
                                            <li class="dropdown">
                                                <a href="" data-toggle="dropdown">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="">Refresh</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Settings</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Other Settings</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body m-t-0">
                                        <table class="table table-inner table-vmiddle">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Place</th>
                                                    <th>From Date</th>
                                                    <th>To Date</th>
                                                    <th>No of Days</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td class="f-500 c-cyan">Yuvaraj</td>
                                                    <td class="f-500 c-cyan">Coimbatore</td>
                                                    <td>01-01-2021</td>
                                                    <td>05-01-2021</td>
                                                    <td>5</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <!-- Calendar -->
                        <div id="calendar-widget1"></div>

                        <!-- Recent Posts -->
                        <!--div class="card">
                            <div class="card-header ch-alt m-b-20">
                                <h2>Minimum Stock <small>Minimum Stock List</small></h2>
                                <ul class="actions">
                                    <li>
                                        <a href="">
                                            <i class="zmdi zmdi-refresh-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="zmdi zmdi-download"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="" data-toggle="dropdown">
                                            <i class="zmdi zmdi-more-vert"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="">Change Date Range</a>
                                            </li>
                                            <li>
                                                <a href="">Change Graph Type</a>
                                            </li>
                                            <li>
                                                <a href="">Other Settings</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>

                            <div class="card-body">
                                <table class="table table-inner table-vmiddle">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Particulars</th>
                                            <th style="width: 60px">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="f-500 c-cyan">2569</td>
                                            <td>Samsung Galaxy Mega</td>
                                            <td class="f-500 c-cyan">10 Nos</td>
                                        </tr>
                                        <tr>
                                            <td class="f-500 c-cyan">9658</td>
                                            <td>Huawei Ascend P6</td>
                                            <td class="f-500 c-cyan">12 Nos</td>
                                        </tr>
                                        <tr>
                                            <td class="f-500 c-cyan">1101</td>
                                            <td>HTC One M8</td>
                                            <td class="f-500 c-cyan">5 Nos</td>
                                        </tr>
                                        <tr>
                                            <td class="f-500 c-cyan">6598</td>
                                            <td>Samsung Galaxy Alpha</td>
                                            <td class="f-500 c-cyan">20 Nos</td>
                                        </tr>
                                        <tr>
                                            <td class="f-500 c-cyan">4562</td>
                                            <td>LG G3</td>
                                            <td class="f-500 c-cyan">8 Nos</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div-->
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            
                            
                            <!-- Todo Lists -->
                            <div id="todo-lists">
                                <div class="tl-header">
                                    <h2>Todo Lists</h2>
                                    <small>Add, edit and manage your Todo Lists</small>
                                    
                                    <ul class="actions actions-alt">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="zmdi zmdi-more-vert"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="">Refresh</a>
                                                </li>
                                                <li>
                                                    <a href="">Manage Widgets</a>
                                                </li>
                                                <li>
                                                    <a href="">Widgets Settings</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                    
                                <div class="clearfix"></div>
                                    
                                <div class="tl-body">
                                    <div id="add-tl-item">
                                        <i class="add-new-item zmdi zmdi-plus"></i>
                                        
                                        <div class="add-tl-body">
                                            <textarea placeholder="What you want to do..."></textarea>
                                            
                                            <div class="add-tl-actions">
                                                <a href="" data-tl-action="dismiss"><i class="zmdi zmdi-close"></i></a>
                                                <a href="" data-tl-action="save"><i class="zmdi zmdi-check"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="zmdi zmdi-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>Collect rs. 45000 From party on 20/Jan/2019</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="zmdi zmdi-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>Gst Filling to be done on 31/Jan/2019</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="zmdi zmdi-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>Purchase Follow up on 10/Jan/2019</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
            </div>
        </div>
                    
        
@stop

@section('css')
    @parent

@stop    
@section('js')
    @parent

<script>

    $(function () {

            
                   $('#calendar-widget1').fullCalendar({
                                contentHeight: 'auto',
                                theme: true,
                        header: {
                            right: '',
                            center: 'prev, title, next',
                            left: ''
                        },
                        defaultDate: '2021-01-09',
                        editable: false,
                        dateClick: function(info) {
                            alert('Date: ' + info.dateStr);
                            alert('Resource ID: ' + info.resource.id);
                          },
                        events: [
                            {
                                title: 'AT Coimbatore',
                                start: '2021-01-01',
                                end: '2021-01-01',
                                className: 'bgm-cyan'
                            },
                            {
                                title: 'At Chennai',
                                start: '2021-01-07',
                                end: '2021-01-08',
                                className: 'bgm-orange'
                            },
                            {
                                id: 9991,
                                title: 'Repeat',
                                start: '2021-01-09',
                                className: 'bgm-lightgreen'
                            },
                            {
                                id: 999,
                                title: 'Repeat',
                                start: '2021-01-16',
                                className: 'bgm-lightblue'
                            },
                            {
                                title: 'Meet',
                                start: '2021-01-12',
                                end: '2021-01-12',
                                className: 'bgm-green'
                            },
                            {
                                title: 'Lunch',
                                start: '2021-01-12',
                                className: 'bgm-cyan'
                            },
                            {
                                title: 'Birthday',
                                start: '2021-01-13',
                                className: 'bgm-amber'
                            },
                            {
                                title: 'Google',
                                url: 'http://google.com/',
                                start: '2021-01-28',
                                className: 'bgm-amber'
                            }
                        ]

                    });       
                    

    });
</script>
@stop
