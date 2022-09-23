@extends('_layouts.app')

@section('title', 'Engineer Report')
@section('page_title', 'Engineer Report')
@section('page_icon_cls', 'fa-building')

@section('page_report_li_cls', 'toggled active')
@section('page_engineerreport_li_cls', 'toggled active')
@section('page_engineerreport_li_list_cls', 'active')
@section('page_engineerreport_li_add_cls', '')

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
            <h3>Engineer Report</h3>
        </div>
        <div class="card-body card-padding " >
            <div style="border: 2px gray solid;border-radius: 5px" >
                <div class="row">
                    <div class="row m-25">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <div class="fg-line">
                                    <p class="c-black f-500 m-b-20">Engineer Name</p>
                                    <div class="input-group form-group">
                                        <select class="selectpicker" placeholder="Engineer Name" aria-describedby="basic-addon1" id="engineer_id" name="engineer_id">
                                            <option value=''></option>
                                            @foreach($engineers as $engineer)
                                            <option value='{{$engineer->id}}'>{{$engineer->name}}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                                </div>
                            </div>
                        </div>
                                        
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
    </div>   
    <div class="card engdetails">
        <div class="card-header">
            <h3>Engineer Name : <span class="engname"></span></h3>
        </div>
        <div class="card-body card-padding ">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card crd-exp">
                        <div class="card-body card-padding bgm-cyan c-white">
                            <h4 class="c-white  text-center"><b>Expenses :</b> <span class="eng_exp"></span></h4>
                        </div>
                    </div>
                </div>
            
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
            <div class="row sow">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"> <h3> Scope of Work </h3></div>
                        <div class="card-body"><div class="sowbody"></div></div>
                    </div>
                </div>
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
                        <th data-column-id="accname">Customer Name</th>
                        <th data-column-id="site_location">Site Location</th>  
                        <th data-column-id="salesno">SO no.</th>
                        <th data-column-id="warrenty">Warrenty</th>
                        <th data-column-id="totalexp">Total Exp</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
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
                        <th data-column-id="sow">Scope Of Work</th>
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
                        <th data-column-id="sow">Scope Of Work</th>
                        <th data-column-id="comp_nature">Complaint Nature</th>
                        <th data-column-id="totalexp">Total Exp</th>
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
                        <div class="modaldetailstatus"> 
                            
                        </div>
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
    
    <script>
        $(function () {
            $("#fromdate").datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd",});
            $("#todate").datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd",});
            
            var _site_url = "{{url('/')}}/";
            
            $(".newrow").hide();
            $(".newrow2").hide();
            $(".newrow3").hide();
            $(".sow").hide();
            $(".engdetails").hide();
            $(".search").click(function(){
                $(".eng_exp").text(0);
                $(".eng_pendjob").text(0);
                $(".eng_jobcomp").text(0);
                var fromdate = $("#fromdate").val();
                var todate = $("#todate").val();
                var engineer_id = $("#engineer_id").val();
                var eng_name = $("#engineer_id option:selected").text();
                $(".engname").text(eng_name);
                var controller = 'engineerreport/';
                var dataConfig = {engineer_id:engineer_id,fromdate:fromdate,todate:todate};

                $.ajax({
                    method: "POST",
                    url: _site_url + controller + "engineerdata",
                    data : dataConfig,
                }).done(function (data, textStatus, jqXHR) {
                    $(".engdetails").show();
                    $(".eng_exp").text(data.expenses);
                    $(".eng_pendjob").text(data.pendingeng);
                    $(".eng_jobcomp").text(data.compjobcnt);

                    $(".crd-exp").click(function(){
                       $(".newrow").show();
                       $(".sow").hide();
                       var expdet = $(".newrow").find("#servicedetail").clone();
                       $(".servicestatus").find(".modaldetailstatus").find("#servicedetail3").remove();
                       $(".servicestatus").find(".modaldetailstatus").find("#servicedetail2").remove();
                       $(".servicestatus").find(".modaldetailstatus").find("#servicedetail").remove();
                       $(".servicestatus").find(".modaldetailstatus").append(expdet);
                       var len = data.expdetails.length;
                       $(".servicestatus").find(".modaldetailstatus tbody").find("tr").remove();
                       for(var i =0;i<len;i++)
                       {
                           var s=i+1;
                           var tr = "<tr><td>"+s+"</td><td>"+data.expdetails[i].complaint_date+"</td><td>"+data.expdetails[i].seqno+"</td><td>"+data.expdetails[i].customer_name+"</td><td>"+data.expdetails[i].site_location+"</td><td>"+data.expdetails[i].salesorder_no+"</td><td>"+data.expdetails[i].warrenty+"</td><td>"+data.expdetails[i].expenses+"</td></tr>";
                           $(".servicestatus").find(".modaldetailstatus tbody").append(tr);
                       }
                       $(".newrow").hide();
                       $(".servicestatus").modal();

                    });

                    $(".crd-jobcomp").click(function(){
                        $(".sow").show();
                        $(".sow").find(".sowbody div").remove();
                        for(var key in data.scopeofwork)
                        {
                            var td = "<div class='col-sm-4'><div class='card eng_sow' data-sow='"+key+"'><div class='card-body card-padding bgm-teal c-white'><h4 class='c-white  text-center'>"+key+" : <span > &nbsp; &nbsp;"+data.scopeofwork[key]+"</span></h4></div></div></div>";
                            $(".sow").find(".sowbody").append(td);
                        }

                        $(".eng_sow").click(function(){
                            var sow = $(this).data("sow");

                            var dataConfig = {sow:sow,engineer_id:engineer_id,fromdate:fromdate,todate:todate};

                            $.ajax({
                                method: "POST",
                                url: _site_url + controller + "sowdata",
                                data : dataConfig,
                            }).done(function (data, textStatus, jqXHR) {

                                $(".newrow3").show();
                               // $(".sow").hide();
                                var expdet = $(".newrow3").find("#servicedetail3").clone();
                                $(".servicestatus").find(".modaldetailstatus").find("#servicedetail3").remove();
                                $(".servicestatus").find(".modaldetailstatus").find("#servicedetail2").remove();
                                $(".servicestatus").find(".modaldetailstatus").find("#servicedetail").remove();
                                $(".servicestatus").find(".modaldetailstatus").append(expdet);
                                var len = data.sowdetails.length;
                                $(".servicestatus").find(".modaldetailstatus tbody").find("tr").remove();
                                for(var i =0;i<len;i++)
                                {
                                    var s=i+1;
                                    var tr = "<tr><td>"+s+"</td><td>"+data.sowdetails[i].complaint_date+"</td><td>"+data.sowdetails[i].seqno+"</td><td>"+data.sowdetails[i].customer_name+"</td><td>"+data.sowdetails[i].site_location+"</td><td>"+data.sowdetails[i].salesorder_no+"</td><td>"+data.sowdetails[i].warrenty+"</td><td>"+data.sowdetails[i].scope_of_work+"</td><td>"+data.sowdetails[i].complaint_nature+"</td><td>"+data.sowdetails[i].expenses+"</td></tr>";
                                    $(".servicestatus").find(".modaldetailstatus tbody").append(tr);
                                }
                                $(".newrow3").hide();
                                $(".servicestatus").modal();

                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                //console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            });
                        });
                        
                    });
                    $(".crd-pendjob").on('click',function(){
                           $(".newrow2").show();
                           $(".sow").hide();
                           //alert();
                           var expdet = $(".newrow2").find("#servicedetail2").clone();
                           $(".servicestatus").find(".modaldetailstatus").find("#servicedetail").remove();
                           $(".servicestatus").find(".modaldetailstatus").find("#servicedetail2").remove();
                           $(".servicestatus").find(".modaldetailstatus").find("#servicedetail3").remove();
                           $(".servicestatus").find(".modaldetailstatus").append(expdet);
                           var len = data.pending_details.length;
                           $(".servicestatus").find(".modaldetailstatus tbody").find("tr").remove();
                           for(var i =0;i<len;i++)
                           {
                               var s=i+1;
                               var tr = "<tr><td>"+s+"</td><td>"+data.pending_details[i].complaint_date+"</td><td>"+data.pending_details[i].seqno+"</td><td>"+data.pending_details[i].customer_name+"</td><td>"+data.pending_details[i].site_location+"</td><td>"+data.pending_details[i].salesorder_no+"</td><td>"+data.pending_details[i].warrenty+"</td><td>"+data.pending_details[i].scope_of_work+"</td><td>"+data.pending_details[i].complaint_nature+"</td></tr>";
                               $(".servicestatus").find(".modaldetailstatus tbody").append(tr);
                           }
                           $(".newrow2").hide();
                           $(".servicestatus").modal();

                        });
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


