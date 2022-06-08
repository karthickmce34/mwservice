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
            <?php $user_type = session()->get('user_type')?>
            
            <div class="card-body card-padding" >
                @if($user_type == 0 || $user_type == 2 || $user_type == 4)
                <div class="tl-header bgm-bluegray">
                    <h4 class='c-white'>Today Stats</h4>
                    <ul class="actions actions-alt">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="">Past 7 days</a>
                                </li>
                                <li>
                                    <a href="">Past 30 days</a>
                                </li>
                                <li>
                                    <a href="">Past 6  months</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="tl-body">
                    <div class="row">
                            <div class="col-sm-6 col-md-5">
                                <span class="f-16">Ticket</span>
                                <div class="card">
                                    <div class="clearfix">
                                        <div class="col-sm-3 bgm-teal text-center" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="{{$opentktdet}}" title="" data-original-title="Ticket Details">
                                            <h5 class="c-white">Raised</h5>
                                            <h3 class="c-white">{{count($openticket)}}</h3>
                                        </div>
                                        <div class="col-sm-3 bgm-blue text-center" >
                                            <h5 class="c-white">Converted</h5>
                                            <h3 class="c-white">{{count($convertedticket)}}</h3>
                                        </div>
                                        <div class="col-sm-3 bgm-blue text-center" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="{{$closetktdet}}" title="" data-original-title="Close Ticket Details">
                                            <h5 class="c-white">Closed</h5>
                                            <h3 class="c-white">{{count($closedticket)}}</h3>
                                        </div>
                                        <div class="col-sm-3 bgm-blue text-center">
                                            <h5 class="c-white">Pending</h5>
                                            <h3 class="c-white">{{count($pendingticket)}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-7">
                                <span class="f-16">Toll free</span>
                                <div class="card">
                                    <div class="clearfix">
                                        <div class="col-sm-3 bgm-teal text-center">
                                            <h5 class="c-white">General</h5>
                                            <h3 class="c-white">{{count($tollfreegeneral)}}</h3>
                                        </div>
                                        <div class="col-sm-3 bgm-teal text-center">
                                            <h5 class="c-white">Service/Spares</h5>
                                            <h3 class="c-white">{{count($tollfreespser)}}</h3>
                                        </div>
                                        <div class="col-sm-2 bgm-lightgreen text-center">
                                            <h5 class="c-white">Answered</h5>
                                            <h3 class="c-white">{{count($tollfreeanswer)}}</h3>
                                        </div>
                                        <div class="col-sm-2 bgm-lightgreen text-center">
                                            <h5 class="c-white">Missed</h5>
                                            <h3 class="c-white">{{count($tollfreenoanswer)}}</h3>
                                        </div>
                                        <div class="col-sm-2 bgm-lightgreen text-center">
                                            <h5 class="c-white">Voice Msg</h5>
                                            <h3 class="c-white">{{count($tollfreevmsg)}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(session()->get('user_type') != 4)
                <div class="col-sm-12">
                    <!-- Calendar -->
                    <div id="calendar-widget1"></div>
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
                @endif
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
       
                    var _site_url = "{{url('/')}}/";

                   $("#pending_enq").dataTable(
                           {
                               'searching':false,
                               'info':false,
                               "lengthMenu": [[5], [5]],
                               "pagingType": "numbers",
                               "lengthChange": false
                           });
                    $("#new_enq").dataTable(
                           {
                               'searching':false,
                               'info':false,
                               "lengthMenu": [[5], [5]],
                               "pagingType": "numbers",
                               "lengthChange": false
                           });
                   $('#calendar-widget1').fullCalendar({
                                contentHeight: 'auto',
                                theme: true,
                        header: {
                            right: '',
                            center: 'prev, title, next',
                            left: ''
                        },
                        defaultDate: $.datepicker.formatDate('yy-mm-dd', new Date()),
                        selectable: true,
                        editable: false,
                        dateClick: function(info) {
                        alert('clicked ' + info.dateStr);
                        },
                        //select: function(info) {
                        events: [
                            /*{
                                title: 'AT Coimbatore',
                                start: '2022-02-15',
                                end: '2022-02-16',
                                className: 'bgm-cyan'
                            },
                            {
                                title: 'At Chennai',
                                start: '2021-07-07',
                                end: '2021-07-08',
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
                            }*/
                        ]

                    }); 
                    /*setTimeout(calwid, 10000);
                    setTimeout(calwid2, 7000);
                   function calwid()
                   {
                       var event = {
                            title: 'New Event',
                            start: Date(Date.now()),
                            backgroundColor: App.getLayoutColorCode('purple'),
                            allDay: false
                            title: 'AT Chennai',
                            start: '2021-07-21',
                            end: '2021-07-26',
                            className: 'bgm-green'
                        }
                        jQuery('#calendar-widget1').fullCalendar('renderEvent',event,true);
                        //console.log("cal");
                   }*/
                   
                    
                    var controller = 'home/';
                    
                    $.ajax({
                            method: "GET",
                            url: _site_url + controller + "calender",

                            }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            console.log( data.calender);
                                var len=data.calender.length;
                                for(var i=0;i<len;i++)
                                {
                                    var event = data.calender[i];
                                    jQuery('#calendar-widget1').fullCalendar('renderEvent',event,true);
                                }

                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            });

    });
</script>
@stop
