                                    
<div class="c-white" style="font-size: 30px;"><b>{{strtoupper($record->compreg->customer_name)}}</b></div>
                                    <div class="ptih-title">
                                        <div >
                                            <em class="m-r-25">Document No : {{$record->compreg->seqno}}</em>
                                            &nbsp;<em class="m-l-25">Registered Date : <?= date('d-m-Y', strtotime($record->compreg->complaint_date)) ?></em>
                                            &nbsp;<em class="m-l-25">Visit Status : @if($record->visit_status == 0) Draft @else @if($record->visit_status == 1) Pending @else @if($record->visit_status == 2) Completed @else @if($record->visit_status == 3) Partially Completed @else Cancelled @endif @endif @endif @endif</em>
                                            
                                        </div>
                                        <div class="text-center">
                                        </div> 

                                    </div>
                                    <div class="pull-right">
                                        <div class="">
                                            @if($record->visit_status==1)
                                            <button type="button" data-id="{{$record->id}}" class="btn btn-primary bgm-orange waves-effect completed "><i class="zmdi zmdi-check"> </i> Visit Completed</button>                                    
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="pti-body text-left">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-header ch-alt">
                                                        <h2>Contact Information</h2>
                                                    </div>
                                                    <div class="card-body card-padding pd-10-20">
                                                        <div class="pmo-contact">        
                                                            <ul>
                                                                <li class="ng-binding"><i class="zmdi zmdi-smartphone-iphone"></i> {{$record->compreg->mobileno}}</li>
                                                                <li class="ng-binding"><i class="zmdi zmdi-account-box-phone"></i> {{$record->compreg->contact_person}}</li>

                                                                <li>
                                                                    <i class="zmdi zmdi-pin"></i>
                                                                    <address class="m-b-0 ng-binding">
                                                                        {{$record->compreg->site_location}}                                   
                                                                    </address>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-header ch-alt">
                                                        <h2>
                                                            Other Information 
                                                        </h2>
                                                    </div>
                                                    <div class="card-body card-padding pd-10-20">
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Serial No</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->compreg->serial_no)?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Product Description</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->compreg->panel_descrption)?></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header ch-alt">
                                                        <h2>
                                                            Registered Information 
                                                        </h2>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Date of Commissioned</b></div>
                                                                <div class="col-sm-6"><?=date('d-m-Y', strtotime($record->compreg->commissioned_date))?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Customer Complaint</b></div>
                                                                <div class="col-sm-6">{!! nl2br(e($record->compreg->complaint_nature)) !!}</div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Outgoing Load</b></div>
                                                                <div class="col-sm-6"><?=nl2br($record->compreg->outgoing_load)?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Relay Make&Type</b></div>
                                                                <div class="col-sm-6"><?=nl2br($record->compreg->relay_make_type)?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Relay Status</b></div>
                                                                <div class="col-sm-6"><?=nl2br($record->compreg->relay_status)?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Cable Length</b></div>
                                                                <div class="col-sm-6">{{$record->compreg->cable_length}}</div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Fault Current</b></div>
                                                                <div class="col-sm-6"><?=nl2br($record->compreg->fault_current)?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>VCB Interlock Condition</b></div>
                                                                <div class="col-sm-6">{!! nl2br(e($record->compreg->vcb_interlock)) !!}</div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Any Mod. Aftr Commisioning</b></div>
                                                                <div class="col-sm-6"><?=nl2br($record->compreg->after_commissioned)?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Event Before Failure</b></div>
                                                                <div class="col-sm-6"><?=nl2br($record->compreg->event_before_failure)?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Warranty</b></div>
                                                                <div class="col-sm-6"><?php if($record->compreg->warrenty == 0){echo'With Warranty';}else{echo' Without Warranty';} ?></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">

                                                        <div class="card-body card-padding pd-10-20">

                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Panel Supply Date</b></div>
                                                                <div class="col-sm-6"><?=date('d-m-Y', strtotime($record->compreg->date_supply))?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Remark/Comments</b></div>
                                                                <div class="col-sm-6">{!! nl2br(e($record->compreg->remark)) !!}</div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Probable Cause of Failure</b></div>
                                                                <div class="col-sm-6">{!! nl2br(e($record->servicespare->failure_cause)) !!}</div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6"><i class="zmdi "></i><b>Scope of Work</b></div>

                                                                <?php  
                                                                    $scope = "";
                                                                    if ($record->servicespare->scope_of_work) {
                                                                        $scope = implode(",<br>",(array) json_decode($record->servicespare->scope_of_work));
                                                                    }
                                                                ?>
                                                                <div class="col-sm-6">{!! $scope !!} </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="pti-body text-left">
                                    <div class="row">
                                        
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header ch-alt">
                                                    <h2>
                                                        Visit Information 
                                                    </h2>
                                                </div>
                                                @if($record->is_agent==1)
                                                <div class="col-sm-6">
                                                    <div class="card-body card-padding pd-10-20">
                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;"> 
                                                            
                                                            <div class="pmo-contact">        
                                                                <ul>
                                                                    <li class="ng-binding"><i class="zmdi zmdi-account"></i> {{$record->agent->company_name}}</li>
                                                                    <li class="ng-binding"><i class="zmdi zmdi-smartphone-iphone"></i> {{$record->agent->mobileno}}</li>
                                                                    <li class="ng-binding"><i class="zmdi zmdi-email"></i> {{$record->agent->emailid}}</li>

                                                                    <li>
                                                                        <i class="zmdi zmdi-pin"></i>
                                                                        <address class="m-b-0 ng-binding">
                                                                            {{$record->agent->address1}},<br>
                                                                            {{$record->agent->address2}},<br>
                                                                            {{$record->agent->city}}&nbsp;-&nbsp;{{$record->agent->pincode}},<br>
                                                                            {{$record->agent->state}},<br>
                                                                            {{$record->agent->country}}.                                      
                                                                        </address>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card-body card-padding pd-10-20">                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">                                                             
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Attended From</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->date_of_depature))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Attended To</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->date_of_return))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Days In Site</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->days_site)?></div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                                
                                                @else
                                                
                                                <div class="col-sm-6">
                                                    <div class="card-body card-padding pd-10-20">
                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;"> 
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Engineers Name</b></div>
                                                            <div class="col-sm-8">@foreach($record->visitengs as $index =>$visiteng)
                                                                                    {{$visiteng->engineer->name}},
                                                                                @endforeach</div>
                                                        </div>
                                                      
                                                        <div class="row" style="    padding: 8px 0 8px 0px;"> 
                                                            
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Departure Date</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->date_of_depature))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Return Date</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->date_of_return))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Days In Site</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->days_site)?></div>
                                                        </div>
                                                        <!--div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Total Expenses</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->total_expenses)?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Contact Person</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->contact_person)?></div>
                                                        </div-->
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    
                                                    <div class="card-body card-padding pd-10-20">
                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Lodging Expenses</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->loading_expenses)?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Boarding Expenses</b></div>
                                                            <div class="col-sm-8">{!! nl2br(e($record->boarding_expenses)) !!}</div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Travel Expenses</b></div>
                                                            <div class="col-sm-8">{!! nl2br(e($record->travel_expenses)) !!}</div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Local Conveyance</b></div>
                                                            <div class="col-sm-8">{!! nl2br(e($record->local_conveyance)) !!}</div>
                                                        </div>
                                                        <!--div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Total Expenses</b></div>
                                                            <div class="col-sm-8"></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Tools Required</b></div>
                                                            <div class="col-sm-8"></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Material Requirements</b></div>
                                                            <div class="col-sm-8"></div>
                                                        </div-->
                                                    </div>
                                                </div>
                                                @endif
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
                                                        <h4>Visit Complete</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="product" style="display:none">
                                                                <div class="thingsnew1">
                                                                    <div class="things0">
                                                                        <div class="row m-t-25">
                                                                            <div class="col-sm-12 ">
                                                                                <div class="col-sm-1 m-t-5">
                                                                                    <div class="fg-line"> <span class="sno"> </span> </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="fg-line">
                                                                                        <input type="type" class="form-control input-sm" placeholder="Product" name="product" id="product" value=""/>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <div class="fg-line">
                                                                                        <input type="type" class="form-control input-sm" placeholder="qty" name="qty" id="qty" value=""/>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <div class="fg-line">
                                                                                        <input type="type" class="form-control input-sm" placeholder="unit price" name="unitprice" id="unitprice" value=""/>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <div class="fg-line">
                                                                                        <input type="type" class="form-control input-sm" placeholder="amount" name="amount" id="amount" value=""/>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-1 text-center m-t-10">
                                                                                    <button type="button" class="btn bgm-red remove"><i class="zmdi zmdi-close"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form action="{{url('pendingvisit')}}/insertsummary" method="POST" role="form" enctype="multipart/form-data">    
                                                                <div class="form-row">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                                                                            <input name="id" type="hidden" value="{{$record->id}}">

                                                                            @if($record->is_agent == 1)
                                                                            <div class="row">
                                                                                <div class="form-group col-sm-6">
                                                                                    <input type='hidden' class="form-control input-sm" name="is_agent"  value="1">
                                                                                    <?php $retdate = $currentdate =date('Y-m-d');  ?>
                                                                                    <label for="act_attend_date_from" class="control-label col-sm-6">Date of Attend From</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm date-picker" name="act_attend_date_from" id="act_attend_date_from" value="{{$retdate}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="act_attend_date_to" class="control-label col-sm-6">Date of Attend To</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm date-picker" name="act_attend_date_to" id="act_attend_date_to" value="{{$retdate}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <label for="work_description" class="control-label col-sm-6">Work Description</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Work Description" name="work_description" id="work_description" ></textarea>                                        
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>    
                                                                            @else
                                                                                <input type='hidden' class="form-control input-sm" name="is_agent"  value="0">
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="date_of_depature" class="control-label col-sm-6">Departure Date</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <?php if($record->date_of_depature == "") { $depdate = $currentdate =date('Y-m-d'); } else {$depdate = $record->date_of_depature;}  ?>
                                                                                            <input type='text' class="form-control input-sm date-picker act_attend_date_from" name="act_attend_date_from"  value="{{$depdate}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <?php if($record->date_of_return == "") { $retdate = $currentdate =date('Y-m-d'); } else {$retdate = $record->date_of_return;}  ?>
                                                                                    <label for="date_of_return" class="control-label col-sm-6">Return Date</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm date-picker act_attend_date_to" name="act_attend_date_to" value="{{$retdate}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="days_site" class="control-label col-sm-6">Total Days</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm" name="days_site" id="days_site" value="{{$record->days_site}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="loading_expenses" class="control-label col-sm-6">Lodging Expenses</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm" name="loading_expenses" id="loading_expenses" value="{{$record->loading_expenses}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="boarding_expenses" class="control-label col-sm-6">Boarding Expenses</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm" name="boarding_expenses" id="boarding_expenses" value="{{$record->boarding_expenses}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="travel_expenses" class="control-label col-sm-6">Travel Expenses</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm" name="travel_expenses" id="travel_expenses" value="{{$record->travel_expenses}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="local_conveyance" class="control-label col-sm-6">Local Conveyance</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm" name="local_conveyance" id="local_conveyance" value="{{$record->local_conveyance}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <label for="work_description" class="control-label col-sm-6">Work Description</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Work Description" name="work_description" id="work_description" ></textarea>                                        
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row col-sm-12 m-t-20">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="panel">
                                                                                <div class="panel-heading ">
                                                                                    <h3>
                                                                                        Things Done
                                                                                    </h3>
                                                                                </div>
                                                                                <div class="panel-body ">
                                                                                    <div class="row bgm-cyan">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="row c-white f-500">
                                                                                                <div class="col-sm-1">
                                                                                                    Issue Checked
                                                                                                </div>
                                                                                                <div class="col-sm-4"> Things Checked</div>
                                                                                                <div class="col-sm-4"> Inspection Remarks</div>
                                                                                                <div class="col-sm-3"> Inspection image</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @if(($record->servicespare->thingstodos))
                                                                                    <div class="row m-t-25">
                                                                                        <div class="col-sm-12">
                                                                                            
                                                                                        <?php $n=0; ?>
                                                                                        @foreach($record->servicespare->thingstodos as $thingstodo)
                                                                                            <?php $n++; ?>
                                                                                            <div>
                                                                                                <input type="hidden" name="todo_id[{{$n}}]" value="{{$thingstodo->id}}" >
                                                                                            </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-1">
                                                                                                            <div class="checkbox">
                                                                                                                <label>
                                                                                                                    <input type="checkbox" name="ischecked[{{$n}}]" class="ischecked" value="1">
                                                                                                                    <i class="input-helper"></i>
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-sm-4 text-center">{{$thingstodo->things_to_do}}</div>
                                                                                                        <div class="col-sm-4">                                    
                                                                                                            <textarea class="form-control input-sm" cols="20" rows="3"  placeholder="Remarks" name="remarks[{{$n}}]"  ></textarea>                                        
                                                                                                        </div>
                                                                                                        <div class="col-sm-3"> 
                                                                                                            <input type='file' class="form-control input-sm imgupload"  name="img_upload[{{$n}}]" >
                                                                                                            <!--input type='file' class="form-control input-sm"  name="files[]" data-validation="required" required="required"-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row col-sm-12 m-t-20">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="panel">
                                                                                <div class="panel-heading ">
                                                                                    <h3>
                                                                                        Any Purchase at Site
                                                                                    </h3>
                                                                                </div>
                                                                                <div class="panel-body ">
                                                                                    <div class="thingsnew2">
                                                                                        
                                                                                    </div>
                                                                                    <div class="row m-t-25">
                                                                                        <div class="col-sm-12">
                                                                                            <button type="button" class="btn btn-xs bgm-cyan pull-right newline"><i class="zmdi zmdi-plus"> New line</i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                                                    
                                                                <div class="form-row">
                                                                    <div class="col-sm-3">
                                                                        <button type="submit" id="submit1" class="submit1 btn bgm-cyan"><i>Submit</i></button>
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
