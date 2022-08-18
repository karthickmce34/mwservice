                                    
<div class="c-white" style="font-size: 30px;"><b>{{strtoupper($record->customer_name)}}</b></div>
                                    <div class="ptih-title">
                                        <div>
                                            &nbsp;<em class="m-r-25 m-l-25">Seqno : {{$record->seqno}}</em>
                                            
                                            &nbsp;<em class="m-r-25">MODE : {{$record->COMPLAINT_MODE_VALUES[$record->mode_of_complaint]}}</em>

                                            &nbsp;<em class="m-r-25">Order Type : {{$record->ORDER_TYPE_VALUES[$record->order_type]}}</em>
                                            
                                            &nbsp;<em class="m-r-25">Registered Date : <?= date('d-m-Y', strtotime($record->complaint_date)) ?></em>
                                        </div> 

                                    </div>
                                    <div class="p-5 pull-right mm-55-0">
                                        <div class="m-t-25">
                                            @if($record->document_status == 0)
                                            <button type="button" data-id="{{$record->id}}" data-type="{{$record->complaint_type}}" data-mode="{{$record->mode_of_complaint}}" class="btn btn-primary bgm-green waves-effect invsolve m-t-25"><i class="zmdi zmdi-refresh"> </i> Complete</button>                                    
                                            @endif
                                            @if($record->document_status != 1 && $record->document_status != 2)
                                            <button type="button" data-id="{{$record->id}}" class="btn btn-primary bgm-red waves-effect invcancel m-t-25"><i class="zmdi zmdi-close"> </i> Cancel</button>                                    
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                

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
                                                            <li class="ng-binding"><i class="zmdi zmdi-smartphone-iphone"></i> {{$record->mobileno}}</li>
                                                            <!--li class="ng-binding"><i class="zmdi zmdi-phone"></i> {{$record->phoneno}}</li-->
                                                            <li class="ng-binding"><i class="zmdi zmdi-account-box-phone"></i> {{$record->contact_person}}</li>
                                                            <li class="ng-binding"><i class="zmdi zmdi-email"></i> {{$record->emailid}}</li>

                                                            <li><?php $text = $record->address1;
                                                                        $newtext = wordwrap($text, 60, "\n", true);?>
                                                                <i class="zmdi zmdi-pin"></i>
                                                                <address class="m-b-0 ng-binding" style="width:6rem;"><?=nl2br($newtext)?>
                                                                </address>
                                                            </li>
                                                            <li>
                                                                <i class="zmdi zmdi-local-shipping"></i>
                                                                <address class="m-b-0 ng-binding"><?php $text2 = $record->address2;
                                                                        $newtext2 = wordwrap($text2, 60, "\n", true);?>
                                                                    <?=nl2br($newtext2)?><br>
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
                                                        <div class="col-sm-8"><?=nl2br($record->gstin)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Sales Order No</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->salesorder_no)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Region</b></div>
                                                        @if($record->region)
                                                        <div class="col-sm-8"><?=nl2br($record->region->region_name)?></div>
                                                        @endif
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Panel Description</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->panel_descrption)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Site Location</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->site_location)?></div>
                                                    </div>
                                                    <div>
                                                        
                                                    </div>
                                                    <!--div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Created By</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->usr->name)?></div>
                                                    </div>

                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Created</b></div>
                                                        <div class="col-sm-8"><?=date('d-m-Y h:i A', strtotime($record->created_at))?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Last Updated</b></div>
                                                        <div class="col-sm-8"><?=date('d-m-Y h:i A', strtotime($record->updated_at))?></div>
                                                    </div-->

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
                                                        @if($record->commissioned_date != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Commissioned Date</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->commissioned_date))?></div>
                                                        </div>
                                                        @endif
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Complaint Nature</b></div>
                                                            <?php $complaint_nature = $record->complaint_nature;
                                                                        $newcomplaint_nature = wordwrap($complaint_nature, 60, "\n", true);?>
                                                            <div class="col-sm-8">{!! nl2br(e($newcomplaint_nature)) !!}</div>
                                                        </div>
                                                        @if($record->outgoing_load != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Outgoing Load</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->outgoing_load)?></div>
                                                        </div>
                                                        @endif
                                                        @if($record->relay_make_type != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Relay Make&Type</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->relay_make_type)?></div>
                                                        </div>
                                                        @endif
                                                        @if($record->cable_length != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Cable Length</b></div>
                                                            <div class="col-sm-8">{{$record->cable_length}}</div>
                                                        </div>
                                                        @endif
                                                        @if($record->fault_current != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Fault Current</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->fault_current)?></div>
                                                        </div>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    
                                                    <div class="card-body card-padding pd-10-20">
                                                        @if($record->vcb_interlock != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>VCB Interlock Condition</b></div>
                                                            <div class="col-sm-8">{!! nl2br(e($record->vcb_interlock)) !!}</div>
                                                        </div>
                                                        @endif
                                                        @if($record->after_commissioned != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-5"><i class="zmdi "></i><b>Any Mod. Aftr Commisioning</b></div>
                                                            <div class="col-sm-7"><?=nl2br($record->after_commissioned)?></div>
                                                        </div>
                                                        @endif
                                                        @if($record->event_before_failure != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Event Before Failure</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->event_before_failure)?></div>
                                                        </div>
                                                        @endif
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Warranty</b></div>
                                                            <div class="col-sm-8"><?php if($record->warrenty == 0){echo'With Warranty';}else{echo' Without Warranty';} ?></div>
                                                        </div>
                                                        @if($record->date_supply != "")
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Panel Supply Date</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->date_supply))?></div>
                                                        </div>
                                                        @endif
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Complaint Status</b></div>
                                                            <div class="col-sm-8"><?php if($record->document_status == 0){echo'<div class="c-red f-20">Draft</div>';}else if($record->document_status == 1) {echo '<div class="c-orange f-20">In-Progress</div>';} else if($record->document_status == 2) {echo '<div class="c-green f-20">Completed</div>';} else {echo '<div class="c-yellow f-20">Cancelled</div>';}?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Remark/Comments</b></div>
                                                            <div class="col-sm-8">{!! nl2br(e($record->remark)) !!}</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    
                                </div>
                                
                                <div id="modalservice">
                                    <div id="modalservice1">
                                        <div class="modal fade completeform" id="completeform" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Complete Form</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="form-group col-sm-6">
                                                                        <label for="comp_status" class="control-label col-sm-4">Complaint Status</label>
                                                                        <div class="col-sm-8">
                                                                            <div class="fg-line">
                                                                                <select class="selectpicker form-control input-sm" placeholder="Type" name="comp_status" id="comp_status">    
                                                                                    <option value="0">Solved By Call/Email</option>
                                                                                    <option value="1">Depute Engineer</option>
                                                                                    <!--option value="5">Rectified And Return</option>
                                                                                    <!--option value="3">Spares Only</option>
                                                                                    <option value="4">Spares With Depute Site Engineer</option-->
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        <label for="remark" class="control-label col-sm-4">Remark</label>
                                                                        <div class="col-sm-8">
                                                                            <div class="fg-line">
                                                                                <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Remark" name="remark" id="remark" data-validation="required" required="required"></textarea>                                        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                        
                                                                    <div class="spdet m-t-20">
                                                                        <div class="form-group col-sm-12">
                                                                            <label for="failure_cause" class="control-label col-sm-5">Probable Cause of Failure</label>
                                                                            <div class="col-sm-7">
                                                                                <div class="fg-line">
                                                                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Probable Cause of Failure" name="failure_cause" id="failure_cause"  ></textarea>                                        
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-sm-12 sow">
                                                                            <label for="scope_of_work" class="control-label col-sm-4">Scope Of Work</label>
                                                                            <div class="col-sm-2">
                                                                                <div class="fg-line">
                                                                                    <div class="checkbox pull-left">
                                                                                        <label>
                                                                                            <input type="checkbox" name="scope_of_work[]" value="General Service">
                                                                                            <i class="input-helper">General Service</i>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="checkbox pull-left">
                                                                                        <label>
                                                                                            <input type="checkbox" name="scope_of_work[]" value="Assessment">
                                                                                            <i class="input-helper">Assessment</i>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="checkbox pull-left">
                                                                                        <label>
                                                                                            <input type="hidden" id="amcval" value='0'>
                                                                                            <input type="checkbox" name="scope_of_work[]" id="amc" value="AMC">
                                                                                            <i class="input-helper">AMC</i>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <div class="fg-line">

                                                                                    <div class="checkbox pull-left">
                                                                                         <label>
                                                                                            <input type="checkbox" name="scope_of_work[]" value="Spares Fixing">
                                                                                            <i class="input-helper">Spares Fixing</i>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="checkbox  pull-left">

                                                                                        <label>
                                                                                            <input type="checkbox" name="scope_of_work[]" value="Commissioning">
                                                                                            <i class="input-helper">Commissioning</i>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="checkbox  pull-left">

                                                                                        <label>
                                                                                            <input type="hidden" id="othrval" value='0'>
                                                                                            <input type="checkbox" name="scope_of_work[]" id="othersscope"  value="Others">
                                                                                            <i class="input-helper">Others</i>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-2">
                                                                                <div class="fg-line">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <input type="checkbox" name="scope_of_work[]" value="Fault Rectification">
                                                                                            <i class="input-helper">Fault Rectification</i>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="fg-line">
                                                                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Scope Of Work" name="scope_of_work_o" readonly="true" id="scope_of_work"  ></textarea>                                        
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-sm-12">
                                                                            <label for="department" class="control-label col-sm-5">Department</label>
                                                                            <div class="col-sm-7">
                                                                                <div class="fg-line">
                                                                                    <select class="selectpicker form-control input-sm" placeholder="Department" name="department" id="department">    
                                                                                        <option value=""></option>
                                                                                        <option value="VCB">VCB</option>
                                                                                        <option value="CT/PT/Spout">CT/PT/Spout</option>
                                                                                        <option value="Relay">Relay</option>
                                                                                        <option value="Railway">Railway</option>
                                                                                        <option value="RMU">RMU</option>
                                                                                        <option value="Projects">Projects</option>
                                                                                        <option value="Transformer">Transformer</option>
                                                                                        <option value="Sensor">Sensor</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-sm-12">
                                                                            <div class="card card-body">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12 text-center">
                                                                                        <h4>Service Billing Details</h4>
                                                                                    </div>
                                                                                </div>
                                                                                <form>
                                                                                    <div class="appsersecond" >

                                                                                    </div>
                                                                                </form>
                                                                                <div class="form-row m-t-25 pull-right">
                                                                                    <button type="button" class="addspline btn bgm-green"><i class="zmdi zmdi-plus"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-sm-12">
                                                                            <div class="card card-body">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12 text-center">
                                                                                        <h4>Offer Details</h4>
                                                                                    </div>
                                                                                </div>
                                                                                <form>
                                                                                    <div class="offersecond" >
                                                                                        <div class="modal-body">
                                                                                            <div class="row m-l-10" role="form">
                                                                                                <div class="form-group col-sm-4">
                                                                                                    <label for="offervalidity" class="control-label col-sm-4 required">Validity</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="fg-line">
                                                                                                            <input type="hidden" name="revision_no" id="revision_no" value="0">
                                                                                                            <select class="form-control input-sm" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="offervalidity" name="offervalidity">
                                                                                                                @foreach($offervalidity as $offerval=>$offername)
                                                                                                                    <option value="{{$offerval}}">{{$offername}}</option>
                                                                                                                @endforeach
                                                                                                            </select>  
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-sm-8">
                                                                                                    <label for="terms" class="control-label col-sm-1">Terms</label>
                                                                                                    <div class="col-sm-11">
                                                                                                        <div class="fg-line">
                                                                                                            <textarea class="form-control input-sm" cols="20" rows="13" placeholder="Terms" name="terms" id="terms"  >{{$terms}}</textarea>                                        
                                                                                                        </div>
                                                                                                        <div class="termsdiv hide">{{$terms}}</div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>    
                                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row form-group ">
                                                                <div class="col-sm-12 m-t-25">
                                                                    <button type="button" id="teruser" class="teruser btn bgm-cyan col-sm-offset-5 col-sm-2"><i>Submit</i></button>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="appserfirst" >
                                                                <div class="row m-l-10" role="form">
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group form-group fg-line">

                                                                            <label class="sr-only" for="product">Product</label>
                                                                            <input type="hidden" class="product_id" name="product_id" />
                                                                            <input type="text" class="form-control input-sm product f-10" name="product" placeholder="Product" autocomplete="off">
                                                                            <span class="input-group-addon last "><i class="zmdi zmdi-search"></i></span>                                                                    
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-1">
                                                                        <div class="form-group fg-line">
                                                                            <label class="sr-only" for="qty">Qty</label>
                                                                            <input type="text" class="form-control input-sm qty f-10" name="qty" placeholder="Qty" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label class="sr-only" for="amount">Price</label>
                                                                            <input type="text" class="form-control input-sm amount f-10" name="amount" placeholder="Amount" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label class="sr-only" for="tax">Tax</label>
                                                                            <select class="form-control input-sm tax_id f-10" placeholder="Tax"  name="tax_id">
                                                                                <option value="3">No Tax</option>
                                                                                <option value="1">GST 18%</option>
                                                                                <option value="2">CGST9% + SGST9%</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label class="sr-only" for="total">Total</label>
                                                                            <input type="hidden" class="form-control input-sm tax_amt f-10" name="tax_amt" >
                                                                            <input type="text" class="form-control input-sm total f-10" name="total" readonly placeholder="Price">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-1">
                                                                        <button type="button" class="btn btn-primary btn-sm m-t-5 waves-effect prdclose"><i class="zmdi zmdi-close"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <!---- AMC Product ----->
                                                            <div class="amcserfirst" >
                                                                <div class="row m-l-10" role="form">
                                                                    <div class="col-sm-3">
                                                                        <div class="input-group form-group fg-line">

                                                                            <label class="sr-only" for="product">Product</label>
                                                                            <input type="hidden" class="product_id" name="product_id[1]" value=""/>
                                                                            <input type="text" class="form-control input-sm f-10" readonly name="product[1]" placeholder="Product" autocomplete="off" value="AMC">
                                                                                                                                             
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label class="sr-only" for="qty">No Of visits</label>
                                                                            <input type="text" class="form-control input-sm amc_qty f-10" name="qty[1]" placeholder="No Of Visits" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label class="sr-only" for="amount">Price</label>
                                                                            <input type="text" class="form-control input-sm amc_amount f-10" name="amount[1]" placeholder="Amount" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label class="sr-only" for="tax">Tax</label>
                                                                            <select class="form-control input-sm amc_tax_id f-10" placeholder="Tax"  name="tax_id[1]">
                                                                                <option value="3">No Tax</option>
                                                                                <option value="1">GST 18%</option>
                                                                                <option value="2">CGST9% + SGST9%</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label class="sr-only" for="total">Total</label>
                                                                            <input type="hidden" class="form-control input-sm amc_tax_amt f-10" name="tax_amt[1]" >
                                                                            <input type="text" class="form-control input-sm amc_total f-10" name="total[1]" readonly placeholder="Price">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right  m-t-25"><i class="zmdi zmdi-close"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="modal3">

                                    </div>
                                    <div id="modalserprd">
                                        <div id="modalserprd2">
                                            <div class="modal fade" id="serproductform" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4>Search Billing Product</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table id="data-table-command" class="table table-striped table-vmiddle">
                                                                <thead>
                                                                    <tr>
                                                                        <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                                                        <th data-column-id="radiob"></th>  
                                                                        <th data-column-id="name">Name</th>
                                                                        <th data-column-id="hsn" >HSN</th>     
                                                                        <th data-column-id="price" >Price</th>     
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($modelData as $item)
                                                                        <tr>
                                                                            <td>{{$item->id}}</td>
                                                                            <td><input class="prdradio" type="radio" name="productid" value="{{$item->id}}"></td>
                                                                            <td class="pname">{{$item->name}}</td>
                                                                            <td class="hsn">{{$item->hsn}}</td>
                                                                            <td class="amount">{{$item->amount}}</td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>                 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="modalser5">

                                    </div>
