@extends('_layouts.app')

@section('title', 'Complaint Register')
@section('page_title', 'Complaint Register')
@section('page_icon_cls', 'fa-building')

@section('page_spares_li_cls', 'toggled active')
@section('page_complaintregister_li_cls', 'toggled active')
@section('page_complaintregister_li_list_cls', 'active')
@section('page_complaintregister_li_add_cls', '')
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
    
        
        @include('_common.base_detail')
@stop

@section('css')
    @parent

@stop    
@section('js')
    @parent

<script>

    $(function () {
            
            var _site_url = "{{url('/')}}/";
            
            $(".spdet").hide();
            $(".spdepartment").hide();
            
            $(".invsolve").click(function(){
                
                $("#modal3").find("#modalservice1").remove();
                var id = $(this).data('id');
                var type = $(this).data('type');
                var mode = $(this).data('mode');

                if(parseInt(type) == 0)
                {
                    var model2 = $("#modalservice").find("#modalservice1").clone();
                    $("#modal3").append(model2);
                    
                }
                else 
                {
                    if(parseInt(type) == 1)
                    {
                        var model2 = $("#modalservice").find("#modalservice1").clone();
                        $("#modal3").append(model2);
                    }
                    else
                    {   
                        var model2 = $("#modalservice").find("#modalservice1").clone();
                        $("#modal3").append(model2);
                    }
                }
                    
                
                var remove = $('.bootstrap-select');
                $(remove).replaceWith($(remove).contents('.selectpicker'));
                $('.selectpicker').selectpicker();
                
                $("#modal3").find("#completeform").modal();
                $(".spdet").hide();
                $(".spdepartment").hide();
                $("#modal3").find("#comp_status").change(function(){
                    var stat=$(this).val(); 
                    if(stat==1 || stat==4 || stat==5)
                    {
                        if(stat==1 || stat==4)
                        {
                            $(".spdet").show();
                        }
                        else
                        {
                            $(".spdet").hide();
                        }
                            
                        $(".spdepartment").show();
                    }
                    else
                    {
                        $(".spdet").hide();
                        $(".spdepartment").hide();
                    }
                 });
                 
                $("#modal3").find("#amc").click(function(){
                    var amcval = $("#modal3").find("#amcval").val();
                    if(amcval == 1)
                    {
                        $("#modal3").find("#amcval").val(0);
                        $("#modal3").find(".addspline").show();
                        $("#modal3").find(".amcsersecond").addClass("appsersecond").removeClass("amcsersecond");
                        $("#modal3").find(".appsersecond .row").remove();
                        product();
                        productreset();
                    }
                    else
                    {
                        $("#modal3").find("#amcval").val(1);
                        $("#modal3").find(".addspline").hide();
                        $("#modal3").find(".appsersecond").addClass("amcsersecond").removeClass("appsersecond");
                        $("#modal3").find(".amcsersecond .row").remove();
                        amcproduct();
                        
                        /**** amc product starts******/
                        $("#modal3").find(".amcsersecond").on('change','.amc_tax_id',function(e){
                            var tax_id = $(this).val();
                            var rowno = $(this).closest('.row').index();
                            var qty = 1;
                            var amt = $("#modal3").find(".amcsersecond .row").eq(rowno).find('.amc_amount').val();
                            amctaxcalc(qty,amt,tax_id,rowno);
                        });
                        $("#modal3").find(".amcsersecond").on('change','.amc_amount',function(e){
                            var rowno = $(this).closest('.row').index();
                            var tax_id = $("#modal3").find(".amcsersecond .row").eq(rowno).find('.amc_tax_id').val();
                            var qty = 1;
                            var amt = $(this).val();
                            if(tax_id != "")
                            {
                                amctaxcalc(qty,amt,tax_id,rowno);
                            }
                        });
                        /**** amc product ends******/
                    }
                    
                     
                 });
                 
                 $("#modal3").find("#faultrectification").click(function(){
                    var faultrectification = $("#modal3").find("#faultrectval").val();
                    if(faultrectification == 1)
                    {
                        $("#modal3").find("#faultrectval").val(0);
                        $("#modal3").find("#department").attr('required','false');
                        
                    }
                    else
                    {
                        $("#modal3").find("#faultrectval").val(1);
                        $("#modal3").find("#department").attr('required','true');
                    }
                 });
                 
                 $("#modal3").find("#othersscope").click(function(){
                    var othrval = $("#modal3").find("#othrval").val();
                    if(othrval == 1)
                    {
                        $("#modal3").find("#othrval").val(0);
                        $("#modal3").find("#scope_of_work").val('');
                        $("#modal3").find("#scope_of_work").attr('readonly','true');
                    }
                    else
                    {
                        $("#modal3").find("#othrval").val(1);
                        $("#modal3").find("#scope_of_work").removeAttr('readonly');
                    }
                    
                     
                 });
                
                $("#modal3").find(".amcserfirst").hide();
                $("#modal3").find(".appserfirst").hide();
                $("#modal3").find(".addspline").on('click',function(){
                    product();
                    productreset();
                });
                
                product();
                productreset();
                function product()
                {
                    $("#modal3").find(".appserfirst").show();
                    var prd = $("#modal3").find(".appserfirst .row").clone();
                    $("#modal3").find(".appsersecond").append(prd).unbind().on('click','.prdclose',function(event){
                            event.preventDefault();
                            //alert();
                            $(this).closest(".row").remove();
                            productreset();
                            });
                    $("#modal3").find(".appserfirst").hide();
                   
                }
                $("#modal3").find(".appsersecond .product").on('click',function(){
                    var _this= this;
                    var indx = $(this).closest(".row").index();
                    $("#modalser5").find("#modalserprd2").remove();
                    var model2 = $("#modalserprd").find("#modalserprd2").clone();
                    $("#modalser5").append(model2);
                    $("#modalser5").find("#data-table-command").dataTable({
                        "lengthMenu": [ [100, 200], [100,200] ],
                        } );
                      $("div.dataTables_filter input").focus();
                    $("#modalser5").find("#data-table-command").on('change','.prdradio',function(){
                        var prdid = $(".prdradio:checked").val();
                        var prdname = $(this).closest('tr').find(".pname").text();
                       var unitprice = $(this).closest('tr').find(".amount").text();
                       $(".appsersecond").find(".product").eq(indx).val(prdname);
                       $(".appsersecond").find(".amount").eq(indx).val(unitprice);
                       $(".appsersecond").find(".product_id").eq(indx).val(prdid);
                       $("#modalser5").find("#serproductform").modal('toggle');
                       $(".appsersecond").find(".qty").eq(indx).focus();
                       
                    });
                    $("#modalser5").find("#serproductform").modal();


                    $(".appsersecond").unbind().on('change','.amount',function(){
                        var indx = $(this).closest(".row").index();
                        var price = $(this).val();
                        var quantity = $(".appsersecond").find(".qty").eq(indx).val();
                        var tot = parseFloat(price)*parseFloat(quantity);
                        $(".appsersecond").find(".total").eq(indx).val(tot);
                    });

                    $(".appsersecond").unbind().on('change','.qty',function(){
                        var indx = $(this).closest(".row").index();
                        var price = $(".appsersecond").find(".amount").eq(indx).val();
                        var quantity = $(this).val();
                        var tot = parseFloat(price)*parseFloat(quantity);
                        $(".appsersecond").find(".total").eq(indx).val(tot);
                    });



                });
                
                function amcproduct()
                {
                    $("#modal3").find(".amcserfirst").show();
                    var prd = $("#modal3").find(".amcserfirst .row").clone();
                    $("#modal3").find(".amcsersecond").append(prd);
                    $("#modal3").find(".amcserfirst").hide();
                    
                }
                /**** other amc product******/
                /*$("#modal3").find(".appsersecond").on('change','.tax_id',function(e){
                    var tax_id = $(this).val();
                    var rowno = $(this).closest('.row').index();
                    var qty = $("#modal3").find(".appsersecond .row").eq(rowno).find('.qty').val();
                    var amt = $("#modal3").find(".appsersecond .row").eq(rowno).find('.amount').val();
                    taxcalc(qty,amt,tax_id,rowno);
                });
                $("#modal3").find(".appsersecond").on('change','.amount',function(e){
                    var rowno = $(this).closest('.row').index();
                    var tax_id = $("#modal3").find(".appsersecond .row").eq(rowno).find('.tax_id').val();
                    var qty = $("#modal3").find(".appsersecond .row").eq(rowno).find('.qty').val();
                    var amt = $(this).val();
                    if(tax_id != "")
                    {
                        taxcalc(qty,amt,tax_id,rowno);
                    }
                });
                $("#modal3").find(".appsersecond").on('change','.qty',function(e){
                    var rowno = $(this).closest('.row').index();
                    var tax_id = $("#modal3").find(".appsersecond .row").eq(rowno).find('.tax_id').val();
                    var qty = $(this).val();
                    var amt = $("#modal3").find(".appsersecond .row").eq(rowno).find('.amount').val();
                    if(tax_id != "")
                    {
                        taxcalc(qty,amt,tax_id,rowno);
                    }
                });*/
                
                
                function productreset()
                {
                    var len=$("#modal3").find(".appsersecond .row").length;
                    for(var i=0;i<len;i++)
                    {
                        var j=parseInt(i)+1;
                        $("#modal3").find(".appsersecond .row").eq(i).find(".product_id").attr("name","product_id["+j+"]");
                        $("#modal3").find(".appsersecond .row").eq(i).find(".product").attr("name","product["+j+"]");
                        $("#modal3").find(".appsersecond .row").eq(i).find(".qty").attr("name","qty["+j+"]");
                        $("#modal3").find(".appsersecond .row").eq(i).find(".tax_id").attr("name","tax_id["+j+"]");
                        $("#modal3").find(".appsersecond .row").eq(i).find(".tax_amt").attr("name","tax_amt["+j+"]");
                        $("#modal3").find(".appsersecond .row").eq(i).find(".amount").attr("name","amount["+j+"]");
                        $("#modal3").find(".appsersecond .row").eq(i).find(".total").attr("name","total["+j+"]");
                        
                        $("#modal3").find(".appsersecond .product").unbind().on('click',function(){
                            
                            var _this= this;
                            
                            var indx = $(this).closest(".row").index();
                            $("#modalser5").find("#modalserprd2").remove();
                            var model2 = $("#modalserprd").find("#modalserprd2").clone();
                            $("#modalser5").append(model2);
                            $("#modalser5").find("#data-table-command").dataTable({
                                "lengthMenu": [ [100, 200], [100,200] ],
                                } );
                            $("div.dataTables_filter input").focus();
                            $("#modalser5").find("#data-table-command").on('change','.prdradio',function(){
                                var prdid = $(".prdradio:checked").val();
                                var prdname = $(this).closest('tr').find(".pname").text();
                                var unitprice = $(this).closest('tr').find(".amount").text();
                                $(".appsersecond").find(".product").eq(indx).val(prdname);
                                $(".appsersecond").find(".amount").eq(indx).val(unitprice);
                                $(".appsersecond").find(".product_id").eq(indx).val(prdid);
                                $("#modalser5").find("#serproductform").modal('toggle');
                                $(".appsersecond").find(".qty").eq(indx).focus();

                            });
                            $("#modalser5").find("#serproductform").modal();
                            
                            
                            
                            $("#modal3").find(".appsersecond").find(".qty").unbind().on('change',function(){
                                var rowno = $(this).closest('.row').index();
                                
                                var tax_id = $(".appsersecond").find(".tax_id").eq(rowno).val();
                                var qty = $(this).val();
                                var amt = $(".appsersecond").find(".amount").eq(rowno).val();
                                if(tax_id != "")
                                {
                                    taxcalc(qty,amt,tax_id,rowno);
                                }
                            });
                            
                            $("#modal3").find(".appsersecond").find(".amount").unbind().on('change',function(){
                                var rowno = $(this).closest('.row').index();
                                var tax_id = $(".appsersecond").find(".tax_id").eq(rowno).val();
                                var qty = $(".appsersecond").find(".qty").eq(rowno).val();
                                var amt = $(this).val();
                                if(tax_id != "")
                                {
                                    taxcalc(qty,amt,tax_id,rowno);
                                }
                            });

                            $("#modal3").find(".appsersecond").find(".tax_id").unbind().on('change',function(){
                                var tax_id = $(this).val();
                                var rowno = $(this).closest('.row').index();
                                var qty = $(".appsersecond").find(".qty").eq(rowno).val();
                                var amt = $(".appsersecond").find(".amount").eq(rowno).val();
                                taxcalc(qty,amt,tax_id,rowno);
                            });
                        });
                    }
                }
                
                function taxcalc(qty,amt,tax_id,rowno)
                {
                    $('.teruser').hide();
                    var datanew = {tax_id:tax_id};
                                    
                    var controller = 'complaintregister/';

                    $.ajax({
                        method: "POST",
                        url: _site_url + controller + "taxcalc",
                        data: datanew,

                    }).done( function( data, textStatus, jqXHR ) {
                        console.log(data);
                        if(data.status ==1)
                        {
                            var netamt= parseFloat(qty)*parseFloat(amt);
                            var taxamt = (parseFloat(netamt)*parseFloat(data.rate))/100;
                            var tot = parseFloat(netamt)+parseFloat(taxamt);
                            $("#modal3").find(".appsersecond .row").eq(rowno).find('.tax_amt').val(taxamt);
                            $("#modal3").find(".appsersecond .row").eq(rowno).find('.total').val(tot);
                            $('.teruser').show();
                        }
                        else
                        {
                            $("#modal3").find(".appsersecond .row").eq(rowno).find('.qty').val(0);
                            $("#modal3").find(".appsersecond .row").eq(rowno).find('.tax_amt').val(0);
                            $("#modal3").find(".appsersecond .row").eq(rowno).find('.total').val(0);
                        }


                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        //console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                }
                
                function amctaxcalc(qty,amt,tax_id,rowno)
                {
                    var datanew = {tax_id:tax_id};
                                    
                    var controller = 'complaintregister/';

                    $.ajax({
                        method: "POST",
                        url: _site_url + controller + "taxcalc",
                        data: datanew,

                    }).done( function( data, textStatus, jqXHR ) {
                        console.log(data);
                        if(data.status ==1)
                        {
                            var netamt= parseFloat(qty)*parseFloat(amt);
                            var taxamt = (parseFloat(netamt)*parseFloat(data.rate))/100;
                            var tot = parseFloat(netamt)+parseFloat(taxamt);
                            $("#modal3").find(".amcsersecond .row").eq(rowno).find('.amc_tax_amt').val(taxamt);
                            $("#modal3").find(".amcsersecond .row").eq(rowno).find('.amc_total').val(tot);
                        }
                        else
                        {
                            $("#modal3").find(".amcsersecond .row").eq(rowno).find('.amc_qty').val(0);
                            $("#modal3").find(".amcsersecond .row").eq(rowno).find('.amc_tax_amt').val(0);
                            $("#modal3").find(".amcsersecond .row").eq(rowno).find('.amc_total').val(0);
                        }


                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        //console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                }
                
                $('.teruser').click(function(){
                    $(this).hide();
                    var comp_status = $("#modal3").find('#comp_status :selected').val();
                    var remark = $("#modal3").find('#remark').val();
                    
                    if(parseInt(comp_status) == 0)
                    {
                        var datanew = {comp_status : comp_status,
                                       remark : remark,
                                       id:id,
                                   };
                        var controller = 'complaintregister/';
                        
                        $.ajax({
                                method: "POST",
                                url: _site_url + controller + "updatestatus",
                                data: datanew,

                            }).done( function( data, textStatus, jqXHR ) {
                                console.log( " ajax done " );
                                if(data.status ==1)
                                {
                                    $("#modal3").find("#completeform").modal('hide');
                                    if(comp_status == 0)
                                    {
                                        window.location.reload();
                                    }
                                    else
                                    {
                                        //var newurl= _site_url+"servicespareregister/"+data.cusid+"/edit";
                                        $(".invsolve").hide();
                                        $(".invcancel").hide();
                                        var newurl= _site_url+"servicespareregister/"+data.cusid;
                                        window.location.href=newurl;


                                    }

                                }
                                else
                                {
                                    $("#modal3").find("#completeform").modal('hide');
                                }


                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            });
                    }
                    else
                    {
                        if(parseInt(comp_status) == 1)
                        {
                            var comp_stat = $("#comp_status :selected").val(); 
                            var chkval = [];
                            $("#modal3").find('.sow :checkbox:checked').each(function(i){
                              chkval[i] = $(this).val();
                            });
                            var scope_of_work = $("#modal3").find("#scope_of_work").val();
                            var probefailue = $("#modal3").find("#failure_cause").val();

                            var department = $("#modal3").find("#department").val();

                            var form_data = $("#modal3").find('form').serializeArray();

                            var formarray={};
                            $.map(form_data, function(n, i){
                                var nms = n['name'];
                                var vl = n['value'];

                                formarray[nms]=vl;

                            });

                            if(chkval.length >=1)
                            {
                                console.log(chkval.includes('Fault Rectification'));
                                if(chkval.includes('Fault Rectification') == true)
                                {
                                  
                                  if(department !="" && department != null)
                                  {
                                      var datanew = $("#modal3").find('form').serialize() +
                                                "&comp_status="+comp_status+
                                                "&remark="+remark+
                                                "&id="+id+
                                                "&chkval="+chkval+
                                                "&scopeofwork="+scope_of_work+
                                                "&failure_cause="+probefailue+
                                                "&department="+department;

                                    var controller = 'complaintregister/';
                                //console.log(scope_of_work);
                                    $.ajax({
                                        method: "POST",
                                        url: _site_url + controller + "updatestatus",
                                        data: datanew,

                                    }).done( function( data, textStatus, jqXHR ) {
                                        console.log( " ajax done " );
                                        if(data.status ==1)
                                        {
                                            $("#modal3").find("#completeform").modal('hide');
                                            if(comp_status == 0)
                                            {
                                                window.location.reload();
                                            }
                                            else
                                            {
                                                //var newurl= _site_url+"servicespareregister/"+data.cusid+"/edit";
                                                $(".invsolve").hide();
                                                $(".invcancel").hide();
                                                var newurl= _site_url+"servicespareregister/"+data.cusid;
                                                window.location.href=newurl;


                                            }

                                        }
                                        else
                                        {
                                            $("#modal3").find("#completeform").modal('hide');
                                        }


                                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                                        console.log( " ajax fail " );
                                        console.log( jqXHR, textStatus, errorThrown );
                                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                        console.log( " ajax always " );
                                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                                    });
                                  }
                                  else
                                  {
                                      alert("Choose Department");
                                      $('.teruser').show();
                                  }
                                    
                                }
                                
                                /*var dataConfig = {
                                    comp_status: comp_status,
                                    remark:remark,
                                    id:id,
                                    chkval:chkval,
                                    scopeofwork:scope_of_work,
                                    failure_cause:probefailue,
                                    data1:$("#modal3").find('form').serialize() 

                                };*/
                                    
                            }
                            else
                            {
                                alert("Check Scope Of Work");
                                
                            }
                        }
                        else
                        {
                            var comp_stat = $("#comp_status :selected").val(); 
                            
                            var department = $("#modal3").find("#department").val();
                            
                            if(department == "")
                            {
                                alert("Choose Department");
                            }
                            else
                            {
                                var datanew = {id:id,comp_status :comp_status,remark :remark,department:department};

                                var controller = 'complaintregister/';
                            //console.log(scope_of_work);
                                $.ajax({
                                    method: "POST",
                                    url: _site_url + controller + "updatestatus",
                                    data: datanew,

                                }).done( function( data, textStatus, jqXHR ) {
                                    console.log( " ajax done " );
                                    if(data.status ==1)
                                    {
                                        $("#modal3").find("#completeform").modal('hide');
                                        if(comp_status == 0)
                                        {
                                            window.location.reload();
                                        }
                                        else
                                        {
                                            //var newurl= _site_url+"servicespareregister/"+data.cusid+"/edit";
                                            $(".invsolve").hide();
                                            $(".invcancel").hide();
                                            var newurl= _site_url+"servicespareregister/"+data.cusid;
                                            window.location.href=newurl;


                                        }

                                    }
                                    else
                                    {
                                        $("#modal3").find("#completeform").modal('hide');
                                    }


                                }).fail( function( jqXHR, textStatus, errorThrown ) {
                                    console.log( " ajax fail " );
                                    console.log( jqXHR, textStatus, errorThrown );
                                }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                    console.log( " ajax always " );
                                    console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                                });
                            }
                            
                                
                        }
                            
                    }
                      
                });
            });
            
            
                
    });
</script>
@stop


