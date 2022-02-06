                                    
<div class="c-white" style="font-size: 30px;"><b>{{strtoupper($record->compreg->customer_name)}}</b></div>
                                    <div class="ptih-title">
                                        <div >
                                            <em class="m-r-25">Document No : {{$record->compreg->seqno}}</em>
                                            &nbsp;<em class="m-l-25">Registered Date : <?= date('d-m-Y', strtotime($record->compreg->complaint_date)) ?></em>
                                            &nbsp;<em class="m-l-25">ATTENDED BY : @if($record->is_agent==1) Agent @else Megawin Engineer @endif</em>
                                            &nbsp;<em class="m-l-25">Visit Status : @if($record->visit_status == 0) Draft @else @if($record->visit_status == 1) Pending @else @if($record->visit_status == 2) Completed @else @if($record->visit_status == 3) Partially Completed @else Cancelled @endif @endif @endif @endif</em>
                                        </div>
                                        <div class="text-center">
                                        </div> 

                                    </div>
                                    <div class="pull-right">
                                        <div class="">
                                            @if($record->visit_status==0)
                                            <button type="button" data-id="{{$record->id}}" class="btn btn-primary bgm-orange waves-effect completed "><i class="zmdi zmdi-check"> </i> Complete</button>                                    
                                            @endif
                                        
                                            <button type="button" data-id="{{$record->id}}" class="btn btn-primary bgm-purple waves-effect complaint "><i class="zmdi zmdi-search"> </i> Details</button>                                    
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
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Contact Person</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->contact_person)?></div>
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
                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Contact Person</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->contact_person)?></div>
                                                        </div>
                                                        
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
                                                        <!--div class="row" style="    padding: 8px 0 8px 0px;">       
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
                                
                                
                                <div id="modalpayment">
                                    <div id="modalpayment1">
                                        <div class="modal fade paymentform" id="paymentform" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Payment Form</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="form-row ">
                                                                    <div class="form-group col-sm-12">
                                                                        <label for="pay_mode" class="control-label col-sm-3">Payment Mode</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="fg-line">
                                                                                <select class="selectpicker form-control input-sm" placeholder="Type" name="pay_mode" id="pay_mode">    
                                                                                    <option value="0">Cash</option>
                                                                                    <option value="1">Cheque</option>
                                                                                    <option value="2">RTGS</option>
                                                                                    <option value="3">NEFT</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-12">
                                                                        <label for="pay_status" class="control-label col-sm-3">Payment Status</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="fg-line">
                                                                                <select class="selectpicker form-control input-sm" placeholder="Type" name="pay_status" id="pay_status">    
                                                                                    <option value="2">Partially Received</option>
                                                                                    <option value="3">100% Received</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-sm-3">
                                                                    <button type="button" id="teruser" class="teruser btn bgm-cyan"><i>Submit</i></button>
                                                                </div>
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
