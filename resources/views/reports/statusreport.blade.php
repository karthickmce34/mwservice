@extends('_layouts.app')

@section('title', 'Service Report')
@section('page_title', 'Service Report')
@section('page_icon_cls', 'fa-building')

@section('page_report_li_cls', 'toggled active')
@section('page_servicereport_li_cls', 'toggled active')
@section('page_servicereport_li_list_cls', 'active')
@section('page_servicereport_li_add_cls', '')

@section('style')
    @parent
    <style>
        #data-table-command {
            table-layout: fixed;
            width: 100% !important;
          }
          #data-table-command td{
            width: auto !important;
            text-overflow: ellipsis;
            overflow: hidden;
          }
          #data-table-command th{
            width: auto !important;
            white-space: normal;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
          }
    </style> 
@stop
@section('menu')
    @parent
@stop
@section('content')
    @parent
    <div class="card">
        <div class="card-header card-padding text-center">
            <h3>Service Report</h3>
        </div>
        
    </div>   
    <div class="card">
        <div class="card col-sm-12 text-center f-18">Total Pending : <b>{{$pendingorder}}</b></div>
        <div class="card col-sm-6">
            <h5>Process Pending <span class="f-16 zmdi zmdi-widgets pull-right"></span></h5>
            
            <div id="chart1">
                
            </div>
            <div id="table1" class='hide'>
                
            </div>
        </div>
        <div class="card col-sm-6">
            <h5>Job Pending <span class="f-16 zmdi zmdi-widgets pull-right"></span></h5>
            <div id="chart2">
                
            </div>
        </div>
    </div>
    <div class="card col-sm-12">
        <div class="card col-sm-6 pc-previous">
            <div class="card-header">
                <h2>Pending Vs Completed <small> For Previous Month</small><span class="pull-right">Total : {{$job_precnt}}</span></h2>
            
                <ul class="actions">
                   
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='current' class="pc_dropdown">Current Month</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="chart3_previous">
                
            </div>
        </div>
        <div class="card col-sm-6 pc-current">
            <div class="card-header">
                <h2>Pending Vs Completed<small> For Current Month</small> <span class="pull-right">Total : {{$job_curcnt}}</span></h2>
            
                <ul class="actions">
                   
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="#" onclick="return false;"  data-target='previous' class="pc_dropdown">Previous Month</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            
            <div id="chart3">
                
            </div>
        </div>
        <div class="card col-sm-6 pc-underwarrenty">
            <div class="card-header">
                <h2>Pending Vs Completed (Warrenty/Out Of Warrenty)<small> For Current Month Under Warrenty</small></h2>
            
                <ul class="actions">
                   
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="#" onclick="return false;"  data-target='outofwarrenty' class="pcwow_dropdown">Out of Warrenty</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            
            <div id="pcuw_chart">
                
            </div>
        </div>
        <div class="card col-sm-6 pc-outofwarrenty">
            <div class="card-header">
                <h2>Pending Vs Completed (Warrenty/Out Of Warrenty)<small> For Current Month Out Of Warrenty</small></h2>
            
                <ul class="actions">
                   
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="#" onclick="return false;"  data-target='underwarrenty' class="pcwow_dropdown">Under Warrenty</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            
            <div id="pcow_chart">
                
            </div>
        </div>
    </div>
    <div class="card col-sm-12">
        <div class="card col-sm-6 ex-overall">
            <div class="card-header">
                <h2>Expenses<small> For Overall</small> <span class="pull-right">Total : {{$overallexptotal}}</span></h2>
            
                <ul class="actions">
                   
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='previous'  class="ex_dropdown">Previous</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='current'  class="ex_dropdown">Current</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="expenses_overall">
                
            </div>
        </div>
        <div class="card col-sm-6 ex-previous">
            <div class="card-header">
                <h2>Expenses<small> For Previous Month</small> <span class="pull-right">Total : {{$previousexptotal}}</span></h2>
            
                <ul class="actions">
                   
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='overall'  class="ex_dropdown">Overall</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='current' class="ex_dropdown">Current</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="expenses_previous">
                
            </div>
        </div>
        <div class="card col-sm-6 ex-current">
            <div class="card-header">
                <h2>Expenses<small> For Current Month</small> <span class="pull-right">Total : {{$currentexptotal}}</span></h2>
            
                <ul class="actions">
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='overall' class="ex_dropdown">Overall</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='previous' class="ex_dropdown">Previous</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="expenses_current">
                
            </div>
        </div>
        
        <div class="card col-sm-6 exwc-overall">
            <div class="card-header">
                <h2>Expenses Engineer Wise<small> For Overall</small> <span class="pull-right">Total : {{$overallexptotal}}</span></h2>
            
                <ul class="actions">
                   
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='previous'  class="exew_dropdown">Previous</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='current'  class="exew_dropdown">Current</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="expenses_engwc_overall">
                
            </div>
        </div>
        <div class="card col-sm-6 exwc-previous">
            <div class="card-header">
                <h2>Expenses Engineer Wise<small> For Previous Month</small> <span class="pull-right">Total : {{$previousexptotal}}</span></h2>
            
                <ul class="actions">
                   
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='overall'  class="exwc_dropdown">Overall</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='current' class="exwc_dropdown">Current</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="expenses_engwc_previous">
                
            </div>
        </div>
        <div class="card col-sm-6 exwc-current">
            <div class="card-header">
                <h2>Expenses Engineer Wise<small> For Current Month</small> <span class="pull-right">Total : {{$currentexptotal}}</span></h2>
            
                <ul class="actions">
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='overall' class="exwc_dropdown">Overall</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='previous' class="exwc_dropdown">Previous</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="expenses_engwc_current">
                
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card col-sm-6 re-overall">
            <div class="card-header">
                <h2>Received vs Expenses<small> For Overall</small></h2>
            
                <ul class="actions">
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='current' class="re_dropdown">Current</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='previous' class="re_dropdown">Previous</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="received_exp_overall">
                
            </div>
        </div>
        <div class="card col-sm-6 re-previous">
            <div class="card-header">
                <h2>Received vs Expenses<small> For Previous Month</small></h2>
            
                <ul class="actions">
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='overall' class="re_dropdown">Over All</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='previous' class="re_dropdown">Previous</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="received_exp_previous">
                
            </div>
        </div>
        <div class="card col-sm-6 re-current">
            <div class="card-header">
                <h2>Received vs Expenses<small> For Current Month</small></h2>
            
                <ul class="actions">
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='overall' class="re_dropdown">Overall</a>
                            </li>
                            <li>
                                <a href="" onclick="return false;" data-target='previous' class="re_dropdown">Previous</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="received_exp_current">
                
            </div>
        </div>
        <div class="card col-sm-6 sw-previous">
            <div class="card-header">
                <h2>Scope Of Work<small> For Previous Month</small></h2>
            
                <ul class="actions">
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="" onclick="return false;" data-target='current' class="sw_dropdown">Current</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="work_previous">
                
            </div>
        </div>
        <div class="card col-sm-6 sw-current">
            <div class="card-header">
                <h2>Scope Of Work<small> For Current Month</small></h2>
            
                <ul class="actions">
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="zmdi zmdi-widgets"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            
                            <li>
                                <a href="" onclick="return false;" data-target='previous' class="sw_dropdown">Previous</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="work">
                
            </div>
            <div id='cool-chart'>
                
            </div>
        </div>
    </div>
    <div class="newrow">
        <div id="row1" class=" table-responsive">
            <table id="servicedetail" class="display table table-striped table-vmiddle f-10">
                <thead>
                    <tr class="">
                        <th data-column-id="sno">Sno</th>
                        <th data-column-id="complaintdate">Complaint Date</th>
                        <th data-column-id="documentno">Documentno</th>
                        <th data-column-id="ordertype">Order Type</th>
                        <th data-column-id="accname">Customer Name</th>
                        <th data-column-id="site_location">Site Location</th>  
                        <th data-column-id="salesno">SO no.</th>
                        <th data-column-id="complaint">Nature of Complaint</th>
                        <th data-column-id="warrenty">Warrenty</th>
                        <th data-column-id="complaintmode">Complaint Received</th>
                        <th data-column-id="status">Action Taken</th>
                        <th data-column-id="deputed">Attended by</th>
                        <th data-column-id="deputedon">Attended Date</th>
                        <th data-column-id="remark">Remarks</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
    <div id="modalreport">
        <div class="modal fade servicestatus" id="servicestatus" role="dialog">
            <div class="modal-dialog  modal-lg" style="width:95%">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Details <span class="detname"></span></h4>
                    </div>
                    
                    <div class="modal-body">
                                       
                    </div>
                    <div class="modal-footer m-t-25">
                        <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
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
    <script src="{{asset('/')}}/d3/d3.min.js" charset="utf-8"></script>
    <script src="{{asset('/')}}/c3/c3.min.js"></script>
    <script>
        $(function () {
            var _site_url = "{{url('/')}}/";
            
            var chart1 = c3.generate({
                        data: {
                            columns: <?php echo json_encode($process_status); ?>,
                            type : 'donut',
                            onclick: function (d, i) { statusreport(d, i); },
                           // onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            //onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                        },
                        donut: {
                            title: "Process Pending",
                            label: {
                              format: function(value, ratio, id) {
                                return value;
                              }
                            },
                            
                        },
                        tooltip: {
                                format: {
                                    title: function (d) { return d; },
                                    value: function (value, ratio, id) {
                                        //var format = id === 'data1' ? d3.format(',') : d3.format('$');
                                        //return format(value);
                                        return value;
                                        
                                        },
                                    }
                                },
                        bindto:"#chart1",
                    });
                
            var chart2 = c3.generate({
                        data: {
                            columns: <?php echo json_encode($job_status); ?>,
                            type : 'donut',
                            onclick: function (d, i) { statusreport(d, i , ''); },
                           // onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                           // onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                        },
                        donut: {
                            title: "Job Pending",
                            label: {
                              format: function(value, ratio, id) {
                                return value;
                              }
                            },
                            
                        
                        },
                        tooltip: {
                                format: {
                                    title: function (d) { return d; },
                                    value: function (value, ratio, id) {
                                        //var format = id === 'data1' ? d3.format(',') : d3.format('$');
                                        //return format(value);
                                        return value;
                                        
                                        },
                        //            value: d3.format(',') // apply this format to both y and y2
                                    }
                                },
                        bindto:"#chart2",
                    });
            var chart3 = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($jobprocess_status); ?>,
                            type : 'bar',
                            onclick: function (d, i) { jb_compltedreport(d, i , 'current'); },
                            /*onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#chart3",
                    });
            var chart3_previous = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($previousjobprocess_status); ?>,
                            type : 'bar',
                            onclick: function (d, i) { jb_compltedreport(d, i , 'previous'); },
                            /*onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#chart3_previous",
                    });
                
            var expenses_overall = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($overall_expenses); ?>,
                            type : 'bar',
                            onclick: function (d, i) { ex_compltedreport(d, i , 'overall'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#expenses_overall",
                    });
            var expenses_previous = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($previous_expenses); ?>,
                            type : 'bar',
                            onclick: function (d, i) { ex_compltedreport(d, i , 'previous'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#expenses_previous",
                    });
            var expenses_current = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($current_expenses); ?>,
                            type : 'bar',
                            onclick: function (d, i) { ex_compltedreport(d, i , 'current'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#expenses_current",
                    });
                
            var received_exp_overall = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($overall_received_expensedata); ?>,
                            type : 'pie',
                            onclick: function (d, i) { received_exp_report(d, i , 'overall'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        pie: {
                            title: "Recieved Vs Expenses",
                            label: {
                              format: function(value, ratio, id) {
                                return value;
                              }
                            },
                            
                        
                        },
                        tooltip: {
                                format: {
                                    title: function (d) { return d; },
                                    value: function (value, ratio, id) {
                                        //var format = id === 'data1' ? d3.format(',') : d3.format('$');
                                        //return format(value);
                                        return value;
                                        
                                        },
                        //            value: d3.format(',') // apply this format to both y and y2
                                    }
                                },
                        bindto:"#received_exp_overall",
                    });
            var received_exp_previous = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($previous_received_expensedata); ?>,
                            type : 'pie',
                            onclick: function (d, i) { received_exp_report(d, i , 'previous'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        pie: {
                            title: "Recieved Vs Expenses",
                            label: {
                              format: function(value, ratio, id) {
                                return value;
                              }
                            },
                            
                        
                        },
                        tooltip: {
                                format: {
                                    title: function (d) { return d; },
                                    value: function (value, ratio, id) {
                                        //var format = id === 'data1' ? d3.format(',') : d3.format('$');
                                        //return format(value);
                                        return value;
                                        
                                        },
                        //            value: d3.format(',') // apply this format to both y and y2
                                    }
                                },
                        bindto:"#received_exp_previous",
                    });
            var received_exp_current = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($current_received_expensedata); ?>,
                            type : 'pie',
                            onclick: function (d, i) { received_exp_report(d, i , 'current'); },
                            //onclick: function (d, i) { console.log("onclick", d, i); },
                            /*onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        pie: {
                            title: "Recieved Vs Expenses",
                            label: {
                              format: function(value, ratio, id) {
                                return value;
                              }
                            },
                            
                        
                        },
                        tooltip: {
                                format: {
                                    title: function (d) { return d; },
                                    value: function (value, ratio, id) {
                                        //var format = id === 'data1' ? d3.format(',') : d3.format('$');
                                        //return format(value);
                                        return value;
                                        
                                        },
                        //            value: d3.format(',') // apply this format to both y and y2
                                    }
                                },
                        bindto:"#received_exp_current",
                    });
                
            var work = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($scopeofwork); ?>,
                            type : 'bar',
                            onclick: function (d, i) { scopeofwork(d, i , 'current'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#work",
                    });
             var work_previous = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php echo json_encode($previousscopeofwork); ?>,
                            type : 'bar',
                            onclick: function (d, i) { scopeofwork(d, i , 'previous'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#work_previous",
                    });
                
            //var jobstatus_col = 
            var pcuw_current = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php 
                                        echo json_encode($jobuwarrentydata);
                                        
                                        ?>,
                            type : 'bar',
                            //onclick: function (d, i) { scopeofwork(d, i , 'previous'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#pcuw_chart",
                    });  
            
            var pcow_current = c3.generate({
                        data: {
                            // iris data from R
                            columns: <?php 
                                        echo json_encode($jobowarrentydata);
                                        
                                        ?>,
                            type : 'bar',
                            //onclick: function (d, i) { scopeofwork(d, i , 'previous'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#pcow_chart",
                    });  
            
            var expenses_engwc_overall = c3.generate({
                data: {
                            // iris data from R
                            columns: <?php echo json_encode($joboverall_exp_engwise); ?>,
                            type : 'bar',
                            onclick: function (d, i) { exwc_compltedreport(d, i , 'overall'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#expenses_engwc_overall",
            });
            
            var expenses_engwc_previous = c3.generate({
                data: {
                            // iris data from R
                            columns: <?php echo json_encode($jobprev_exp_engwise); ?>,
                            type : 'bar',
                            onclick: function (d, i) { exwc_compltedreport(d, i , 'previous'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#expenses_engwc_previous",
            });
            
            var expenses_engwc_current = c3.generate({
                data: {
                            // iris data from R
                            columns: <?php echo json_encode($jobcur_exp_engwise); ?>,
                            type : 'bar',
                            onclick: function (d, i) { exwc_compltedreport(d, i , 'current'); },
                            /*onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
                        },
                        bindto:"#expenses_engwc_current",
            });
                    
            function statusreport(d, i)
            {
                console.log("onclick", d, i);

                var orderstatus = d.id;

                var dataConfig = {
                        orderstatus: orderstatus
                        };

                var controller = 'statusreport/';

                $.ajax({
                            method: "POST",
                            url: _site_url + controller + "statusdetails",
                            data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                           // alert(data);
                            $(".detname").html(" For "+orderstatus);
                            if(data.status ==1)
                            {
                                
                                $("#modalreport").find(".modal-body div").remove();
                                $("#modalreport").find(".modal-body").append("<div class='statrep'></div>");
                                $("#modalreport").find(".modal-body .statrep").append("<table id='data-table-command' class='table table-striped'><thead><th class='f-10 text-center'>Seqno</th><th class='f-10 text-center'>Complaint Date</th><th class='f-10 text-center'>Customer Name</th><th class='f-10 text-center'>Mobileno</th><th class='f-10 text-center'>So No</th><th class='f-10 text-center'>Scope</th></thead><tbody></tbody></table>");
                                var len = data.servicedata.length;
                                for (var i=0;i<len;i++)
                                {
                                    $("#modalreport").find(".statrep tbody").append("<tr><td class='f-10 text-center'>"+data.servicedata[i].seqno+"</td><td class='f-10 text-center'>"+data.servicedata[i].complaint_date+"</td><td class='f-10 text-center'>"+data.servicedata[i].customer_name+"</td><td class='f-10 text-center'>"+data.servicedata[i].mobileno+"</td><td  class='f-10 text-center'>"+data.servicedata[i].salesorder_no+"</td><td  class='f-10 text-center'>"+data.servicedata[i].scope_of_work+"</td></tr>");
                                }
                                $("#modalreport").find(".statrep table").dataTable({autoWidth:true});
                                $("#modalreport").find("#servicestatus").modal();
                            }

                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            console.log( " ajax fail " );
                            //console.log( jqXHR, textStatus, errorThrown );
                        }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                            console.log( " ajax always " );
                            //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                        });


                //alert(d.id);
            }
            
            function jb_compltedreport(d, i , type)
            {
                var orderstatus = d.id;

                var dataConfig = {
                        orderstatus: orderstatus,type:type
                        };

                var controller = 'statusreport/';

                $.ajax({
                            method: "POST",
                            url: _site_url + controller + "jb_compltedreport",
                            data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                           // alert(data);
                            $(".detname").html(" For "+orderstatus);
                            if(data.status ==1)
                            {
                                
                                $("#modalreport").find(".modal-body div").remove();
                                $("#modalreport").find(".modal-body").append("<div class='statrep'></div>");
                                $("#modalreport").find(".modal-body .statrep").append("<table class='table'><thead><th>Seqno</th><th>Complaint Date</th><th>Customer Name</th><th>Mobileno</th><th>So No</th><th>Scope</th></thead><tbody></tbody></table>");
                                var len = data.servicedata.length;
                                for (var i=0;i<len;i++)
                                {
                                    $("#modalreport").find(".statrep tbody").append("<tr><td>"+data.servicedata[i].seqno+"</td><td>"+data.servicedata[i].complaint_date+"</td><td>"+data.servicedata[i].customer_name+"</td><td>"+data.servicedata[i].mobileno+"</td><td>"+data.servicedata[i].salesorder_no+"</td><td>"+data.servicedata[i].scope_of_work+"</td></tr>");
                                }
                                
                                $("#modalreport").find("#servicestatus").modal();
                            }

                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            console.log( " ajax fail " );
                            //console.log( jqXHR, textStatus, errorThrown );
                        }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                            console.log( " ajax always " );
                            //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                        });  
                
            }
            
            function ex_compltedreport(d, i , type)
           {
                var orderstatus = d.id;

                var dataConfig = {
                        orderstatus: orderstatus,type:type
                        };

                var controller = 'statusreport/';

                $.ajax({
                            method: "POST",
                            url: _site_url + controller + "ex_compltedreport",
                            data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                           // alert(data);
                            $(".detname").html(" For "+orderstatus);
                            if(data.status ==1)
                            {
                                
                                $("#modalreport").find(".modal-body div").remove();
                                $("#modalreport").find(".modal-body").append("<div class='statrep' style='width:100%'></div>");
                                $("#modalreport").find(".modal-body .statrep").append("<table id='data-table-command' class='table table-striped'><thead><th>Seqno</th><th>Complaint Date</th><th>Customer Name</th><th>Engineer Name</th><th>Work</th><th>Attend From</th><th>Attend To</th><th>Lodging</th><th>Boarding</th><th>Travel</th><th>Local</th></thead><tbody></tbody></table>");
                                var len = data.servicedata.length;
                                for (var i=0;i<len;i++)
                                {
                                    $("#modalreport").find(".statrep tbody").append("<tr><td>"+data.servicedata[i].seqno+"</td><td>"+data.servicedata[i].complaint_date+"</td><td>"+data.servicedata[i].customer_name+"</td><td>"+data.servicedata[i].serviceengineer+"</td><td>"+data.servicedata[i].scope_of_work+"</td><td>"+data.servicedata[i].date_of_attend+"</td><td>"+data.servicedata[i].date_of_complete+"</td><td>"+data.servicedata[i].loading_expenses+"</td><td>"+data.servicedata[i].boarding_expenses+"</td><td>"+data.servicedata[i].travel_expenses+"</td><td>"+data.servicedata[i].local_conveyance+"</td></tr>");
                                }
                                $("#modalreport").find(".statrep .table").dataTable();
                                $("#modalreport").find("#servicestatus").modal();
                            }

                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            console.log( " ajax fail " );
                            //console.log( jqXHR, textStatus, errorThrown );
                        }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                            console.log( " ajax always " );
                            //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                        });  
                
            }
            
            function received_exp_report(d, i , type)
            {
                var orderstatus = d.id;

                var dataConfig = {
                        orderstatus: orderstatus,type:type
                        };

                var controller = 'statusreport/';

                $.ajax({
                            method: "POST",
                            url: _site_url + controller + "received_exp_report",
                            data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                           // alert(data);
                            $(".detname").html(" For "+orderstatus);
                            if(data.status ==1)
                            {
                                
                                $("#modalreport").find(".modal-body div").remove();
                                $("#modalreport").find(".modal-body").append("<div class='statrep' ></div>");
                                if(orderstatus == 'Received')
                                {
                                    $("#modalreport").find(".modal-body .statrep").append("<table class='table'><thead><th>Seqno</th><th>Complaint Date</th><th>Customer Name</th><th>SO No</th><th>Engineer Name</th><th>Work</th><th>Income</th></thead><tbody></tbody></table>");
                                    var len = data.servicedata.length;
                                    var totincomeamt = 0;
                                    for (var i=0;i<len;i++)
                                    {
                                        $("#modalreport").find(".statrep tbody").append("<tr><td class='f-10'>"+data.servicedata[i].seqno+"</td><td class='f-10'>"+data.servicedata[i].complaint_date+"</td><td class='f-10'>"+data.servicedata[i].customer_name+"</td><td class='f-10'>"+data.servicedata[i].salesorder_no+"</td><td class='f-10'>"+data.servicedata[i].serviceengineer+"</td><td class='f-10'>"+data.servicedata[i].scope_of_work+"</td><td class='f-10'>"+data.servicedata[i].incomeamt+"</td></tr>");
                                        totincomeamt = parseInt(totincomeamt)+parseInt(data.servicedata[i].incomeamt);
                                    }
                                    $("#modalreport").find(".statrep tbody").append("<tr><td></td><td></td><td></td><td></td><td></td><td>Total</td><td>"+parseInt(totincomeamt)+"</td></tr>");
                                    //$("#modalreport").find(".statrep .table").dataTable({'autoWidth':true});
                                    $("#modalreport").find("#servicestatus").modal();
                                }
                                else
                                {
                                    $("#modalreport").find(".modal-body .statrep").append("<table class='table'><thead><th>Seqno</th><th>Complaint Date</th><th>Customer Name</th><th>SO No</th><th>Engineer Name</th><th>Work</th><th>Attend From</th><th>Attend To</th><th>Expenses</th></thead><tbody></tbody></table>");
                                    var len = data.servicedata.length;
                                    var totexpenses = 0;
                                    for (var i=0;i<len;i++)
                                    {
                                        $("#modalreport").find(".statrep tbody").append("<tr><td class='f-10'>"+data.servicedata[i].seqno+"</td><td class='f-10'>"+data.servicedata[i].complaint_date+"</td><td class='f-10'>"+data.servicedata[i].customer_name+"</td><td class='f-10'>"+data.servicedata[i].salesorder_no+"</td><td class='f-10'>"+data.servicedata[i].serviceengineer+"</td><td class='f-10'>"+data.servicedata[i].scope_of_work+"</td><td class='f-10'>"+data.servicedata[i].date_of_attend+"</td><td class='f-10'>"+data.servicedata[i].date_of_complete+"</td><td class='f-10'>"+data.servicedata[i].expenses+"</td></tr>");
                                        totexpenses = parseInt(totexpenses)+parseInt(data.servicedata[i].expenses);
                                    }
                                    $("#modalreport").find(".statrep tbody").append("<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Total</td><td>"+parseInt(totexpenses)+"</td></tr>");
                                    //$("#modalreport").find(".statrep .table").dataTable();
                                    $("#modalreport").find("#servicestatus").modal();
                                }
                                    
                            }

                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            console.log( " ajax fail " );
                            //console.log( jqXHR, textStatus, errorThrown );
                        }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                            console.log( " ajax always " );
                            //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                        });  
            }
            
            function scopeofwork(d, i , type)
            {
                var orderstatus = d.id;

                var dataConfig = {
                        orderstatus: orderstatus,type:type
                        };

                var controller = 'statusreport/';

                $.ajax({
                            method: "POST",
                            url: _site_url + controller + "scopeofwork_report",
                            data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                           // alert(data);
                            $(".detname").html(" For "+orderstatus);
                            if(data.status ==1)
                            {
                                
                                $("#modalreport").find(".modal-body div").remove();
                                $("#modalreport").find(".modal-body").append("<div class='statrep'></div>");
                                $("#modalreport").find(".modal-body .statrep").append("<table class='table'><thead><th>Seqno</th><th>Complaint Date</th><th>Customer Name</th><th>So no</th><th>Engineer Name</th><th>Work</th><th>Income</th><th>Expenses</th></thead><tbody></tbody></table>");
                                var len = data.servicedata.length;
                                var totincomeamt =0;
                                var totexpenses = 0;
                                
                                for (var i=0;i<len;i++)
                                {
                                    $("#modalreport").find(".statrep tbody").append("<tr><td>"+data.servicedata[i].seqno+"</td><td>"+data.servicedata[i].complaint_date+"</td><td>"+data.servicedata[i].customer_name+"</td><td>"+data.servicedata[i].salesorder_no+"</td><td>"+data.servicedata[i].serviceengineer+"</td><td>"+data.servicedata[i].scope_of_work+"</td><td>"+data.servicedata[i].incomeamt+"</td><td>"+data.servicedata[i].expenses+"</td></tr>");
                                    totexpenses = parseInt(totexpenses)+parseInt(data.servicedata[i].expenses);
                                    totincomeamt = parseInt(totincomeamt)+parseInt(data.servicedata[i].incomeamt);
                                }
                                $("#modalreport").find(".statrep tbody").append("<tr><td></td><td></td><td></td><td></td><td></td><td>Total</td><td>"+parseInt(totincomeamt)+"</td><td>"+parseInt(totexpenses)+"</td></tr>");

                                //$("#modalreport").find(".statrep .table").dataTable({'autoWidth':true});
                                $("#modalreport").find("#servicestatus").modal();
                                    
                            }

                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            console.log( " ajax fail " );
                            //console.log( jqXHR, textStatus, errorThrown );
                        }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                            console.log( " ajax always " );
                            //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                        });  
            }
            
            
            $('.pc-previous').hide();
            $(".pc_dropdown").on('click',function()
            {
               var targetdata = $(this).data('target');
               if(targetdata == 'previous')
               {
                   $('.pc-previous').show();
                   $('.pc-current').hide();
               }
               else
               {
                   $('.pc-previous').hide();
                   $('.pc-current').show();
               }
            });
            
            $('.ex-overall').hide();
            $('.ex-previous').hide();
            $(".ex_dropdown").on('click',function()
            {
               var targetdata = $(this).data('target');
               if(targetdata == 'previous')
               {
                   $('.ex-previous').show();
                   $('.ex-current').hide();
                   $('.ex-overall').hide();
               }
               else
               {
                   if(targetdata == 'current')
                   {
                        $('.ex-previous').hide();
                        $('.ex-current').show();
                        $('.ex-overall').hide();
                   }
                   else
                   {
                        $('.ex-previous').hide();
                        $('.ex-current').hide();
                        $('.ex-overall').show();
                   }
                   
               }
            });
            
            $('.re-overall').hide();
            $('.re-previous').hide();
            $(".re_dropdown").on('click',function()
            {
               var targetdata = $(this).data('target');
               if(targetdata == 'previous')
               {
                   $('.re-previous').show();
                   $('.re-current').hide();
                   $('.re-overall').hide();
               }
               else
               {
                   if(targetdata == 'current')
                   {
                        $('.re-previous').hide();
                        $('.re-current').show();
                        $('.re-overall').hide();
                   }
                   else
                   {
                        $('.re-previous').hide();
                        $('.re-current').hide();
                        $('.re-overall').show();
                   }
                   
               }
            });
            
            $('.sw-previous').hide();
            $(".sw_dropdown").on('click',function()
            {
               var targetdata = $(this).data('target');
               if(targetdata == 'previous')
               {
                   $('.sw-previous').show();
                   $('.sw-current').hide();
               }
               else
               {
                   $('.sw-previous').hide();
                   $('.sw-current').show();
               }
            });
            
            $('.exwc-overall').hide();
            $('.exwc-previous').hide();
            $(".exwc_dropdown").on('click',function()
            {
               var targetdata = $(this).data('target');
               if(targetdata == 'previous')
               {
                   $('.exwc-previous').show();
                   $('.exwc-current').hide();
                   $('.exwc-overall').hide();
               }
               else
               {
                   if(targetdata == 'current')
                   {
                        $('.exwc-previous').hide();
                        $('.exwc-current').show();
                        $('.exwc-overall').hide();
                   }
                   else
                   {
                        $('.exwc-previous').hide();
                        $('.exwc-current').hide();
                        $('.exwc-overall').show();
                   }
                   
               }
            });
            
            $('.pc-outofwarrenty').hide();
            $(".pcwow_dropdown").on('click',function()
            {
               var targetdata = $(this).data('target');
               if(targetdata == 'outofwarrenty')
               {
                   $('.pc-outofwarrenty').show();
                   $('.pc-underwarrenty').hide();
               }
               else
               {
                   $('.pc-underwarrenty').show();
                   $('.pc-outofwarrenty').hide();
               }
            });
            /***************************/
            
          /*  var jobwarrenty_status = <?php //echo json_encode($jobwarrenty_status); ?>;
            
            console.log(jobwarrenty_status);
            
            console.log(<?php //echo json_encode($jobwarrentydata2); ?>);
            jQuery.each( jobwarrenty_status, function( i, val ) {
                //$( "#" + val ).text( "Mine is " + val + "." );

                // Will stop running after "three"
                console.log ( "Mine is " + jobwarrenty_status[i] + "." );
              });
            var matrix = [<?php //echo json_encode($jobwarrentydata2); ?>];
                          //countsData can be build using matrix
                          var countsData = [
                                      ['OutofWarrent', 2, 4, 6],
                                      ['UnderWarrenty', 20, 40, 60],
                                  ];

                          var riskToColor = {
                                      OutofWarrent: '#9ACD32',
                                      UnderWarrenty: '#FFD700',
                                  };
                          var categoriesList = ['Job', 'Proceess', 'Completed'];

                          var chart = c3.generate({
                            bindto: '#pcwow_chart',
                            
                              data: {
                                  columns: countsData,
                                  type: 'bar',
                                  colors: riskToColor,
                                  groups: [
                                      ['OutofWarrent', 'UnderWarrenty']
                                  ],
                                 order: null,
                                 
                                },
                                axis: {
                                   //rotated: true,
                                   x: {
                                    type: 'category',
                                    categories: categoriesList
                                   },
                                  //y: {show: false}
                                 },
                                tooltip: {
                                  contents: function (d) {
                                    var $$ = this, config = $$.config,text;
                                    //console.log(d[0]);
                                    text = "<table class='" + $$.CLASS.tooltip + "'><tr><th colspan='3'>"+categoriesList[d[0].index]+"</th></tr>"; 
                                    text += "<tr class='" + $$.CLASS.tooltipName + "'>";
                                    text += "<td class='name'>Type</td>";
                                    text += "<td class='name'>Count</td>";
                                    for (i = 0; i < d.length; i++) {
                                      text += "<tr class='" + $$.CLASS.tooltipName + "'>";
                                      text += "<td class='name'><span style='background-color:"+riskToColor[d[i].name]+"'></span>"+d[i].name+"</td>";
                                      text += "<td class='value'>"+d[i].value+"</td></tr>";
                                     }
                                    return text + "</table>";
                                  }
                               }
                          });*/
        });
        
            
    </script>
@stop


