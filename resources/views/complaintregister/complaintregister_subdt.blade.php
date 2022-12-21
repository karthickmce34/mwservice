        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
            <div class="panel panel-collapse">
                <div class="panel-heading color-block bgm-teal" role="tab" id="headingAduit">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAduit" aria-expanded="false" aria-controls="collapseTwo">
                            Complaint Register Audit
                        </a>
                    </h4>
                </div>
                <div id="collapseAduit" class="collapse" role="tabpanel" aria-labelledby="headingAduit">
                    <div class="panel-body p-10">
                        <div class="p-5 pull-right mm-55-0">
                            <a href="{{url('complaintregister/addnew', $record->id)}}" target="_self">
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
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->registeraudits))
                                        <div class="row">
                                        @foreach($record->registeraudits as $registeraudit)
                                            <?php $n++; ?>
                                            
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
                                                            <div class="col-sm-2 text-center">
                                                                <a href="{{url('complaintregister/editdoc', $registeraudit->id)}}" target="_self">
                                                                    <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit"></i></button>
                                                                </a>
                                                                <a href="{{url('complaintregister/deletedoc', $registeraudit->id)}}" target="_self">
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
        @if($record->servicereg)
            @if($record->document_status == 1 || $record->document_status == 2)
            <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                <div class="panel panel-collapse">
                    <div class="panel-heading color-block bgm-cyan" role="tab" id="headingServiceAduit">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseServiceAduit" aria-expanded="false" aria-controls="collapseTwo">
                                Service Register Details
                            </a>
                        </h4>
                    </div>
                    <div id="collapseServiceAduit" class="collapse" role="tabpanel" aria-labelledby="headingServiceAduit">
                        <div class="panel-body p-10">
                            <div class="p-5 pull-right mm-55-0">
                                <a href="{{url('servicespareregister', $record->servicereg->id)}}" target="_self">
                                    <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-view-web"></i></button>                                    
                                </a>
                            </div>
                            <div class="row ">  
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header ch-alt ">
                                            <h4>Offer Details</h4>
                                        </div>
                                        <div class="card-body m-t-5 p-5">
                                            <!--- Product----->
                                                @php
                                                    $offercnt = 0;
                                                @endphp

                                            @foreach($record->servicereg->offerdata as $offerdata)
                                                @php
                                                    $offercnt=$offercnt+1;
                                                @endphp
                                                @if($record->servicereg->final_offer_id == $offerdata->id)
                                                    @php 
                                                        $color = 'bgm-cyan'; 
                                                        $btn = '';
                                                    @endphp
                                                @else 
                                                    @php 
                                                        $color = 'bgm-gray'; 
                                                        $btn = '';
                                                        $btn = '';// Due to make last as default we set again btn as empty
                                                     @endphp
                                                @endif

                                            <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">

                                                <div class="panel panel-collapse">
                                                    <div class="panel-heading color-block {{$color}}" role="tab" id="headingOffer">

                                                        <h4 class="panel-title">
                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionOffer" href="#{{$offerdata->revision_no}}" aria-expanded="false" aria-controls="collapseZero">

                                                                Revision - {{$offerdata->revision_no}}
                                                            </a>
                                                        </h4>
                                                    </div>

                                                    <div id="{{$offerdata->revision_no}}" class="collapse" role="tabpanel" aria-labelledby="headingOffer" style="background-color: #e6f9ff">
                                                        @php echo $btn; @endphp
                                                        <div class="p-5"> <!-- panel-body -->
                                                            @if($record->servicereg->complaint_type == 1)
                                                            <div class="m-t-5" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                                                                <div class="panel panel-collapse">
                                                                    <div class="panel-heading color-block bgm-orange" role="tab" id="headingTerms">
                                                                        <h4 class="panel-title ">
                                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionOffer" href="#collapseTerms-{{$offerdata->revision_no}}" aria-expanded="false" aria-controls="collapseOne">
                                                                                Terms and Conditions
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseTerms-{{$offerdata->revision_no}}" class="collapse" role="tabpanel" aria-labelledby="headingTerms">
                                                                        <div class="panel-body p-10">

                                                                            <div class="row ">  
                                                                                <div class="col-sm-12">
                                                                                    <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                                                                        @if(($offerdata))
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="card" style="overflow: auto;">

                                                                                                        <div class="card-body card-padding pd-10-20">
                                                                                                            <textarea cols="130" rows="15" disabled>{{$offerdata->terms}}</textarea>
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
                                                            <div class="m-t-5" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                                                                <div class="panel panel-collapse">
                                                                    <div class="panel-heading color-block bgm-blue" role="tab" id="headingProduct">
                                                                        <h4 class="panel-title ">
                                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionOffer" href="#collapseProduct-{{$offerdata->revision_no}}" aria-expanded="false" aria-controls="collapseOne">
                                                                                Material To Be Supply
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseProduct-{{$offerdata->revision_no}}" class="collapse" role="tabpanel" aria-labelledby="headingProduct">
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
                                                                                        @if(($offerdata->registerprds))
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="card" style="overflow: auto;">
                                                                                                        <div class="card-head card-padding pd-10-20">
                                                                                                            <div class="row c-black">
                                                                                                                <div class="col-sm-3 f-10 text-center">
                                                                                                                                Product Name                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-3 f-10 text-center">
                                                                                                                                Description                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 text-center">
                                                                                                                                Unit Price                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 text-center">
                                                                                                                                Quantity                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 text-center">
                                                                                                                                Discount                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 f-10 text-center">
                                                                                                                                Tax                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 f-12 text-center">
                                                                                                                                Total                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 f-10text-center">
                                                                                                                    Comments
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="card-body card-padding pd-10-20">
                                                                                                    @foreach($offerdata->registerprds as $registerprd)
                                                                                                        <?php $n++; ?>
                                                                                                            <div class="row" >
                                                                                                                <div class="col-sm-3 f-10 text-center">
                                                                                                                    @if($registerprd->product)
                                                                                                                        {{$registerprd->product->name}}
                                                                                                                    @else 
                                                                                                                       {{$registerprd->prd_description}}
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                                <div class="col-sm-3 f-10 text-center">
                                                                                                                                {{$registerprd->description}}                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 text-center">
                                                                                                                                {{$registerprd->unit_price}}                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 text-center">
                                                                                                                                {{$registerprd->quantity}}                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 text-center">
                                                                                                                                {{$registerprd->discount}}                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 f-10 text-center">
                                                                                                                                {{$registerprd->tax->tax_name}}                                                       
                                                                                                                </div>
                                                                                                                <div class="col-sm-1 f-12 text-center">
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
                                                            @endif
                                                            <!--- Service Charge----->
                                                            @if($record->servicereg->complaint_type != 1)
                                                            <div class="m-t-5" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                                                                <div class="panel panel-collapse">
                                                                    <div class="panel-heading color-block bgm-orange" role="tab" id="headingTerms">
                                                                        <h4 class="panel-title ">
                                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionOffer" href="#collapseTerms-{{$offerdata->revision_no}}" aria-expanded="false" aria-controls="collapseOne">
                                                                                Terms and Conditions
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseTerms-{{$offerdata->revision_no}}" class="collapse" role="tabpanel" aria-labelledby="headingTerms">
                                                                        <div class="panel-body p-10">

                                                                            <div class="row" >  
                                                                                <div class="col-sm-12">
                                                                                    <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                                                                        @if(($offerdata))
                                                                                            <div class="row">
                                                                                                <div class="p-5 pull-right mm-55-0">

                                                                                                </div>
                                                                                                <div class="col-sm-10">
                                                                                                    <div class="card" style="overflow: auto;">

                                                                                                        <div class="form-group col-sm-10">
                                                                                                            <label for="offerdate_{{$offerdata->id}}" class="control-label col-sm-2 ">Date</label>
                                                                                                            <div class="col-sm-10">
                                                                                                                <div class="fg-line">
                                                                                                                    <input type="text" name="terms" readonly id='offerdate_{{$offerdata->id}}' value="{{$offerdata->offer_date}}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group col-sm-10">
                                                                                                            <label for="offerdate_{{$offerdata->id}}" class="control-label col-sm-2 ">Terms</label>
                                                                                                            <div class="col-sm-10">
                                                                                                                <div class="fg-line">
                                                                                                                    <textarea cols="90" rows="15" name="terms" id="terms_{{$offerdata->id}}" readonly>{{$offerdata->terms}}</textarea>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-2 m-t-25">
                                                                                                    <div class="offerdetailsedit m-t-25">

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
                                                            <div class="m-t-5" data-collapse-color="yellow" role="tablist" aria-multiselectable="true">
                                                                <div class="panel panel-collapse">
                                                                    <div class="panel-heading color-block bgm-teal" role="tab" id="headingService">
                                                                        <h4 class="panel-title">
                                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionOffer" href="#collapseService-{{$offerdata->revision_no}}" aria-expanded="false" aria-controls="collapseThree">
                                                                                Service Charges
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseService-{{$offerdata->revision_no}}" class="collapse" role="tabpanel" aria-labelledby="headingService">
                                                                        <div class="panel-body p-10">

                                                                            <div class="row servicedetail">  
                                                                                <div class="col-sm-12">
                                                                                    <?php
                                                                                    $crrDate = date("Y-m-d");
                                                                                    $activestatus = "";
                                                                                    $active = "";
                                                                                    $n = 0;
                                                                                    ?>
                                                                                    <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                                                                        @if(($offerdata->registerprds))
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="card">
                                                                                                        <div class="card-head card-padding pd-10-20">
                                                                                                            <div class="row" style="padding: 8px 0 8px 0px;">
                                                                                                                <div class="col-sm-3 text-center c-black">Description</div>
                                                                                                                <div class="col-sm-1 text-center c-black">No of Days</div>
                                                                                                                <div class="col-sm-2 text-center c-black">Cost/Day</div>
                                                                                                                <div class="col-sm-2 text-center c-black">Tax</div>
                                                                                                                <div class="col-sm-2 text-center c-black">Total</div>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="card-body card-padding pd-10-20">
                                                                                                    @foreach($offerdata->registerprds as $sercharge)
                                                                                                        <?php $n++; ?>
                                                                                                            <div class="row" style="padding: 8px 0 8px 0px;">
                                                                                                                <div class="col-sm-3 text-center">{{$sercharge->prd_description}}</div>
                                                                                                                <div class="col-sm-1 text-center">{{$sercharge->quantity}}</div>
                                                                                                                <div class="col-sm-2 text-center">{{$sercharge->unit_price}}</div>
                                                                                                                <div class="col-sm-2 text-center">{{$sercharge->tax->tax_name}}</div>
                                                                                                                <div class="col-sm-2 text-center">{{$sercharge->total_price}}</div>

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
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                            <div class="offercnt" data-cnt="{{$offercnt}}"></div>               
                                        </div>
                                    </div>
                                    @foreach($record->servicereg->visitplan as $visitplan)
                                        <div class="card">
                                            <div class="card-header ch-alt ">
                                                <h4>Visitplan &nbsp; - &nbsp; {{$visitplan->date_of_depature}} &nbsp; to &nbsp; {{$visitplan->date_of_return}}</h4>
                                            </div>
                                            <div class="card-body">
                                                @if($record->servicereg->complaint_type != 1)
                                                    @if(($record->servicereg->site_depute == 1))
                                                    <div class="panel-group" data-collapse-color="yellow" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse">
                                                            <div class="panel-heading color-block bgm-lightblue" role="tab" id="headingThingtodo-{{$visitplan->id}}">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEngineer-{{$visitplan->id}}" aria-expanded="false" aria-controls="collapseOne">
                                                                        Site Engineer Details
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseEngineer-{{$visitplan->id}}" class="collapse" role="tabpanel" aria-labelledby="headingEngineer-{{$visitplan->id}}">
                                                                <div class="panel-body p-10">

                                                                     <div class="row">  
                                                                         <div class="col-sm-12">

                                                                         </div>
                                                                     </div>
                                                                    <div class="row engineerdetail">  
                                                                        <div class="col-sm-12">
                                                                            <?php
                                                                            $crrDate = date("Y-m-d");
                                                                            $activestatus = "";
                                                                            $active = "";
                                                                            $n = 0;
                                                                            ?>
                                                                            <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="card">
                                                                                            <div class="card-body card-padding pd-10-20">
                                                                                                <div class="contacts clearfix row">

                                                                                                    @if($visitplan->is_agent ==0)
                                                                                                        @if($visitplan->visitengs)
                                                                                                            @foreach($visitplan->visitengs as $visiteng)
                                                                                                                <?php $n++; ?>
                                                                                                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                                                                                                        <div class="c-item">
                                                                                                                            <a href="" class="ci-avatar">
                                                                                                                                <img src="{{url('/')}}/{{$visiteng->engineer->file_path}}/{{$visiteng->engineer->file_name}}" alt="">
                                                                                                                            </a>
                                                                                                                            <div class="c-info">
                                                                                                                                <strong>{{$visiteng->engineer->name}}</strong>
                                                                                                                                <small>{{$visiteng->engineer->mobileno}}</small>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    @else 
                                                                                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                                                                                            <div class="c-item">
                                                                                                                <a href="" class="ci-avatar">
                                                                                                                    <img src="{{url('/')}}/static/images/business-man.jpg" alt="">
                                                                                                                </a>
                                                                                                                <div class="c-info">
                                                                                                                    <strong>{{$visitplan->agent->company_name}}</strong>
                                                                                                                    <small>{{$visitplan->agent->mobileno}}</small>
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                    </div>
                                                    @endif

                                                <div class="panel-group" data-collapse-color="yellow" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-collapse">
                                                        <div class="panel-heading color-block bgm-lightblue" role="tab" id="headingThingtodo-{{$visitplan->id}}">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThingtodo-{{$visitplan->id}}" aria-expanded="false" aria-controls="collapseOne">
                                                                    Instruction to Check in Site
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseThingtodo-{{$visitplan->id}}" class="collapse" role="tabpanel" aria-labelledby="headingThingtodo-{{$visitplan->id}}">
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
                                                                            @if(($visitplan->thingstodos))
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="card">
                                                                                            <div class="card-head card-padding">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-1 c-black text-center">Sno</div>
                                                                                                    <div class="col-sm-9 c-black text-center">Things To Do</div>
                                                                                                    <!--div class="col-sm-3 c-black">
                                                                                                                    Answer Type                                                       
                                                                                                    </div-->

                                                                                                    <div class="col-sm-2 text-center c-black">
                                                                                                        Comments
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card-body card-padding pd-10-20">
                                                                                        @foreach($visitplan->thingstodos as $thingstodo)
                                                                                            <?php $n++; ?>
                                                                                                <div class="row m-t-5">
                                                                                                    <div class="col-sm-1 text-center">{{$n}}</div>
                                                                                                    <div class="col-sm-9 text-center">{{$thingstodo->things_to_do}}</div>
                                                                                                    <!--div class="col-sm-3">
                                                                                                                    @if($thingstodo->answer_type == 0)
                                                                                                                        Text Box
                                                                                                                    @else 
                                                                                                                        CheckBox
                                                                                                                    @endif
                                                                                                    </div-->


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
                                                        <div class="panel-heading color-block bgm-cyan" role="tab" id="headingThingtodo-{{$visitplan->id}}">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThingtotaken-{{$visitplan->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                                    Tools and Tackles
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseThingtotaken-{{$visitplan->id}}" class="collapse" role="tabpanel" aria-labelledby="headingThingtotaken-{{$visitplan->id}}">
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
                                                                            @if(($visitplan->prdtakens))
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="card">
                                                                                            <div class="card-head card-padding pd-10-20">
                                                                                                <div class="row" style="padding: 8px 0 8px 0px;">
                                                                                                    <div class="col-sm-4 text-center c-black">Things To Taken</div>
                                                                                                    <div class="col-sm-2 text-center c-black">Quantity</div>
                                                                                                    <div class="col-sm-2 text-center c-black">Isreturn</div>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card-body card-padding pd-10-20">
                                                                                        @foreach($visitplan->prdtakens as $prdtaken)
                                                                                            <?php $n++; ?>
                                                                                                <div class="row" style="padding: 8px 0 8px 0px;">
                                                                                                    <div class="col-sm-4 text-center">{{$prdtaken->prd_description}}</div>
                                                                                                    <div class="col-sm-2 text-center">{{$prdtaken->quantity}}</div>
                                                                                                    <div class="col-sm-2 text-center">
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
                                                @endif
                                                <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-collapse">
                                                        <div class="panel-heading color-block bgm-green" role="tab" id="headingAduittow">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAduittwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Documents Upload
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseAduittwo" class="collapse" role="tabpanel" aria-labelledby="headingAduit">
                                                            <div class="panel-body p-10">
                                                                <div class="p-5 pull-right mm-55-0">

                                                                </div>
                                                                <div class="row ">  
                                                                    <div class="col-sm-12">
                                                                        <?php
                                                                        $crrDate = date("Y-m-d");
                                                                        $activestatus = "";
                                                                        $active = "";
                                                                        $n = 0;
                                                                        ?>
                                                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                                                            @if(($visitplan->registeraudits))
                                                                                <div class="row">
                                                                                @foreach($visitplan->registeraudits as $registeraudit)
                                                                                    <?php $n++; ?>

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
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($record->servicereg->order_status == 8 || $record->servicereg->order_status == 11 || $record->servicereg->order_status == 12)
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
                                                                                            @foreach($visitplan->visitsummary as $visitplansum)
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Outgoing Load</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->outgoing_load}}</div>
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Relay Make/Type</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->relay_make_type}}</div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Cable Length/Size</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->cable_length}}</div>
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Fault Current</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->fault_current}}</div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">    
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Interlock Condition</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->vcb_interlock}}</div>
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>After Commissioning</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->after_commissioned}}</div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">    
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Event before Failure</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->event_before_failure}}</div>
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Serial number</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->serial_no}}</div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Transformer Rating</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->transformer_rating}}</div>
                                                                                                    <div class="col-sm-3"><i class="zmdi "></i><b>Others</b></div>
                                                                                                    <div class="col-sm-3">{{$visitplansum->others}}</div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-4"><i class="zmdi "></i><b>Description</b></div>
                                                                                                    <div class="col-sm-8">{{$visitplansum->work_description}}</div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-4"><i class="zmdi "></i><b>Service Report</b></div>
                                                                                                    <div class="col-sm-8"><a style="width: inherit;" href="{{url('/')}}/{{$visitplansum->file_path}}/{{$visitplansum->file_name}}" tabindex="_self">{{$visitplansum->file_name}}</a></div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-4"><i class="zmdi "></i><b>SLD</b></div>
                                                                                                    <div class="col-sm-8 text-center">@if($visitplansum->sld_file_path == "")  @else
                                                                                                        <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$visitplansum->sld_file_path}}/{{$visitplansum->sld_file_name}}" /> @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-4"><i class="zmdi "></i><b>Panel Front</b></div>
                                                                                                    <div class="col-sm-8 text-center">@if($visitplansum->panelfront_file_path == "")  @else
                                                                                                        <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$visitplansum->panelfront_file_path}}/{{$visitplansum->panelfront_file_name}}" /> @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-4"><i class="zmdi "></i><b>Panel Inside</b></div>
                                                                                                    <div class="col-sm-8 text-center">@if($visitplansum->panelinside_file_path == "")  @else
                                                                                                        <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$visitplansum->panelinside_file_path}}/{{$visitplansum->panelinside_file_name}}" /> @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-4"><i class="zmdi "></i><b>Panel Left</b></div>
                                                                                                    <div class="col-sm-8 text-center">@if($visitplansum->panelleft_file_path == "")  @else
                                                                                                        <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$visitplansum->panelleft_file_path}}/{{$visitplansum->panelleft_file_name}}" /> @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                                    <div class="col-sm-4"><i class="zmdi "></i><b>Panel Right</b></div>
                                                                                                    <div class="col-sm-8 text-center">@if($visitplansum->panelright_file_path == "")  @else
                                                                                                        <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$visitplansum->panelright_file_path}}/{{$visitplansum->panelright_file_name}}" /> @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-12">

                                                                                    <div class="card-body card-padding pd-10-20">
                                                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                            <button type="button" data-visitid="{{$visitplan->id}}"  class="btn btn-primary bgm-cyan waves-effect pull-right approve_expense">Approve Expenses</button>                                    
                                                                                        </div>
                                                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                            <div class="col-sm-4"><i class="zmdi "></div>
                                                                                            <div class="col-sm-4 text-center"></i><b>Planned Expenses</b></div>
                                                                                            <div class="col-sm-4 text-center"></i><b>Actual Expenses</b></div>
                                                                                        </div>
                                                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Lodging Expenses</b></div>
                                                                                            <div class="col-sm-4 text-center"><?=nl2br($visitplan->loading_expenses)?></div>
                                                                                            @foreach($visitplan->visitsummary as $visitplansum)
                                                                                            <div class="col-sm-4 text-center"><?=nl2br($visitplansum->loading_expenses)?></div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Boarding Expenses</b></div>
                                                                                            <div class="col-sm-4 text-center">{!! nl2br(e($visitplan->boarding_expenses)) !!}</div>
                                                                                            @foreach($visitplan->visitsummary as $visitplansum)
                                                                                            <div class="col-sm-4 text-center">{!! nl2br(e($visitplansum->boarding_expenses)) !!}</div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                            <div class="col-sm-4 "><i class="zmdi "></i><b>Travel Expenses</b></div>
                                                                                            <div class="col-sm-4 text-center">{!! nl2br(e($visitplan->travel_expenses)) !!}</div>
                                                                                            @foreach($visitplan->visitsummary as $visitplansum)
                                                                                            <div class="col-sm-4 text-center">{!! nl2br(e($visitplansum->travel_expenses)) !!}</div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Local Conveyance</b></div>
                                                                                            <div class="col-sm-4 text-center">{!! nl2br(e($visitplan->local_conveyance)) !!}</div>
                                                                                            @foreach($visitplan->visitsummary as $visitplansum)
                                                                                            <div class="col-sm-4 text-center">{!! nl2br(e($visitplansum->local_conveyance)) !!}</div>
                                                                                            @endforeach
                                                                                        </div>

                                                                                        <div class="row" >       
                                                                                            <div class="col-sm-4"><i class="zmdi "></i><b></b></div>
                                                                                            <div class="col-sm-4 text-center">------------------------</div>
                                                                                            <div class="col-sm-4 text-center">------------------------</div>
                                                                                        </div>
                                                                                        @php

                                                                                        $planned_total=$visitplan->loading_expenses+$visitplan->boarding_expenses+$visitplan->travel_expenses+$visitplan->local_conveyance;
                                                                                        $actual_total=$visitplansum->loading_expenses+$visitplansum->boarding_expenses+$visitplansum->travel_expenses+$visitplansum->local_conveyance;
                                                                                        @endphp
                                                                                        <div class="row">       
                                                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Total</b></div>
                                                                                            <div class="col-sm-4 text-center">{{$planned_total}}</div>
                                                                                            <div class="col-sm-4 text-center">{{$actual_total}}</div>
                                                                                        </div>

                                                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Lodging Bill</b></div>
                                                                                            <div class="col-sm-8 text-center">@if($visitplansum->lodgingbill_file_path == "")  @else
                                                                                                <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$visitplansum->lodgingbill_file_path}}/{{$visitplansum->lodgingbill_file_name}}" /> @endif
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Travel Bill</b></div>
                                                                                            <div class="col-sm-8 text-center">@if($visitplansum->travelbill_file_path == "")  @else
                                                                                                <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$visitplansum->travelbill_file_path}}/{{$visitplansum->travelbill_file_name}}" /> @endif
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
                                                        <div class="panel-heading color-block bgm-gray" role="tab" id="headingSitephoto">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSitephoto" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Site Photos
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseSitephoto" class="collapse" role="tabpanel" aria-labelledby="headingSitephoto">
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
                                                                            <div class="row">
                                                                                @foreach($visitplan->visitsummary as $visitplansum)
                                                                                        @foreach($visitplansum->visitsummaryAsset as $registeraudit)
                                                                                            <?php $n++; ?>
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

                                                                                    @endforeach
                                                                             </div> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                        </div>            
                                        @endforeach 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif