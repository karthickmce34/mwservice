@extends('_layouts.app')

@section('title', 'Complaint Register')
@section('page_title', 'Complaint Register')
@section('page_icon_cls', 'fa-building')

@section('page_spares_li_cls', 'toggled active')
@section('page_complaintregister_li_cls', 'toggled active')
@section('page_complaintregister_li_list_cls', 'active')
@section('page_complaintregister_li_add_cls', '')


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
<div class="">
    <!--BEGIN INPUT TEXT FIELDS-->
    <div class="text-center">
        <h2 class="f-400">Request Register</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Add <span class="label label-default">New</span>
                Request Register
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <?php $currentdate =date('Y-m-d'); 
                       $timestamp = date('Y-m-d H:i:s');?>
                <form role="form" action="{{url('complaintregister')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">    
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>

                        <div class="form-group col-sm-6">
                            <label for="bp_name" class="control-label col-sm-4 required">Mode of Complaint</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="frm-mode_of_complaint" name="mode_of_complaint">
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
                                        <input class="form-control input-sm docno " readonly placeholder="Document No" name="seqno" type="text" id="docseq_no" value="{{$docseq_no}}">                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="form-group col-sm-6">
                            <label for="bp_name" class="control-label col-sm-4 required">Complaint Type</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="frm-complaint_type" name="complaint_type">
                                        <option value="">=== Select Type ===</option>
                                        <option value="0">Service</option>
                                        <option value="1">Spares</option>
                                        <option value="2">Service & Spares</option>
                                    </select>                                        
                                </div>
                            </div>
                        </div-->
                        <div class="form-group col-sm-6">
                            <label for="customer_name" class="control-label col-sm-4">Register Date</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="frm-complaint_date" name="complaint_date" value="{{$currentdate}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="salesorder_no" class="control-label col-sm-4">Sales Order No</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="fg-line">
                                        <input class="form-control input-sm salno1" placeholder="Sales Order No" name="salesorder_no" type="text" id="frm-salesorder_no">                                        
                                    </div>
                                    <span class="input-group-addon last salno"><i class="btn zmdi zmdi-search"></i></span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-sm-6">
                            <label for="serial_no" class="control-label col-sm-4">VCB Serial No</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Serial No" name="serial_no" type="text" id="frm-serial_no">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="customer_name" class="control-label col-sm-4 required">Customer</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Customer" name="customer_name" type="text" id="frm-customer_name" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address1" class="control-label col-sm-4 required">Bill Address</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address" name="address1" id="frm-address1" data-validation="required" required="required"></textarea>                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address2" class="control-label col-sm-4">Delivery Address</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address2" name="address2" id="frm-address2" ></textarea>                                        
                                </div>
                            </div>
                        </div>

                        <!--div class="form-group col-sm-6">
                            <label for="city" class="control-label col-sm-4">City</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="City" name="city" type="text" id="frm-city">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="pincode" class="control-label col-sm-4">Pincode</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Pincode" name="pincode" type="number" id="frm-pincode">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="state" class="control-label col-sm-4">State</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="State" name="state" type="text" id="frm-state">                                        
                                </div>
                            </div>
                        </div-->
                        <div class="form-group col-sm-6">
                            <label for="gstin" class="control-label col-sm-4">GSTin</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="GStin"  name="gstin" type="text" id="frm-gstin">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="panno" class="control-label col-sm-4">PAN No</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="PAN No"  name="panno" type="text" id="frm-panno">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="mobileno" class="control-label col-sm-4 required">Mobile no</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Mobile Number" name="mobileno" type="text" id="frm-mobileno" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phoneno" class="control-label col-sm-4">Phone no</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Phone Number" name="phoneno" type="text" id="frm-phoneno">                                        
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="emailid" class="control-label col-sm-4">Email</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Eg: example@gmail.com" name="emailid" type="text" id="frm-emailid">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="contact_person" class="control-label col-sm-4">Contact Person</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Contact Person" name="contact_person" type="text" id="frm-contact_person">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="panel_descrption" class="control-label col-sm-4">Product Description</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Product Description" name="panel_descrption" type="text" id="frm-panel_descrption">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="commissioned_date" class="control-label col-sm-4">Date Of Commissioning</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="frm-commissioned_date" name="commissioned_date" value="{{$currentdate}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="complaint_nature" class="control-label col-sm-4 required">Customer Complaint</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Customer Complaint" name="complaint_nature" id="frm-complaint_nature" data-validation="required" required="required"></textarea>                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="outgoing_load" class="control-label col-sm-4">Outgoing Load</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Connected/Demand" name="outgoing_load" type="text" id="frm-outgoing_load">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="relay_make_type" class="control-label col-sm-4">Relay Make&Type</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Relay Make&Type" name="relay_make_type" type="text" id="frm-relay_make_type">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="relay_status" class="control-label col-sm-4">Relay Status</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Relay Status" name="relay_status" type="text" id="frm-relay_status">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="cable_length" class="control-label col-sm-4">Cable Length (load)</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Cable Length (load)" name="cable_length" type="text" id="frm-cable_length">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="fault_current" class="control-label col-sm-4">Fault Current (with Timestamp)</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Fault Current (with Timestamp)" name="fault_current" type="text" id="frm-fault_current">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="vcb_interlock" class="control-label col-sm-4">VCB Interlock Condition</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="VCB Interlock Condition" name="vcb_interlock" type="text" id="frm-vcb_interlock">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="after_commissioned" class="control-label col-sm-4 o-visible">Modification After Commissioning</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Modification After Commissioning" name="after_commissioned" type="text" id="frm-after_commissioned">

                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="event_before_failure" class="control-label col-sm-4">Event Before Failure</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Event Before Failure" name="event_before_failure" type="text" id="frm-event_before_failure">                                      
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="warrenty" class="control-label col-sm-4 required">Warranty</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="col-sm-4" aria-describedby="basic-addon1" data-validation="required" required="required" id="frm-warrenty" name="warrenty">
                                        <option value="">=== Select Warranty ===</option>
                                        <option value="0">With Warranty</option>
                                        <option value="1">Out of Warranty</option>
                                    </select>   
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="date_supply" class="control-label col-sm-4">Date of Supply</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="frm-date_supply" name="date_supply" value="{{$currentdate}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="doc_upload" class="control-label col-sm-3 required">Upload</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                        <div>
                                            <span class="btn btn-info btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type='file' class="form-control input-sm" id="frm-doc_upload" name="doc_upload" >
                                            </span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="form-group col-sm-6 hide">
                            <label for="status" class="control-label col-sm-4 required">Status</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm " placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="frm-status" name="status">
                                        <option value="">=== Select Status ===</option>
                                        <option value="0">InActive</option>
                                        <option value="1" selected="selected">Active</option>
                                    </select>                                                                                    
                                </div>
                            </div>
                        </div-->
                    </div>
                    <div class="row">  
                        <div class="form-group col-sm-6 col-xs-6 text-center pull-left clear-left" >
                            <button class="btn bgm-lime waves-effect" type="submit" placeholder="Submit" value="Add" title="Add"><i class="zmdi zmdi-check"></i> Add</button>
                        </div>
                        <div class="form-group col-sm-6 col-xs-6 text-center">
                            <button class="btn bgm-cyan waves-effect" type="reset" placeholder="Clear" value="Clear"><i class="zmdi zmdi-close"></i> Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@parent
<!--    
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}jonthornton-jquery-timepicker-107ab73/jquery.timepicker.css"/ >
-->        
@stop    
@section('js')
@parent
<!--    
    <script type="text/javascript" src="{{asset('/')}}jonthornton-jquery-timepicker-107ab73/jquery.timepicker.js"></script>
        
    <script type="text/javascript" src="{{asset('static/js/jquery.form-validator.js')}}"></script>
-->
<script>

    $(function () {
                $("#frm-complaint_date").datepicker({dateFormat: 'yy-mm-dd'});
                $("#frm-commissioned_date").datepicker({dateFormat: 'yy-mm-dd'});
                $("#frm-date_supply").datepicker({dateFormat: 'yy-mm-dd'});
                
                $("#frm-salesorder_no").focus();
                
                var _site_url = "{{url('/')}}/";
                
                $(".salno").click(function(){
                    var salno = $(".salno1").val();
                    var len = salno.length;
                    if(len >4)
                    {
                        cusdetails(salno);
                    }
                });
                
                $(".salno1").keyup(function(){
                    var salno = $(this).val();
                    var len = salno.length;
                    if(len >4)
                    {
                        cusdetails(salno);
                    }
                    
                });
                
                function cusdetails(salno){
                    $("#frm-customer_name").val("");
                    $("#frm-address1").html("");
                    $("#frm-address2").val("");
                    $("#frm-city").val("");
                    $("#frm-state").val("");
                    $("#frm-pincode").val("");
                    $("#frm-emailid").val("");
                    $("#frm-gstin").val("");
                    $("#frm-phoneno").val("");
                    
                    var controller = 'home/';
                    $.ajax({
                        method: "GET",
                        url: _site_url + controller + "cusdetail",
                        data: {wrd:salno},
                        }).done(function (data, textStatus, jqXHR) {
                            //$("#searchmodal").modal();
                            $("#frm-customer_name").val(data[0].bpname);
                            $("#frm-address1").html(data[0].address1);
                            $("#frm-address2").val(data[0].address2);
                            $("#frm-city").val(data[0].city);
                            $("#frm-state").val(data[0].regionid);
                            $("#frm-pincode").val(data[0].pincode);
                            $("#frm-emailid").val(data[0].em_ms_email);
                            $("#frm-gstin").val(data[0].em_ms_customergstin);
                            $("#frm-phoneno").val(data[0].phoneno);
                            $('#frm-mobileno').focus();

                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            console.log(" ajax fail ");
                            //console.log(jqXHR, textStatus, errorThrown);
                        }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                            console.log(" ajax always ");
                            //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                        });
                }
            });

</script>
@stop



