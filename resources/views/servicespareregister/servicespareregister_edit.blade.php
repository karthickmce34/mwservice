@extends('_layouts.app')

@section('title', 'Service Spare Register')
@section('page_title', 'Service Spare Register')
@section('page_icon_cls', 'fa-building')

@section('page_spares_li_cls', 'toggled active')
@section('page_servicespareregister_li_cls', 'toggled active')
@section('page_servicespareregister_li_list_cls', 'active')
@section('page_servicespareregister_li_add_cls', '')


@section('style')
@parent
<style>

</style> 
@stop
@section('menu')
@parent
@stop
@section('content')
@parent
<div class="">
    <!--BEGIN INPUT TEXT FIELDS-->
    <div class="text-center">
        <h2 class="f-400">Spares/Service Call Register</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Edit <span class="label label-default"></span>
                Spares/Service Call Register
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">

                <form role="form" action="{{url('servicespareregister')}}/{{$modelData->id}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="_method" id="_method" value="PUT"/>
                        <input name="id" type="hidden" value="{{$modelData->id}}">
                        @if($modelData->complaint_type == 3)
                        <div class="form-group col-sm-6">
                            <label for="bp_name" class="control-label col-sm-4 required">Complaint Type</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="complaint_type" name="complaint_type">
                                        @if($modelData->complaint_type == 0)
                                        <option value="0" selected>Service</option>
                                        @else 
                                        @if($modelData->complaint_type == 1)
                                        <option value="1" selected>Spares</option>
                                        @else
                                        <option value="2" selected>Service & Spares</option>
                                        @endif
                                        @endif
                                    </select>                                        
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group col-sm-6">
                            <label for="complaint_date" class="control-label col-sm-4">Register Date</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm date-picker" disabled="disabled" value="{{$modelData->compreg->complaint_date}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="customer_name" class="control-label col-sm-4">Customer</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    @if($modelData->complaint_type == 1)
                                    <input class="form-control input-sm" placeholder="Customer" type="text" value="{{$modelData->compreg->customer_name}}">                                        
                                    @else 
                                    <input class="form-control input-sm" placeholder="Customer" disabled="disabled"  type="text" value="{{$modelData->compreg->customer_name}}">                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label for="mobileno" class="control-label col-sm-4">Mobile no</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    @if($modelData->complaint_type == 5)
                                    <input class="form-control input-sm" placeholder="Mobile Number" disabled="disabled" type="text" value="{{$modelData->compreg->mobileno}}">                                        
                                    @else
                                    <input class="form-control input-sm" placeholder="Mobile Number" type="text" value="{{$modelData->compreg->mobileno}}">                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="emailid" class="control-label col-sm-4">Email</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    @if($modelData->complaint_type == 5)
                                    <input class="form-control input-sm" placeholder="Eg: example@gmail.com" disabled="disabled" type="text" value="{{$modelData->compreg->emailid}}">                                        
                                    @else 
                                    <input class="form-control input-sm" placeholder="Eg: example@gmail.com"  type="text" value="{{$modelData->compreg->emailid}}">                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="contact_person" class="control-label col-sm-4">Contact Person</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    @if($modelData->complaint_type == 5)
                                    <input class="form-control input-sm " placeholder="Contact Person" disabled="disabled" type="text"  value="{{$modelData->compreg->contact_person}}">                                        
                                    @else 
                                    <input class="form-control input-sm " placeholder="Contact Person" type="text"  value="{{$modelData->compreg->contact_person}}">                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($modelData->complaint_type == 0)
                        <div class="form-group col-sm-6">
                            <label for="panel_descrption" class="control-label col-sm-4">Product Description</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Product Description"  type="text" disabled="disabled"  value="{{$modelData->compreg->panel_descrption}}">                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="failure_cause" class="control-label col-sm-4 required">Probable Cause of Failure</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Probable Cause of Failure" name="failure_cause" id="failure_cause" @if ($modelData->complaint_type == 0)data-validation="required" required="required" @endif >{{$modelData->failure_cause}}</textarea>                                        
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group col-sm-6">
                            <label for="po_date" class="control-label col-sm-4">Po Date</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="po_date" name="po_date" value="{{$modelData->po_date}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="po_ref" class="control-label col-sm-4">Po Refernce</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Po Refernce" name="po_ref" type="text" id="po_ref">                                        
                                </div>
                            </div>
                        </div> 
                        @if($modelData->complaint_type == 0)
                        <div class="form-group col-sm-6">
                           <label for="warrenty" class="control-label col-sm-4 required">Warranty</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Warranty" aria-describedby="basic-addon1" data-validation="required" required="required" id="warrenty" name="warrenty" >

                                        @if($modelData->compreg->warrenty == 0)
                                        <option value="0" selected>With Warranty</option>
                                        @else 
                                        <option value="1" selected>Out of Warranty</option>
                                        @endif
                                    </select>   
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label for="scope_of_work" class="control-label col-sm-4">Scope Of Work</label>
                            <div class="col-sm-4">
                                <?php $scope = array();
                                    if($modelData->scope_of_work)
                                    $scope = explode(",",json_decode($modelData->scope_of_work));?>
                                <div class="fg-line">
                                    <div class="checkbox">
                                        <label>
                                            @if(in_array('General Service',$scope))
                                            <input type="checkbox" name="scope_of_work[]" value="General Service" checked>
                                            @else 
                                            <input type="checkbox" name="scope_of_work[]" value="General Service">
                                            @endif
                                            <i class="input-helper">General Service</i>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if(in_array('Assessment',$scope))
                                            <input type="checkbox" name="scope_of_work[]" value="Assessment" checked>
                                            @else 
                                            <input type="checkbox" name="scope_of_work[]" value="Assessment">
                                            @endif
                                            <i class="input-helper">Assessment</i>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if(in_array('AMC',$scope))
                                            <input type="checkbox" name="scope_of_work[]" value="AMC" checked>
                                            @else 
                                            <input type="checkbox" name="scope_of_work[]" value="AMC">
                                            @endif
                                            <i class="input-helper">AMC</i>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if(in_array('Others',$scope))
                                            <input type="checkbox" name="scope_of_work[]" value="Others" checked>
                                            @else 
                                            <input type="checkbox" name="scope_of_work[]" value="Others">
                                            @endif
                                            <i class="input-helper">Others</i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="fg-line">
                                    <div class="checkbox">
                                        
                                        <label>
                                            @if(in_array('Commissioning',$scope))
                                            <input type="checkbox" name="scope_of_work[]" value="Commissioning" checked>
                                            @else 
                                            <input type="checkbox" name="scope_of_work[]" value="Commissioning">
                                            @endif
                                            <i class="input-helper">Commissioning</i>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if(in_array('Spares Fixing',$scope))
                                            <input type="checkbox" name="scope_of_work[]" value="Spares Fixing" checked>
                                            @else 
                                            <input type="checkbox" name="scope_of_work[]" value="Spares Fixing">
                                            @endif
                                            <i class="input-helper">Spares Fixing</i>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if(in_array('Fault Rectification',$scope))
                                            <input type="checkbox" name="scope_of_work[]" value="Fault Rectification" checked>
                                            @else 
                                            <input type="checkbox" name="scope_of_work[]" value="Fault Rectification">
                                            @endif
                                            <i class="input-helper">Fault Rectification</i>
                                        </label>
                                    </div>
                                    @if(in_array('Others',$scope))
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Scope Of Work" name="scope_of_work_o" id="scope_of_work"  >{{$modelData->scope_of_work_o}}</textarea>                                        
                                    @else 
                                    <textarea class="form-control input-sm" cols="20" rows="3" readonly placeholder="Scope Of Work" name="scope_of_work_o" id="scope_of_work"  ></textarea>                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--div class="form-group col-sm-6">
                            <label for="isbom" class="control-label col-sm-4">Is BOM</label>
                            <div class="col-sm-8">
                                <div class="checkbox">
                                    <label>
                                        @if($modelData->isbom =='0')
                                        <input type="checkbox" name="isbom" value="1">
                                        @else
                                        <input type="checkbox" name="isbom" value="1" checked>
                                        @endif
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                        </div-->
                        <div class="form-group col-sm-6">
                            <label for="things_to_take" class="control-label col-sm-4">Advance Amount</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Advance Amount" name="advance_amt" type="text" id="advance_amt">                                        
                                </div>
                            </div>
                        </div>
                        @if($modelData->complaint_type == 1)
                        <div class="form-group col-sm-6">
                            <label for="things_to_do" class="control-label col-sm-4">Clarification</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="3" placeholder="Clarification" name="things_to_do" id="things_to_do"  >{{$modelData->things_to_do}}</textarea>                                        
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group col-sm-6">
                            <label for="region_id" class="control-label col-sm-4 required">Region</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Region" aria-describedby="basic-addon1" data-validation="required" required="required" id="region_id" name="region_id">
                                        <option value="">=== Select Region ===</option>
                                        @foreach($regiondata as $region)
                                        
                                            @if($modelData->compreg->region_id == $region->id)
                                                <option value="{{$region->id}}" selected>{{$region->region_name}}</option>
                                            @else 
                                                <option value="{{$region->id}}">{{$region->region_name}}</option>                                           
                                            @endif
                                        @endforeach
                                        
                                    </select>                                                                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <label for="notes" class="control-label col-sm-2">Notes</label>
                            <div class="col-sm-10">
                                <div class="fg-line">
                                    <input class="form-control input-sm" placeholder="Notes" name="notes" type="text" id="notes">                                        
                                </div>
                            </div>
                        </div>
                        <!--div class="form-group col-sm-12">
                            <label for="terms" class="control-label col-sm-1">Terms</label>
                            <div class="col-sm-11">
                                <div class="fg-line">
                                    <textarea class="form-control input-sm" cols="20" rows="13" placeholder="Terms" name="terms" id="terms"  >{{$terms}}</textarea>                                        
                                </div>
                                <div class="termsdiv hide">{{$terms}}</div>
                            </div>
                        </div-->
                    </div> 
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-6 text-center pull-left clear-left" >
                            <button class="btn bgm-orange waves-effect" type="submit" placeholder="Submit" value="Add" title="Save"><i class="zmdi zmdi-check"></i> Save</button>
                        </div>
                        <div class="form-group col-sm-6 col-xs-6 text-center">
                            <button class="btn bgm-cyan waves-effect" type="reset" placeholder="Cancel" value="cancel"><i class="zmdi zmdi-close"></i><a href="{{url()->previous()}}" class="c-white"> Cancel</a></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@parent
   
@stop    
@section('js')
@parent

<script>

    $(function () {
        
                $(".creditdays").hide();
                
                $("#complaint_date").datepicker({dateFormat: 'yy-mm-dd'});
                $("#commissioned_date").datepicker({dateFormat: 'yy-mm-dd'});
                $("#date_supply").datepicker({dateFormat: 'yy-mm-dd'});
                $("#po_date").datepicker({dateFormat: 'yy-mm-dd'});
                
                
                
                terms();
                
                $("#offervalidity").change(function()
                {
                    terms();
                });
                $("#freight").change(function()
                {
                    terms();
                });
                $("#deliveryperiod").change(function()
                {
                    terms();
                });
                $("#paymentterms").change(function()
                {
                    var paymentterms = $(this).val();
                    if(parseInt(paymentterms)==3)
                    {
                        $(".creditdays").show();
                        terms();
                        $("#dayscredit").change(function()
                        {
                            terms();
                        });
                        
                    }
                    else
                    {
                        $(".creditdays").hide();
                        terms();
                    }
                });
                
                function terms()
                {
                    var offervalidity = $("#offervalidity option:selected").html();
                    var freight = $("#freight option:selected").html();
                    var deliveryperiod = $("#deliveryperiod option:selected").html();
                    var paymentterms = $("#paymentterms option:selected").val();
                    if(parseInt(paymentterms)==3)
                    {
                        var credit = $("#dayscredit").val();
                        var paywrd = credit+" Days Credit";
                    }
                    else
                    {
                        var paywrd = $("#paymentterms option:selected").html();
                    }
                    var terms = $(".termsdiv").html();
                    var otherterms = "\n * Prices quoted are ex-works(Salem) and Valid for  "+offervalidity+"\n * "+freight+"\n * Delivery Period Should be "+deliveryperiod+" from the date of receipt of Purchase Order. "+"\n * "+paywrd+"\n";

                    $("#terms").html(otherterms+terms);
                }
            });

</script>
@stop



