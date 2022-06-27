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
        <?php echo json_encode($process_status); ?>
    </div>   
    <div class="card">
        <div class="card col-sm-6">
            <div id="chart1">
                
            </div>
        </div>
        <div class="card col-sm-6">
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
            var chart1 = c3.generate({
                        data: {
                            columns: <?php echo json_encode($process_status); ?>,
                            type : 'donut',
                            onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                        },
                        donut: {
                            title: "Process Pending"
                        },
                        bindto:"#chart1",
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
                        bindto:"#chart2",
                    });
        });
    </script>
@stop


