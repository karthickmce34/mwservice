                                    
<div class="c-white" style="font-size: 30px;"><b>{{strtoupper($record->compreg->customer_name)}}</b></div>
                                    <div class="ptih-title">
                                        <div >
                                            <em class="m-r-25">Document No : {{$record->compreg->seqno}}</em>
                                            &nbsp;<!--em class="m-r-25 m-l-25">TYPE : {{$record->COMPLAINT_TYPE_VALUES[$record->complaint_type]}}</em-->
                                        
                                            &nbsp;<em class="m-l-25 m-r-25">MODE : {{$record->COMPLAINT_MODE_VALUES[$record->compreg->mode_of_complaint]}}</em>
                                            &nbsp;<em class="m-l-25">Registered Date : <?= date('d-m-Y', strtotime($record->compreg->complaint_date)) ?></em>
                                            &nbsp;<em class="m-l-25">Status : @if($record->order_status == 0) Enquiry Received @else @if($record->order_status == 1) Offer Sent @else @if($record->order_status == 2) PO Received  @else @if($record->order_status == 3) PI Sent @else @if($record->order_status == 4) Advance Received @else @if($record->order_status == 5) Payment Received @else @if($record->order_status == 6) DI Sent @else @if($record->order_status == 7) Partially Dispatched @else @if($record->order_status == 8) @if($record->complaint_type == 0) Completed @else Dispatched @endif @else @if($record->order_status == 10) Deputed @else Cancelled @endif @endif @endif @endif @endif @endif @endif @endif @endif @endif</em>
                                        </div>
                                        <div class="text-center">
                                        </div> 

                                    </div>
                                    

                                    <div class="pull-right">

                                        @if($record->complaint_type == 1)
                                            @if($record->order_status == 0)
                                                <div class="header_button">
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-pink waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email"><i class="zmdi zmdi-email"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-blue" role="menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" data-offer="{{$record->final_offer_id}}" class="offeremail "><i class="zmdi zmdi-email"> </i> Offer </a></li>
                                                        </ul>

                                                    </div>
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a>
                                                            </li>
                                                        </ul>
                                                        
                                                    </div>
                                                    <button type="button" data-id="{{$record->id}}"  class="btn btn-primary bgm-cyan waves-effect orderstatus">Status</button>                                    


                                                </div>
                                            @endif
                                            @if($record->order_status == 1)
                                                <div class="header_button">
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-pink waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email"><i class="zmdi zmdi-email"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-blue" role="menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" data-offer="{{$record->final_offer_id}}" class="offeremail "><i class="zmdi zmdi-email"> </i> Offer </a></li>
                                                            <li class="divider"></li>
                                                        </ul>

                                                    </div>
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a></li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" data-id="{{$record->id}}"  class="btn btn-primary bgm-cyan waves-effect orderstatus">Status</button>                                    
                                                </div>
                                            @endif
                                            @if($record->order_status == 2)
                                                <div class="header_button">
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-pink waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email"><i class="zmdi zmdi-email"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-blue" role="menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" data-offer="{{$record->final_offer_id}}" class="offeremail "><i class="zmdi zmdi-email"> </i> Offer </a></li>
                                                            <li class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaemail "><i class="zmdi zmdi-email"> </i> Performa Invoice</a></li>
                                                        </ul>

                                                    </div>
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a></li>
                                                            <li class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaprint "><i class="zmdi zmdi-print"> </i> Performa Invoice</a></li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" data-id="{{$record->id}}"  class="btn btn-primary bgm-cyan waves-effect orderstatus">Status</button>                                    
                                                    <!--button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" @if($record->compreg->payment_status != 0 && $record->compreg->payment_status != 3 ) style="display:block" @else style="display:none" @endif class="btn btn-primary bgm-purple waves-effect payment">Pay</button>                                    

                                                    <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" @if($record->compreg->payment_status == 0 || $record->compreg->payment_status == 3 && $record->complaint_type != 1 && $record->site_depute == 0) style="display:block" @else style="display:none" @endif class="btn btn-primary bgm-lightblue waves-effect depute" title="Site Deputation"><i class="zmdi zmdi-account"> </i></button>                                    

                                                    <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" @if($record->compreg->payment_status == 3 && $record->complaint_type == 1 && $record->compreg->order_status == 0) style="display:block" @else style="display:none" @endif class="btn btn-primary bgm-purple waves-effect order"><i class="zmdi zmdi-refresh"> </i> Convert Order</button-->                                    

                                                </div>
                                            @endif
                                            @if($record->order_status == 3 || $record->order_status == 4 )
                                                <div class="header_button">
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-pink waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email"><i class="zmdi zmdi-email"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-blue" role="menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" data-offer="{{$record->final_offer_id}}" class="offeremail "><i class="zmdi zmdi-email"> </i> Offer </a></li>
                                                            <li class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaemail "><i class="zmdi zmdi-email"> </i> Performa Invoice</a></li>
                                                        </ul>

                                                    </div>
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a></li>
                                                            <li class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaprint "><i class="zmdi zmdi-print"> </i> Performa Invoice</a></li>
                                                        </ul>
                                                    </div>
                                                    @if($record->compreg->payment_status != 0 && $record->compreg->payment_status != 4 )
                                                    <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="btn btn-primary bgm-purple waves-effect payment">Pay</button>                                    
                                                    @endif
                                                    <!--button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" @if($record->compreg->payment_status == 0 || $record->compreg->payment_status == 3 && $record->complaint_type != 1 && $record->site_depute == 0) style="display:block" @else style="display:none" @endif class="btn btn-primary bgm-lightblue waves-effect depute" title="Site Deputation"><i class="zmdi zmdi-account"> </i></button>                                    

                                                    <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" @if($record->compreg->payment_status == 3 && $record->complaint_type == 1 && $record->compreg->order_status == 0) style="display:block" @else style="display:none" @endif class="btn btn-primary bgm-purple waves-effect order"><i class="zmdi zmdi-refresh"> </i> Convert Order</button-->                                    

                                                </div>
                                            @endif
                                            @if($record->order_status == 5 )
                                                <div class="header_button">
                                                    
                                                    <div class="dropdown pull-right">
                                                        <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                        <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a></li>
                                                            <li class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaprint "><i class="zmdi zmdi-print"> </i> Performa Invoice</a></li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="btn btn-primary bgm-purple waves-effect order"><i class="zmdi zmdi-refresh"> </i> Convert Order</button-->                                    

                                                </div>
                                            @endif
                                            
                                        @else
                                            @if($record->order_status == 0)
                                            <div class="header_button ">
                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle btn bgm-pink waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email"><i class="zmdi zmdi-email"> </i></a>
                                                    <ul class="dropdown-menu dm-icon bgm-blue" role="menu">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" data-offer="{{$record->final_offer_id}}" class="offeremail "><i class="zmdi zmdi-email"> </i> Offer </a></li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                    <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a></li>
                                                    </ul>
                                                </div>
                                                <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}"  class="btn btn-primary bgm-lightblue waves-effect depute pull-right" title="Site Deputation"><i class="zmdi zmdi-account"> </i></button>                                    
                                                <button type="button" data-id="{{$record->id}}"  class="btn btn-primary bgm-cyan waves-effect orderstatus pull-right">S</button>                                    
                                            </div>
                                            @endif
                                            @if($record->order_status == 1 || $record->order_status == 2)
                                            <div class="header_button ">
                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle btn bgm-pink waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email"><i class="zmdi zmdi-email"> </i></a>
                                                    <ul class="dropdown-menu dm-icon bgm-blue" role="menu">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" data-offer="{{$record->final_offer_id}}" class="offeremail "><i class="zmdi zmdi-email"> </i> Offer </a></li>
                                                        <li class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaemail "><i class="zmdi zmdi-email"> </i> Performa Invoice</a></li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                    <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a></li>
                                                        <li class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaprint "><i class="zmdi zmdi-print"> </i> Performa Invoice</a></li>
                                                    </ul>
                                                </div>
                                                <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="btn btn-primary bgm-lightblue waves-effect depute pull-right" title="Site Deputation"><i class="zmdi zmdi-account"> </i></button>                                    
                                                <button type="button" data-id="{{$record->id}}"  class="btn btn-primary bgm-cyan waves-effect orderstatus pull-right">S</button>                                    
                                            </div>
                                            @endif
                                            @if($record->order_status == 3 || $record->order_status == 4)
                                            <div class="header_button ">
                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle btn bgm-pink waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email"><i class="zmdi zmdi-email"> </i></a>
                                                    <ul class="dropdown-menu dm-icon bgm-blue" role="menu">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" data-offer="{{$record->final_offer_id}}" class="offeremail "><i class="zmdi zmdi-email"> </i> Offer </a></li>
                                                        <li class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaemail "><i class="zmdi zmdi-email"> </i> Performa Invoice</a></li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                    <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a></li>
                                                        <li class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaprint "><i class="zmdi zmdi-print"> </i> Performa Invoice</a></li>
                                                    </ul>
                                                </div>
                                                <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}"  class="btn btn-primary bgm-purple waves-effect payment">Pay</button>                                    
                                                <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}"  class="btn btn-primary bgm-lightblue waves-effect depute pull-right" title="Site Deputation"><i class="zmdi zmdi-account"> </i></button>                                    
                                            </div>
                                            @endif
                                            @if($record->order_status == -1)
                                            <div class="header_button">

                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle btn bgm-pink waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email"><i class="zmdi zmdi-email"> </i></a>
                                                    <ul class="dropdown-menu dm-icon bgm-blue" role="menu">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" data-offer="{{$record->final_offer_id}}" class="offeremail "><i class="zmdi zmdi-email"> </i> Offer </a></li>
                                                        <li class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaemail "><i class="zmdi zmdi-email"> </i> Performa Invoice</a></li>
                                                    </ul>

                                                </div>
                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle btn bgm-orange waves-effect" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="zmdi zmdi-print"> </i></a>
                                                    <ul class="dropdown-menu dm-icon bgm-cyan" role="menu">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="offerprint "><i class="zmdi zmdi-print"> </i> Offer    </a></li>
                                                        <li class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" class="invperformaprint "><i class="zmdi zmdi-print"> </i> Performa Invoice</a></li>
                                                    </ul>
                                                </div>
                                                <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" @if($record->compreg->payment_status != 0 && $record->compreg->payment_status !=4 ) style="display:block" @else style="display:none" @endif class="btn btn-primary bgm-purple waves-effect payment">Pay</button>                                    

                                                <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" @if($record->compreg->payment_status == 0 || $record->compreg->payment_status == 3 && $record->complaint_type != 1 && $record->site_depute == 0) style="display:block" @else style="display:none" @endif class="btn btn-primary bgm-lightblue waves-effect depute" title="Site Deputation"><i class="zmdi zmdi-account"> </i></button>                                    

                                                <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}" @if($record->compreg->payment_status == 3 && $record->complaint_type == 1 && $record->compreg->order_status == 0) style="display:block" @else style="display:none" @endif class="btn btn-primary bgm-purple waves-effect order"><i class="zmdi zmdi-refresh"> </i> Convert Order</button>                                    

                                            </div>
                                            @endif
                                            @if($record->order_status > 4)
                                                 @if($record->site_depute == 0)
                                                    <button type="button" data-id="{{$record->id}}" data-compid="{{$record->compreg->id}}"  data-mode="{{$record->compreg->mode_of_complaint}}"  class="btn btn-primary bgm-lightblue waves-effect depute pull-right" title="Site Deputation"><i class="zmdi zmdi-account"> </i></button>                                    
                                                 @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="card card-bady loader">
                                    <div class="preloader pl-lg">
                                        <svg class="pl-circular" viewBox="25 25 50 50">
                                            <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                        </svg>
                                        <span class="m-t-25">Downloading....</span>
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
                                                            <li class="ng-binding"><i class="zmdi zmdi-smartphone-iphone"></i> {{$record->compreg->mobileno}}</li>
                                                            <!--li class="ng-binding"><i class="zmdi zmdi-phone"></i> {{$record->compreg->phoneno}}</li-->
                                                            <li class="ng-binding"><i class="zmdi zmdi-account-box-phone"></i> {{$record->compreg->contact_person}}</li>
                                                            <li class="ng-binding"><i class="zmdi zmdi-email"></i> {{$record->compreg->emailid}}</li>

                                                            <li><?php $text = $record->compreg->address1;
                                                                        $newtext = wordwrap($text, 60, "\n", true);?>
                                                                <i class="zmdi zmdi-pin"></i>
                                                                <address class="m-b-0 ng-binding"><?=nl2br($newtext)?>
                                                                </address>
                                                            </li>
                                                            <li>
                                                                <i class="zmdi zmdi-local-shipping"></i>
                                                                <address class="m-b-0 ng-binding"><?php $text2 = $record->compreg->address2;
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
                                                    @if($record->compreg->gstin != "")
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>GSTIN :</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->compreg->gstin)?></div>
                                                    </div>
                                                    @endif
                                                    @if($record->complaint_type == 0)
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Panel :</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->compreg->panel_descrption)?></div>
                                                    </div>
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Serial No :</b></div>
                                                        <div class="col-sm-8"><?=nl2br($record->compreg->serial_no)?></div>
                                                    </div>
                                                    @endif
                                                    <div class="row" > 
                                                        <div class="col-sm-6" style="    padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>SO No :</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->compreg->salesorder_no)?></div>
                                                        </div>
                                                        <div class="col-sm-6" style="    padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Region :</b></div>
                                                            <div class="col-sm-8">@if($record->compreg->region)<?=nl2br($record->compreg->region->region_name)?>@endif</div>
                                                        </div>  
                                                        @if($record->offer_date != "")
                                                        <div class="col-sm-6" style="    padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Offer Date :</b></div>
                                                            <div class="col-sm-8">@if($record->offer_date == "") @else<?=date('d-m-Y', strtotime($record->offer_date))?> @endif</div>
                                                        </div>
                                                        @endif
                                                        @if($record->pi_date != "")
                                                            @if($record->order_status != 1 || $record->order_status != 2 )
                                                            <div class="col-sm-6" style="    padding: 8px 0 8px 0px;">
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>PI Date :</b></div>
                                                                <div class="col-sm-8">@if($record->pi_date == "") @else<?=date('d-m-Y', strtotime($record->pi_date))?> @endif</div>
                                                            </div>
                                                            @endif 
                                                        @endif
                                                        @if($record->po_ref != "")
                                                        <div class="col-sm-6" style="    padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Po Ref :</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->po_ref)?></div>
                                                        </div>
                                                        @endif
                                                        @if($record->po_date != "")
                                                        <div class="col-sm-6" style="    padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>PO Date :</b></div>
                                                            <div class="col-sm-8">@if($record->po_date == "") @else<?=date('d-m-Y', strtotime($record->po_date))?> @endif</div>
                                                        </div>
                                                        @endif
                                                        <div class="col-sm-6" style="    padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Total Amt :</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->total_gross_amt)?></div>
                                                        </div>
                                                        <div class="col-sm-6" style="    padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4"><i class="zmdi "></i><b>Advance :</b></div>
                                                            <div class="col-sm-8"><?=nl2br($record->advance_amt)?></div>
                                                        </div>
                                                    </div>
                                                    @if($record->paid_date != "")
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Last Payment :</b></div>
                                                        <div class="col-sm-8">@if($record->paid_date == "") @else<?=date('d-m-Y', strtotime($record->paid_date))?> @endif</div>
                                                    </div>
                                                    @endif
                                                    @if($record->complaint_type == 1)
                                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                        <div class="col-sm-4"><i class="zmdi "></i><b>Complaint Status</b></div>
                                                        <div class="col-sm-8"><?php if($record->compreg->document_status == 0){echo'<div class="c-red f-20">Draft</div>';}else if($record->compreg->document_status == 1) {echo '<div class="c-orange f-20">In-Progress</div>';} else if($record->compreg->document_status == 2) {echo '<div class="c-green f-20">Completed</div>';} else {echo '<div class="c-yellow f-20">Cancelled</div>';}?></div>
                                                    </div>
                                                    
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                                    
                                        @if($record->complaint_type == 0)
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header ch-alt">
                                                    <h2>
                                                        Registered Information 
                                                    </h2>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="card-body card-padding pd-10-20">
                                                            @if($record->compreg->date_supply != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Panel Supply Date</b></div>
                                                                <div class="col-sm-6 f-14"><?=date('d-m-Y', strtotime($record->compreg->date_supply))?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->commissioned_date != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Date of Commissioned</b></div>
                                                                <div class="col-sm-6 f-14"><?=date('d-m-Y', strtotime($record->compreg->commissioned_date))?></div>
                                                            </div>
                                                            @endif
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Customer Complaint</b></div>
                                                                <?php $complaint_nature = $record->compreg->complaint_nature;
                                                                        $newcomplaint_nature = wordwrap($complaint_nature, 60, "\n", true);?>
                                                                <div class="col-sm-6 f-14">{!! nl2br(e($newcomplaint_nature)) !!}</div>
                                                            </div>
                                                            @if($record->compreg->outgoing_load != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Outgoing Load</b></div>
                                                                <div class="col-sm-6 f-14"><?=nl2br($record->compreg->outgoing_load)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->relay_make_type != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Relay Make&Type</b></div>
                                                                <div class="col-sm-6 f-14"><?=nl2br($record->compreg->relay_make_type)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->relay_status != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Relay Status</b></div>
                                                                <div class="col-sm-6 f-14"><?=nl2br($record->compreg->relay_status)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->cable_length != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Cable Length</b></div>
                                                                <div class="col-sm-6 f-14">{{$record->compreg->cable_length}}</div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->fault_current != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Fault Current</b></div>
                                                                <div class="col-sm-6 f-14"><?=nl2br($record->compreg->fault_current)?></div>
                                                            </div>
                                                            @endif
                                                            @if($record->compreg->vcb_interlock != "")
                                                            <div class="row" style="   padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>VCB Interlock Condition</b></div>
                                                                <div class="col-sm-6 f-14">{!! nl2br(e($record->compreg->vcb_interlock)) !!}</div>
                                                            </div>
                                                            @endif

                                                            

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">

                                                        <div class="card-body card-padding pd-10-20">


                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4"><i class="zmdi "></i><b>Complaint Status</b></div>
                                                                <div class="col-sm-8"><?php if($record->compreg->document_status == 0){echo'<div class="c-red f-20">Draft</div>';}else if($record->compreg->document_status == 1) {echo '<div class="c-orange f-20">In-Progress</div>';} else if($record->compreg->document_status == 2) {echo '<div class="c-green f-20">Completed</div>';} else {echo '<div class="c-yellow f-20">Cancelled</div>';}?></div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4 f-12"><i class="zmdi "></i><b>Remark/Comments</b></div>
                                                                <div class="col-sm-8 f-14">{!! nl2br(e($record->compreg->remark)) !!}</div>
                                                            </div>
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4 f-12"><i class="zmdi "></i><b>Probable Cause of Failure</b></div>
                                                                <div class="col-sm-8 f-14">{!! nl2br(e($record->failure_cause)) !!}</div>
                                                            </div>
                                                            @if($record->compreg->after_commissioned != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Any Mod. Aftr Commisioning</b></div>
                                                                <div class="col-sm-6 f-14"><?=nl2br($record->compreg->after_commissioned)?></div>
                                                            </div>
                                                            @endif
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4 f-12"><i class="zmdi "></i><b>Scope of Work</b></div>
                                                                <?php  if($record->scope_of_work == "")
                                                                        {
                                                                            $scope ="";
                                                                        }
                                                                        else
                                                                        {
                                                                            $scope = json_decode($record->scope_of_work);
                                                                        }   
                                                                        ?>
                                                                <div class="col-sm-8 f-14">{!! $scope !!} </div>
                                                            </div>
                                                            @if($record->compreg->event_before_failure != "")
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-6 f-12"><i class="zmdi "></i><b>Event Before Failure</b></div>
                                                                <div class="col-sm-6 f-14"><?=nl2br($record->compreg->event_before_failure)?></div>
                                                            </div>
                                                            @endif
                                                            <div class="row" style="    padding: 8px 0 8px 0px;">       
                                                                <div class="col-sm-4 f-12"><i class="zmdi "></i><b>Warranty</b></div>
                                                                <div class="col-sm-8 f-14"><?php if($record->compreg->warrenty == 0){echo'With Warranty';}else{echo' Without Warranty';} ?></div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!--div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row" style="    padding: 8px 2px 8px 2pxpx;">       
                                                                <div class="col-sm-2 f-12"><i class="zmdi "></i><b>Terms</b></div>
                                                                <div class="col-sm-10 f-10">{!! nl2br(e($record->terms)) !!}</div>
                                                            </div>
                                                        </div>
                                                            
                                                    </div>
                                                </div-->
                                            </div>
                                        </div>
                                        @endif
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
                                                    <?php $currentdate =date('Y-m-d'); ?>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="form-row ">
                                                                    <!--div class="form-group col-sm-12">
                                                                        <label for="pay_date" class="control-label col-sm-3">Payment Date</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="fg-line">
                                                                                <input type='text' class="form-control input-sm" id="pay_date" name="pay_date" value="{{$currentdate}}">
                                                                            </div>
                                                                        </div>
                                                                    </div-->
                                                                    <div class="form-group col-sm-12">
                                                                        <label for="pay_mode" class="control-label col-sm-3">Payment Mode</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="fg-line">
                                                                                <input type='hidden' class="form-control input-sm" id="pay_date" name="pay_date" value="{{$currentdate}}">
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
                                                                                    <option value="2">Advance Received</option>
                                                                                    <option value="3">Partially Received</option>
                                                                                    <option value="4">100% Received</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group col-sm-12 adv_pay hide">
                                                                        <label for="advance_amt" class="control-label col-sm-3">Advance Amt</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="fg-line">
                                                                                <input type="text" class="form-control" placeholder="Advance Amt" id="advance_amt">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 pay_amt hide">
                                                                        <label for="payment_amt" class="control-label col-sm-3">Payment Amt</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="fg-line">
                                                                                <input type="text" class="form-control" placeholder="Payment Amt" id="payment_amt">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-6 tot_amt">
                                                                        <label for="tot_pay_amt" class="control-label col-sm-5">Total</label>
                                                                        <div class="col-sm-7">
                                                                            <div class="fg-line">
                                                                                <input type="text" class="form-control" placeholder="Total Amt" disabled id="tot_pay_amt" value="{{$record->total_gross_amt}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-6 tot_amt">
                                                                        <label for="tot_pay_amt" class="control-label col-sm-5">Pending</label>
                                                                        <div class="col-sm-7">
                                                                            <div class="fg-line">
                                                                                @php
                                                                                
                                                                                $pend = $record->total_gross_amt-($record->advance_amt+$record->payment_received)
                                                                                @endphp
                                                                                <input type="text" class="form-control" disabled id="pend_amt" value="{{$pend}}">
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
                                <div id="modalstatus">
                                    <div id="modalstatus2">
                                        <div class="modal fade statusform" id="statusform" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4> Status Form </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                         @if($record->complaint_type == 1 || $record->complaint_type == 0)
                                                            @if($record->order_status == 0)  
                                                                <button type="button" data-id="{{$record->id}}" data-orderstatus="1" class="btn btn-primary bgm-cyan waves-effect upstatus">Offer Send</button>                                    
                                                            @endif
                                                            @if($record->order_status == 1) 
                                                            <div class="form-group">
                                                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                                                                <div class="form-row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <span class="control-label"><i class="zmdi zmdi-sun"></i></span>
                                                                            <div class="fg-line">
                                                                                <input type="text" class="form-control" placeholder="Po Ref" id="order_ref_no">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                  
                                                                    <div class="col-sm-6 ordercalender">
                                                                        <div class="form-group">
                                                                            <span class="control-label"><i class="zmdi zmdi-calender"></i></span>
                                                                            <div class="fg-line">
                                                                                <?php $retdate = date('Y-m-d');  ?>
                                                                                <input type='text' class="form-control datepicker" name="po_date" value="{{$retdate}}">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-row">
                                                                    <div class="col-sm-12">
                                                                        <button type="button" data-id="{{$record->id}}" data-orderstatus="2" class="btn btn-primary bgm-cyan waves-effect upstatus">PO Received</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                            @endif
                                                            @if($record->order_status == 2)  
                                                                <button type="button" data-id="{{$record->id}}" data-orderstatus="3" class="btn btn-primary bgm-cyan waves-effect upstatus">PI Send</button>                                    
                                                            @endif
                                                         @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="modaldepute">
                                    <div id="modaldepute1">
                                        <div class="modal fade deputeform" id="deputeform" role="dialog">
                                            <div class="modal-dialog" style="width:60%">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Depute Form</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="form-row ">
                                                                    <div class="form-group col-sm-12">
                                                                        <label for="depute_engineer" class="control-label col-sm-6">Depute Engineer</label>
                                                                        <div class="col-sm-6">
                                                                            <div class="fg-line">
                                                                                <select class="selectpicker form-control input-sm" placeholder="Type" name="depute_engineer" id="depute_engineer">    
                                                                                    <option value="0">Service Engineer</option>
                                                                                    <option value="1">Agent</option>
                                                                                </select>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="row servicediv">

                                                                        <div class="form-group col-sm-12">
                                                                            <label for="agent_id" class="control-label col-sm-6 required">Service engineer</label>
                                                                            <div class="col-sm-6">
                                                                                <div class="fg-line">
                                                                                    <select class="selectpicker" multiple placeholder="Service Engineer" aria-describedby="basic-addon1" data-validation="required" required="required" id="engineer_id" name="engineer_id[]">
                                                                                        <option value=" " ></option>
                                                                                        @foreach($modelEngLists as $modelEngList)
                                                                                            <option value="{{$modelEngList->id}}">{{$modelEngList->name}}</option>
                                                                                        @endforeach
                                                                                    </select>                                        
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-sm-6">
                                                                                <label for="date_of_depature" class="control-label col-sm-6">Departure Date</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <?php $depdate = $currentdate =date('Y-m-d'); ?>
                                                                                        <input type='text' class="form-control input-sm date-picker se_date_of_depature" name="date_of_depature" value="{{$depdate}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <?php $retdate = $currentdate =date('Y-m-d'); ?>
                                                                                <label for="date_of_return" class="control-label col-sm-6">Return Date</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <input type='text' class="form-control input-sm date-picker se_date_of_return" name="date_of_return" value="{{$retdate}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <label for="days_site" class="control-label col-sm-6">Total Days</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <input type='text' class="form-control input-sm" name="days_site" id="se_days_site" value="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <label for="loading_expenses" class="control-label col-sm-6">Lodging Expenses</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <input type='text' class="form-control input-sm" name="loading_expenses" id="se_loading_expenses" value="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <label for="boarding_expenses" class="control-label col-sm-6">Boarding Expenses</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <input type='text' class="form-control input-sm" name="boarding_expenses" id="se_boarding_expenses" value="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <label for="travel_expenses" class="control-label col-sm-6">Travel Expenses</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <input type='text' class="form-control input-sm" name="travel_expenses" id="se_travel_expenses" value="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <label for="local_conveyance" class="control-label col-sm-6">Local Conveyance</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <input type='text' class="form-control input-sm" name="local_conveyance" id="se_local_conveyance" value="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <label for="contact_person" class="control-label col-sm-6">Contact Person (at site)</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <input type='text' class="form-control input-sm" name="contact_person" id="se_contact_person" value="{{$record->compreg->contact_person}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <label for="contact_number" class="control-label col-sm-6">Contact Number (at site)</label>
                                                                                <div class="col-sm-6">
                                                                                    <div class="fg-line">
                                                                                        <input type='text' class="form-control input-sm" name="contact_number" id="se_contact_number" value="{{$record->compreg->mobileno}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row agentdiv">
                                                                        <div class="form-group col-sm-12">
                                                                            <label for="bp_name" class="control-label col-sm-6 required">Agent</label>
                                                                            <div class="col-sm-6">
                                                                                <div class="fg-line">
                                                                                    <select class="form-control input-sm" placeholder="Agent" aria-describedby="basic-addon1" data-validation="required" required="required" id="agent_id" name="agent_id">
                                                                                        <option value=" " ></option>
                                                                                        @foreach($modelAgents as $modelAgent)
                                                                                            <option value="{{$modelAgent->id}}">{{$modelAgent->company_name}}</option>
                                                                                        @endforeach
                                                                                    </select>                                        
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group col-sm-6">
                                                                            <?php $depdate = $currentdate =date('Y-m-d');  ?>
                                                                            <label for="date_of_depature" class="control-label col-sm-6">Attend From</label>
                                                                            <div class="col-sm-6">
                                                                                <div class="fg-line">
                                                                                    <input type='text' class="form-control input-sm date-picker sa_date_of_depature" name="date_of_depature"  value="{{$depdate}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <?php $retdate = $currentdate =date('Y-m-d');  ?>
                                                                            <label for="date_of_return" class="control-label col-sm-6">Attend To</label>
                                                                            <div class="col-sm-6">
                                                                                <div class="fg-line">
                                                                                    <input type='text' class="form-control input-sm date-picker sa_date_of_return" name="date_of_return" value="{{$retdate}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <label for="days_site" class="control-label col-sm-6">Total Days</label>
                                                                            <div class="col-sm-6">
                                                                                <div class="fg-line">
                                                                                    <input type='text' class="form-control input-sm" name="days_site" id="sa_days_site" value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <label for="contact_person" class="control-label col-sm-6">Contact Person (at site)</label>
                                                                            <div class="col-sm-6">
                                                                                <div class="fg-line">
                                                                                    <input type='text' class="form-control input-sm" name="contact_person" id="sa_contact_person" value="{{$record->compreg->contact_person}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <label for="contact_number" class="control-label col-sm-6">Contact Number (at site)</label>
                                                                            <div class="col-sm-6">
                                                                                <div class="fg-line">
                                                                                    <input type='text' class="form-control input-sm" name="contact_number" id="sa_contact_number" value="{{$record->compreg->mobileno}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>    

                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-sm-3">
                                                                    <button type="button" id="seruser" class="seruser btn bgm-cyan"><i>Submit</i></button>
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
                                <div id="modalproduct">
                                    <div id="modalproduct1">
                                        <div class="modal fade productform" id="productform" role="dialog">
                                            <div class="modal-dialog  modal-lg" style="width:98%">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Product Form</h4>
                                                    </div>
                                                    <?php $currentdate =date('Y-m-d'); ?>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="form-row ">
                                                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                                                                    <input type="hidden" name="service_spares_register_id" id="service_spares_register_id" value="{{$record->id}}"/>
                                                                     <input type="hidden" name="offer_details_id" id="offer_details_id" value=""/>
                                                                </div>
                                                            </div>
                                                            <div class="row m-l-10">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group fg-line">
                                                                        <label>Product</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group fg-line">
                                                                        <label >Description</label>
                                                                    </div>
                                                                </div>



                                                                <div class="col-sm-4">
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label>Qty</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group fg-line">
                                                                            <label>Price</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group fg-line">
                                                                            <label>Dis %</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <div class="form-group fg-line">
                                                                            <label>Tax</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="col-sm-9">
                                                                        <div class="form-group fg-line">
                                                                            <label>Total</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="serviceprdsecond">
                                                                
                                                            </div>
                                                            <div class="modal fade modelloader" id="modelloader" role="dialog">
                                                                <div class="modal-dialog  modal-lg" style="width:98%">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <div class="preloader pl-xl">
                                                                                <svg class="pl-circular" viewBox="25 25 50 50">
                                                                                    <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row m-t-25 pull-right">
                                                                    <button type="button" id="addline" class="addline btn bgm-green"><i class="zmdi zmdi-plus"></i></button>
                                                            </div>
                                                            <div class="form-row m-t-25">
                                                                <div class="col-sm-3 m-t-25">
                                                                    <button type="button" id="serviceprdsubmit" class="serviceprdsubmit btn bgm-cyan"><i>Submit</i></button>
                                                                </div>
                                                            </div>                 
                                                        </div>
                                                        <div class="modal-footer m-t-25">
                                                            <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div id="modalprd">
                                    <div id="modalprd2">
                                        <div class="modal fade completeform" id="productform" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Product Search</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="data-table-command" class="table table-striped table-vmiddle">
                                                            <thead>
                                                                <tr>
                                                                    <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                                                    <th data-column-id="radiob"></th>  
                                                                    <th data-column-id="code">Code</th>                                    
                                                                    <th data-column-id="name">Name</th>
                                                                    <th data-column-id="uom" >UOM</th>     
                                                                    <th data-column-id="price" >Price</th>     
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($products as $item)
                                                                    <tr>
                                                                        <td>{{$item->id}}</td>
                                                                        <td><input class="prdradio" type="radio" name="productid" value="{{$item->id}}"></td>
                                                                        <td>{{$item->code}}</td>
                                                                        <td class="pname">{{$item->name}}</td>
                                                                        <td>{{$item->uom}}</td>
                                                                        <td class="price">{{$item->price}}</td>
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
                                <div class="prdfirst" >
                                    <div class="row m-l-10" role="form">
                                        <div class="col-sm-3">
                                            <div class="input-group form-group fg-line">
                                                <label class="sr-only" for="product">Product</label>
                                                <input type="hidden" class="product_id" name="product_id" />
                                                <input type="text" class="form-control input-sm product" name="product" placeholder="Product" autocomplete="off">
                                                <span class="input-group-addon last prd_search"><i class="btn btn-xs zmdi zmdi-search"></i></span>                                                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group fg-line">
                                                <label class="sr-only" for="description">Description</label>
                                                <input type="text" class="form-control input-sm description" name="description" placeholder="Description" autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-sm-4">
                                            <div class="col-sm-2">
                                                <div class="form-group fg-line">
                                                    <label class="sr-only" for="qty">Qty</label>
                                                    <input type="text" class="form-control input-sm qty" placeholder="Qty" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group fg-line">
                                                    <label class="sr-only" for="unit_price">Price</label>
                                                    <input type="text" class="form-control input-sm unit_price" placeholder="Price" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group fg-line">
                                                    <label class="sr-only" for="discount">Discount</label>
                                                    <input type="text" class="form-control input-sm discount" placeholder="Discount" autocomplete="off" value="0">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group fg-line">
                                                    <label class="sr-only" for="tax">Tax</label>
                                                    <select class="form-control input-sm tax_id" placeholder="Tax" aria-describedby="basic-addon1" data-validation="required" required="required" id="frm-tax_id" name="tax_id">
                                                        <option value="3">No Tax</option>
                                                        <option value="1">GST 18%</option>
                                                        <option value="2">CGST 9% + SGST 9%</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="col-sm-9">
                                                <div class="form-group fg-line">
                                                    <label class="sr-only" for="total">Total</label>
                                                    <input type="hidden" class="form-control input-sm tax_amt">
                                                    <input type="text" class="form-control input-sm total" readonly placeholder="Price">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <button type="button" class="btn btn-primary btn-sm m-t-5 waves-effect prdclose"><i class="zmdi zmdi-close"></i></button>
                                            </div>
                                        </div>
                                            
                                    </div>
                                </div>
                                <div id="modalproductedit">
                                    <div id="modalproductedit1">
                                        <div class="modal fade producteditform" id="producteditform" role="dialog">
                                            <div class="modal-dialog  modal-lg" style="width:98%">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Product Edit Form</h4>
                                                    </div>
                                                    <?php $currentdate =date('Y-m-d'); ?>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="form-row ">
                                                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                                                                    <input type="hidden" name="service_spares_register_id" id="service_spares_register_id" value="{{$record->id}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="prdeditsecond">
                                                                <input type="hidden" name="service_product_id" id="service_product_id" value=""/>
                                                            </div>
                                                            <div class="modal fade modelloader" id="modelloader" role="dialog">
                                                                <div class="modal-dialog  modal-lg" style="width:90%">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <div class="preloader pl-xl">
                                                                                <svg class="pl-circular" viewBox="25 25 50 50">
                                                                                    <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row m-t-25">
                                                                <div class="col-sm-3 m-t-25">
                                                                    <button type="button" id="editprd" class="editprd btn bgm-cyan"><i>update</i></button>
                                                                </div>
                                                            </div>                 
                                                        </div>
                                                        <div class="modal-footer m-t-25">
                                                            <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                <div id="modalofferprint">
                                    <div id="modalofferprint1">
                                        <div class="modal fade offerprintform" id="offerprintform" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4>Offer Print</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                           
                                                        <select class="selectpicker" id="offerid">
                                                            @foreach($record->offerdata as $offerdata)
                                                            <option value="{{$offerdata->id}}">{{$offerdata->revision_no}}</option>
                                                            @endforeach
                                                        </select>

                                                            <div class="form-row m-t-25">
                                                                <div class="col-sm-3 m-t-25">
                                                                    <button type="button" id="printoffernew" class="printoffernew btn bgm-cyan"><i>Print</i></button>
                                                                </div>
                                                            </div>                 
                                                        </div>
                                                        <div class="modal-footer m-t-25">
                                                            <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div id="upmodal"></div>
                                <div id="modal5"></div>
                                <div id="modal3"></div>
                                <div id="modalprint"></div>
                                <div id="prdmodal"><form></form></div>