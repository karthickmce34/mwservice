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
        <div class="card-body card-padding " >
            <div style="border: 2px gray solid;border-radius: 5px" >
                <div class="row m-25">
                    <div class="row m-25">
                        
                        <div class="col-xs-3">
                           <div class="form-group">
                                <div class="fg-line">
                                    <p class="c-black f-500 m-b-20">Order Type</p>

                                    <div class="input-group form-group">
                                        <select class="selectpicker" placeholder="Order Type" aria-describedby="basic-addon1" required   id="order_type" name="order_type">
                                            <option value="">=== Order Type === </option>
                                            <option value="0">Standard</option>
                                            <option value="1">Industry</option>
                                            <option value="2">Utility</option>
                                            <option value="3">Projects</option>
                                            <option value="4">Railway</option>
                                        </select>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                           <div class="form-group">
                                <div class="fg-line">
                                    <p class="c-black f-500 m-b-20">Order Status</p>

                                    <div class="input-group form-group">
                                        <select class="selectpicker" placeholder="Order Status" aria-describedby="basic-addon1"    id="order_status" name="order_status">
                                            <option value="">=== Order Status ===</option>
                                            <option value="pending">Pending</option>
                                            <option value="0">Enquiryreceived</option>
                                            <option value="1">OfferSent</option>
                                            <option value="2">Poreceived</option>
                                            <option value="3">PIsent</option>
                                            <option value="4">Advcance Received</option>
                                            <option value="10">Deputed</option>
                                            <option value="5">Payment Received</option>
                                            <option value="6">DISent</option>
                                            <option value="8">Completed</option>
                                            <option value="9">Cancelled</option>
                                            
                                        </select>   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 frmdt">
                            <div class="form-group">
                                <div class="fg-line">
                                    <?php $firstdate = date("Y-m-01"); ?>
                                    <p class="c-black f-500 m-b-20">From date</p>
                                    <div class="input-group form-group">
                                        <input type='text' class="form-control" placeholder="Click here..." id='fromdate' name='fromdate' value="{{$firstdate}}">
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="col-xs-3 todt">
                           <div class="form-group">
                                <div class="fg-line">
                                    <p class="c-black f-500 m-b-20">To date</p>
                                    <?php $currdate = date("Y-m-d"); ?>
                                    <div class="input-group form-group">
                                        <input type='text' class="form-control" placeholder="Click here..." id='todate' name='todate' value="{{$currdate}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center reportview">
                    <div class="col-xs-12">
                       <div class="form-group">
                           <div class="fg-line">
                                <button type="button" class="btn bgm-orange search"><i class="zmdi zmdi-search"></i> Search</button>

                           </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="m-t-25" id="purview">
                <div class="loader text-center" style="display: none;height: 150px; ">
                    <div class="preloader pls-gray">
                        <svg class="pl-circular m-b-25" viewBox="25 25 50 50">
                            <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                        </svg>

                        <p class="m-t-25">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body card-padding">
            <div class="newrow2">
                
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
    
    <script>
        $(function () {
            $("#fromdate").datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd",});
            $("#todate").datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd",});
            $(".newrow").hide();
            var _site_url = "{{url('/')}}/";
            $("#order_status").change(function(){
                var orderstatus = $("#order_status option:selected").val();
                if(orderstatus == "pending")
                {
                    $(".frmdt").hide();
                    $(".todt").hide();
                }
                else
                {
                    $(".frmdt").show();
                    $(".todt").show();
                }
            });
            
            $(".search").click(function(){
                                var fromdate = $("#fromdate").val();
                                var todate = $("#todate").val();
                                var orderstatus = $("#order_status option:selected").val();
                                var ordertype = $("#order_type option:selected").val();
                                
                                var controller = 'servicereport/';
                                var dataConfig = {fromdate:fromdate,todate:todate,orderstatus:orderstatus,ordertype:ordertype};
                                
                                $.ajax({
                                    method: "POST",
                                    url: _site_url + controller + "servicedata",
                                    data : dataConfig,
                                }).done(function (data, textStatus, jqXHR) {
                                    
                                    console.log(" ajax done ");
                                    $(".newrow").show();
                                    var newrow = $(".newrow").find("#row1").clone();
                                    $(".newrow2").find("div").remove();
                                    $(".newrow2").append(newrow);
                                    $(".newrow").hide();
                                    var len = data.servicedata.length;
                                    
                                    for(var i=0;i<len;i++)
                                    {
                                        var j = parseInt(i)+1;
                                        if(data.servicedata[i].attendedby == null)
                                        {
                                            var attendedby = '';
                                        }
                                        else
                                        {
                                            var attendedby=data.servicedata[i].attendedby;
                                        }
                                        
                                        var tr = "<tr><td>"+j+"</td><td>"+data.servicedata[i].complaintdate+"</td><td>"+data.servicedata[i].seqno+"</td><td>"+data.servicedata[i].ordertype+"</td><td>"+data.servicedata[i].customer_name+"</td>"+ 
                                                  "<td>"+data.servicedata[i].site_location+"</td><td>"+data.servicedata[i].salesorder_no+"</td><td>"+data.servicedata[i].complaint_nature+"</td><td>"+data.servicedata[i].warrentytype+"</td><td>"+data.servicedata[i].complaintmode+"</td>"+
                                                  "<td>"+data.servicedata[i].orderstatus+"</td><td>"+attendedby+"</td><td>"+data.servicedata[i].attendeddate+"</td><td>"+data.servicedata[i].workdecription+"</td></tr>";
                                        $(".newrow2").find("#servicedetail tbody").append(tr);
                                    }
                                       
                                    $(".newrow2").find("#servicedetail").DataTable({
                                        "displayLength": 100,
                                        "paging":false,
                                        "info" : false,
                                        "scrollX":true,
                                        "search":true,
                                        "dom":"Bfrtip",
                                        "autoWidth":false,
                                        buttons:[
                                          'excel'  
                                        ],
                                    });
                                    
                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                        });
        });
    </script>
@stop


