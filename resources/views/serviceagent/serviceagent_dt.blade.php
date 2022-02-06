                                    
                                    <h2>{{strtoupper($record->company_name)}}</h2>
                                    
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
                                                            <li class="ng-binding"><i class="zmdi zmdi-email"></i> {{$record->emailid}}</li>
                                                           @if($record->contact_person == "") @else <li class="ng-binding"><i class="zmdi zmdi-account-box-phone"></i> {{$record->contact_person}}</li> @endif


                                                            <li>
                                                                <i class="zmdi zmdi-pin"></i>
                                                                <address class="m-b-0 ng-binding">
                                                                    {{$record->address1}},<br>
                                                                    {{$record->address2}},<br>
                                                                    {{$record->city}}&nbsp;-&nbsp;{{$record->pincode}},<br>
                                                                    {{$record->state}},<br>
                                                                    {{$record->country}}.                                      
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
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>PAN No</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->panno)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Region</b></div>
                                                        <div class="col-sm-8">@if($record->region)<?=nl2br($record->region->region_name)?>@endif</div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Status</b></div>
                                                        <div class="col-sm-8"><?php if($record->status == 0){echo'InActive';}else{echo'Active';} ?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
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
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                