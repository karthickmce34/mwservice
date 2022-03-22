                                    
                        <div class="c-white" style="font-size: 30px;"><b>{{strtoupper($record->visitplan->compreg->customer_name)}}</b></div>

                                    <div class="ptih-title">
                                        <div >
                                            <em class="m-r-25">Complaint Document No : {{$record->visitplan->compreg->seqno}}</em>
                                            &nbsp;<em class="m-l-25">Registered Date : <?= date('d-m-Y', strtotime($record->visitplan->compreg->complaint_date)) ?></em>

                                        </div>
                                        <div class="text-center">
                                        </div> 

                                    </div>
                                    
                                </div>
                                
                                <div class="pti-body text-left">
                                    <div class="row">
                                        
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header ch-alt">
                                                    <h2>
                                                        Visitplan Summary 
                                                    </h2>
                                                </div>
                                                
                                                @if($record->is_agent == 1)
                                                <div class="col-sm-6">
                                                    <div class="card-body card-padding pd-10-20">
                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;"> 
                                                            
                                                            <div class="pmo-contact">        
                                                                <ul>
                                                                    <li class="ng-binding"><i class="zmdi zmdi-account"></i> {{$record->visitplan->agent->company_name}}</li>
                                                                    <li class="ng-binding"><i class="zmdi zmdi-smartphone-iphone"></i> {{$record->visitplan->agent->mobileno}}</li>
                                                                    <li class="ng-binding"><i class="zmdi zmdi-email"></i> {{$record->visitplan->agent->emailid}}</li>

                                                                    <li>
                                                                        <i class="zmdi zmdi-pin"></i>
                                                                        <address class="m-b-0 ng-binding">
                                                                            {{$record->visitplan->agent->address1}},<br>
                                                                            {{$record->visitplan->agent->address2}},<br>
                                                                            {{$record->visitplan->agent->city}}&nbsp;-&nbsp;{{$record->visitplan->agent->pincode}},<br>
                                                                            {{$record->visitplan->agent->state}},<br>
                                                                            {{$record->visitplan->agent->country}}.                                      
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
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->date_of_attend))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Attended To</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->date_of_complete))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Work Description</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->work_description)?></div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                                
                                                @else
                                                <div class="col-sm-6">
                                                    <div class="card-body card-padding pd-10-20">
                                                        
                                                        <div class="row" style="    padding: 8px 0 8px 0px;"> 
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Engineers Name</b></div>
                                                            <div class="col-sm-8">@foreach($record->visitplan->visitengs as $index =>$visiteng)
                                                                                    {{$visiteng->engineer->name}},
                                                                                @endforeach</div>
                                                        </div>
                                                      
                                                        <div class="row" style="    padding: 8px 0 8px 0px;"> 
                                                            
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Departure Date</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->visitplan->date_of_depature))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Return Date</b></div>
                                                            <div class="col-sm-8"><?=date('d-m-Y', strtotime($record->visitplan->date_of_return))?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Days In Site</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->visitplan->days_site)?></div>
                                                        </div>
                                                        <!--div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Total Expenses</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->visitplan->total_expenses)?></div>
                                                        </div-->
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Contact Person</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->visitplan->contact_person)?></div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    
                                                    <div class="card-body card-padding pd-10-20">
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></div>
                                                            <div class="col-sm-4 text-center"></i><b>Planned Expenses</b></div>
                                                            <div class="col-sm-4 text-center"></i><b>Actual Expenses</b></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Lodging Expenses</b></div>
                                                            <div class="col-sm-4 text-center"><?=nl2br($record->visitplan->loading_expenses)?></div>
                                                            <div class="col-sm-4 text-center"><?=nl2br($record->loading_expenses)?></div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Boarding Expenses</b></div>
                                                            <div class="col-sm-4 text-center">{!! nl2br(e($record->visitplan->boarding_expenses)) !!}</div>
                                                            <div class="col-sm-4 text-center">{!! nl2br(e($record->boarding_expenses)) !!}</div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4 "><i class="zmdi "></i><b>Travel Expenses</b></div>
                                                            <div class="col-sm-4 text-center">{!! nl2br(e($record->visitplan->travel_expenses)) !!}</div>
                                                            <div class="col-sm-4 text-center">{!! nl2br(e($record->travel_expenses)) !!}</div>
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Local Conveyance</b></div>
                                                            <div class="col-sm-4 text-center">{!! nl2br(e($record->visitplan->local_conveyance)) !!}</div>
                                                            <div class="col-sm-4 text-center">{!! nl2br(e($record->local_conveyance)) !!}</div>
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
                                                        </div>
                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Service Report</b></div>
                                                            <div class="col-sm-8"><a style="width: inherit;" href="{{url('/')}}/{{$record->file_path}}/{{$record->file_name}}" tabindex="_self">{{$record->file_name}}</a></div>
                                                        </div-->
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
