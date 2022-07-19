@extends('_layouts.app')

@section('title', 'Projectplan')
@section('page_title', 'Projectplan Add')
@section('page_icon_cls', 'fa-building')

@section('page_project_li_cls', 'toggled active')
@section('page_projectplan_li_cls', 'toggled active')
@section('page_projectplan_li_list_cls', 'active')
@section('page_projectplan_li_add_cls', '')


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
        <h2 class="f-400">Project Plan </h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Add <span class="label label-default">New</span>
                Project Plan
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <?php $currentdate =date('Y-m-d'); 
                       $timestamp = date('Y-m-d H:i:s');?>
                @if($user_id != '')
                <form role="form" action="{{url('project')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">    
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="is_agent" id="is_agent" value="0"/>
                        <input type="hidden" name="engineer_id" id="engineer_id" value="{{Session::get('user_id')}}"/>
                        <div class="form-group col-sm-6">
                            <label for="project_name" class="control-label col-sm-3 required">Project Name</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Project Name" name="project_name" type="text" id="project_name" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="visit_date" class="control-label col-sm-3 required">Visit Date</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Visit Date" name="visit_date" type="date" id="visit_date" data-validation="required" required="required" value="{{$currentdate}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="site_detail" class="control-label col-sm-3 required">Site Details</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Site Details" name="site_details" id="site_details" data-validation="required" required="required"></textarea>                                        
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
                @else 
                <button class="col-sm-12 col-xs-12 f-14 text-center btn-warning">Login as Engineer</button>
                @endif
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
    $("#visit_date").datepicker({dateFormat: 'yy-mm-dd'});
</script>
@stop



