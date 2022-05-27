                                    
                                    <h2>{{strtoupper($record->doc_no)}}
                                            @if($record->ticket_status == 0)
                                            <button type="button" data-id="{{$record->id}}"  class="btn btn-primary bgm-red waves-effect ticketclose pull-right">Close</button>                                    
                                            <button type="button" data-id="{{$record->id}}"  class="btn btn-primary bgm-cyan waves-effect ticketrequest pull-right">Raise Request</button>                                    
                                            @endif
                                    </h2>
                                    
                                </div>
                                
                                

                                <div class="pti-body text-left">
                                    <div class="row text-center">
                                        
                                        <div class="col-sm-12 ">
                                            <div class="card">
                                                <div class="card-header ch-alt">
                                                    <h2>
                                                        Ticket Information 
                                                    </h2>
                                                </div>
                                                <div class="card-body card-padding pd-10-20 text-left">
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Customer Name</b></div>
                                                        <div class="col-sm-8"><input type="hidden" id="companyname" value="{{$record->customer_name}}" ><?=nl2br(strtoupper($record->company_name))?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Mode Type</b></div>
                                                        <div class="col-sm-8"><input type="hidden" id="modetype" value="{{$record->mode}}" >@if($record->mode == 0) Phone @else Email @endif </div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Email</b></div>
                                                        <div class="col-sm-8"><input type="hidden" id="emailaddress" value="{{$record->email_address}}" ><?=nl2br($record->email_address)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Mobile</b></div>
                                                        <div class="col-sm-8"><input type="hidden" id="mobileno" value="{{$record->mobileno}}" ><?=nl2br($record->mobileno)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Contact</b></div>
                                                        <div class="col-sm-8"><input type="hidden" id="contactperson" value="{{$record->contact_person}}" ><?=nl2br($record->contact_person)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Complaint nature</b></div>
                                                        <div class="col-sm-8" style="white-space: normal;width: 60rem;"><input type="hidden" id="complaintnature" value="{{$record->complaint_nature}}" ><p><?=nl2br($record->complaint_nature)?></p></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Status</b></div>
                                                        <div class="col-sm-8 f-14"><?php 
                                                                                if($record->ticket_status == 0){echo'Pending';}
                                                                                else
                                                                                    if($record->ticket_status == 1){echo'InProgress';}
                                                                                else
                                                                                    if($record->ticket_status == 2){echo 'Completed';}
                                                                                else
                                                                                    {echo'Closed';} ?></div>
                                                    </div>
                                                    @if($record->ticket_status == 3)
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Close Reason</b></div>
                                                        <div class="col-sm-8 f-14"><?php 
                                                                                if($record->close_reason == 1){echo'Spam Mail';}
                                                                                else
                                                                                    if($record->close_reason == 2){echo'Internal Mail';}
                                                                                else
                                                                                    if($record->close_reason == 2){echo 'Already Request Raised';}
                                                                                else
                                                                                    {echo'Reply Mail';} ?></div>
                                                    </div>
                                                    @endif
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Raised By</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->usr->name)?></div>
                                                    </div>

                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Raised On</b></div>
                                                        <div class="col-sm-8"><?=date('d-m-Y h:i A', strtotime($record->created_at))?></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="modalticketstatus">
                                    <div id="modalticketstatus2">
                                        <div class="modal fade mymodal" id="ticketstatusform" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                        <!--                            <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Mail Status</h4>
                                                    </div>-->
                                                    <div class="modal-header bgm-cyan m-b-20" >
                                                        <button type="button" class="close" data-dismiss="modal"> <i class='fa fa-times'></i> </button>   

                                                        <button class="close modalMinimize"> <i class='fa fa-minus'></i> </button> 

                                                        <h4 class="modal-title">Ticket Close</h4>
                                                      </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <input type="hidden" id="ticketid" value="{{$record->id}}">
                                                            <div class="col-sm-offset-4 col-sm-3">
                                                                <select class="selstatus selectpicker" name="status">

                                                                    <option value="1">Spam Mail</option>
                                                                    <option value="2">Internal mail</option>
                                                                    <option value="3">Already Request Raised</option>
                                                                    <option value="4">Reply Mail</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-sm-3">
                                                                    <button type="submit" id="submitemst" class="submitemst btn bgm-cyan"><i>Submit</i></button>
                                                                </div>
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
                                @if($record->ticket_status == 1 || $record->ticket_status == 2)
                                <div class="panel-group" data-collapse-color="yellow" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-collapse">
                                        <div class="panel-heading color-block bgm-cyan" role="tab" id="headingEmail">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEmail" aria-expanded="false" aria-controls="collapseOne">
                                                    Email Details
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseEmail" class="collapse" role="tabpanel" aria-labelledby="headingEmail">
                                            <div class="panel-body p-10">
                                                <div class="row emaildetail">  
                                                    <div class="col-sm-12">
                                                        
                                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                                            @if(($record->email))
                                                            @php
                                                                $myfile="";
                                                                $myfile = $record->email->emailid.".txt";
                                                                $file = 'email/'.$record->email->emailid.".txt";
                                                                if(Storage::exists($file))
                                                                {
                                                                    $contents = Storage::disk('email')->get($myfile);
                                                                }
                                                                else 
                                                                {
                                                                    $contents = "";
                                                                }

                                                            @endphp
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="card-body  p-5 " style="overflow: auto;">
                                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                <div class="col-sm-2"><i class="zmdi "></i><b>Mail Content</b></div>
                                                                            </div>
                                                                            <div class="">{!!$contents!!}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-group" data-collapse-color="yellow" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-collapse">
                                        <div class="panel-heading color-block bgm-teal" role="tab" id="headingService">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseService" aria-expanded="false" aria-controls="collapseThree">
                                                    Service Details
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseService" class="collapse" role="tabpanel" aria-labelledby="headingService">
                                            <div class="panel-body p-10">

                                                <div class="row takendetail">  
                                                    <div class="col-sm-12">
                                                        
                                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">
                                                                <div class="col-sm-3 text-center"></i><b>Service Number</b></div>
                                                                <div class="col-sm-3 text-center"></i><b>{{$record->complaint->seqno}}</b></div>
                                                                <div class="col-sm-3 text-center"></i><b>Call Log Status</b></div>
                                                                <div class="col-sm-3 text-center f-18 C-green"></i><b>@if($record->complaint->document_status == 0) <span class='c-red'>Draft</span>
                                                                                                        @else @if($record->complaint->document_status == 1)
                                                                                                                        @if($record->complaint->servicereg->order_status == 0) Enquiry Received @else @if($record->complaint->servicereg->order_status == 1) Offer Sent @else @if($record->complaint->servicereg->order_status == 2) PO Received  @else @if($record->complaint->servicereg->order_status == 3) PI Sent @else @if($record->complaint->servicereg->order_status == 4) Advance Received @else @if($record->complaint->servicereg->order_status == 5) Payment Received @else @if($record->complaint->servicereg->order_status == 6) DI Sent @else @if($record->complaint->servicereg->order_status == 7) Partially Dispatched @else @if($record->complaint->servicereg->order_status == 8) @if($record->complaint->complaint_type == 0) Completed @else Dispatched @endif @else @if($record->complaint->servicereg->order_status == 10) Deputed @else Cancelled @endif @endif @endif @endif @endif @endif @endif @endif @endif @endif
                                                                                                                @else @if($record->complaint->document_status == 2) Completed @else Cancelled @endif @endif @endif</b></div>
                                                                
                                                            </div>
                                                            
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">
                                                                <div class="col-sm-3 text-center"></i><b>Service Remark</b></div>
                                                                <div class="col-sm-3 text-center"></i><b>{{$record->complaint->remark}}</b></div>
                                                                <div class="col-sm-3 text-center"></i><b>Failure Cause </b></div>
                                                                <div class="col-sm-3 text-center"></i><b>@if($record->complaint->servicereg){{$record->complaint->servicereg->failure_cause}}@endif</b></div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif