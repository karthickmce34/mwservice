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
                                    @if(($record->visitplan->servicespare->registerprds))
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
                                                @foreach($record->visitplan->servicespare->registerprds as $registerprd)
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
                            Things Done
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
        
        