@extends('_layouts.app')

@section('title', 'Service Engineer')
@section('page_title', 'Service Engineer')
@section('page_icon_cls', 'fa-building')

@section('page_master_li_cls', 'toggled active')
@section('page_serviceengineer_li_cls', 'toggled active')
@section('page_serviceengineer_li_list_cls', 'active')
@section('page_serviceengineer_li_add_cls', '')


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
        <h2 class="f-400">Service Engineer</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Add <span class="label label-default">New</span>
                Service Engineer
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <?php $currentdate =date('Y-m-d'); 
                       $timestamp = date('Y-m-d H:i:s');?>
                <form role="form" action="{{url('serviceengineer')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">    
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>

                        <div class="form-group col-sm-6">
                            <label for="name" class="control-label col-sm-3 required">Name</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Name" name="name" type="text" id="name" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address1" class="control-label col-sm-3 required">Address1</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address" name="address1" id="address1" data-validation="required" required="required"></textarea>                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address2" class="control-label col-sm-3 required">Address2</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address2" name="address2" id="address2" data-validation="required" required="required"></textarea>                                        
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="city" class="control-label col-sm-3 required">City</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="City" name="city" type="text" id="city" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="pincode" class="control-label col-sm-3 required">Pincode</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Pincode" name="pincode" type="number" id="pincode" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="state" class="control-label col-sm-3 required">State</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="State" name="state" type="text" id="state" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="mobileno" class="control-label col-sm-3 required">Mobile no</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Mobile Number" name="mobileno" type="text" id="mobileno" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="emailid" class="control-label col-sm-3 required">Email</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Eg: example@gmail.com" name="emailid" type="text" id="emailid" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="img_upload" class="control-label col-sm-3 required">Photo</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                        <div>
                                            <span class="btn btn-info btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type='file' class="form-control input-sm" id="img_upload" name="img_upload" data-validation="required" required="required">
                                            </span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="status" class="control-label col-sm-3 required">Status</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <select class="form-control input-sm " placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="status" name="status">
                                        <option value="">=== Select Status ===</option>
                                        <option value="0">InActive</option>
                                        <option value="1" selected="selected">Active</option>
                                    </select>                                                                                    
                                </div>
                            </div>
                        </div>
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
    
</script>
@stop



