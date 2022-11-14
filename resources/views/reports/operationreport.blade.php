@extends('_layouts.app')

@section('title', 'Operation Report')
@section('page_title', 'Operation Report')
@section('page_icon_cls', 'fa-building')

@section('page_report_li_cls', 'toggled active')
@section('page_operationreport_li_cls', 'toggled active')
@section('page_operationreport_li_list_cls', 'active')
@section('page_operationreport_li_add_cls', '')

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
    <div class="card" style="height:900px;">
        <div class="card-header card-padding text-center">
            <h3>Operation Report</h3>
        </div>
        <div class="card-body card-padding " >
            <div style="border: 2px gray solid;border-radius: 5px" >
                <div class="row">
                    <div class="row m-25">
                        
                                        
                        <div class="col-xs-3">
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
                        <div class="col-xs-3">
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
                        <div class="col-xs-2 m-t-25">
                            <div class="form-group">
                                <div class="fg-line">
                                     <button type="button" class="btn bgm-orange search"><i class="zmdi zmdi-search"></i> Search</button>

                                </div>
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
       
        <div class="card engdetails">
            <div class="card-header">
                <h3>Operation : Fault Rectification</h3>
            </div>
            <div class="card-body card-padding ">
                <div class="row">
                    
                    <div class="col-sm-4">
                        <div class="card crd-pendjob">
                            <div class="card-body card-padding bgm-pink c-white">
                                 <h4 class="c-white text-center"><b>Pending Jobs :</b> <span class="eng_pendjob"></span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card crd-jobcomp">
                            <div class="card-body card-padding bgm-teal c-white">
                                 <h4 class="c-white  text-center"><b>Job Completed : </b> <span class="eng_jobcomp"></span></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="reprtdata">
                    <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-collapse">
                            <div class="panel-heading color-block bgm-teal" role="tab" id="headingAduit">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAduit" aria-expanded="false" aria-controls="collapseTwo">
                                        <span id="reporttitle"></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseAduit" class="collapse" role="tabpanel" aria-labelledby="headingAduit">
                                <div class="panel-body p-10">
                                    <div class="row">
                                        <div class="servicestatus" id="servicestatus">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                                
            </div>
            <div class="card-header">
                <h3>Warrenty Details</h3>
            </div>
            <div class="card-body card-padding ">
                <div class="row">
                    <h4 class="text-center"><b>Pending Jobs </b></h4>
                    <div class="crd-pendjob_wrnty">
                        
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center"><b>Completed Jobs </b></h4>
                    <div class="crd-compjob_wrnty">
                        
                    </div>
                     
                </div>
                
                    
                                
            </div>
        </div>
    </div>
    
    <div class="newrow2">
        <div id="row1" class=" table-responsive">
            <table id="servicedetail2" class="display table table-striped table-vmiddle f-10">
                <thead>
                    <tr class="">
                        <th data-column-id="sno">Sno</th>
                        <th data-column-id="complaintdate">Complaint Date</th>
                        <th data-column-id="documentno">Documentno</th>
                        <th data-column-id="accname">Customer Name</th>
                        <th data-column-id="site_location">Site Location</th>  
                        <th data-column-id="salesno">SO no.</th>
                        <th data-column-id="warrenty">Warrenty</th>
                        <th data-column-id="nofodays">No Of Days</th>
                        <th data-column-id="comp_nature">Complaint Nature</th>
                        
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
    <div class="newrow3">
        <div id="row1" class=" table-responsive">
            <table id="servicedetail3" class="display table table-striped table-vmiddle f-10">
                <thead>
                    <tr class="">
                        <th data-column-id="sno">Sno</th>
                        <th data-column-id="complaintdate">Complaint Date</th>
                        <th data-column-id="documentno">Documentno</th>
                        <th data-column-id="accname">Customer Name</th>
                        <th data-column-id="site_location">Site Location</th>  
                        <th data-column-id="salesno">SO no.</th>
                        <th data-column-id="warrenty">Warrenty</th>
                        <th data-column-id="comp_nature">Complaint Nature</th>
                        <th data-column-id="nofodays">No Of Days</th>
                        <th data-column-id="totalexp">Total Exp</th>
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
            
            var _site_url = "{{url('/')}}/";
            
            $(".newrow").hide();
            $(".newrow2").hide();
            $(".newrow3").hide();
            $(".reprtdata").hide();
            $(".engdetails").hide();
            $(".search").click(function(){
                $(".eng_pendjob").text(0);
                $(".eng_jobcomp").text(0);
                var fromdate = $("#fromdate").val();
                var todate = $("#todate").val();
                var controller = 'operationreport/';
                var dataConfig = {fromdate:fromdate,todate:todate};

                $.ajax({
                    method: "POST",
                    url: _site_url + controller + "operationdata",
                    data : dataConfig,
                }).done(function (data, textStatus, jqXHR) {
                    $(".engdetails").show();
                    $(".eng_pendjob").text(data.pendingeng);
                    $(".eng_jobcomp").text(data.compjobcnt);

                    
                    $(".crd-pendjob").on('click',function(){
                        $(".newrow2").show();
                        $(".reprtdata").show();
                        $("#reporttitle").html(" Pending Details");
                        
                        //alert();
                        var expdet = $(".newrow2").find("#servicedetail2").clone();
                        $(".servicestatus").find("#servicedetail2").remove();
                        $(".servicestatus").find("div").remove();
                        $(".servicestatus").find("#servicedetail3").remove();
                        $(".servicestatus").append(expdet);
                        var len = data.pending_details.length;
                        $(".servicestatus").find("tbody").find("tr").remove();
                        for(var i =0;i<len;i++)
                        {
                            var s=i+1;
                            var tr = "<tr><td>"+s+"</td><td>"+data.pending_details[i].complaint_date+"</td><td>"+data.pending_details[i].seqno+"</td><td>"+data.pending_details[i].customer_name+"</td><td>"+data.pending_details[i].site_location+"</td><td>"+data.pending_details[i].salesorder_no+"</td><td>"+data.pending_details[i].warrenty+"</td><td>"+data.pending_details[i].diffdate+"</td><td>"+data.pending_details[i].complaint_nature+"</td></tr>";
                            $(".servicestatus").find("tbody").append(tr);
                        }
                        $(".newrow2").hide();
                        
                        $(".servicestatus").find("#servicedetail2").DataTable({
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

                     });
                    $(".crd-jobcomp").on('click',function(){
                        $(".newrow3").show();
                        $(".reprtdata").show();
                        $("#reporttitle").html(" Completed Details");
                        //alert();
                        var expdet = $(".newrow3").find("#servicedetail3").clone();
                        $(".servicestatus").find("#servicedetail2").remove();
                        $(".servicestatus").find("#servicedetail3").remove();
                        $(".servicestatus").find("div").remove();
                        $(".servicestatus").append(expdet);
                        var len = data.jobcomp_details.length;
                        $(".servicestatus").find("tbody").find("tr").remove();
                        for(var i =0;i<len;i++)
                        {
                            var s=i+1;
                           var tr = "<tr><td>"+s+"</td><td>"+data.jobcomp_details[i].complaint_date+"</td><td>"+data.jobcomp_details[i].seqno+"</td><td>"+data.jobcomp_details[i].customer_name+"</td><td>"+data.jobcomp_details[i].site_location+"</td><td>"+data.jobcomp_details[i].salesorder_no+"</td><td>"+data.jobcomp_details[i].warrenty+"</td><td>"+data.jobcomp_details[i].complaint_nature+"</td><td>"+data.jobcomp_details[i].diffdate+"</td><td>"+data.jobcomp_details[i].expenses+"</td></tr>";
                            $(".servicestatus").find("tbody").append(tr);
                        }
                        $(".newrow3").hide();
                        $(".servicestatus").find("#servicedetail3").DataTable({
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

                     });    
                     var penwrtylen = data.pending_warrenty_cnt.length;
                     $(".crd-pendjob_wrnty").find("div").remove();
                    for(var t=0;t<penwrtylen;t++)
                    {
                       var pendwrty= "<div class='col-sm-6'><div class='card pendwrntydata' data-warrenty='"+data.pending_warrenty_cnt[t].wrnty+"'><div class='card-body card-padding bgm-pink c-white'><h4 class='c-white text-center'><b>"+data.pending_warrenty_cnt[t].warrenty+" :</b> <span class='wty_pendjob'>"+data.pending_warrenty_cnt[t].pendingjobs+"</span></h4></div></div></div>";
                       $(".crd-pendjob_wrnty").append(pendwrty);
                    }
                    
                    
                    
                    var cmpwrtylen = data.jobcomp_warrenty_cnt.length;
                     $(".crd-compjob_wrnty").find("div").remove();
                    for(var s=0;s<cmpwrtylen;s++)
                    {
                       var cmpwrty= "<div class='col-sm-6'><div class='card compwrntydata' data-warrenty='"+data.jobcomp_warrenty_cnt[s].wrnty+"'><div class='card-body card-padding bgm-green c-white'><h4 class='c-white text-center'><b>"+data.jobcomp_warrenty_cnt[s].warrenty+" :</b> <span class='wty_cmpjob'>"+data.jobcomp_warrenty_cnt[s].engjobcnt+"</span></h4></div></div></div>";
                       $(".crd-compjob_wrnty").append(cmpwrty);
                    }
                        
                    
            }).fail( function( jqXHR, textStatus, errorThrown ) {
                console.log( " ajax fail " );
                //console.log( jqXHR, textStatus, errorThrown );
            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                console.log( " ajax always " );
                //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
            });
    });
        });
    </script>
@stop


