        <div class="card">
            <div class="card-header ch-alt">
                <h4>Offer Details</h4>
                <div class="pull-right">
                    <button class="btn btn-success  waves-effect waves-float offeradd"><i class="zmdi zmdi-plus"> Offer</i></button>                                    
                </div>
            </div>
            <div class="card-body m-t-20 p-5">
                <!--- Product----->
                    @php
                        $offercnt = 0;
                    @endphp
                @foreach($record->offerdata as $offerdata)
                    @php
                        $offercnt=$offercnt+1;
                    @endphp
                    @if($record->final_offer_id == $offerdata->id)
                        @php 
                            $color = 'bgm-cyan'; 
                            $btn = '';
                        @endphp
                    @else 
                        @php 
                            $color = 'bgm-gray'; 
                            $btn = '<button class="btn bgm-indigo waves-effect pull-right offersetdefault" style="margin-block: -36px;" data-offerid='.$offerdata->id.' data-ssid='.$offerdata->service_spares_register_id.' ><i class="zmdi">set default</i></button>';
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
                        
                        <div id="{{$offerdata->revision_no}}" class="collapse" role="tabpanel" aria-labelledby="headingOffer">
                            @php echo $btn; @endphp
                            <div class="panel-body">
                                @if($record->complaint_type == 1)
                                <div class="panel-group m-t-25" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-collapse">
                                        <div class="panel-heading color-block bgm-orange" role="tab" id="headingTerms">
                                            <h4 class="panel-title ">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTerms-{{$offerdata->revision_no}}" aria-expanded="false" aria-controls="collapseOne">
                                                    Terms and Conditions
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTerms-{{$offerdata->revision_no}}" class="collapse" role="tabpanel" aria-labelledby="headingTerms">
                                            <div class="panel-body p-10">
                                                <div class="p-5 pull-right mm-55-0">
                                                    <button class="btn btn-warning btn-icon waves-effect waves-circle waves-float editterms" data-offerid='{{$offerdata->id}}'><i class="zmdi zmdi-edit"></i></button>                                    
                                                </div>
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
                                <div class="panel-group m-t-25" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-collapse">
                                        <div class="panel-heading color-block bgm-blue" role="tab" id="headingProduct">
                                            <h4 class="panel-title ">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseProduct-{{$offerdata->revision_no}}" aria-expanded="false" aria-controls="collapseOne">
                                                    Material To Be Supply
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseProduct-{{$offerdata->revision_no}}" class="collapse" role="tabpanel" aria-labelledby="headingProduct">
                                            <div class="panel-body p-10">
                                                <div class="p-5 pull-right mm-55-0">
                                                    <!--a href="{{url('servicespareregister/addprd', $record->id)}}" target="_self">
                                                        <button class="btn bgm-lime btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></button>                                    
                                                    </a-->
                                                        <button class="btn btn-info btn-icon waves-effect waves-circle waves-float prdct" data-offerid='{{$offerdata->id}}'><i class="zmdi zmdi-plus"></i></button>                                    
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
                                                                                    <div class="col-sm-1 f-10 text-center">
                                                                                        <!--a href="{{url('servicespareregister/editprd', $registerprd->id)}}" target="_self">
                                                                                            <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit"></i></button>
                                                                                        </a-->
                                                                                        <button class="btn bgm-orange waves-effect waves-float  prdctedit" data-id='{{$registerprd->id}}' data-prdid='{{$registerprd->product_id}}' data-prddesc='{{$registerprd->prd_description}}' data-desc='{{$registerprd->description}}' data-discount='{{$registerprd->discount}}' data-price='{{$registerprd->unit_price}}' data-qty='{{$registerprd->quantity}}' data-tax_id='{{$registerprd->tax_id}}' data-tax_amt='{{$registerprd->tax_amt}}' data-total='{{$registerprd->total_price}}'><i class="zmdi zmdi-edit"></i></button>                                    

                                                                                        <a href="{{url('servicespareregister/deleteprd', $registerprd->id)}}" target="_self">
                                                                                            <button class="btn bgm-red waves-effect waves-float"><i class="zmdi zmdi-close"></i></button>
                                                                                        </a>
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
                                @if($record->complaint_type != 1)
                                <div class="panel-group" data-collapse-color="yellow" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-collapse">
                                        <div class="panel-heading color-block bgm-teal" role="tab" id="headingService">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseService" aria-expanded="false" aria-controls="collapseThree">
                                                    Service Charges
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseService" class="collapse" role="tabpanel" aria-labelledby="headingService">
                                            <div class="panel-body p-10">
                                                <div class="p-5 pull-right mm-55-0">
                                                    <button type="button" class="btn bgm-lime btn-icon waves-effect waves-circle waves-float serviceadd"><i class="zmdi zmdi-plus"></i></button>                                    
                                                </div>
                                                <div id="modalservice">
                                                    <div id="modalservice1">
                                                        <div class="modal fade serchargeform" id="serchargeform" role="dialog">
                                                            <div class="modal-dialog modal-lg" style="width:96%">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4>Service Charges</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <div class="form-row ">
                                                                                <div class="col-sm-12">
                                                                                    <div class="card">
                                                                                        <div class="card-body card-padding serchargenew">
                                                                                            <div class="serchargenew1">
                                                                                                <div class="sercharge0">
                                                                                                        <div class="row m-t-25">
                                                                                                            <div class="col-sm-12 ">

                                                                                                                <div class="col-sm-6">
                                                                                                                    <div class="col-sm-6">
                                                                                                                        <div class="input-group form-group fg-line">

                                                                                                                            <label class="sr-only" for="product">Product</label>
                                                                                                                            <input type="hidden" class="sr_product_id" name="product_id" />
                                                                                                                            <input type="text" class="form-control input-sm sr_product" name="product" placeholder="Product" autocomplete="off">
                                                                                                                            <span class="input-group-addon sr_last "><i class="btn btn-xs zmdi zmdi-search"></i></span>                                                                    
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-6">
                                                                                                                        <div class="form-group fg-line">
                                                                                                                            <label class="sr-only" for="prd_description">Description</label>
                                                                                                                            <input type="text" class="form-control input-sm sr_description" placeholder="Description" autocomplete="off">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-sm-6">
                                                                                                                    <div class="col-sm-2">
                                                                                                                        <div class="form-group fg-line">
                                                                                                                            <label class="sr-only" for="qty">Qty</label>
                                                                                                                            <input type="text" class="form-control input-sm sr_qty" placeholder="Qty" autocomplete="off">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-2">
                                                                                                                        <div class="form-group fg-line">
                                                                                                                            <label class="sr-only" for="unit_price">Price</label>
                                                                                                                            <input type="text" class="form-control input-sm sr_unit_price" placeholder="Price" autocomplete="off">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-4">
                                                                                                                        <div class="form-group fg-line">
                                                                                                                            <label class="sr-only" for="tax">Tax</label>
                                                                                                                            <select class="form-control input-sm sr_tax_id" placeholder="Tax" aria-describedby="basic-addon1" data-validation="required" required="required" id="frm-tax_id" name="tax_id">
                                                                                                                                <option value="3">No Tax</option>
                                                                                                                                <option value="1">GST 18%</option>
                                                                                                                                <option value="2">CGST 9% + SGST 9%</option>
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-3">
                                                                                                                        <div class="form-group fg-line">
                                                                                                                            <label class="sr-only" for="total">Total</label>
                                                                                                                            <input type="hidden" class="form-control input-sm sr_tax_amt">
                                                                                                                            <input type="text" class="form-control input-sm sr_total" readonly placeholder="Price">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-1 text-center m-t-5d">
                                                                                                                        <button type="button" class="btn bgm-red remove"><i class="zmdi zmdi-close"></i></button>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="servicenew2">
                                                                                                <form>
                                                                                                    <input type="hidden" name='register_id' value="{{$record->id}}"/>
                                                                                                </form>
                                                                                            </div>
                                                                                            <div class="row m-t-25">
                                                                                                <div class="col-sm-12">
                                                                                                    <button type="button" class="btn btn-xs bgm-cyan pull-right newserln"><i class="zmdi zmdi-plus"> New line</i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-sm-3">
                                                                                <button type="button" id="submitservice" class="submitservice btn bgm-cyan"><i>Submit</i></button>
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
                                                <div id="modalserprd">
                                                        <div id="modalserprd2">
                                                            <div class="modal fade serproductform" id="serproductform" role="dialog">
                                                                <div class="modal-dialog modal-lg">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4>Service charge Search</h4>
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
                                                                                    @foreach ($services as $item)
                                                                                        <tr>
                                                                                            <td>{{$item->id}}</td>
                                                                                            <td><input class="sr_prdradio" type="radio" name="productid" value="{{$item->id}}"></td>
                                                                                            <td>{{$item->code}}</td>
                                                                                            <td class="sr_pname">{{$item->name}}</td>
                                                                                            <td>{{$item->uom}}</td>
                                                                                            <td class="sr_price">{{$item->amount}}</td>
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
                                                <div id="modalservice3">
                                                </div>
                                                <div id="modalservicech">
                                                </div>
                                                <div class="row servicedetail">  
                                                    <div class="col-sm-12">
                                                        <?php
                                                        $crrDate = date("Y-m-d");
                                                        $activestatus = "";
                                                        $active = "";
                                                        $n = 0;
                                                        ?>
                                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                                            @if(($record->sercharges))
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
                                                                                    <div class="col-sm-2 text-center c-black">
                                                                                        Comments
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body card-padding pd-10-20">
                                                                        @foreach($record->sercharges as $sercharge)
                                                                            <?php $n++; ?>
                                                                                <div class="row" style="padding: 8px 0 8px 0px;">
                                                                                    <div class="col-sm-3 text-center">{{$sercharge->prd_description}}</div>
                                                                                    <div class="col-sm-1 text-center">{{$sercharge->quantity}}</div>
                                                                                    <div class="col-sm-2 text-center">{{$sercharge->unit_price}}</div>
                                                                                    <div class="col-sm-2 text-center">{{$sercharge->tax->tax_name}}</div>
                                                                                    <div class="col-sm-2 text-center">{{$sercharge->total_price}}</div>
                                                                                    <div class="col-sm-2 text-center">
                                                                                        <button type="button" data-id={{$sercharge->id}} class="btn bgm-orange waves-effect waves-float editservicecharge"><i class="zmdi zmdi-edit"></i></button>

                                                                                        <a href="{{url('servicespareregister/deleteprd', $sercharge->id)}}" target="_self">
                                                                                            <button class="btn bgm-red waves-effect waves-float"><i class="zmdi zmdi-close"></i></button>
                                                                                        </a>

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
                            </div>
                        </div>
                    </div>
                </div>
                    
                @endforeach
                <div class="offercnt" data-cnt="{{$offercnt}}"></div>               
            </div>
        </div>
                

                    
                
        @if($record->complaint_type != 1)
        <div class="panel-group" data-collapse-color="yellow" role="tablist" aria-multiselectable="true">
            <div class="panel panel-collapse">
                <div class="panel-heading color-block bgm-lightblue" role="tab" id="headingThingtodo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThingtodo" aria-expanded="false" aria-controls="collapseOne">
                            Site Observation
                        </a>
                    </h4>
                </div>
                <div id="collapseThingtodo" class="collapse" role="tabpanel" aria-labelledby="headingThingtodo">
                    <div class="panel-body p-10">
                        <div class="p-5 pull-right mm-55-0">
                            <button type="button" class="btn bgm-lime btn-icon waves-effect waves-circle waves-float thingsadd"><i class="zmdi zmdi-plus"></i></button>                                    
                        </div>
                        <div id="modalthings">
                            <div id="modalthings1">
                                <div class="modal fade thingsform" id="thingsform" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4>Site Observation Form</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="form-row ">
                                                        <div class="col-sm-12">
                                                            <div class="card">
                                                                <div class="card-body card-padding thingsnew">
                                                                    <div class="thingsnew1">
                                                                        <div class="things0">
                                                                                <div class="row m-t-25">
                                                                                    <div class="col-sm-12 ">
                                                                                        <div class="col-sm-1 m-t-5">
                                                                                            <div class="fg-line"> <span class="sno"> </span> </div>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="fg-line">
                                                                                                <textarea class="form-control input-sm" cols="20" rows="2"  title="Things To Do" name="things_to_do"></textarea>                                        
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-3 " style="display:none;">
                                                                                            <div class="fg-line">
                                                                                                <select class="form-control input-sm m-t-15" name="answer_type">
                                                                                                    <option value="0" selected>Textbox</option>
                                                                                                    <option value="1">Checkbox</option>
                                                                                                </select>                                                                                    
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-1 text-center m-t-10">
                                                                                            <button type="button" class="btn bgm-red remove"><i class="zmdi zmdi-close"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="thingsnew2">
                                                                        <form>
                                                                            <input type="hidden" name='register_id' id="register_id" value="{{$record->id}}"/>
                                                                        </form>
                                                                    </div>
                                                                    <div class="row m-t-25">
                                                                        <div class="col-sm-12">
                                                                            <button type="button" class="btn btn-xs bgm-cyan pull-right newline"><i class="zmdi zmdi-plus"> New line</i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-sm-3">
                                                        <button type="button" id="submitthings" class="submitthings btn bgm-cyan"><i>Submit</i></button>
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
                        <div id="modalthings3">
                        </div>
                        <div class="row thingsdetail">  
                            <div class="col-sm-12">
                                <?php
                                $crrDate = date("Y-m-d");
                                $activestatus = "";
                                $active = "";
                                $n = 0;
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->thingstodos))
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
                                                @foreach($record->thingstodos as $thingstodo)
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
                                                            
                                                            <div class="col-sm-2 text-center">
                                                                    <button type="button" data-id={{$thingstodo->id}} class="btn bgm-orange  waves-effect waves-float editthings"><i class="zmdi zmdi-edit"></i></button>
                                                                    <a href="{{url('servicespareregister/deletethingstodo', $thingstodo->id)}}" target="_self">
                                                                        <button class="btn bgm-red waves-effect waves-float"><i class="zmdi zmdi-close"></i></button>
                                                                    </a>
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
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThingtotaken" aria-expanded="false" aria-controls="collapseThree">
                            Tools To Be Taken (Non - Invoice Items)
                        </a>
                    </h4>
                </div>
                <div id="collapseThingtotaken" class="collapse" role="tabpanel" aria-labelledby="headingThingtotaken">
                    <div class="panel-body p-10">
                        <div class="p-5 pull-right mm-55-0">
                            <button type="button" class="btn bgm-lime btn-icon waves-effect waves-circle waves-float takenadd"><i class="zmdi zmdi-plus"></i></button>                                    
                        </div>
                        <div id="modaltaken">
                            <div id="modaltaken1">
                                <div class="modal fade takenform" id="takenform" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4>Things To Taken Form</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="form-row ">
                                                        <div class="col-sm-12">
                                                            <div class="card">
                                                                <div class="card-body card-padding takennew">
                                                                    <div class="takennew1">
                                                                        <div class="taken0">
                                                                                <div class="row m-t-25">
                                                                                    <div class="col-sm-12 ">
                                                                                        <div class="col-sm-1 m-t-5">
                                                                                            <div class="fg-line"> <span class="sno"> </span> </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-4 fg-float">
                                                                                            <div class="col-sm-12">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm fg-input" title="Things To Taken" name="things_to_taken" id="things_to_taken" />                                        
                                                                                                    <label class="fg-label m-l-10">Things To Be Taken</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-2 fg-float">
                                                                                            <div class="col-sm-12">
                                                                                                <div class="fg-line">
                                                                                                    <input class="form-control input-sm fg-input" title="Qty" name="quantity" id="quantity" />                                        
                                                                                                    <label class="fg-label">Qty</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <div class="col-sm-2 ">
                                                                                            <div class="fg-line">
                                                                                                <label class="fg-label col-sm-3">Return</label>
                                                                                                <input class="col-sm-9" type="checkbox" name="isreturn" value="0" id="isreturn">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-1 text-center m-t-10">
                                                                                            <button type="button" class="btn bgm-red remove"><i class="zmdi zmdi-close"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="takennew2">
                                                                        <form>
                                                                            <input type="hidden" name='register_id' id="reg_id" value="{{$record->id}}"/>
                                                                        </form>
                                                                    </div>
                                                                    <div class="row m-t-25">
                                                                        <div class="col-sm-12">
                                                                            <button type="button" class="btn btn-xs bgm-cyan pull-right newln"><i class="zmdi zmdi-plus"> New line</i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-sm-3">
                                                        <button type="button" id="submittaken" class="submittaken btn bgm-cyan"><i>Submit</i></button>
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
                        <div id="modaltaken3">
                        </div>
                        <div class="row takendetail">  
                            <div class="col-sm-12">
                                <?php
                                $crrDate = date("Y-m-d");
                                $activestatus = "";
                                $active = "";
                                $n = 0;
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->prdtakens))
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-head card-padding pd-10-20">
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-4 text-center c-black">Things To Taken</div>
                                                            <div class="col-sm-2 text-center c-black">Quantity</div>
                                                            <div class="col-sm-2 text-center c-black">Isreturn</div>
                                                            <div class="col-sm-2 text-center c-black">
                                                                Comments
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body card-padding pd-10-20">
                                                @foreach($record->prdtakens as $prdtaken)
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
                                                            
                                                            <div class="col-sm-2 text-center">
                                                                    <button type="button" data-id={{$prdtaken->id}} class="btn bgm-orange waves-effect waves-float edittaken"><i class="zmdi zmdi-edit"></i></button>
                                                                    <a href="{{url('servicespareregister/deleteprd', $prdtaken->id)}}" target="_self">
                                                                        <button class="btn bgm-red waves-effect waves-float"><i class="zmdi zmdi-close"></i></button>
                                                                    </a>
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
                <div class="panel-heading color-block bgm-green" role="tab" id="headingAduit">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAduit" aria-expanded="false" aria-controls="collapseTwo">
                            Documents Upload
                        </a>
                    </h4>
                </div>
                <div id="collapseAduit" class="collapse" role="tabpanel" aria-labelledby="headingAduit">
                    <div class="panel-body p-10">
                        <div class="p-5 pull-right mm-55-0">
                            <a href="{{url('servicespareregister/addnew', $record->id)}}" target="_self">
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
                                                                <a href="{{url('servicespareregister/editdoc', $registeraudit->id)}}" target="_self">
                                                                    <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit"></i></button>
                                                                </a>
                                                                <a href="{{url('servicespareregister/deletedoc', $registeraudit->id)}}" target="_self">
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
        <!-- modal group -->
        
        <div id="emailmodal">
                                    
        </div>
        <div id="modalsent">
            <div id="modalsent2">
                <div class="modal fade sentform" id="sentform" role="dialog">
                    <div class="modal-dialog modal-lg" style="width:80%;">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4> Email Sent Form </h4>
                            </div>
                            <div class="card card-bady emailloader text-center">
                                <div class="preloader pl-lg">
                                    <svg class="pl-circular" viewBox="25 25 50 50">
                                        <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                    </svg>
                                    <span class="m-t-25 f-12">Loading....</span>
                                </div>

                            </div>
                                
                            <div class="mailform" style="display: none;">
                                <form id="offermail" enctype='multipart/form-data'  action="" method="post">
                                    <div class="modal-body">
                                        <div class="row">
                                            <input type="hidden" name="fromaddress" class="form-control fromaddress" readonly placeholder="From Address">                                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-account f-14">&nbsp;To &nbsp;&nbsp;</i></span>
                                                    <div class="fg-line">
                                                        <input type="text" name="toaddress" class="form-control toaddress" placeholder="To Address">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-accounts-alt f-14">&nbsp;CC &nbsp;</i></span>
                                                    <div class="fg-line">
                                                        <input type="text" name="ccaddress" class="form-control ccaddress" placeholder="CC Address">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-format-subject f-14">&nbsp;Sub </i></span>
                                                    <div class="fg-line">
                                                        <input type="text" name="subject" class="form-control subject" id="subject" placeholder="Subject">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row m-t-20">
                                            <div class="col-sm-12">
                                                 <textarea class="summernote input-block-level" id="content" name="content" rows="18"></textarea>
                                            </div>
                                        </div>
                                        <div class="row m-t-25">
                                            <div class="col-sm-6">
                                                <p class="f-500 c-black m-b-20">Attachments
                                                    <button type="button" class="btn bgm-teal waves-effect emailattach" title="Add Attach"><i class="zmdi zmdi-attachment"> </i></button>                                    
                                                </p>
                                                <div class="mailattach " style="display: none">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn btn-primary btn-file m-r-10">
                                                            <span class="fileinput-new">Select file</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" class="email_attach" name="attachment">
                                                        </span>
                                                        <span class="fileinput-filename"></span>
                                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                    </div>
                                                    <button type="button" class="btn bgm-red waves-effect closeattach pull-right" title="Close"><i class="zmdi zmdi-close"> </i></button>                                    

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn bgm-cyan btn-icon waves-effect mailsend"><i class="zmdi zmdi-mail-send"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="card card-bady emailsendloader text-center" style="display: none;">
                                <div class="preloader pl-lg">
                                    <svg class="pl-circular" viewBox="25 25 50 50">
                                        <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                    </svg>
                                    <span class="m-t-25">Mail Sending Inprogress....</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- modal end --->
        
        <!--- Offer Modal --->
        <div id="offermodal">
            <form>
                
            </form>                        
        </div>
        
        <div class="offerfirst" >
            <div class="modal fade offerform" id="offerform" role="dialog">
                <div class="modal-dialog  modal-lg" style="width:98%">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4>Offer Form</h4>
                            <small></small>
                        </div>
                        <?php $currentdate =date('Y-m-d'); ?>
                        <!--if(!empty($offerdata))-->
                            <div class="modal-body">
                                <div class="row m-l-10" role="form">
                                    <div class="form-group col-sm-6">
                                        <label for="offervalidity" class="control-label col-sm-4 required">Offer Validity</label>
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                <input type="hidden" name="spares_register_id" value="{{$record->id}}">
                                                <input type="hidden" name="revision_no" id="revision_no" value="">
                                                @if(!empty($offerdata))
                                                <input type="hidden" name="last_offer_id" id="last_offer_id" value="{{$offerdata->id}}">
                                                @endif

                                                <select class="form-control input-sm" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="offervalidity" name="offervalidity">
                                                    @foreach($offervalidity as $offerval=>$offername)
                                                        @if(!empty($offerdata))
                                                            @if($offerval == $offerdata->offervalidity)
                                                                <option value="{{$offerval}}" selected>{{$offername}}</option>
                                                            @else 
                                                                <option value="{{$offerval}}">{{$offername}}</option>
                                                            @endif
                                                        @else 
                                                                <option value="{{$offerval}}">{{$offername}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>  

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="freight" class="control-label col-sm-4 required">Freight</label>
                                        <div class="col-sm-8">
                                            <div class="fg-line">

                                                <select class="form-control input-sm" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="freight" name="freight">
                                                    @foreach($freight as $freightval=>$freightname)
                                                        @if(!empty($offerdata))
                                                            @if($freightval == $offerdata->freight)
                                                                <option value="{{$freightval}}" selected>{{$freightname}}</option>
                                                            @else 
                                                                <option value="{{$freightval}}">{{$freightname}}</option>
                                                            @endif
                                                        @else 
                                                                <option value="{{$freightval}}">{{$freightname}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>                                                                                    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="deliveryperiod" class="control-label col-sm-4 required">Delivery period</label>
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                <select class="form-control input-sm" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="deliveryperiod" name="deliveryperiod">
                                                    @foreach($deliveryperiod as $deliveryperiodval=>$deliveryperiodname)
                                                        @if(!empty($offerdata))
                                                            @if($deliveryperiodval == $offerdata->deliveryperiod)
                                                                <option value="{{$deliveryperiodval}}" selected>{{$deliveryperiodname}}</option>
                                                            @else 
                                                                <option value="{{$deliveryperiodval}}">{{$deliveryperiodname}}</option>
                                                            @endif
                                                        @else
                                                                <option value="{{$deliveryperiodval}}">{{$deliveryperiodname}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>                                                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <label for="paymentterms" class="control-label col-sm-3 required">Payment terms</label>
                                        <div class="col-sm-9">
                                            <div class="fg-line">
                                                <select class="form-control input-sm f-10" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="paymentterms" name="paymentterms">
                                                    @foreach($paymentterms as $paymenttermsval=>$paymenttermsname)
                                                        @if(!empty($offerdata))
                                                            @if($paymenttermsval == $offerdata->paymentterms)
                                                                <option value="{{$paymenttermsval}}" selected>{{$paymenttermsname}}</option>
                                                            @else 
                                                                <option value="{{$paymenttermsval}}">{{$paymenttermsname}}</option>
                                                            @endif
                                                        @else 
                                                                <option value="{{$paymenttermsval}}">{{$paymenttermsname}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>                                                                                    
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="creditdays">
                                        <div class="form-group col-sm-4">
                                            <label for="dayscredit" class="control-label col-sm-4">No of Days Credit</label>
                                            <div class="col-sm-8">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" placeholder="No of Days Credit" name="dayscredit" type="text" id="dayscredit">                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="form-group col-sm-12">
                                        <label for="terms" class="control-label col-sm-1">Terms</label>
                                        <div class="col-sm-11">
                                            <div class="fg-line">
                                                <textarea class="form-control input-sm" cols="20" rows="13" placeholder="Terms" name="terms" id="terms"  >{{$terms}}</textarea>                                        
                                            </div>
                                            <div class="termsdiv hide">{{$terms}}</div>
                                        </div>
                                    </div>

                                </div>    
                                <div class="form-row m-t-25">
                                    <div class="col-sm-3 m-t-25">
                                        <button type="button" id="addoffer" class="addoffer btn bgm-cyan"><i>ADD</i></button>
                                    </div>
                                </div>                 
                            </div>
                            <div class="modal-footer m-t-25">
                                <button data-dismiss="modal" class="btn bgm-cyan btn-icon waves-effect waves-circle waves-float pull-right"><i class="zmdi zmdi-close"></i></button>
                            </div>
                        <!--endif-->
                    </div>
                </div>
            </div>
                            
        </div>
        @if(!empty($offerdata))
        <div class="offersecond" >
            <div class="modal fade offerform" id="offerform" role="dialog">
                <div class="modal-dialog  modal-lg" style="width:98%">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4>Offer Form</h4>
                            <small></small>
                        </div>
                        <?php $currentdate =date('Y-m-d'); ?>
                        <div class="modal-body">
                            <div class="row m-l-10" role="form">
                                <div class="form-group col-sm-6">
                                    <label for="offervalidity" class="control-label col-sm-4 required">Offer Validity</label>
                                    <div class="col-sm-8">
                                        <div class="fg-line">
                                            <input type="hidden" name="spares_register_id" value="{{$record->id}}">
                                            <input type="hidden" name="revision_no" id="revision_no" value="">
                                            <input type="hidden" name="last_offer_id" id="last_offer_id" value="{{$offerdata->id}}">
                                            <select class="form-control input-sm" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="offervalidity" name="offervalidity">
                                                @foreach($offervalidity as $offerval=>$offername)
                                                    <option value="{{$offerval}}">{{$offername}}</option>
                                                @endforeach
                                            </select>                                                                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="freight" class="control-label col-sm-4 required">Freight</label>
                                    <div class="col-sm-8">
                                        <div class="fg-line">
                                            <select class="form-control input-sm" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="freight" name="freight">
                                                @foreach($freight as $freightval=>$freightname)
                                                    <option value="{{$freightval}}">{{$freightname}}</option>
                                                @endforeach
                                            </select>                                                                                    
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="deliveryperiod" class="control-label col-sm-4 required">Delivery period</label>
                                    <div class="col-sm-8">
                                        <div class="fg-line">
                                            <select class="form-control input-sm" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="deliveryperiod" name="deliveryperiod">
                                                @foreach($deliveryperiod as $deliveryperiodval=>$deliveryperiodname)
                                                    <option value="{{$deliveryperiodval}}">{{$deliveryperiodname}}</option>
                                                @endforeach
                                            </select>                                                                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-8">
                                    <label for="paymentterms" class="control-label col-sm-3 required">Payment terms</label>
                                    <div class="col-sm-9">
                                        <div class="fg-line">
                                            <select class="form-control input-sm f-10" placeholder="Validity" aria-describedby="basic-addon1" data-validation="required" required="required" id="paymentterms" name="paymentterms">
                                                @foreach($paymentterms as $paymenttermsval=>$paymenttermsname)
                                                    <option value="{{$paymenttermsval}}">{{$paymenttermsname}}</option>
                                                @endforeach
                                            </select>                                                                                    
                                        </div>
                                    </div>
                                </div>
                                @if($offerdata->paymentterms == 3)
                                <div class="creditdays">
                                    <div class="form-group col-sm-4">
                                        <label for="dayscredit" class="control-label col-sm-4">No of Days Credit</label>
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                <input class="form-control input-sm" placeholder="No of Days Credit" name="dayscredit" type="text" id="dayscredit">                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="creditdays hide">
                                    <div class="form-group col-sm-4">
                                        <label for="dayscredit" class="control-label col-sm-4">No of Days Credit</label>
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                <input class="form-control input-sm" placeholder="No of Days Credit" name="dayscredit" type="text" id="dayscredit">                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group col-sm-12">
                                    <label for="terms" class="control-label col-sm-1">Terms</label>
                                    <div class="col-sm-11">
                                        <div class="fg-line">
                                            <textarea class="form-control input-sm" cols="20" rows="13" placeholder="Terms" name="terms" id="terms"  >{{$terms}}</textarea>                                        
                                        </div>
                                        <div class="termsdiv hide">{{$terms}}</div>
                                    </div>
                                </div>

                            </div>    
                            <div class="form-row m-t-25">
                                <div class="col-sm-3 m-t-25">
                                    <button type="button" id="addoffer" class="addoffer btn bgm-cyan"><i>ADD</i></button>
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
        @endif
        <!-- End Offer Modal -->