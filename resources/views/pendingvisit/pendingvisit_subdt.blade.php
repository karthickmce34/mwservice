        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
            <div class="panel panel-collapse">
                <div class="panel-heading color-block bgm-blue" role="tab" id="headingProduct">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseProduct" aria-expanded="false" aria-controls="collapseOne">
                            Service Product
                        </a>
                    </h4>
                </div>
                <div id="collapseProduct" class="collapse" role="tabpanel" aria-labelledby="headingProduct">
                    <div class="panel-body p-10">
                        
                        <div class="row ">  
                            <div class="col-sm-12">
                                <?php
                                $crrDate = date("Y-m-d");
                                $activestatus = "";
                                $active = "";
                                $n = 0;
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->servicespare->registerprds))
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-head card-padding pd-10-20">
                                                        <div class="row c-black" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-2 text-center" >Product Code</div>
                                                            <div class="col-sm-4 text-center">
                                                                            Product Name                                                       
                                                            </div>
                                                            <div class="col-sm-1 text-center">
                                                                            Unit Price                                                       
                                                            </div>
                                                            <div class="col-sm-1 ">
                                                                            Quantity                                                       
                                                            </div>
                                                            <div class="col-sm-1 ">
                                                                            Total                                                       
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body card-padding pd-10-20">
                                                @foreach($record->servicespare->registerprds as $registerprd)
                                                    <?php $n++; ?>
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-2 text-center">{{$registerprd->product->code}}</div>
                                                            <div class="col-sm-4 text-center">
                                                                            {{$registerprd->product->name}}                                                       
                                                            </div>
                                                            <div class="col-sm-1 text-center">
                                                                            {{$registerprd->unit_price}}                                                       
                                                            </div>
                                                            <div class="col-sm-1 ">
                                                                            {{$registerprd->quantity}}                                                       
                                                            </div>
                                                            <div class="col-sm-1 ">
                                                                            {{$registerprd->total_price}}                                                       
                                                            </div>
                                                            
                                                        </div>
                                                @endforeach
                                                    </div>
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
                <div class="panel-heading color-block bgm-cyan" role="tab" id="headingThingtodo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThingtodo" aria-expanded="false" aria-controls="collapseOne">
                            Things To Do
                        </a>
                    </h4>
                </div>
                <div id="collapseThingtodo" class="collapse" role="tabpanel" aria-labelledby="headingThingtodo">
                    <div class="panel-body p-10">
                        <div class="row thingsdetail">  
                            <div class="col-sm-12">
                                <?php
                                $crrDate = date("Y-m-d");
                                $activestatus = "";
                                $active = "";
                                $n = 0;
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->servicespare->thingstodos))
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-head card-padding pd-10-20">
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-2 c-black text-center">Sno</div>
                                                            <div class="col-sm-10 c-black text-center">Things To Do</div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="card-body card-padding pd-10-20">
                                                @foreach($record->servicespare->thingstodos as $thingstodo)
                                                    <?php $n++; ?>
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-2 c-black text-center">{{$n}}</div>
                                                            <div class="col-sm-10 text-center">{{$thingstodo->things_to_do}}</div>
                                                            
                                                        </div>
                                                @endforeach
                                                    </div>
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
                <div class="panel-heading color-block bgm-teal" role="tab" id="headingThingtodo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThingtotaken" aria-expanded="false" aria-controls="collapseThree">
                            Tools And Tackles
                        </a>
                    </h4>
                </div>
                <div id="collapseThingtotaken" class="collapse" role="tabpanel" aria-labelledby="headingThingtotaken">
                    <div class="panel-body p-10">

                        <div class="row takendetail">  
                            <div class="col-sm-12">
                                <?php
                                $crrDate = date("Y-m-d");
                                $activestatus = "";
                                $active = "";
                                $n = 0;
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->servicespare->prdtakens))
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-head card-padding pd-10-20">
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4 c-black">Things To Taken</div>
                                                            <div class="col-sm-2 c-black">Qunatity</div>
                                                            <div class="col-sm-2 c-black">Isreturn</div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="card-body card-padding pd-10-20">
                                                @foreach($record->servicespare->prdtakens as $prdtaken)
                                                    <?php $n++; ?>
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4">{{$prdtaken->prd_description}}</div>
                                                            <div class="col-sm-2">{{$prdtaken->quantity}}</div>
                                                            <div class="col-sm-2">
                                                                            @if($prdtaken->isreturn == 0)
                                                                                Returnable
                                                                            @else 
                                                                                Non-Returnable
                                                                            @endif
                                                            </div>

                                                        </div>
                                                @endforeach
                                                    </div>
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
        
        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
            <div class="panel panel-collapse">
                <div class="panel-heading color-block bgm-teal" role="tab" id="headingAduit">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAduit" aria-expanded="false" aria-controls="collapseTwo">
                            Documents Attached
                        </a>
                    </h4>
                </div>
                <div id="collapseAduit" class="collapse" role="tabpanel" aria-labelledby="headingAduit">
                    <div class="panel-body p-10">
                        @if($record->visit_status == 0)
                        <div class="p-5 pull-right mm-55-0">
                            <a href="{{url('visitplan/addnew', $record->id)}}" target="_self">
                                <button class="btn bgm-lime btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></button>                                    
                            </a>
                        </div>
                        @endif
                        <div class="row ">  
                            <div class="col-sm-12">
                                <?php
                                $crrDate = date("Y-m-d");
                                $activestatus = "";
                                $active = "";
                                $n = 0;
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->visitaudits))
                                        <div class="row">
                                        @foreach($record->visitaudits as $visitaudit)
                                            <?php $n++; ?>
                                            
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-body card-padding pd-10-20">
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-2">{{$visitaudit->name}}</div>
                                                            <div class="col-sm-4 ">
                                                                @if($visitaudit->file_type == 0)
                                                                    <img style="width: inherit;" src="{{url('/')}}/{{$visitaudit->file_path}}/{{$visitaudit->file_name}}" />
                                                                @else
                                                                    <a style="width: inherit;" href="{{url('/')}}/{{$visitaudit->file_path}}/{{$visitaudit->file_name}}" tabindex="_self">{{$visitaudit->file_name}}<a/>
                                                                @endif                                                                    
                                                            </div>
                                                            <div class="col-sm-2 text-center">
                                                                <a href="{{url('visitplan/editdoc', $visitaudit->id)}}" target="_self">
                                                                    <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit"></i></button>
                                                                </a>
                                                                <a href="{{url('visitplan/deletedoc', $visitaudit->id)}}" target="_self">
                                                                    <button class="btn bgm-red btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-close"></i></button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="blankModal" class="modal fade">
            <div class="modal-dialog modal-lg" style="width: 95%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                        <h2 class="modal-title">Complaint Details</h2>
                    </div>
                    <div class="modal-body">
                        <div class="card-body card-padding">
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
                                                            <li class="ng-binding"><i class="zmdi zmdi-phone"></i> {{$record->compreg->phoneno}}</li>
                                                            <li class="ng-binding"><i class="zmdi zmdi-account-box-phone"></i> {{$record->compreg->contact_person}}</li>
                                                            <li class="ng-binding"><i class="zmdi zmdi-email"></i> {{$record->compreg->emailid}}</li>

                                                            <li>
                                                                <i class="zmdi zmdi-pin"></i>
                                                                <address class="m-b-0 ng-binding">
                                                                    {{$record->compreg->address1}},<br>
                                                                    {{$record->compreg->address2}},<br>
                                                                    {{$record->compreg->city}}&nbsp;-&nbsp;{{$record->compreg->pincode}},<br>
                                                                    {{$record->compreg->state}},<br>
                                                                    {{$record->compreg->country}}.                                      
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
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>GSTIN</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->compreg->gstin)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>PAN No</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->compreg->panno)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Sales Order No</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->compreg->salesorder_no)?></div>
                                                    </div>
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
                                                            <div class="col-sm-6"><i class="zmdi "></i><b>Complaint Status</b></div>
                                                            <div class="col-sm-6"><?php if($record->compreg->document_status == 0){echo'<div class="c-red f-20">Draft</div>';}else if($record->compreg->document_status == 1) {echo '<div class="c-orange f-20">In-Progress</div>';} else if($record->compreg->document_status == 2) {echo '<div class="c-green f-20">Completed</div>';} else {echo '<div class="c-yellow f-20">Cancelled</div>';}?></div>
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
                        </div>
                    </div>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>