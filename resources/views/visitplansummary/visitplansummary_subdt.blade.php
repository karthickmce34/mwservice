        
        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
            <div class="panel panel-collapse">
                <div class="panel-heading color-block bgm-cyan" role="tab" id="headingDescription">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDescription" aria-expanded="false" aria-controls="collapseOne">
                            Work Description (On Site)
                        </a>
                    </h4>
                </div>
                <div id="collapseDescription" class="collapse" role="tabpanel" aria-labelledby="headingDescription">
                    <div class="panel-body p-10">
                        <div class="row ">  
                            <div class="col-sm-12">
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-head card-padding pd-10-20">
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Description</b></div>
                                                        <div class="col-sm-8">{{$record->work_description}}</div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Service Report</b></div>
                                                        <div class="col-sm-8"><a style="width: inherit;" href="{{url('/')}}/{{$record->file_path}}/{{$record->file_name}}" tabindex="_self">{{$record->file_name}}</a></div>
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
            </div>
        </div>
        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
            <div class="panel panel-collapse">
                <div class="panel-heading color-block bgm-blue" role="tab" id="headingProduct">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseProduct" aria-expanded="false" aria-controls="collapseOne">
                            Service Product (On Site)
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
                                    @if(($record->visitsummaryProduct))
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-head card-padding pd-10-20">
                                                        <div class="row c-black" style="padding: 8px 0 8px 0px;">
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
                                                            <div class="col-sm-3 ">
                                                                            Image                                                       
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body card-padding pd-10-20">
                                                @foreach($record->visitsummaryProduct as $registerprd)
                                                    <?php $n++; ?>
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4 text-center">
                                                                            {{$registerprd->product}}                                                       
                                                            </div>
                                                            <div class="col-sm-1 text-center">
                                                                            {{$registerprd->unit_price}}                                                       
                                                            </div>
                                                            <div class="col-sm-1 ">
                                                                            {{$registerprd->qty}}                                                       
                                                            </div>
                                                            <div class="col-sm-1 ">
                                                                            {{$registerprd->amount}}                                                       
                                                            </div>
                                                            <div class="col-sm-3 text-center">@if($registerprd->file_path == "")  @else
                                                                <img style="width: inherit;" src="{{url('/')}}/{{$registerprd->file_path}}/{{$registerprd->file_name}}" /> @endif
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
                            Site Inspection Detail
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
                                    @if(($record->visitlines))
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-head card-padding pd-10-20">
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-1 c-black text-center">Sno</div>
                                                            <div class="col-sm-3 c-black text-center">Things To Do</div>
                                                            <div class="col-sm-3 c-black text-center">Remarks</div>
                                                            <div class="col-sm-2 c-black text-center">Is Checked</div>
                                                            <div class="col-sm-3 c-black text-center">Upload Image</div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body card-padding pd-10-20">
                                                @foreach($record->visitlines as $visitline)
                                                    <?php $n++; ?>
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-1 c-black text-center">{{$n}}</div>
                                                            <div class="col-sm-3 text-center">{{$visitline->thingstodo->things_to_do}}</div>
                                                            <div class="col-sm-3 text-center">{{$visitline->remarks}}</div>
                                                            <div class="col-sm-2 text-center">@if($visitline->ischecked == 1) Checked @else Not Checked @endif</div>
                                                            <div class="col-sm-3 text-center">@if($visitline->file_path == "")  @else
                                                                <img style="width: inherit;" src="{{url('/')}}/{{$visitline->file_path}}/{{$visitline->file_name}}" /> @endif
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
                                    @if(($record->visitplan->servicespare->prdtakens))
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
                                                @foreach($record->visitplan->servicespare->prdtakens as $prdtaken)
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
                <div class="panel-heading color-block bgm-cyan" role="tab" id="headingAduit">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAduit" aria-expanded="false" aria-controls="collapseTwo">
                            Site Documents and Photos
                        </a>
                    </h4>
                </div>
                <div id="collapseAduit" class="collapse" role="tabpanel" aria-labelledby="headingAduit">
                    <div class="panel-body p-10">
                        <div class="p-5 pull-right mm-55-0">
                            <a href="{{url('visitplansummary/addphoto', $record->id)}}" target="_self">
                                <button class="btn bgm-lime btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></button>                                    
                            </a>
                        </div>
                        <div class="row ">  
                            <div class="col-sm-12">
                                <?php
                                $crrDate = date("Y-m-d");
                                $activestatus = "";
                                $active = "";
                                $n = 0;
                                $m = 0;
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->visitplan->visitaudits))
                                        <div class="row">
                                        @foreach($record->visitplan->visitaudits as $visitaudit)
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
                                                                <a href="{{url('visitplan/editphoto', $visitaudit->id)}}" target="_self">
                                                                    <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit"></i></button>
                                                                </a>
                                                                <a href="{{url('visitplan/deletephoto', $visitaudit->id)}}" target="_self">
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
                                    <div class="row">
                                        @foreach($record->visitsummaryAsset as $visitsummaryAsset)
                                            <?php $n++; ?>
                                            
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-body card-padding pd-10-20">
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-2">{{$visitsummaryAsset->name}}</div>
                                                            <div class="col-sm-4 ">
                                                                @if($visitsummaryAsset->file_type == 0)
                                                                    <img style="width: inherit;" src="{{url('/')}}/{{$visitsummaryAsset->file_path}}/{{$visitsummaryAsset->file_name}}" />
                                                                @else
                                                                    <a style="width: inherit;" href="{{url('/')}}/{{$visitsummaryAsset->file_path}}/{{$visitsummaryAsset->file_name}}" tabindex="_self">{{$visitsummaryAsset->file_name}}<a/>
                                                                @endif                                                                    
                                                            </div>
                                                            <div class="col-sm-2 text-center">
                                                                <a href="{{url('visitplansummary/editphoto', $visitsummaryAsset->id)}}" target="_self">
                                                                    <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit"></i></button>
                                                                </a>
                                                                <a href="{{url('visitplansummary/deletephoto', $visitsummaryAsset->id)}}" target="_self">
                                                                    <button class="btn bgm-red btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-close"></i></button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @foreach($record->visitplan->servicespare->registeraudits as $registeraudit)
                                        <?php $m++; ?>
                                            
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-body card-padding pd-10-20">
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-2">{{$registeraudit->name}}</div>
                                                            <div class="col-sm-4 ">
                                                                @if($registeraudit->file_type == 0)
                                                                    <img style="width: inherit;" src="{{url('/')}}/{{$registeraudit->file_path}}/{{$registeraudit->file_name}}" />
                                                                @else
                                                                    <a style="width: inherit;" href="{{url('/')}}/{{$registeraudit->file_path}}/{{$registeraudit->file_name}}" tabindex="_self">{{$registeraudit->file_name}}<a/>
                                                                @endif                                                                    
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        