@extends('_layouts.app')

@section('title', 'VisitPlan')
@section('page_title', 'VisitPlan')
@section('page_icon_cls', 'fa-building')

@section('page_spares_li_cls', 'toggled active')
@section('page_visitplan_li_cls', 'toggled active')
@section('page_visitplan_li_list_cls', 'active')
@section('page_visitplan_li_add_cls', '')



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
        <h2 class="f-400">Site Engineer Photo</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Upload <span class="label label-default">Edit</span>
                Spares/Service Call Register Documents
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <?php $currentdate =date('Y-m-d'); 
                       $timestamp = date('Y-m-d H:i:s');?>
                <form role="form" action="{{url('visitplan/updatedoc')}}/{{$modelData->id}}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="_method" id="_method" value="PUT"/>
                        <input type="hidden" name="visitplan_id" id="visitplan_id" value="{{$modelData->visitplan_id}}"/>
                        <div class="form-group col-sm-6">
                            <label for="customer_name" class="control-label col-sm-3 required">Document Name</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="doc_name" name="doc_name"  value="{{$modelData->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="doc_type" class="control-label col-sm-3 required">Document Type</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="doc_type" name="doc_type">
                                        @if($modelData->file_type == 0)
                                        <option value="0" selected>Image</option>
                                        <option value="1">Doc</option>
                                        <option value="2">Pdf</option>
                                        <option value="3">Excel</option>
                                        @else @if($modelData->file_type == 1)
                                        <option value="0">Image</option>
                                        <option value="1" selected>Doc</option>
                                        <option value="2">Pdf</option>
                                        <option value="3">Excel</option>
                                        @else @if($modelData->file_type == 2)
                                        <option value="0">Image</option>
                                        <option value="1">Doc</option>
                                        <option value="2" selected>Pdf</option>
                                        <option value="3">Excel</option>
                                        @else 
                                        <option value="0">Image</option>
                                        <option value="1">Doc</option>
                                        <option value="2">Pdf</option>
                                        <option value="3" selected>Excel</option>
                                        @endif @endif @endif
                                    </select>                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="doc_upload" class="control-label col-sm-3">Upload</label>
                            @if ($modelData->file_type == 0)
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <div class="fileinput fileinput-exists" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">                                        
                                                <img style="width: inherit;" src="{{url('/')}}/{{$modelData->file_path}}/{{$modelData->file_name}}" />
                                            </div>
                                            <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type='file' class="form-control input-sm" id="doc_upload" name="doc_upload" value="{{$modelData->file_name}}">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            @else
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <div class="fileinput fileinput-exists" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">                                        
                                                {{$modelData->file_name}}
                                            </div>
                                            <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type='file' class="form-control input-sm" id="doc_upload" name="doc_upload" value="{{$modelData->file_name}}">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
                            <button class="btn bgm-orange waves-effect" type="submit" placeholder="Submit" value="Update" title="Update"><i class="zmdi zmdi-refresh"></i> Update</button>
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



