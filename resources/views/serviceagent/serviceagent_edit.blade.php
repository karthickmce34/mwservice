@extends('_layouts.app')

@section('title', 'Service Agent')
@section('page_title', 'Service Agent')
@section('page_icon_cls', 'fa-building')

@section('page_master_li_cls', 'toggled active')
@section('page_serviceagent_li_cls', 'toggled active')
@section('page_serviceagent_li_list_cls', 'active')
@section('page_serviceagent_li_add_cls', '')

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
        <h2 class="f-400">Service Agent</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Edit <span class="label label-default"></span>
                Service Agent
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">

                <form role="form" action="{{url('serviceagent')}}/{{$modelData->id}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="_method" id="_method" value="PUT"/>
                        <input name="id" type="hidden" value="{{$modelData->id}}">
                        <div class="form-group col-sm-6">
                            <label for="company_name" class="control-label col-sm-3 required">Agent Name</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Agent/Company Name" name="company_name" type="text" id="company_name" data-validation="required" required="required" value="{{$modelData->company_name}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address1" class="control-label col-sm-3 required">Address1</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address" name="address1" id="address1" data-validation="required" required="required">{{$modelData->address1}}</textarea>                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address2" class="control-label col-sm-3 required">Address2</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Address2" name="address2" id="address2" data-validation="required" required="required"> {{$modelData->address2}}</textarea>                                        
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="city" class="control-label col-sm-3 required">City</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="City" name="city" type="text" id="city" data-validation="required" required="required"  value="{{$modelData->city}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="pincode" class="control-label col-sm-3 required">Pincode</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Pincode" name="pincode" type="number" id="pincode" data-validation="required" required="required"  value="{{$modelData->pincode}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="state" class="control-label col-sm-3 required">State</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="State" name="state" type="text" id="state" data-validation="required" required="required"  value="{{$modelData->state}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="mobileno" class="control-label col-sm-3 required">Mobile no</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Mobile Number" name="mobileno" type="text" id="mobileno" data-validation="required" required="required" value="{{$modelData->mobileno}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="emailid" class="control-label col-sm-3 required">Email</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Eg: example@gmail.com" name="emailid" type="text" id="emailid" data-validation="required" required="required" value="{{$modelData->emailid}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="gstin" class="control-label col-sm-3 required">GSTin</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="GStin"  name="gstin" type="text" id="gstin"  value="{{$modelData->gstin}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="panno" class="control-label col-sm-3 required">PAN No</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="PAN No"  name="panno" type="text" id="panno"  value="{{$modelData->panno}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="contact_person" class="control-label col-sm-3 required">Contact Person</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Contact Person" name="contact_person" type="text" id="contact_person" data-validation="required" required="required" value="{{$modelData->contact_person}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="region" class="control-label col-sm-3">Region</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <select class="form-control input-sm " placeholder="Region" aria-describedby="basic-addon1"  id="region" name="region_id">
                                        <option value="">=== Select Region ===</option>
                                        @foreach($regions as $region)
                                            @if($region->id = $modelData->region_id)
                                                <option value="{{$region->id}}" selected>{{$region->region_name}}</option>
                                            @else 
                                                <option value="{{$region->id}}" >{{$region->region_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>                                                                                    
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

    
</script>
@stop



