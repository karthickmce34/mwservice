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
        <h2 class="f-400">Spares/Service Call Register</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Edit <span class="label label-default"></span>
                Spares/Service Call Register
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">

                <form role="form" action="{{url('complaintregister')}}/{{$modelData->id}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="_method" id="_method" value="PUT"/>
                        <input name="id" type="hidden" value="{{$modelData->id}}">
                        <div class="form-group col-sm-6">
                            <label for="bp_name" class="control-label col-sm-4 required">Mode of Complaint</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="mode_of_complaint" name="mode_of_complaint">
                                        @if($modelData->mode_of_complaint == 1)
                                        <option value="0">Phone</option>
                                        <option value="1" selected>Email</option>
                                        @else 
                                        <option value="0" selected>Phone</option>
                                        <option value="1">Email</option>
                                        @endif
                                    </select>                                        
                                </div>
                            </div>
                        </div>
                        <!--div class="form-group col-sm-6">
                            <label for="bp_name" class="control-label col-sm-4 required">Complaint Type</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="complaint_type" name="complaint_type">
                                        @if($modelData->complaint_type == 0)
                                        <option value="0" selected>Service</option>
                                        <option value="1">Spares</option>
                                        <option value="2">Service & Spares</option>
                                        @else 
                                        @if($modelData->complaint_type == 1)
                                        <option value="0">Service</option>
                                        <option value="1" selected>Spares</option>
                                        <option value="2">Service & Spares</option>
                                        @else
                                        <option value="0">Service</option>
                                        <option value="1">Spares</option>
                                        <option value="2" selected>Service & Spares</option>
                                        @endif
                                        @endif
                                    </select>                                        
                                </div>
                            </div>
                        </div-->
                        <div class="form-group col-sm-6">
                            <label for="customer_name" class="control-label col-sm-4">Register Date</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm date-picker" id="complaint_date" name="complaint_date" value="{{$modelData->complaint_date}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="customer_name" class="control-label col-sm-4 required">Customer</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Customer" name="customer_name" type="text" id="customer_name" data-validation="required" required="required" value="{{$modelData->customer_name}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address1" class="control-label col-sm-4 required">Bill Address</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address" name="address1" id="address1" data-validation="required" required="required">{{$modelData->address1}}</textarea>                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address2" class="control-label col-sm-4">Delivery Address</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address2" name="address2" id="address2" > {{$modelData->address2}}</textarea>                                        
                                </div>
                            </div>
                        </div>

                        <!--div class="form-group col-sm-6">
                            <label for="city" class="control-label col-sm-4 required">City</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="City" name="city" type="text" id="city" data-validation="required" required="required"  value="{{$modelData->city}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="pincode" class="control-label col-sm-4 required">Pincode</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Pincode" name="pincode" type="number" id="pincode" data-validation="required" required="required"  value="{{$modelData->pincode}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="state" class="control-label col-sm-4 required">State</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="State" name="state" type="text" id="state" data-validation="required" required="required"  value="{{$modelData->state}}">                                        
                                </div>
                            </div>
                        </div-->
                        <div class="form-group col-sm-6">
                            <label for="gstin" class="control-label col-sm-4">GSTin</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="GStin"  name="gstin" type="text" id="gstin"  value="{{$modelData->gstin}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="panno" class="control-label col-sm-4">PAN No</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="PAN No"  name="panno" type="text" id="panno"  value="{{$modelData->panno}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="mobileno" class="control-label col-sm-4 required">Mobile no</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Mobile Number" name="mobileno" type="text" id="mobileno" data-validation="required" required="required" value="{{$modelData->mobileno}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phoneno" class="control-label col-sm-4">Phone no</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Phone Number" name="phoneno" type="text" id="phoneno" value="{{$modelData->phoneno}}">                                        
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="emailid" class="control-label col-sm-4 required">Email</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Eg: example@gmail.com" name="emailid" type="text" id="emailid" data-validation="required" required="required" value="{{$modelData->emailid}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="contact_person" class="control-label col-sm-4 required">Contact Person</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Contact Person" name="contact_person" type="text" id="contact_person" data-validation="required" required="required" value="{{$modelData->contact_person}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="salesorder_no" class="control-label col-sm-4">Sales Order No</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Sales Order No" name="salesorder_no" type="text" id="salesorder_no" value="{{$modelData->salesorder_no}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="serial_no" class="control-label col-sm-4">Serial No</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Serial No" name="serial_no" type="text" id="serial_no" value="{{$modelData->serial_no}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="panel_descrption" class="control-label col-sm-4">Product Description</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Product Description" name="panel_descrption" type="text" id="panel_descrption" value="{{$modelData->panel_descrption}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="commissioned_date" class="control-label col-sm-4">Date Of Commissioning</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="commissioned_date" name="commissioned_date"  value="{{$modelData->commissioned_date}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="complaint_nature" class="control-label col-sm-4 required">Customer Complaint</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Customer Complaint" name="complaint_nature" id="complaint_nature" data-validation="required" required="required">{{$modelData->complaint_nature}}</textarea>                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="outgoing_load" class="control-label col-sm-4">Outgoing Load</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Connected/Demand" name="outgoing_load" type="text" id="outgoing_load" value="{{$modelData->outgoing_load}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="relay_make_type" class="control-label col-sm-4">Relay Make&Type</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Relay Make&Type" name="relay_make_type" type="text" id="relay_make_type" value="{{$modelData->relay_make_type}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="relay_status" class="control-label col-sm-4">Relay Status</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Relay Status" name="relay_status" type="text" id="relay_status" value="{{$modelData->relay_status}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="cable_length" class="control-label col-sm-4">Cable Length (load)</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Cable Length (load)" name="cable_length" type="text" id="cable_length" value="{{$modelData->cable_length}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="fault_current" class="control-label col-sm-4">Fault Current (with Timestamp)</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Fault Current (with Timestamp)" name="fault_current" type="text" id="fault_current" value="{{$modelData->fault_current}}">                                        
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label for="vcb_interlock" class="control-label col-sm-4">VCB Interlock Condition</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="VCB Interlock Condition" name="vcb_interlock" type="text" id="vcb_interlock" value="{{$modelData->vcb_interlock}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="after_commissioned" class="control-label col-sm-4">Modification After Commissioned</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Modification After Commissioned" name="after_commissioned" type="text" id="after_commissioned" value="{{$modelData->after_commissioned}}">

                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="event_before_failure" class="control-label col-sm-4">Event Before Failure</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Event Before Failure" name="event_before_failure" type="text" id="event_before_failure" value="{{$modelData->event_before_failure}}">                                      
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="warrenty" class="control-label col-sm-4 required">Warranty</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Warranty" aria-describedby="basic-addon1" data-validation="required" required="required" id="warrenty" name="warrenty" >

                                        @if($modelData->warrenty == 0)
                                        <option value="0" selected>With Warranty</option>
                                        <option value="1">Out of Warranty</option>
                                        @else 
                                        <option value="0">With Warranty</option>
                                        <option value="1" selected>Out of Warranty</option>
                                        @endif
                                    </select>   
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="date_supply" class="control-label col-sm-4 ">Date of Supply</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="date_supply" name="date_supply"  value="{{$modelData->date_supply}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="region_id" class="control-label col-sm-4 required">Region</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Region" aria-describedby="basic-addon1" data-validation="required" required="required" id="region_id" name="region_id">
                                        <option value="">=== Select Region ===</option>
                                        @foreach($regiondata as $region)
                                        
                                            @if($modelData->region_id == $region->id)
                                                <option value="{{$region->id}}" selected>{{$region->region_name}}</option>
                                            @else 
                                                <option value="{{$region->id}}">{{$region->region_name}}</option>                                           
                                            @endif
                                        @endforeach
                                        
                                    </select>                                                                                    
                                </div>
                            </div>
                        </div>
                        <!--div class="form-group col-sm-6">
                            <label for="status" class="control-label col-sm-4 required">Status</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="status" name="status">
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
                            <button class="btn bgm-orange waves-effect" type="submit" placeholder="Submit" value="Add" title="Save"><i class="zmdi zmdi-check"></i> Save</button>
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
   
@stop    
@section('js')
@parent

<script>

    $(function () {
                $("#complaint_date").datepicker({dateFormat: 'yy-mm-dd'});
                $("#commissioned_date").datepicker({dateFormat: 'yy-mm-dd'});
                $("#date_supply").datepicker({dateFormat: 'yy-mm-dd'});
            });

</script>
@stop



