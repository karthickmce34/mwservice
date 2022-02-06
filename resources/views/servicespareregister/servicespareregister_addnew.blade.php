@extends('_layouts.app')

@section('title', 'Service Spare Register')
@section('page_title', 'Service Spare Register')
@section('page_icon_cls', 'fa-building')

@section('page_spares_li_cls', 'toggled active')
@section('page_servicespareregister_li_cls', 'toggled active')
@section('page_servicespareregister_li_list_cls', 'active')
@section('page_servicespareregister_li_add_cls', '')


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
        <h2 class="f-400">Spares/Service Call Documents</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Upload <span class="label label-default">New</span>
                Spares/Service Call Register Documents
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <?php $currentdate =date('Y-m-d'); 
                       $timestamp = date('Y-m-d H:i:s');?>
                <form role="form" action="{{url('servicespareregister/storedoc')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">    
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="service_spares_register_id" id="service_spares_register_id" value="{{$id}}"/>
                        <div class="form-group col-sm-6">
                            <label for="doc_name" class="control-label col-sm-3 required">Document Name</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="doc_name" name="doc_name" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="doc_type" class="control-label col-sm-3 required">Document Type</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="doc_type" name="doc_type">
                                        <option value="">=== Select Doc Type ===</option>
                                        <option value="0">Image</option>
                                        <option value="1">Doc</option>
                                        <option value="2">Pdf</option>
                                        <option value="3">Excel</option>
                                    </select>                                        
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
                                                <input type='file' class="form-control input-sm" id="doc_upload" name="doc_upload" >
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
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="status" name="status">
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



