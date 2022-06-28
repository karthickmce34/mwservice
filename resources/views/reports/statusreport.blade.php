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
        <div class="card col-sm-6">
            <h5>Process Pending <span class="f-16 zmdi zmdi-widgets pull-right"></span></h5>
            
            <div id="chart1">
                
            </div>
        </div>
        <div class="card col-sm-6">
            <h5>Job Pending <span class="f-16 zmdi zmdi-widgets pull-right"></span></h5>
            <div id="chart2">
                
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
            <div class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Details</h4>
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
            var chart2 = c3.generate({
                        data: {
                            // iris data from R
                            columns: [
                                ['data1', 30],
                                ['data2', 120],
                            ],
                            type : 'pie',
                            onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                        },
                        bindto:"#chart3",
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
                            if(data.status ==1)
                            {
                                
                                $("#modalreport").find(".modal-body div").remove();
                                $("#modalreport").find(".modal-body").append("<div class='statrep'></div>");
                                $("#modalreport").find(".modal-body div").append("<table><thead<th>Seqno</th><th>Complaint Date</th><th>Customer Name</th><th>Mobileno</th><th>So No</th><th>Scope</th></table>");
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
        });
        
            
    </script>
@stop


