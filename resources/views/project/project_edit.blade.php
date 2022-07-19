@extends('_layouts.app')

@section('title', 'ProjectPlan')
@section('page_title', 'ProjectPlan')
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
        <h2 class="f-400">Project Plan</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Edit <span class="label label-default"></span>
                Project Plan
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">

                <form role="form" action="{{url('project')}}/{{$modelData->id}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="_method" id="_method" value="PUT"/>
                        <input name="id" type="hidden" value="{{$modelData->id}}">
                        
                        <input name="engineer_id" type="hidden" value="{{$modelData->engineer_id}}">
                            
                            <div class="form-group col-sm-6">
                                <label for="visit_date" class="control-label col-sm-3">Visit Date</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <input type='date' class="form-control input-sm date-picker" name="visit_date" id="visit_date" value="{{$modelData->visit_date}}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-6">
                                <label for="contact_person" class="control-label col-sm-3">Site Details</label>
                                <div class="col-sm-9">
                                    <div class="fg-line">
                                        <textarea type='text' class="form-control input-sm" name="site_details" id="site_details" >{{$modelData->site_details}}</textarea>
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
                $("#visit_date").datepicker({dateFormat: 'yy-mm-dd'});
            });

</script>
@stop



