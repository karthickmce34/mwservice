@extends('_layouts.app')

@section('title', 'User')
@section('page_title', 'User')
@section('page_icon_cls', 'fa-building')

@section('page_master_li_cls', 'toggled active')
@section('page_user_li_cls', 'toggled active')
@section('page_user_li_list_cls', 'active')
@section('page_user_li_add_cls', '')


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
        <h2 class="f-400">User</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Add <span class="label label-default">New</span>
                User
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <?php $currentdate =date('Y-m-d'); 
                       $timestamp = date('Y-m-d H:i:s');?>
                <form role="form" action="{{url('user')}}" method="POST" enctype="multipart/form-data">
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
                            <label for="email" class="control-label col-sm-3 required">Email</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Eg: example@gmail.com" name="email" type="text" id="email" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="username" class="control-label col-sm-3 required">Username</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Username" name="username" type="text" id="username" data-validation="required" required="required">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="user_type" class="control-label col-sm-3 required">User Type</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <select class="selectpicker" name='user_type' id='user_type'>
                                        <option value="0">Admin</option>
                                        <option value="1">Spares</option>
                                        <option value="2">Service</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="password" class="control-label col-sm-3 required">Password</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Password" name="password" type="text" id="password" data-validation="required" required="required">                                        
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



