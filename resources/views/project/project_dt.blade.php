                                    
<div class="c-white" style="font-size: 30px;"><b>{{strtoupper($record->project_name)}}</b></div>
                                    <div class="ptih-title">
                                        <div >
                                                @if($record->approval_status == 0)
                                                    <em class="m-l-25 approve_div">Approved Status : @if($record->approval_status == 0) Pending  @endif</em>
                                                @endif
                                            <em class="m-l-25">Visit Status : @if($record->visit_status == 0) Draft  @else  Completed  @endif</em>
                                        </div>
                                        <div class="text-center">
                                        </div> 

                                    </div>
                                    <div class="pull-right">
                                        <div class="">
                                            @if($record->visit_status==0 && $record->approval_status == 1 && Session::get('user_type') == 5)
                                            <button type="button" data-id="{{$record->id}}" class="btn btn-primary bgm-orange waves-effect completed "><i class="zmdi zmdi-check"> </i> Complete</button>                                    
                                            @endif
                                            @if(Session::get('user_type') != 5 && $record->approval_status == 0)
                                            <button type="button" data-id="{{$record->id}}" class="btn btn-primary bgm-orange waves-effect approve "><i class="zmdi zmdi-check"> </i> Approval</button>                                    
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                

                                <div class="pti-body text-left">
                                    <div class="row">
                                        
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header ch-alt">
                                                    <h2>
                                                        Project Plan
                                                    </h2>
                                                </div>
                                                <div class="card-body card-padding pd-10-20">
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Project Plan Date</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->visit_date)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Site Details</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->site_details)?></div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="modalcomplete">
                                    <div id="modalcomplete1">
                                        <div class="modal fade visitcompleteform" id="visitcompleteform" role="dialog">
                                            <div class="modal-dialog modal-lg" style="width: 95%">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Project Visit Complete</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            
                                                            <form action="{{url('project')}}/insertsummary" method="POST" role="form" enctype="multipart/form-data">    
                                                                <div class="form-row">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                                                                            <input name="id" type="hidden" value="{{$record->id}}">
                                                                                <input name="engineer_id" type="hidden" value="{{$record->engineer_id}}">
                                                                                <input type='hidden' class="form-control input-sm" name="is_agent"  value="0">
                                                                                <div class="form-group col-sm-12 col-xs-12">
                                                                                    <label for="visit_date" class="control-label col-sm-4 col-xs-4">Visit Date</label>
                                                                                    <div class="col-sm-2 col-xs-8 text-left">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm " readonly name="visit_date" id="visit_date" value="{{$record->visit_date}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xs-12">
                                                                                    <label for="boarding_expenses" class="control-label col-sm-6 col-xs-4">Boarding Expenses</label>
                                                                                    <div class="col-sm-6 col-xs-8">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm " name="boarding_expenses" id="boarding_expenses" value="{{$record->boarding_expenses}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xs-12">
                                                                                    <label for="local_conveyance" class=" control-label col-sm-6 col-xs-4">Local Conveyance</label>
                                                                                    <div class="col-sm-6 col-xs-8">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm " name="local_conveyance" id="local_conveyance" value="{{$record->local_conveyance}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xs-12">
                                                                                    <label for="loading_expenses" class="control-label col-sm-6 col-xs-4">Lodging Expenses</label>
                                                                                    <div class="col-sm-6 col-xs-8">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm " name="loading_expenses" id="loading_expenses" value="{{$record->loading_expenses}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xs-12">
                                                                                    <label for="travel_expenses" class="control-label col-sm-6 col-xs-4">Travel Expenses</label>
                                                                                    <div class="col-sm-6 col-xs-8">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm " name="travel_expenses" id="travel_expenses" value="{{$record->travel_expenses}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-4 billlodging col-xs-12">
                                                                                    <label for="lodgingbill" class="control-label col-sm-2 m-l-10 col-xs-6"><b>Lodging Bill</b></label>
                                                                                    <div class="col-sm-10 col-xs-12">
                                                                                        <div class="fg-line">
                                                                                            <input type='file' class="form-control input-sm lodgingbill "  name="lodgingbill" >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-group col-sm-4 billtravel col-xs-12" >
                                                                                    <label for="travelbill" class="control-label col-sm-2 m-l-10 col-xs-8"><b>Travel Bill</b></label>
                                                                                    <div class="col-sm-10 ">
                                                                                        <div class="fg-line">
                                                                                            <input type='file' class="form-control input-sm travelbill"  name="travelbill" >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-group col-sm-4 billtravel col-xs-12" >
                                                                                    <label for="site_photo" class="control-label col-sm-2 m-l-10 col-xs-8"><b>Site Photo</b></label>
                                                                                    <div class="col-sm-10 ">
                                                                                        <div class="fg-line">
                                                                                            <input type='file' class="form-control input-sm site_photo"  name="site_photo" >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="row m-t-20 m-b-20">
                                                                                    <div class="col-sm-12">
                                                                                        <label for="work_description" class="control-label col-sm-2">Work Description</label>
                                                                                        <div class="col-sm-10">
                                                                                            <div class="fg-line">
                                                                                                <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Work Description" name="work_description" id="work_description" ></textarea>                                        
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                  
                                                                <div class="form-row col-sm-12">
                                                                    <div class="col-sm-12">
                                                                        <button type="submit" id="submit1" class="submit1 btn bgm-cyan text-center"><i>Submit</i></button>
                                                                    </div>
                                                                </div> 
                                                            </form>
                                                        </div>   
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div id="modal3">
                                </div>
