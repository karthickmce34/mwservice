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
        <h2 class="f-400">Spares/Service Product</h2>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="card organisation">
        <div class="card-header">
            <h2>
                Upload <span class="label label-default">New</span>
                Spares/Service Call Register Documents
            </h2>
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <?php $currentdate =date('Y-m-d'); 
                       $timestamp = date('Y-m-d H:i:s');?>
                <form role="form" action="{{url('servicespareregister/storeprd')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">    
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="service_spares_register_id" id="service_spares_register_id" value="{{$id}}"/>
                        <div class="form-group col-sm-6">
                            <label for="product" class="control-label col-sm-3 required">Product Name</label>
                            <div class="col-sm-9">
                                <div class="fg-line prd">
                                    <input type="hidden" name="product_id" id="product_id" />
                                    <input type="text" class="input-sm col-sm-12" id="prdname"/>
                                    <label class="zmdi zmdi-search f-20 m-t-5"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="unit_price" class="control-label col-sm-3 required">Price</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="unit_price" name="unit_price" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="quantity" class="control-label col-sm-3 required">Qty</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" id="quantity" name="quantity" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="tax" class="control-label col-sm-3 required">TAX</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <select class="form-control input-sm" placeholder="Status" aria-describedby="basic-addon1" data-validation="required" required="required" id="frm-complaint_type" name="complaint_type">
                                        <option value="">=== Select Tax ===</option>
                                        <option value="1">GST 18%</option>
                                        <option value="2">CGST 9% + SGST 9%</option>
                                    </select>                                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="total_price" class="control-label col-sm-3 required">Total</label>
                            <div class="col-sm-9">
                                <div class="fg-line">
                                    <input type='text' class="form-control input-sm" readonly id="total_price" name="total_price" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-6 text-center pull-left clear-left" >
                            <button class="btn bgm-lime waves-effect" type="submit" placeholder="Submit" value="Add" title="Add"><i class="zmdi zmdi-check"></i> Add</button>
                        </div>
                        <div class="form-group col-sm-6 col-xs-6 text-center">
                            <button class="btn bgm-cyan waves-effect" type="reset" placeholder="Clear" value="Clear"><i class="zmdi zmdi-close"></i> Clear</button>
                        </div>
                    </div>
                </form>
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
    <div id="modal3">

    </div>
</div>
@stop

@section('css')
@parent
<!--    
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}jonthornton-jquery-timepicker-107ab73/jquery.timepicker.css"/ >
-->        
@stop    
@section('js')
@parent
<!--    
    <script type="text/javascript" src="{{asset('/')}}jonthornton-jquery-timepicker-107ab73/jquery.timepicker.js"></script>
        
    <script type="text/javascript" src="{{asset('static/js/jquery.form-validator.js')}}"></script>
-->
<script>
    $(function () {
       $('#prdname').click(function(){
            var _site_url = "{{url('/')}}/";
            $("#modal3").find("#modalprd2").remove();
            var model2 = $("#modalprd").find("#modalprd2").clone();
            $("#modal3").append(model2);
            $("#modal3").find("#data-table-command").dataTable({
                    "lengthMenu": [ [100, 200], [100,200] ]
                  } );
            $("#modal3").find("#data-table-command").on('change','.prdradio',function(){
               var prdid = $(".prdradio:checked").val();
               var prdname = $(this).closest('tr').find(".pname").text();
               var unitprice = $(this).closest('tr').find(".price").text();
               $("#prdname").val(prdname);
               $("#unit_price").val(unitprice);
               $("#product_id").val(prdid);
               $("#modal3").find("#productform").modal('toggle');
            });
            $("#modal3").find("#productform").modal();
            
            
            $("#unit_price").on('change',function(){
                var price = $("#unit_price").val();
                var quantity = $("#quantity").val();
                var tot = parseFloat(price)*parseFloat(quantity);
                $("#total_price").val(tot);
            });
            
            $("#quantity").on('change',function(){
                var price = $("#unit_price").val();
                var quantity = $("#quantity").val();
                var tot = parseFloat(price)*parseFloat(quantity);
                $("#total_price").val(tot);
            });
            
            /*var query = $('#countryid').val();
                        var _site_url = "{{url('/')}}/";
                var dataConfig = {
                    query: query,
                };

                var controller = 'servicespareregister/';

                $.ajax({
                    method: "POST",
                    url: _site_url + controller + "find2",
                    data: dataConfig,

                }).done( function( data, textStatus, jqXHR ) {
                    console.log( " ajax done " );
                    swal({   
                                    title: "Downloaded",   
                                    text: "Report Downloaded SucessFully",   
                                    type: "success",   
                                    showCancelButton: false,   
                                    allowOutsideClick: false
                                    });
                    
                    

                }).fail( function( jqXHR, textStatus, errorThrown ) {
                    console.log( " ajax fail " );
                    console.log( jqXHR, textStatus, errorThrown );
                }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                    console.log( " ajax always " );
                    console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                }); */
            
            
            
       });
       
    });
</script>
@stop



