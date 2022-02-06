@extends('_layouts.app')

@section('title', 'Service Charge')
@section('page_title', 'Service Charge')
@section('page_icon_cls', 'fa-building')

@section('page_master_li_cls', 'toggled active')
@section('page_servicecharge_li_cls', 'toggled active')
@section('page_servicecharge_li_list_cls', 'active')
@section('page_servicecharge_li_add_cls', '')


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
        <h2 class="f-400">Service Charge</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Add <span class="label label-default">New</span>
                Service Charge
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <?php $currentdate =date('Y-m-d'); 
                       $timestamp = date('Y-m-d H:i:s');?>
                <form role="form" action="{{url('servicecharge')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">    
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <div class="form-group col-sm-6">
                            <label for="code" class="control-label col-sm-3 required">Code</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Code" name="code" type="text" id="code" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="name" class="control-label col-sm-3 required">Service Charge Name</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Service Charge Name" name="name" type="text" id="name" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="amount" class="control-label col-sm-3 required">Amount</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Amount" name="amount" type="text" id="amount" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="hsn" class="control-label col-sm-3 required">HSN</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="HSN" name="hsn" type="text" id="hsn" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="uom" class="control-label col-sm-3 required">UOM</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="UOM" name="uom" type="text" id="uom" data-validation="required" required="required">                                        
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



