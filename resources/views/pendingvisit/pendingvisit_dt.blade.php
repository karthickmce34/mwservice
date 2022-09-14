                                    
<div class="c-white" style="font-size: 30px;"><b>{{strtoupper($record->compreg->customer_name)}}</b></div>
                                    <div class="ptih-title">
                                        <div class="col-xs-12 col-sm-12">
                                            <em class="col-sm-4 col-xs-12">Document No : {{$record->compreg->seqno}}</em>
                                            <em class="col-sm-4 col-xs-12">Registered Date : <?= date('d-m-Y', strtotime($record->compreg->complaint_date)) ?></em>
                                            <em class="col-sm-4 col-xs-12">Visit Status : @if($record->visit_status == 0) Draft @else @if($record->visit_status == 1) Pending @else @if($record->visit_status == 2) Completed @else @if($record->visit_status == 3) Partially Completed @else Cancelled @endif @endif @endif @endif</em>
                                            
                                        </div>

                                    </div>
                                    <div class="pull-right">
                                        <div class="">
                                            @if($record->visit_status==1)
                                            <button type="button" data-id="{{$record->id}}" class="btn btn-primary btn-xs bgm-orange waves-effect completed "><i class="zmdi zmdi-check"> Complete</i></button>                                    
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
                                                                <li class="ng-binding"><i class="zmdi zmdi-smartphone-iphone"></i> {{$record->contact_number}}</li>
                                                                <li class="ng-binding"><i class="zmdi zmdi-account-box-phone"></i> {{$record->contact_person}}</li>

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
                                                            @if($record->compreg->commissioned_date != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Date of Commissioned</b></div>
                                                                <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->compreg->commissioned_date))?></div>
                                                            </div>
                                                            @endif
                                                            
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Customer Complaint</b></div>
                                                                <?php $complaint_nature = $record->compreg->complaint_nature;
                                                                            $newcomplaint_nature = wordwrap($complaint_nature, 50, "\n", true);?>
                                                                <div class="col-sm-8">{!! nl2br(e($newcomplaint_nature)) !!}</div>
                                                            </div>
                                                            
                                                            @if($record->compreg->outgoing_load != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Outgoing Load</b></div>
                                                                <div class="col-sm-8"><?=nl2br($record->compreg->outgoing_load)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->relay_make_type != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Relay Make&Type</b></div>
                                                                <div class="col-sm-8"><?=nl2br($record->compreg->relay_make_type)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->relay_status != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Relay Status</b></div>
                                                                <div class="col-sm-8"><?=nl2br($record->compreg->relay_status)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->cable_length != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Cable Length</b></div>
                                                                <div class="col-sm-8">{{$record->compreg->cable_length}}</div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->fault_current != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Fault Current</b></div>
                                                                <div class="col-sm-8"><?=nl2br($record->compreg->fault_current)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->vcb_interlock != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>VCB Interlock Condition</b></div>
                                                                <div class="col-sm-8">{!! nl2br(e($record->compreg->vcb_interlock)) !!}</div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->after_commissioned != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Any Mod. Aftr Commisioning</b></div>
                                                                <div class="col-sm-8"><?=nl2br($record->compreg->after_commissioned)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->event_before_failure != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Event Before Failure</b></div>
                                                                <div class="col-sm-8"><?=nl2br($record->compreg->event_before_failure)?></div>
                                                            </div>
                                                            @endif
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Warranty</b></div>
                                                                <div class="col-sm-8"><?php if($record->compreg->warrenty == 0){echo'With Warranty';}else{echo' Without Warranty';} ?></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">

                                                        <div class="card-body card-padding pd-10-20">

                                                            @if($record->compreg->date_supply != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Panel Supply Date</b></div>
                                                                <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->compreg->date_supply))?></div>
                                                            </div>
                                                            @endif
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Remark/Comments</b></div>
                                                                <div class="col-sm-8">{!! nl2br(e($record->compreg->remark)) !!}</div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Probable Cause of Failure</b></div>
                                                                <?php $failure_cause = $record->servicespare->failure_cause;
                                                                            $newfailure_cause = wordwrap($failure_cause, 50, "\n", true);?>
                                                                <div class="col-sm-8">{!! nl2br(e($newfailure_cause)) !!}</div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Scope of Work</b></div>

                                                                <?php  
                                                                    $scope = "";
                                                                    if ($record->servicespare->scope_of_work) {
                                                                        $scope = implode(",<br>",(array) json_decode($record->servicespare->scope_of_work));
                                                                    }
                                                                ?>
                                                                <div class="col-sm-8">{!! $scope !!} </div>
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
                                                
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="card-body card-padding pd-10-20">
                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;"> 
                                                            <div class="col-sm-4 col-xs-6"><i class="zmdi "></i><b>Engineers Name</b></div>
                                                            <div class="col-sm-8 col-xs-6">@foreach($record->visitengs as $index =>$visiteng)
                                                                                    {{$visiteng->engineer->name}},
                                                                                @endforeach</div>
                                                        </div>
                                                      
                                                        <div class="row" style="    padding: 8px 0 8px 0px;"> 
                                                            
                                                            <div class="col-sm-4 col-xs-6"><i class="zmdi "></i><b>Departure Date</b></div>
                                                            <div class="col-sm-8 col-xs-6"><?=date('d-m-Y', strtotime($record->date_of_depature))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4 col-xs-6"><i class="zmdi "></i><b>Return Date</b></div>
                                                            <div class="col-sm-8 col-xs-6"><?=date('d-m-Y', strtotime($record->date_of_return))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4 col-xs-6"><i class="zmdi "></i><b>Days In Site</b></div>
                                                            <div class="col-sm-8 col-xs-6"><?=nl2br($record->days_site)?></div>
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
                                                <div class="col-sm-6 col-xs-12">
                                                    
                                                    <div class="card-body card-padding pd-10-20">
                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4 col-xs-6"><i class="zmdi "></i><b>Lodging Expenses</b></div>
                                                            <div class="col-sm-8 col-xs-6"><?=nl2br($record->loading_expenses)?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4 col-xs-6"><i class="zmdi "></i><b>Boarding Expenses</b></div>
                                                            <div class="col-sm-8 col-xs-6">{!! nl2br(e($record->boarding_expenses)) !!}</div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4 col-xs-6"><i class="zmdi "></i><b>Travel Expenses</b></div>
                                                            <div class="col-sm-8 col-xs-6">{!! nl2br(e($record->travel_expenses)) !!}</div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4 col-xs-6"><i class="zmdi "></i><b>Local Conveyance</b></div>
                                                            <div class="col-sm-8 col-xs-6">{!! nl2br(e($record->local_conveyance)) !!}</div>
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
                                                                                <div class="col-sm-1">
                                                                                    <div class="fg-line">
                                                                                        <input type="type" class="form-control input-sm" placeholder="Qty" name="qty" id="qty" value=""/>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <div class="fg-line">
                                                                                        <input type="type" class="form-control input-sm" placeholder="Cost" name="unitprice" id="unitprice" value=""/>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <div class="fg-line">
                                                                                        <input type="type" class="form-control input-sm" placeholder="Total" name="amount" id="amount" value=""/>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <div class="fg-line">
                                                                                        <input type='file' class="form-control input-sm billimage"  name="billimage" >
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
                                                                                <input type='hidden' class="form-control input-sm" name="is_agent"  value="1">
                                                                                <div class="form-group col-sm-3 col-xs-12">
                                                                                    <label for="act_attend_date_from" class="control-label col-sm-6">Attend From</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <?php if($record->date_of_depature == "") { $depdate = $currentdate =date('Y-m-d'); } else {$depdate = $record->date_of_depature;}  ?>
                                                                                            <input type='text' class="form-control input-sm date-picker act_agent_date_from" name="act_attend_date_from"  value="{{$depdate}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-3 col-xs-12">
                                                                                    <?php if($record->date_of_return == "") { $retdate = $currentdate =date('Y-m-d'); } else {$retdate = $record->date_of_return;}  ?>
                                                                                    <label for="act_agent_date_to" class="control-label col-sm-6">Attend To</label>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm date-picker act_agent_date_to" name="act_attend_date_to" value="{{$retdate}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row form-group col-sm-3 col-xs-12">
                                                                                    <label for="invoice_bill" class="control-label col-sm-6 col-xs-4">Invoice Value</label>
                                                                                    <div class="col-sm-6 col-xs-8">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm " name="invoice_bill" id="invoice_bill" value="0">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-sm-3 invoicecopy1 col-xs-12">
                                                                                    <label for="invoicecopy" class="control-label col-sm-2 m-l-10 col-xs-6"><b>Invoice Copy</b></label>
                                                                                    <div class="col-sm-10 col-xs-12">
                                                                                        <div class="fg-line">
                                                                                            <input type='file' class="form-control input-sm invoicecopy "  name="invoicecopy" >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                                
                                                                                
                                                                               
                                                                            @else
                                                                            <div class="row">
                                                                                <input type='hidden' class="form-control input-sm" name="is_agent"  value="0">
                                                                                <div class="form-group col-sm-4 col-xs-12">
                                                                                    <label for="date_of_depature" class="control-label col-sm-6 col-xs-4">Departure Date</label>
                                                                                    <div class="col-sm-6 col-xs-8">
                                                                                        <div class="fg-line">
                                                                                            <?php if($record->date_of_depature == "") { $depdate = $currentdate =date('Y-m-d'); } else {$depdate = $record->date_of_depature;}  ?>
                                                                                            <input type='text' class="form-control input-sm date-picker act_attend_date_from" name="act_attend_date_from"  value="{{$depdate}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-4 col-xs-12">
                                                                                    <?php if($record->date_of_return == "") { $retdate = $currentdate =date('Y-m-d'); } else {$retdate = $record->date_of_return;}  ?>
                                                                                    <label for="date_of_return" class="control-label col-sm-6 col-xs-4">Return Date</label>
                                                                                    <div class="col-sm-6 col-xs-8">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm date-picker act_attend_date_to" name="act_attend_date_to" value="{{$retdate}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-sm-4 col-xs-12">
                                                                                    <label for="days_site" class="control-label col-sm-6 col-xs-4">Total Days</label>
                                                                                    <div class="col-sm-6 col-xs-8">
                                                                                        <div class="fg-line">
                                                                                            <input type='text' class="form-control input-sm required" name="days_site" id="days_site" required value="{{$record->days_site}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                
                                                                                    
                                                                                
                                                                                @php $cnt=0; @endphp
                                                                                @foreach($record->visitengs as $index =>$visiteng)
                                                                                    @php $cnt++; @endphp
                                                                                    <div class="col-sm-4 col-xs-12">
                                                                                    <input type='hidden' class="form-control input-sm required" name="engineer_id[{{$cnt}}]" id="engineer_id" required value="{{$visiteng->engineer->id}}">
                                                                                    <input type='text' class="form-control input-sm text-center" name="engineer_name[{{$cnt}}]" id="engineer_id" readonly value="{{$visiteng->engineer->name}}">
                                                                                    <div class="row form-group col-sm-12 col-xs-12">
                                                                                        <label for="boarding_expenses" class="control-label col-sm-6 col-xs-4">Boarding Expenses</label>
                                                                                        <div class="col-sm-6 col-xs-8">
                                                                                            <div class="fg-line">
                                                                                                <input type='text' class="form-control input-sm " name="boarding_expenses[{{$cnt}}]" id="boarding_expenses" value="{{$record->boarding_expenses}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group col-sm-12 col-xs-12">
                                                                                        <label for="local_conveyance" class=" control-label col-sm-6 col-xs-4">Local Conveyance</label>
                                                                                        <div class="col-sm-6 col-xs-8">
                                                                                            <div class="fg-line">
                                                                                                <input type='text' class="form-control input-sm " name="local_conveyance[{{$cnt}}]" id="local_conveyance" value="{{$record->local_conveyance}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group col-sm-12 col-xs-12">
                                                                                        <label for="loading_expenses" class="control-label col-sm-6 col-xs-4">Lodging Expenses</label>
                                                                                        <div class="col-sm-6 col-xs-8">
                                                                                            <div class="fg-line">
                                                                                                <input type='text' class="form-control input-sm " name="loading_expenses[{{$cnt}}]" id="loading_expenses" value="{{$record->loading_expenses}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group col-sm-12 col-xs-12">
                                                                                        <label for="travel_expenses" class="control-label col-sm-6 col-xs-4">Travel Expenses</label>
                                                                                        <div class="col-sm-6 col-xs-8">
                                                                                            <div class="fg-line">
                                                                                                <input type='text' class="form-control input-sm " name="travel_expenses[{{$cnt}}]" id="travel_expenses" value="{{$record->travel_expenses}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>    
                                                                                        
                                                                                @endforeach
                                                                                <div class="row form-group col-sm-6 billlodging1 col-xs-12">
                                                                                    <label for="lodgingbill" class="control-label col-sm-2 m-l-10 col-xs-6"><b>Lodging Bill</b></label>
                                                                                    <div class="col-sm-10 col-xs-12">
                                                                                        <div class="fg-line">
                                                                                            <input type='file' class="form-control input-sm lodgingbill "  name="lodgingbill" >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row form-group col-sm-6 billtravel2 col-xs-12" >
                                                                                    <label for="travelbill" class="control-label col-sm-2 m-l-10 col-xs-8"><b>Travel Bill</b></label>
                                                                                    <div class="col-sm-10 ">
                                                                                        <div class="fg-line">
                                                                                            <input type='file' class="form-control input-sm travelbill"  name="travelbill" >
                                                                                        </div>
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
                                                                                        Site Information
                                                                                    </h3>
                                                                                </div>
                                                                                <div class="panel-body ">
                                                                                    <div class="row">
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="outgoing_load" class="control-label col-sm-4 f-10 col-xs-4">Outgoing Load<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm required f-10" required placeholder="Outgoing Load" name="outgoing_load" type="text" id="outgoing_load" autocomplete="off">                                        
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="relay_make_type" class="control-label col-sm-4 col-xs-4 f-10">Relay Make&Type<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm required f-10" required placeholder="Relay Make&Type" name="relay_make_type" type="text" id="relay_make_type" autocomplete="off">                                        
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="cable_length" class="control-label col-sm-4 col-xs-4 f-10">Cable Length /Size (load)<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm required f-10" required placeholder="Cable Length (load)" name="cable_length" type="text" id="cable_length" autocomplete="off">                                        
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="fault_current" class="control-label col-sm-4 col-xs-4 f-10">Fault Current</label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm f-10" placeholder="Fault Current" name="fault_current" type="text" id="fault_current" autocomplete="off">                                        
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="vcb_interlock" class="control-label col-sm-4 col-xs-4 f-10">VCB Interlock Condition</label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm f-10" placeholder="VCB Interlock" name="vcb_interlock" type="text" id="vcb_interlock" autocomplete="off">                                        
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="after_commissioned" class="control-label col-sm-4 col-xs-4 f-10">Modification After Commissioned</label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm f-10" placeholder="After Commissioned" name="after_commissioned" type="text" id="after_commissioned" autocomplete="off">

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="event_before_failure" class="control-label col-sm-4 col-xs-4 f-10">Event Before Failure</label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm f-10" placeholder="Event Before Failure" name="event_before_failure" type="text" id="event_before_failure" autocomplete="off">                                      
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="serial_no" class="control-label col-sm-4 col-xs-4 f-10">VCB Serial No<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm required f-10" required placeholder="Serial No" name="serial_no" type="text" id="serial_no">                                        
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="transformer_rating" class="control-label col-sm-4 col-xs-4 f-10">Transformer Rating<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm required f-10" required placeholder="Transformer Rating" name="transformer_rating" type="text" id="transformer_rating">                                        
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6 col-xs-12">
                                                                                            <label for="others" class="control-label col-sm-4 col-xs-4 f-10">Others</label>
                                                                                            <div class="col-sm-8 col-xs-8">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm f-10" placeholder="Others" name="others" type="text" id="others" autocomplete="off">                                        
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row m-t-10">
                                                                                        <div class="col-sm-6">
                                                                                            <label for="servicereport" class="control-label col-sm-4">Site Report<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="fg-line">
                                                                                                    <input type='file' class="form-control input-sm servicereport required" required name="servicereport" >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <label for="sld" class="control-label col-sm-4">SLD<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="fg-line">
                                                                                                    <input type='file' class="form-control input-sm sld required" required name="sld" accept="image/*">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row m-t-10">
                                                                                        <div class="col-sm-6">
                                                                                            <label for="panel-front" class="control-label col-sm-4">Panel Front<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="fg-line">
                                                                                                    <input type='file' class="form-control input-sm panelfront required" required name="panelfront" accept="image/*">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <label for="panelleft" class="control-label col-sm-4">Panel Left<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="fg-line">
                                                                                                    <input type='file' class="form-control input-sm panelleft required" required name="panelleft" accept="image/*">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <label for="panelright" class="control-label col-sm-4">Panel Right<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="fg-line">
                                                                                                    <input type='file' class="form-control input-sm panelright required" required name="panelright" accept="image/*">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <label for="panelinside" class="control-label col-sm-4">Panel Inside<span class="c-red">*</span></label>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="fg-line">
                                                                                                    <input type='file' class="form-control input-sm panelinside required" required name="panelinside" accept="image/*">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row m-t-10">
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
                                                                    </div>
                                                                </div>
                                                                @if($record->is_agent == 0)
                                                                <div class="form-row col-sm-12 m-t-20">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="panel">
                                                                                <div class="panel-heading ">
                                                                                    <h3>
                                                                                        Site Inspection Detail
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
                                                                                    @if(($record->thingstodos))
                                                                                    <div class="row m-t-25">
                                                                                        <div class="col-sm-12">
                                                                                            
                                                                                        <?php $n=0; ?>
                                                                                        @foreach($record->thingstodos as $thingstodo)
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
                                                                @endif                    
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
