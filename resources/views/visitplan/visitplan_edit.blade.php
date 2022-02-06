@extends('_layouts.app')

@section('title', 'Visit Plan')
@section('page_title', 'Visit Plan')
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
        <h2 class="f-400">Visit Plan</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Edit <span class="label label-default"></span>
                Visit Plan
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">

                <form role="form" action="{{url('visitplan')}}/{{$modelData->id}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="_method" id="_method" value="PUT"/>
                        <input name="id" type="hidden" value="{{$modelData->id}}">
                        
                        @if($modelData->is_agent == 1)
                            <div class="form-group col-sm-6">
                                <label for="bp_name" class="control-label col-sm-3 required">Agent</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <select class="form-control input-sm" placeholder="Agent" aria-describedby="basic-addon1" data-validation="required" required="required" id="agent_id" name="agent_id">
                                                <option value=" " ></option>
                                            @if($modelAgents)
                                                @foreach($modelAgents as $modelAgent)
                                                    @if($modelAgent->id == $modelData->agent_id)
                                                        <option value="{{$modelAgent->id}}" selected>{{$modelAgent->company_name}}</option>
                                                    @else 
                                                        <option value="{{$modelAgent->id}}">{{$modelAgent->company_name}}</option>
                                                    @endif
                                                 @endforeach
                                            @endif
                                        </select>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="complaint_date" class="control-label col-sm-3">Address</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <textarea type='text' class="form-control input-sm" disabled="disabled" >{{$modelData->agent->address1}} &nbsp; {{$modelData->agent->address2}} &nbsp; {{$modelData->agent->city}} &nbsp; {{$modelData->agent->state}} &nbsp; {{$modelData->agent->pincode}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <?php if($modelData->date_of_depature == "") { $depdate = $currentdate =date('Y-m-d'); } else {$depdate = $modelData->date_of_depature;}  ?>
                                <label for="date_of_depature" class="control-label col-sm-3">Attend From</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm date-picker" name="date_of_depature" id="date_of_depature" value="{{$depdate}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <?php if($modelData->date_of_return == "") { $retdate = $currentdate =date('Y-m-d'); } else {$retdate = $modelData->date_of_return;}  ?>
                                <label for="date_of_return" class="control-label col-sm-3">Attend To</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm date-picker" name="date_of_return" id="date_of_return" value="{{$retdate}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="days_site" class="control-label col-sm-3">Total Days</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm" name="days_site" id="days_site" value="{{$modelData->days_site}}">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="contact_person" class="control-label col-sm-3">Contact Person (at site)</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm" name="contact_person" id="contact_person" value="{{$modelData->contact_person}}">
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group col-sm-6">
                                <label for="bp_name" class="control-label col-sm-3 required">Service engineer</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <select class="selectpicker" multiple placeholder="Service Engineer" aria-describedby="basic-addon1" data-validation="required" required="required" id="agent_id" name="engineer_id[]">
                                                <option value=" " ></option>
                                                <?php $englist=array(); ?>
                                                @foreach($modelEngineers as $modelEngineer)
                                                    <?php $englist[] = $modelEngineer->engineer_id; ?>
                                                @endforeach
                                                @if(isset($modelEngLists))
                                                    @foreach($modelEngLists as $modelEngList)
                                                        @if(in_array($modelEngList->id,$englist))
                                                            <option value="{{$modelEngList->id}}" selected>{{$modelEngList->name}}</option>
                                                        @else 
                                                            <option value="{{$modelEngList->id}}">{{$modelEngList->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </select>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="date_of_depature" class="control-label col-sm-3">Departure Date</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <?php if($modelData->date_of_depature == "") { $depdate = $currentdate =date('Y-m-d'); } else {$depdate = $modelData->date_of_depature;}  ?>
                                        <input type='text' class="form-control input-sm date-picker" name="date_of_depature" id="date_of_depature" value="{{$depdate}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <?php if($modelData->date_of_return == "") { $retdate = $currentdate =date('Y-m-d'); } else {$retdate = $modelData->date_of_return;}  ?>
                                <label for="date_of_return" class="control-label col-sm-3">Return Date</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm date-picker" name="date_of_return" id="date_of_return" value="{{$retdate}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="days_site" class="control-label col-sm-3">Total Days</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm" name="days_site" id="days_site" value="{{$modelData->days_site}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="loading_expenses" class="control-label col-sm-3">Lodging Expenses</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm" name="loading_expenses" id="loading_expenses" value="{{$modelData->loading_expenses}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="boarding_expenses" class="control-label col-sm-3">Boarding Expenses</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm" name="boarding_expenses" id="boarding_expenses" value="{{$modelData->boarding_expenses}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="travel_expenses" class="control-label col-sm-3">Travel Expenses</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm" name="travel_expenses" id="travel_expenses" value="{{$modelData->travel_expenses}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="local_conveyance" class="control-label col-sm-3">Local Conveyance</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm" name="local_conveyance" id="local_conveyance" value="{{$modelData->local_conveyance}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="contact_person" class="control-label col-sm-3">Contact Person (at site)</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='text' class="form-control input-sm" name="contact_person" id="contact_person" value="{{$modelData->contact_person}}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    
                        
                        
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

    $(function () {
                $("#date_of_depature").datepicker({dateFormat: 'yy-mm-dd'});
                $("#date_of_return").datepicker({dateFormat: 'yy-mm-dd'});
                
                var dod=$("#date_of_depature").val();
                var dor= $("#date_of_return").val();
                var datedep= new Date(dod).getTime();
                var dateret= new Date(dor).getTime();
                var diff = dateret-datedep;
                var site = Math.round(diff/(24*60*60*1000));
                //$('#days_site').val((parseInt(site)));
                
                $("#date_of_depature").change(function() { 
                    var dod=$("#date_of_depature").val();
                    var dor= $("#date_of_return").val();
                    var datedep= new Date(dod).getTime();
                    var dateret= new Date(dor).getTime();
                    var diff = dateret-datedep;
                    var site = Math.round(diff/(24*60*60*1000));
                    //$('#days_site').val((parseInt(site)));
                });
                
                $("#date_of_return").change(function() {
                    var dod=$("#date_of_depature").val();
                    var dor= $("#date_of_return").val();
                    var datedep= new Date(dod).getTime();
                    var dateret= new Date(dor).getTime();
                    var diff = dateret-datedep;
                    var site = Math.round(diff/(12*31*24*60*60*1000));
                    //$('#days_site').val((parseInt(site)));
                });
            });

</script>
@stop



