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
            $(".loader").hide();
            $(".prdfirst").hide();
            $(".offerfirst").hide();
            $(".payment").click(function(){
                $("#modal3").find("#modalpayment1").remove();
                var id = $(this).data('id');
                var compid = $(this).data('compid');
                var type = $(this).data('type');
                var model2 = $("#modalpayment").find("#modalpayment1").clone();
                $("#modal3").append(model2);
                
                var remove = $('.bootstrap-select');
                $(remove).replaceWith($(remove).contents('.selectpicker'));
                $('.selectpicker').selectpicker();
                
                $(".adv_pay").removeClass('hide');
                $("#modal3").find("#paymentform").modal();
                
                $("#modal3").find("#pay_status").on("change",function(){
                    var pay_status = $("#modal3").find("#pay_status :selected").val();
                    
                    if(pay_status == 2)
                    {
                        $(".adv_pay").removeClass('hide');
                        $(".pay_amt").addClass('hide');
                    }
                    else
                    {
                        $(".adv_pay").addClass('hide');
                    }
                    if(pay_status == 3)
                    {
                        $(".pay_amt").removeClass('hide');
                        //$(".tot_amt").removeClass('hide');
                    }
                    
                    if(pay_status == 4)
                    {
                        $(".pay_amt").addClass('hide');
                        $(".adv_pay").addClass('hide');
                    }
                });
                
                $('.teruser').click(function(){
                    $(this).hide();
                   var pay_mode = $("#modal3").find('#pay_mode :selected').val();
                   var pay_date = $("#modal3").find('#pay_date').val();
                   var pay_status = $("#modal3").find("#pay_status :selected").val();
                   var advance_amt = 0;
                   var payment_amt = 0;
                   
                   if(parseInt(pay_status) == 2)
                   {
                       advance_amt = $("#modal3").find("#advance_amt").val();
                   }
                   
                   if(parseInt(pay_status) != 2)
                   {
                       payment_amt = $("#modal3").find("#payment_amt").val();
                   }
                   
                   var dataConfig = {
                    pay_date: pay_date,
                    pay_mode:pay_mode,
                    pay_status:pay_status,
                    id:id,
                    compid:compid,
                    advance_amt:advance_amt,
                    payment_amt:payment_amt
                    };

                var controller = 'servicespareregister/';

                    $.ajax({
                        method: "POST",
                        url: _site_url + controller + "updatestatus",
                        data: dataConfig,

                    }).done( function( data, textStatus, jqXHR ) {
                        console.log( " ajax done " );
                        if(data.status ==1)
                        {
                            swal({   
                                        title: "Payment",   
                                        text: "Payment Added SucessFully",   
                                        type: "success",   
                                        showCancelButton: false,   
                                        allowOutsideClick: false,
                                        showCancelButton: false,   
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false,
                                    },function(){ 
                                        window.location.reload();
                                    });
                            $("#modal3").find("#paymentform").modal('hide');
                            if(pay_status==4)
                            {
                               $(".header_button").find(".payment").hide();
                               $(".header_button").find(".depute").show();
                            }
                        }
                        else
                        {
                            $("#modal3").find("#paymentform").modal('hide');
                        }


                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    }); 
                });
            });
            
            $(".offersetdefault").click(function()
            {
                $(this).hide();
                var offerid = $(this).data('offerid');
                var ssid = $(this).data('ssid');
                var controller = 'servicespareregister/';
                $.ajax({
                        method: "POST",
                        url: _site_url + controller + "updatedefault",
                        data: {offerid:offerid,ssid:ssid},

                    }).done( function( data, textStatus, jqXHR ) {
                        console.log( " ajax done " );
                        if(data.status ==1)
                        {
                            swal({   
                                        title: "Default",   
                                        text: "Default Set SucessFully",   
                                        type: "success",   
                                        showCancelButton: false,   
                                        allowOutsideClick: false,
                                        showCancelButton: false,   
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false,
                                    },function(){ 
                                        window.location.reload();
                                    });
                            
                                    
                        }
                        else
                        {
                           
                        }


                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        $(this).show();
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    }); 
            });
            
            
            
            /*$(".summernote").summernote({
                            placeholder: '',
                            height: 200,
                            popover: {
                                air: [
                                  ['color', ['color']],
                                  ['font', ['bold', 'underline', 'clear']]
                                ]
                            }
                        });*/
            
            $(".depute").click(function(){
                $("#modal3").find("#modaldepute1").remove();
                var id = $(this).data('id');
                var type = $(this).data('type');
                $(".agentdiv").hide();
                var model2 = $("#modaldepute").find("#modaldepute1").clone();
                $("#modal3").append(model2);
                $("#modal3").find('#depute_engineer').change(function(){
                    var dept = $(this).val();
                    if(parseInt(dept) == 0)
                    {
                        $(".agentdiv").hide();
                        $(".servicediv").show();
                    }
                    else
                    {
                        $(".agentdiv").show();
                        $(".servicediv").hide();
                    }
                });
                $("#modal3").find(".se_date_of_depature").attr("id","se_date_of_depature");
                $("#modal3").find(".se_date_of_return").attr("id","se_date_of_return");
                
                $("#modal3").find("#se_date_of_depature").datepicker({dateFormat: 'yy-mm-dd'});
                $("#modal3").find("#se_date_of_return").datepicker({dateFormat: 'yy-mm-dd'});
                
                $("#modal3").find(".sa_date_of_depature").attr("id","sa_date_of_depature");
                $("#modal3").find(".sa_date_of_return").attr("id","sa_date_of_return");
                
                $("#modal3").find("#sa_date_of_depature").datepicker({dateFormat: 'yy-mm-dd'});
                $("#modal3").find("#sa_date_of_return").datepicker({dateFormat: 'yy-mm-dd'});
                
                var remove = $('.bootstrap-select');
                $(remove).replaceWith($(remove).contents('.selectpicker'));
                $('.selectpicker').selectpicker();
                
                
                $("#modal3").find("#deputeform").modal();
                
                $('.seruser').click(function(){
                    $(this).hide();
                    var depute_engineer = $("#modal3").find('#depute_engineer :selected').val();
                    var agent_id = "";
                    var engineer_id = [];
                    
                    var days_site = $("#modal3").find("#se_days_site").val();
                    var loading_expenses = $("#modal3").find("#se_loading_expenses").val();
                    var boarding_expenses = $("#modal3").find("#se_boarding_expenses").val();
                    var travel_expenses = $("#modal3").find("#se_travel_expenses").val();
                    var local_conveyance = $("#modal3").find("#se_local_conveyance").val();
                    
                    
                    if(parseInt(depute_engineer) == 0)
                    {
                        //engineer_id = $("#modal3").find('#engineer_id :selected').val();
                        $("#modal3").find('#engineer_id :selected').each(function(i, sel){
                            engineer_id.push($(sel).val());
                        });
                        var date_of_depature = $("#modal3").find(".se_date_of_depature").val();
                        var date_of_return = $("#modal3").find(".se_date_of_return").val();
                        var contact_person = $("#modal3").find("#se_contact_person").val();
                        var contact_number = $("#modal3").find("#se_contact_number").val();
                    }
                    else
                    {
                        agent_id = $("#modal3").find('#agent_id :selected').val();
                        var date_of_depature = $("#modal3").find(".sa_date_of_depature").val();
                        var date_of_return = $("#modal3").find(".sa_date_of_return").val();
                        var contact_person = $("#modal3").find("#sa_contact_person").val();
                        var contact_number = $("#modal3").find("#sa_contact_number").val();
                    }
                    var dataConfig = {
                     depute_engineer: depute_engineer,
                     engineer_id:engineer_id,
                     agent_id:agent_id, 
                     id:id,
                     date_of_depature:date_of_depature,
                     date_of_return:date_of_return,
                     days_site:days_site,
                     loading_expenses:loading_expenses,
                     boarding_expenses:boarding_expenses,
                     travel_expenses:travel_expenses,
                     local_conveyance:local_conveyance,
                     contact_person:contact_person,
                     contact_number:contact_number,
                 };
                 var dt;
                 if(parseInt(depute_engineer) == 0)
                 {
                     if(engineer_id.length >0)
                     {
                        dt = 1; 
                     }
                     else
                     {
                         dt=0;
                     }
                 }
                 else
                 {
                     if(parseInt(agent_id) > 0)
                     {
                         dt = 1;
                     }
                     else
                     {
                         dt=0;
                     }
                 }
                 //console.log(dt);return false;
                    if(parseInt(dt) == 1)
                    {
                        var controller = 'servicespareregister/';

                        $.ajax({
                         method: "POST",
                         url: _site_url + controller + "deputeengineer",
                         data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                         console.log( " ajax done " );
                         if(data.status ==1)
                         {
                             swal({   
                                    title: "VisitPlan",   
                                    text: "Added SucessFully",   
                                    type: "success",   
                                    showCancelButton: false,   
                                    allowOutsideClick: false
                                    });
                             $("#modal3").find("#deputeform").modal('hide');
                             $(".header_button").find(".depute").hide();
                             $(".header_button").find(".orderstatus").hide();
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
                        swal('Warning!','Choose Enginner /Agent','warning');
                        $(this).show();
                    }
                });
            });
            
            /****************** things to do functions***********************/
            $(".editthings").click(function()
            {
                var id = $(this).data('id');
                
                $("#modalthings3").find("#modalthings1").remove();
                var things = $("#modalthings").find("#modalthings1").clone();
                $("#modalthings3").append(things);
                var thigsnew = $("#modalthings3").find(".thingsnew .thingsnew1 .things0").clone();
                $("#modalthings3").find(".thingsnew2 form").append(thigsnew);
                arrayreset();
                $("#modalthings3").find(".thingsnew .thingsnew1 .things0").hide();
                
                
                $("#modalthings3").find(".thingsnew").remove();
                $("#modalthings3").find(".submitthings").removeClass("submitthings").addClass("updatethings");
                $("#modalthings3").find(".updatethings i").html("Update");
                
                
                var controller = 'servicespareregister/';

                $.ajax({
                    method: "POST",
                    url: _site_url + controller + "thingsedit",
                    data: {id:id},

                    }).done( function( data, textStatus, jqXHR ) {
                    console.log( " ajax done " );
                    if(data.status ==1)
                    {
                        var textbx="";
                        var chckbx="";
                        
                        if(data.data.answer_type==0)
                        {
                           textbx=0; 
                        }
                        else
                        {
                            chckbx=0;
                        }
                        var textarea = "<div class='card-body card-padding'><form><div class='row m-t-25'><div class='col-sm-12'><div class='col-sm-1 m-t-5'><div class='fg-line'><span class='sno'><input type='hidden' name='id' value='"+data.data.id+"' /> </span> </div></div><div class='col-sm-8'><div class='fg-line'><textarea class='form-control input-sm' cols='20' rows='2'  title='Things To Do' name='things_to_do'>"+data.data.things_to_do+"</textarea></div></div><div class='col-sm-3 ' style='display:none;'><div class='fg-line'>"+
                                        "<select class='form-control input-sm m-t-15' name='answer_type'><option value='0' "+textbx+">Textbox</option><option value='1' "+chckbx+">Checkbox</option></select></div></div><div class='col-sm-1 text-center m-t-10'></div></div></div></form></div>"
                        $("#modalthings3 #thingsform").find(".card").append(textarea);
                        
                        $("#modalthings3").find("#modalthings1 .thingsform").modal();
                        $(".updatethings").click(function()
                        {
                            console.log($("#modalthings3 #thingsform").find('form').serializeArray());
                            $.ajax({
                                method: "POST",
                                url: _site_url + controller + "thingsupdate",
                                data: $("#modalthings3 #thingsform").find('form').serializeArray(),

                                }).done( function( data, textStatus, jqXHR ) {
                                console.log( " ajax done " );
                                if(data.status ==1)
                                {
                                    
                                    $("#thingsform").modal('hide');
                                    swal({   
                                            title: "Updated!",   
                                            text: "Updated successfully",   
                                            type: "success",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false,
                                            showCancelButton: false,   
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                        },function(){ 
                                            window.location.reload();
                                        });
                                }
                                
                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            }); 
                        });
                    }
                    else
                    {

                    }

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                
            });
            
            $(".thingsadd").click(function()
            {
                $("#modalthings3").find("#modalthings1").remove();
                var things = $("#modalthings").find("#modalthings1").clone();
                $("#modalthings3").append(things);
                
                var thigsnew = $("#modalthings3").find(".thingsnew .thingsnew1 .things0").clone();
                $("#modalthings3").find(".thingsnew2 form").append(thigsnew);
                arrayreset();
                $("#modalthings3").find(".thingsnew .thingsnew1 .things0").hide();
                $("#modalthings3").find(".thingsform").modal();
                $("#modalthings3").find(".newline").on('click',function()
                {
                   $("#modalthings3").find(".thingsnew .thingsnew1 .things0").show();
                   var thigsnew = $("#modalthings3").find(".thingsnew .thingsnew1 .things0").clone(); 
                   $("#modalthings3").find(".thingsnew2 form").append(thigsnew).on('click','.remove',function()
                    {
                        $(this).closest(".things0").remove();
                        arrayreset();
                    });
                   $("#modalthings3").find(".thingsnew .thingsnew1 .things0").hide();
                   
                   arrayreset();
                });
                
                $("#modalthings3").find("#modalthings1 #submitthings").click(function()
                    {
                        
                        //console.log($(".thingsnew2").find('.things0').serializeArray());
                        $(this).hide();
                        var controller = 'servicespareregister/';

                        $.ajax({
                            method: "POST",
                            url: _site_url + controller + "thingstodo",
                            data: $(".thingsnew2").find('form').serializeArray(),

                            }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            if(data.status ==1)
                            {
                                $("#modalthings3").find(".thingsform").modal('hide');
                                swal({   
                                            title: "Added!",   
                                            text: "Things To do Added Successfully",   
                                            type: "success",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false,
                                            showCancelButton: false,   
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                        },function(){ 
                                            window.location.reload();
                                        });
                                
                            }
                            else
                            {

                            }

                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            });
                    });
                
            });
            /*******************************************/
            
            $(".offerprint").click(function()
            {
                var id = $(this).data('id');
                $("#modalprint").find("#modalofferprint1").remove();
                var print_offer = $("#modalofferprint").find("#modalofferprint1").clone();
                $("#modalprint").append(print_offer);
                $("#modalprint").find("button#printoffernew").on("click",function()
                {
                    $(this).hide();
                    var print_id = $("#modalprint").find("#offerid option:selected").val();
                    
                    var controller = 'servicespareregister/';
                    //$(".loader").show();
                    $.ajax({
                    method: "POST",
                    url: _site_url + controller + "offerprint",
                    data: {id:print_id},

                    }).done( function( data, textStatus, jqXHR ) {
                    console.log( " ajax done " );
                    if(data.status == 1)
                    {
                        $(".loader").hide();
                        $("#modalprint").find("button#printoffernew").show();
                        setTimeout(function() {
                            var win = window.open(data.filepath, '_blank');
                            //$('.container').find("#elabelloader #loader").css("display","none");
                            //$('.container').find("#elabelprint").css("display","block");

                            if (win) {
                                //Browser has allowed it to be opened
                                win.focus();
                            } else {
                                //Browser has blocked it
                                alert('Please allow popups for this website');
                            }
                        }, 8000);
                    }    
                    else
                    {

                    }

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        $(".loader").hide();
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                });
                $("#modalprint").find("#offerprintform").modal();
                
                
                
                
                
            });
              //invperformaprint  
            $(".invperformaprint").click(function()
            {
                var id = $(this).data('id');
                var controller = 'servicespareregister/';
                $(".loader").show();
                $.ajax({
                    method: "POST",
                    url: _site_url + controller + "invperformaprint",
                    data: {id:id},

                    }).done( function( data, textStatus, jqXHR ) {
                    console.log( " ajax done " );
                    if(data.status == 1)
                    {


                        setTimeout(function() {
                            var win = window.open(data.filepath, '_blank');
                            //$('.container').find("#elabelloader #loader").css("display","none");
                            //$('.container').find("#elabelprint").css("display","block");

                            if (win) {
                                //Browser has allowed it to be opened
                                win.focus();
                            } else {
                                //Browser has blocked it
                                alert('Please allow popups for this website');
                            }
                        }, 6000);
                    }    
                    else
                    {

                    }

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        $(".loader").show();
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                
            });  
              
            /****************** things to do functions***********************/
            
            $(".takenadd").click(function()
            {
                $("#modaltaken3").find("#modaltaken1").remove();
                var taken = $("#modaltaken").find("#modaltaken1").clone();
                $("#modaltaken3").append(taken);
                
                var thigsnew = $("#modaltaken3").find(".takennew .takennew1 .taken0").clone();
                $("#modaltaken3").find(".takennew2 form").append(thigsnew);
                arrayresettaken();
                $("#modaltaken3").find(".takennew .takennew1 .taken0").hide();
                $("#modaltaken3").find(".takenform").modal();
                $("#modaltaken3").find(".newln").on('click',function()
                {
                   $("#modaltaken3").find(".takennew .takennew1 .taken0").show();
                   var thigsnew = $("#modaltaken3").find(".takennew .takennew1 .taken0").clone(); 
                   $("#modaltaken3").find(".takennew2 form").append(thigsnew).on('click','.remove',function()
                    {
                        $(this).closest(".taken0").remove();
                        arrayresettaken();
                    });
                   $("#modaltaken3").find(".takennew .takennew1 .taken0").hide();
                   
                   arrayresettaken();
                });
                
                $("#modaltaken3").find("#modaltaken1 #submittaken").click(function()
                    {
                        $(this).hide();
                        //console.log($(".takennew2").find('.taken0').serializeArray());
                        var controller = 'servicespareregister/';
                        console.log($(".takennew2").find('form').serializeArray());
                        $.ajax({
                            method: "POST",
                            url: _site_url + controller + "thingstotaken",
                            data: $(".takennew2").find('form').serializeArray(),

                            }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            if(data.status ==1)
                            {
                                swal({   
                                            title: "Added!",   
                                            text: "Things To do Added Successfully",   
                                            type: "success",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false,
                                            showCancelButton: false,   
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                        },function(){ 
                                            window.location.reload();
                                        });
                                $("#modaltaken3").find(".takenform").modal('hide');
                            }
                            else
                            {

                            }

                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            });
                    });
                
            });
            
            $(".edittaken").click(function()
            {
                var id = $(this).data('id');
                $("#modaltaken3").find("#modaltaken1").remove();
                var taken = $("#modaltaken").find("#modaltaken1").clone();
                $("#modaltaken3").append(taken);
                $("#modaltaken3").find(".takennew").remove();
                
                
                
                $("#modaltaken3").find(".takenform .submittaken").removeClass("submittaken").addClass("updatetaken");
                $("#modaltaken3").find(".takenform .updatetaken i").html("Update");
                
                
                var controller = 'servicespareregister/';

                $.ajax({
                    method: "POST",
                    url: _site_url + controller + "takenedit",
                    data: {id:id},

                    }).done( function( data, textStatus, jqXHR ) {
                    console.log( " ajax done " );
                    if(data.status ==1)
                    {
                        var textbx="";
                        var chckbx="";
                        
                        if(data.data.isreturn==0)
                        {
                           textbx="checked"; 
                        }
                        
                        var textarea = "<div class='card-body card-padding'><form><div class='row m-t-25'><div class='col-sm-12'><div class='col-sm-1 m-t-5'><div class='fg-line'><span class='sno'><input type='hidden' name='id' value='"+data.data.id+"' /> </span> </div></div>"+
                "<div class='col-sm-5'><div class='fg-line'><textarea class='form-control input-sm' cols='20' rows='2'  title='Things To Taken' name='prd_description'>"+data.data.prd_description+"</textarea></div></div>"+
                "<div class='col-sm-2 '><div class='fg-line'><input class='form-control input-sm fg-input' name='quantity' id='quantity' value='"+data.data.quantity+"' /></div></div>"+
                "<div class='col-sm-2 '><div class='fg-line'><label class='fg-label col-sm-3'>Return</label><input class='col-sm-9' type='checkbox' "+textbx+" name='isreturn' value='0' id='isreturn'></div></div>"+
                "</div></div></form></div>";
                        $("#modaltaken3").find(".takenform .card").append(textarea);
                        
                        $("#modaltaken3").find(".takenform").modal();
                        $(".updatetaken").click(function()
                        {
                            console.log($("#modaltaken3 #takenform").find('form').serializeArray());
                            $.ajax({
                                method: "POST",
                                url: _site_url + controller + "takenupdate",
                                data: $("#modaltaken3 #takenform").find('form').serializeArray(),

                                }).done( function( data, textStatus, jqXHR ) {
                                console.log( " ajax done " );
                                if(data.status ==1)
                                {
                                    $("#takenform").modal('hide');
                                    swal({   
                                            title: "Updated!",   
                                            text: "Updated successfully",   
                                            type: "success",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false,
                                            showCancelButton: false,   
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                        },function(){ 
                                            window.location.reload();
                                        });
                                }
                                
                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            }); 
                        });
                    }
                    else
                    {

                    }

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
            });
            
            /*****************************************/
            $(".prdct").on('click',function(){
                //$("#prdmodal").find("#modelloader").modal();
                $("#prdmodal").find("form #modalproduct1").remove();
                var model2 = $("#modalproduct").find("#modalproduct1").clone();
                var offerid = $(this).data('offerid');
                
                $("#prdmodal form").append(model2);
                addproduct();
                $("#prdmodal form").find("#offer_details_id").val(offerid);
                
                $("#prdmodal").find("#productform .addline").on('click',function(){
                    addproduct();
                });
                $("#prdmodal").find("#productform").modal();
                
                $("#prdmodal").find('#productform .serviceprdsubmit').click(function(){
                    $(this).hide();
                    var form_data = $("#prdmodal").find('form').serializeArray();
                    
                    var formarray={};

                    $.map(form_data, function(n, i){
                        formarray[n['name']] = n['value'];
                    });
                    
                    var serviceid = $("#service_spares_register_id").val();
                    
                    
                    var dataConfig = {serviceid:serviceid,offerid:offerid,formarray:form_data}
                    //console.log(form_data);
                    
                    var controller = 'servicespareregister/';

                    $.ajax({
                     method: "POST",
                     url: _site_url + controller + "productadd",
                     data: form_data,

                 }).done( function( data, textStatus, jqXHR ) {
                     console.log( " ajax done " );
                     if(data.status ==1)
                     {
                         swal({   
                                title: "Product",   
                                text: "Added SucessFully",   
                                type: "success",   
                                showCancelButton: false,   
                                allowOutsideClick: false,
                                showCancelButton: false,   
                                confirmButtonText: "Ok",
                                closeOnConfirm: false,
                            },function(){ 
                                window.location.reload();
                            });
                         $("#prdmodal").find("#productform").modal('hide');
                     }
                     else
                     {
                         $("#prdmodal").find("#completeform").modal('hide');
                     }
                     

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    }); 
                });
                
                $(".serviceprdsecond").on('change','.tax_id',function(){
                    var indx = $(this).closest(".row").index();
                    var tax_id = $(this).val();
                    var quantity = $(".serviceprdsecond").find(".qty").eq(indx).val();
                    var discount = $(".serviceprdsecond").find(".discount").eq(indx).val();
                    var price = $(".serviceprdsecond").find(".unit_price").eq(indx).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                    taxcalc(quantity,price,tax_id,indx,discount);
                });

                $(".serviceprdsecond").on('change','.discount',function(){
                    var indx = $(this).closest(".row").index();
                    var discount = $(this).val();
                    var quantity = $(".serviceprdsecond").find(".qty").eq(indx).val();
                    var price = $(".serviceprdsecond").find(".unit_price").eq(indx).val();
                    var tax_id = $(".serviceprdsecond").find(".tax_id").eq(indx).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {

                    }
                    else
                    {
                        taxcalc(quantity,price,tax_id,indx,discount);
                    }
                });

                $(".serviceprdsecond").on('change','.unit_price',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $(this).val();
                    var quantity = $(".serviceprdsecond").find(".qty").eq(indx).val();
                    var tax_id = $(".serviceprdsecond").find(".tax_id").eq(indx).val();
                    var discount = $(".serviceprdsecond").find(".discount").eq(indx).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {

                    }
                    else
                    {
                        taxcalc(quantity,price,tax_id,indx,discount);
                    }
                });
                
                $(".serviceprdsecond").on('change','.qty',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $(".serviceprdsecond").find(".unit_price").eq(indx).val();
                    var quantity = $(this).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    var tax_id = $(".serviceprdsecond").find(".tax_id").eq(indx).val();
                    var discount = $(".serviceprdsecond").find(".discount").eq(indx).val();
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {
                       
                    }
                    else
                    {
                        taxcalc(quantity,price,tax_id,indx,discount);
                    }
                });
            });
            
            function addproduct()
            {
                $(".prdfirst").show();
                var prdfirst = $(".prdfirst").find(".row").clone();
                $("#prdmodal").find(".serviceprdsecond").append(prdfirst).on('click','.prdclose',function(){
                    $(this).closest(".row").remove();
                });
                $(".prdfirst").hide();
                
                prdreset();
                
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
            }
            
            function prdreset()
            {
                var len=$("#prdmodal").find(".serviceprdsecond .row").length;
                for(var i=0;i<len;i++)
                {
                    var j=parseInt(i)+1;
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".product_id").attr("name","product_id["+j+"]");
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".product").attr("name","product["+j+"]");
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".qty").attr("name","qty["+j+"]");
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".description").attr("name","description["+j+"]");
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".tax_id").attr("name","tax_id["+j+"]");
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".tax_amt").attr("name","tax_amt["+j+"]");
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".unit_price").attr("name","unit_price["+j+"]");
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".discount").attr("name","discount["+j+"]");
                    $("#prdmodal").find(".serviceprdsecond .row").eq(i).find(".total").attr("name","total["+j+"]");
                }
            }
            
            function arrayreset()
            {
                var len = $(".thingsnew2").find(".things0").length;
                for(var i=0;i<len;i++)
                {
                    var j=parseInt(i)+1;
                    $(".thingsnew2").find(".things0").eq(i).find(".sno").text(j+")");
                    $(".thingsnew2").find(".things0").eq(i).find("textarea").attr("name","things_to_do["+j+"]");
                    $(".thingsnew2").find(".things0").eq(i).find("select").attr("name","answer_type["+j+"]");
                }
            }
            
            function arrayresettaken()
            {
                var len = $(".takennew2").find(".taken0").length;
                for(var i=0;i<len;i++)
                {
                    var j=parseInt(i)+1;
                    $(".takennew2").find(".taken0").eq(i).find(".sno").text(j+")");
                    $(".takennew2").find(".taken0").eq(i).find("#things_to_taken").attr("name","things_to_taken["+j+"]");
                    $(".takennew2").find(".taken0").eq(i).find("#quantity").attr("name","quantity["+j+"]");
                    $(".takennew2").find(".taken0").eq(i).find("#isreturn").attr("name","isreturn["+j+"]");
                }
            }
            
            function servicereset()
            {
                var len = $("#modalservice3").find(".servicenew2 .sercharge0").length;
                
                for(var i=0;i<len;i++)
                {
                    var j=parseInt(i)+1;
                    
                    $("#modalservice3").find(".servicenew2 .sercharge0").eq(i).find(".sr_product_id").attr("name","product_id["+j+"]");
                    $("#modalservice3").find(".servicenew2 .sercharge0").eq(i).find(".sr_product").attr("name","product["+j+"]");
                    $("#modalservice3").find(".servicenew2 .sercharge0").eq(i).find(".sr_description").attr("name","description["+j+"]");
                    $("#modalservice3").find(".servicenew2 .sercharge0").eq(i).find(".sr_qty").attr("name","qty["+j+"]");
                    $("#modalservice3").find(".servicenew2 .sercharge0").eq(i).find(".sr_tax_id").attr("name","tax_id["+j+"]");
                    $("#modalservice3").find(".servicenew2 .sercharge0").eq(i).find(".sr_tax_amt").attr("name","tax_amt["+j+"]");
                    $("#modalservice3").find(".servicenew2 .sercharge0").eq(i).find(".sr_unit_price").attr("name","unit_price["+j+"]");
                    $("#modalservice3").find(".servicenew2 .sercharge0").eq(i).find(".sr_total").attr("name","total["+j+"]");
                }
            }
            
            function taxcalc(qty,amt,tax_id,rowno,discount)
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
                            var disc = ((parseFloat(qty)*parseFloat(amt))*(parseFloat(discount)/100))
                            var netamt= ((parseFloat(qty)*parseFloat(amt))-parseFloat(disc));
                            var taxamt = (parseFloat(netamt)*parseFloat(data.rate))/100;
                            var tot = parseFloat(netamt)+parseFloat(taxamt);
                            $("#prdmodal").find(".serviceprdsecond .row").eq(rowno).find('.tax_amt').val(taxamt.toFixed(2));
                            $("#prdmodal").find(".serviceprdsecond .row").eq(rowno).find('.total').val(tot.toFixed(2));
                        }
                        else
                        {
                            $("#prdmodal").find(".serviceprdsecond .row").eq(rowno).find('.qty').val(0);
                            $("#prdmodal").find(".serviceprdsecond .row").eq(rowno).find('.tax_amt').val(0);
                            $("#prdmodal").find(".serviceprdsecond .row").eq(rowno).find('.total').val(0);
                        }


                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        //console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                }
             
            function edittaxcalc(qty,amt,tax_id,rowno,discnt)
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
                            var disc = ((parseFloat(qty)*parseFloat(amt))*(parseFloat(discnt)/100));
                            var netamt= ((parseFloat(qty)*parseFloat(amt))-parseFloat(disc));
                            var taxamt = (parseFloat(netamt)*parseFloat(data.rate))/100;
                            var tot = parseFloat(netamt)+parseFloat(taxamt);
                            $("#prdmodal").find(".prdeditsecond .row").eq(rowno).find('.tax_amt').val(taxamt.toFixed(2));
                            $("#prdmodal").find(".prdeditsecond .row").eq(rowno).find('.total').val(tot.toFixed(2));
                        }
                        else
                        {
                            $("#prdmodal").find(".prdeditsecond .row").eq(rowno).find('.qty').val(0);
                            $("#prdmodal").find(".prdeditsecond .row").eq(rowno).find('.tax_amt').val(0);
                            $("#prdmodal").find(".serviceprdsecond .row").eq(rowno).find('.total').val(0);
                        }


                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        //console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                }
                
            function sertaxcalc(qty,amt,tax_id,rowno)
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
                            $("#modalservice3 .sercharge0").eq(rowno).find('.sr_tax_amt').val(taxamt.toFixed(2));
                            $("#modalservice3 .sercharge0").eq(rowno).find('.sr_total').val(tot.toFixed(2));
                        }
                        else
                        {
                            $("#modalservice3 .sercharge0").eq(rowno).find('.sr_qty').val(0);
                            $("#modalservice3 .sercharge0").eq(rowno).find('.sr_tax_amt').val(0);
                            $("#modalservice3 .sercharge0").eq(rowno).find('.sr_total').val(0);
                        }


                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        //console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                }
                
            function sertaxcalc(qty,amt,tax_id)
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
                            $("#modalservice3").find('.serchargeform .sr_tax_amt').val(taxamt.toFixed(2));
                            $("#modalservice3").find('.serchargeform .sr_total').val(tot.toFixed(2));
                        }
                        else
                        {
                            $("#modalservice3").find('.serchargeform .sr_qty').val(0);
                            $("#modalservice3").find('.serchargeform .sr_tax_amt').val(0);
                            $("#modalservice3").find('.serchargeform .sr_total').val(0);
                        }


                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        //console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        //console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                }
                
            //$("#prdmodal").on('focusin','.product',function(){
            $("#prdmodal").on('click','.prd_search',function(){
                var _this= this;
                var indx = $(this).closest(".row").index();
                $("#modal5").find("#modalprd2").remove();
                var model2 = $("#modalprd").find("#modalprd2").clone();
                $("#modal5").append(model2);
                $("#modal5").find("#data-table-command").dataTable({
                    "lengthMenu": [ [100, 200], [100,200] ],
                    } );
                  $("div.dataTables_filter input").focus();
                $("#modal5").find("#data-table-command").on('change','.prdradio',function(){
                   var prdid = $(".prdradio:checked").val();
                   var prdname = $(this).closest('tr').find(".pname").text();
                   var unitprice = $(this).closest('tr').find(".price").text();
                   $(".serviceprdsecond").find(".product").eq(indx).val(prdname);
                   $(".serviceprdsecond").find(".unit_price").eq(indx).val(unitprice);
                   $(".serviceprdsecond").find(".product_id").eq(indx).val(prdid);
                   $("#modal5").find("#productform").modal('toggle');
                   $(".serviceprdsecond").find(".qty").eq(indx).focus();
                });
                $("#modal5").find("#productform").modal();
            
                $(".serviceprdsecond").on('change','.tax_id',function(){
                    var indx = $(this).closest(".row").index();
                    var tax_id = $(this).val();
                    var quantity = $(".serviceprdsecond").find(".qty").eq(indx).val();
                    var discount = $(".serviceprdsecond").find(".discount").eq(indx).val();
                    var price = $(".serviceprdsecond").find(".unit_price").eq(indx).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                    taxcalc(quantity,price,tax_id,indx,discount);
                });
            
                $(".serviceprdsecond").on('change','.discount',function(){
                    var indx = $(this).closest(".row").index();
                    var discount = $(this).val();
                    var quantity = $(".serviceprdsecond").find(".qty").eq(indx).val();
                    var price = $(".serviceprdsecond").find(".unit_price").eq(indx).val();
                    var tax_id = $(".serviceprdsecond").find(".tax_id").eq(indx).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {
                       
                    }
                    else
                    {
                        taxcalc(quantity,price,tax_id,indx,discount);
                    }
                });
                
                $(".serviceprdsecond").on('change','.unit_price',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $(this).val();
                    var quantity = $(".serviceprdsecond").find(".qty").eq(indx).val();
                    var tax_id = $(".serviceprdsecond").find(".tax_id").eq(indx).val();
                    var discount = $(".serviceprdsecond").find(".discount").eq(indx).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {
                       
                    }
                    else
                    {
                        taxcalc(quantity,price,tax_id,indx,discount);
                    }
                });
            
            
                $(".serviceprdsecond").on('change','.qty',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $(".serviceprdsecond").find(".unit_price").eq(indx).val();
                    var quantity = $(this).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    var tax_id = $(".serviceprdsecond").find(".tax_id").eq(indx).val();
                    var discount = $(".serviceprdsecond").find(".discount").eq(indx).val();
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {
                       
                    }
                    else
                    {
                        taxcalc(quantity,price,tax_id,indx,discount);
                    }
                });
                
                
       
            });
            
            


            
            /*$("#modal3").on('click','.product',function(){
                var _this= this;
                var indx = $(this).closest(".row").index();
                $("#modal5").find("#modalprd2").remove();
                var model2 = $("#modalprd").find("#modalprd2").clone();
                $("#modal5").append(model2);
                $("#modal5").find("#data-table-command").dataTable({
                    "lengthMenu": [ [100, 200], [100,200] ]
                  } );
                $("#modal5").find("#data-table-command").on('change','.prdradio',function(){
                   var prdid = $(".prdradio:checked").val();
                   var prdname = $(this).closest('tr').find(".pname").text();
                   var unitprice = $(this).closest('tr').find(".price").text();
                   $(".serviceprdsecond").find(".product").eq(indx).val(prdname);
                   $(".serviceprdsecond").find(".unit_price").eq(indx).val(unitprice);
                   $(".serviceprdsecond").find(".product_id").eq(indx).val(prdid);
                   $(".serviceprdsecond").find(".qty").eq(indx).val(0);
                   $("#modal5").find("#productform").modal('toggle');
                   $(".serviceprdsecond").find(".qty").eq(indx).focus();
                });
                $("#modal5").find("#productform").modal();
            
            
                $(".serviceprdsecond").on('change','.unit_price',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $(this).val();
                    var quantity = $(".serviceprdsecond").find(".qty").eq(indx).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                });
            
                $(".serviceprdsecond").on('change','.qty',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $(".serviceprdsecond").find(".qty").eq(indx).val();
                    var quantity = $(this).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".serviceprdsecond").find(".total").eq(indx).val(tot);
                });
            
            
            });
       */
       
            $(".prdctedit").on('click',function(){
                var id = $(this).data('id');
                var prdid = $(this).data('prdid');
                var prddesc = $(this).data('prddesc');
                var price = $(this).data('price');
                var qty = $(this).data('qty');
                var desc = $(this).data('desc');
                var discount = $(this).data('discount');
                var tax_id = $(this).data('tax_id');
                var tax_amt = $(this).data('tax_amt');
                var total = $(this).data('total');
                //$("#prdmodal").find("#modelloader").modal();
                $("#prdmodal").find("form #modalproductedit1").remove();
                var model23 = $("#modalproductedit").find("#modalproductedit1").clone();
                
                $("#prdmodal form").append(model23);
                $(".prdfirst").show();
                var prdedtfirst = $(".prdfirst").find(".row").clone();
                $("#prdmodal").find(".prdeditsecond").append(prdedtfirst).on('click','.prdclose',function(){
                    $(this).closest(".row").remove();
                });
                $(".prdfirst").hide();
                 
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".product_id").attr("name","product_id");
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".product").attr("name","product");
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".description").attr("name","description");
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".qty").attr("name","qty");
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".discount").attr("name","discount");
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".tax_id").attr("name","tax_id");
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".tax_amt").attr("name","tax_amt");
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".unit_price").attr("name","unit_price");
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".total").attr("name","total");
                
                $("#prdmodal").find(".prdeditsecond").find("#service_product_id").val(id);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".product_id").val(prdid);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".product").val(prddesc);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".description").val(desc);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".qty").val(qty);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".tax_id").val(tax_id);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".discount").val(discount);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".tax_amt").val(tax_amt);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".unit_price").val(price);
                $("#prdmodal").find(".prdeditsecond .row").eq(0).find(".total").val(total);
                
                $("#prdmodal").find(".prdeditsecond").on('change','.tax_id',function(){
                    var indx = $(this).closest(".row").index();
                    var tax_id = $(this).val();
                    var quantity = $(".prdeditsecond").find(".qty").eq(0).val();
                    var price = $(".prdeditsecond").find(".unit_price").eq(0).val();
                    var discnt = $("#prdmodal .prdeditsecond").find(".discount").eq(0).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".prdeditsecond").find(".total").eq(0).val(tot);
                    edittaxcalc(quantity,price,tax_id,0,discnt);
                });
            
                $("#prdmodal").find(".prdeditsecond").on('change','.unit_price',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $(this).val();
                    var quantity = $(".prdeditsecond").find(".qty").eq(0).val();
                    var discnt = $("#prdmodal .prdeditsecond").find(".discount").eq(0).val();
                    var tax_id = $(".prdeditsecond").find(".tax_id").eq(0).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $(".prdeditsecond").find(".total").eq(0).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {
                       
                    }
                    else
                    {
                        edittaxcalc(quantity,price,tax_id,0,discnt);
                    }
                });
            
                $("#prdmodal").find(".prdeditsecond").on('change','.qty',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $("#prdmodal .prdeditsecond").find(".unit_price").eq(0).val();
                    var quantity = $(this).val();
                    var discnt = $("#prdmodal .prdeditsecond").find(".discount").eq(0).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    var tax_id = $("#prdmodal .prdeditsecond").find(".tax_id").eq(0).val();
                    $("#prdmodal .prdeditsecond").find(".total").eq(0).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {
                       
                    }
                    else
                    {
                        edittaxcalc(quantity,price,tax_id,0,discnt);
                    }
                });
                
                $("#prdmodal").find(".prdeditsecond").on('change','.discount',function(){
                    var indx = $(this).closest(".row").index();
                    var price = $("#prdmodal .prdeditsecond").find(".unit_price").eq(0).val();
                    var discnt = $(this).val();
                    var quantity = $("#prdmodal .prdeditsecond").find(".qty").eq(0).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    var tax_id = $("#prdmodal .prdeditsecond").find(".tax_id").eq(0).val();
                    $("#prdmodal .prdeditsecond").find(".total").eq(0).val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {
                       
                    }
                    else
                    {
                        edittaxcalc(quantity,price,tax_id,0,discnt);
                    }
                });
                
                
                $("#prdmodal").find("#producteditform").modal();
                
                $("#prdmodal").find('#producteditform .editprd').click(function(){
                    $(this).hide();
                    var form_data = $("#prdmodal").find('form').serializeArray();
                    
                    var formarray={};

                    $.map(form_data, function(n, i){
                        formarray[n['name']] = n['value'];
                    });
                    
                    var serviceid = $("#service_spares_register_id").val();
                    
                    var dataConfig = {serviceid:serviceid,formarray:form_data}
                    //console.log(form_data);
                    
                    var controller = 'servicespareregister/';

                    $.ajax({
                     method: "POST",
                     url: _site_url + controller + "productupdte",
                     data: form_data,

                 }).done( function( data, textStatus, jqXHR ) {
                     console.log( " ajax done " );
                     if(data.status ==1)
                     {
                         swal({   
                                title: "Product",   
                                text: "Added SucessFully",   
                                type: "success",   
                                showCancelButton: false,   
                                allowOutsideClick: false,
                                showCancelButton: false,   
                                confirmButtonText: "Ok",
                                closeOnConfirm: false,
                            },function(){ 
                                window.location.reload();
                            });
                         $("#prdmodal").find("#producteditform").modal('hide');
                     }
                     else
                     {
                         $("#prdmodal").find("#completeform").modal('hide');
                     }
                     

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    }); 
                });
                
            });
            
            $(".serviceadd").on('click',function(){
                var offerid = $(this).data('offerid');
                $("#modalservice3").find("#modalservice1").remove();
                var service = $("#modalservice").find("#modalservice1").clone();
                $("#modalservice3").append(service);
                $("#modalservice3").find(".sr_offer_details_id").val(offerid);
                
                var servicenew = $("#modalservice3").find(".serchargenew .serchargenew1 .sercharge0").clone();
                $("#modalservice3").find(".servicenew2 form").append(servicenew);
                servicereset();
                $("#modalservice3").find(".serchargenew .serchargenew1 .sercharge0").hide();
                $("#modalservice3").find(".serchargeform").modal();
                $("#modalservice3").find(".newserln").on('click',function()
                {
                   $("#modalservice3").find(".serchargenew .serchargenew1 .sercharge0").show();
                   var servicenew = $("#modalservice3").find(".serchargenew .serchargenew1 .sercharge0").clone(); 
                   $("#modalservice3").find(".servicenew2 form").append(servicenew).on('click','.remove',function()
                    {
                        $(this).closest(".sercharge0").remove();
                        servicereset();
                    });
                   $("#modalservice3").find(".serchargenew .serchargenew1 .sercharge0").hide();
                   
                   servicereset();
                });
                /**********************************************************/
                
                $("#modalservice3").on('change','.sr_tax_id',function(){
                    var indx = $(this).closest(".sercharge0").index();
                    var tax_id = $(this).val();
                    var quantity = $("#modalservice3 .sercharge0").eq(indx).find(".sr_qty").val();
                    var price = $("#modalservice3 .sercharge0").eq(indx).find(".sr_unit_price").val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $("#modalservice3 .sercharge0").eq(indx).find(".sr_total").val(tot);
                    sertaxcalc(quantity,price,tax_id,indx);
                });

                $("#modalservice3").on('change','.sr_unit_price',function(){
                    var indx = $(this).closest(".sercharge0").index();
                    var price = $(this).val();
                    var quantity = $("#modalservice3 .sercharge0").eq(indx).find(".sr_qty").val();
                    var tax_id = $("#modalservice3 .sercharge0").eq(indx).find(".sr_tax_id").val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    $("#modalservice3 .sercharge0").eq(indx).find(".sr_total").val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {

                    }
                    else
                    {
                        sertaxcalc(quantity,price,tax_id,indx);
                    }
                });

                $("#modalservice3").on('change','.sr_qty',function(){
                    var indx = $(this).closest(".sercharge0").index();
                    var price = $("#modalservice3 .sercharge0").eq(indx).find(".sr_unit_price").val();
                    var quantity = $(this).val();
                    var tot = parseFloat(price)*parseFloat(quantity);
                    var tax_id = $("#modalservice3 .sercharge0").eq(indx).find(".sr_tax_id").val();
                    $("#modalservice3 .sercharge0").eq(indx).find(".sr_total").val(tot);
                    if(tax_id =="" || typeof(tax_id) === "undefined")
                    {

                    }
                    else
                    {
                        sertaxcalc(quantity,price,tax_id,indx);
                    }
                });
                
                /************************************************/
                //$("#modalservice3").on('focusin','.sr_product',function(){
                $("#modalservice3").on('click','.sr_last',function(){
                    var _this= this;
                    var indx = $(this).closest(".sercharge0").index();
                    $("#modalservicech").find("#modalserprd2").remove();
                    var model2 = $("#modalserprd").find("#modalserprd2").clone();
                    $("#modalservicech").append(model2);
                    $("#modalservicech").find("#data-table-command").dataTable({
                        "lengthMenu": [ [100, 200], [100,200] ],
                        } );
                      $("div.dataTables_filter input").focus();
                    $("#modalservicech").find("#data-table-command").on('change','.sr_prdradio',function(){
                        var prdid = $(".sr_prdradio:checked").val();
                        var prdname = $(this).closest('tr').find(".sr_pname").text();
                        var unitprice = $(this).closest('tr').find(".sr_price").text();
                        $("#modalservice3 .sercharge0").eq(indx).find(".sr_product").val(prdname);
                        $("#modalservice3 .sercharge0").eq(indx).find(".sr_unit_price").val(unitprice);
                        $("#modalservice3 .sercharge0").eq(indx).find(".sr_product_id").val(prdid);
                        $("#modalservicech").find("#serproductform").modal('toggle');
                        $("#modalservice3 .sercharge0").eq(indx).find(".sr_qty").focus();
                    });
                    $("#modalservicech").find("#serproductform").modal();
                    
                    $("#modalservice3").on('change','.sr_tax_id',function(){
                        var indx = $(this).closest(".sercharge0").index();
                        var tax_id = $(this).val();
                        var quantity = $("#modalservice3 .sercharge0").eq(indx).find(".sr_qty").val();
                        var price = $("#modalservice3 .sercharge0").eq(indx).find(".sr_unit_price").val();
                        var tot = parseFloat(price)*parseFloat(quantity);
                        $("#modalservice3 .sercharge0").eq(indx).find(".sr_total").val(tot);
                        sertaxcalc(quantity,price,tax_id,indx);
                    });

                    $("#modalservice3").on('change','.sr_unit_price',function(){
                        var indx = $(this).closest(".sercharge0").index();
                        var price = $(this).val();
                        var quantity = $("#modalservice3 .sercharge0").eq(indx).find(".sr_qty").val();
                        var tax_id = $("#modalservice3 .sercharge0").eq(indx).find(".sr_tax_id").val();
                        var tot = parseFloat(price)*parseFloat(quantity);
                        $("#modalservice3 .sercharge0").eq(indx).find(".sr_total").val(tot);
                        if(tax_id =="" || typeof(tax_id) === "undefined")
                        {

                        }
                        else
                        {
                            sertaxcalc(quantity,price,tax_id,indx);
                        }
                    });

                    $("#modalservice3").on('change','.sr_qty',function(){
                        var indx = $(this).closest(".sercharge0").index();
                        var price = $("#modalservice3 .sercharge0").eq(indx).find(".sr_unit_price").val();
                        var quantity = $(this).val();
                        var tot = parseFloat(price)*parseFloat(quantity);
                        var tax_id = $("#modalservice3 .sercharge0").eq(indx).find(".sr_tax_id").val();
                        $("#modalservice3 .sercharge0").eq(indx).find(".sr_total").val(tot);
                        if(tax_id =="" || typeof(tax_id) === "undefined")
                        {

                        }
                        else
                        {
                            sertaxcalc(quantity,price,tax_id,indx);
                        }
                    });
                });
                
                /****************************************************/
                
                $("#modalservice3").find("#modalservice1 #submitservice").click(function()
                    {
                        
                        //console.log($(".takennew2").find('.taken0').serializeArray());
                        var controller = 'servicespareregister/';
                        console.log($(".servicenew2").find('form').serializeArray());
                        $.ajax({
                            method: "POST",
                            url: _site_url + controller + "servicecharge",
                            data: $(".servicenew2").find('form').serializeArray(),

                            }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            if(data.status ==1)
                            {
                                swal({   
                                            title: "Added!",   
                                            text: "Service Charge Added Successfully",   
                                            type: "success",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false,
                                            showCancelButton: false,   
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                        },function(){ 
                                            window.location.reload();
                                        });
                                $("#modalservice3").find(".serchargeform").modal('hide');
                            }
                            else
                            {

                            }

                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            });
                    });
                
            });
            
            $(".offeremail").on('click',function()
            {
                $("#emailmodal").find("#modalsent2").remove();
                var id = $(this).data('offer');
                var regid = $(this).data('id');
                var compid = $(this).data('compid');
                var mdsent = $("#modalsent").find("#modalsent2").clone();
                $("#emailmodal").append(mdsent);
                $("#emailmodal").find(".sentform").modal();
                $("#emailmodal").find(".sentform .mailattach").remove();
                $("#emailmodal").find(".sentform .summernote").summernote({
                            placeholder: '',
                            height: 200,
                            popover: {
                                air: [
                                  ['color', ['color']],
                                  ['font', ['bold', 'underline', 'clear']]
                                ]
                            },
                            toolbar: [
                                    [ 'style', [ 'style' ] ],
                                    [ 'font', [ 'bold', 'italic', 'underline',  'superscript', 'subscript', 'clear'] ],
                                    [ 'fontname', [ 'fontname' ] ],
                                    [ 'fontsize', [ 'fontsize' ] ],
                                    [ 'color', [ 'color' ] ],
                                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                                    [ 'table', [ 'table' ] ],
                                    [ 'insert', [ 'link'] ],
                                    [ 'view', [  'fullscreen', 'codeview', 'help' ] ]
                                ]
                        });
                //$("#emailmodal").find('div.note-group-select-from-files').remove();
                //
                $("#emailmodal").find(".mailform").hide();
                var dataConfig = {
                     compid: compid,
                     id: id,
                     type:0,
                     regid:regid,//offer
                 };

                    var controller = 'servicespareregister/';

                    $.ajax({
                        method: "POST",
                        url: _site_url + controller + "offerdata",
                        data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            if(data.status ==1)
                            {
                                $(".toaddress").val(data.toaddress);
                                $(".fromaddress").val(data.fromaddress);
                                $(".ccaddress").val(data.ccaddress);
                                $(".subject").val(data.subject);
                                
                            }
                            else
                            {
                                $("#emailmodal").find("#sentform").modal('hide');
                            }
                            if(data.contact_person == "" || data.contact_person == null)
                            {
                                var detail = "<b>Dear Sir/Mam,</b><br><br><span class='m-l-25'> Greeting from Megawin!!</span><br><span  class='m-l-25'><p>Thank you for your enquiry for service from Megawin Switchgear Ltd, Salem.<br>Please find the offer attached. Please release the PO/WO with 100% advance payment as early as possible.</p><br>With Warm Regards,</span>";
                            }
                            else
                            {
                                var detail = "<b>Dear "+data.contact_person+",</b><br><br><span class='m-l-25'> Greeting from Megawin!!</span><br><span  class='m-l-25'><p>Thank you for your enquiry for service from Megawin Switchgear Ltd, Salem.<br>Please find the offer attached. Please release the PO/WO with 100% advance payment as early as possible.</p><br>With Warm Regards,</span>";
                            }
                            if(parseInt(data.type) == 0)
                            {
                                detail = detail+"<br><span class='c-green'><b>Ashik Ali S </b></span><br>"+
                                                "<span class='c-green'><b>Kathiravan C </b></span><br>"+
                                                "Service department <br>"+
                                                "============================================<br>"+ 
                                                "M/s Megawin Switchgear-P-Limited - Unit - II,<br>"+
                                                "2 / 18, 2 / 19, Narasothipatti, Perumal Malai Adivaram,<br>"+
                                                "Salem-636004 I Tamil Nadu-India<br>"+ 
                                                "Toll Free Number for Spares & Service: 89295 99797<br>"+
                                                "<span class='c-blue'>Mail: service@megawin.co.in   Web:www.megawinswitchgear.com</span>";
                            }
                            else
                            {
                                detail = detail+"<br><span class='c-green'><b> </b></span><br>"+
                                                "<span class='c-green'><b> </b></span><br>"+
                                                "Spares department <br>"+
                                                "============================================<br>"+ 
                                                "M/s Megawin Switchgear-P-Limited - Unit - II,<br>"+
                                                "2 / 18, 2 / 19, Narasothipatti, Perumal Malai Adivaram,<br>"+
                                                "Salem-636004 I Tamil Nadu-India<br>"+ 
                                                "Toll Free Number for Spares & Service: 89295 99797<br>"+
                                                "<span class='c-blue'>Mail: spares@megawin.co.in   Web:www.megawinswitchgear.com</span>";
                            }
                            $("#emailmodal").find(".summernote").code(detail);
                            $("#emailmodal").find(".emailattach").closest("div").append("<input type='hidden' class='form-control col-sm-6' readonly name='regid' value='"+regid+"'><input type='text' class='form-control col-sm-6' readonly name='attachname' value='"+data.filename+"'><input type='hidden' name='mailattach' value='"+data.filepath+"'>");
                            //$("#emailmodal").find(".emailattach .email_attach").val(data.filename);
                            //$("#emailmodal").find(".mailattach  .fileinput-filename").html("SericeOffer.pdf");

                            //$("#emailmodal").find(".emailattach .email_attach").bootstrapFileInput();
                            $("#emailmodal").find(".mailform").show();
                            $("#emailmodal").find(".emailloader").hide();
                            

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    }); 
                    
                    $("#emailmodal").find(".emailattach").on('click',function(e)
                    {
                        e.preventDefault();
                        $("#modalsent").find(".mailattach").show();
                        var attach = $("#modalsent").find("#modalsent2 .mailattach").clone();
                        $("#modalsent").find(".mailattach").hide();
                        console.log(attach);
                        $(this).closest("div").append(attach).on('click','.closeattach',function()
                        {
                          $(this).closest("div").remove();
                          attachreset();
                        });
                        attachreset();
                    });
                    
                     /*$("#emailmodal").on('click','.mailsend',function()
                     {
                        var toaddress = $("#emailmodal").find(".toaddress").val();
                        var fromaddress = $("#emailmodal").find(".fromaddress").val();
                        var ccaddress = $("#emailmodal").find(".ccaddress").val();
                        var ccaddress = $("#emailmodal").find(".ccaddress").val();
                        var subject = $("#emailmodal").find(".subject").val();
                        var body = $("#emailmodal").find(".summernote").code();
                        
                        var dataConfig = {
                            toaddress: toaddress,
                            fromaddress: fromaddress,
                            ccaddress: ccaddress,
                            subject: subject,
                            body: body
                        };

                        var controller = 'servicespareregister/';

                        $.ajax({
                         method: "POST",
                         url: _site_url + controller + "emailsend",
                         data: dataConfig,

                            }).done( function( data, textStatus, jqXHR ) {
                                console.log( " ajax done " );
                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                               console.log( " ajax fail " );
                               console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                               console.log( " ajax always " );
                               console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            }); 
                     });*/
                    $("#emailmodal").find("#offermail").on('submit',(function(e){
                            e.preventDefault();
                            $(this).hide();
                            $("#emailmodal").find(".emailsendloader").show();
                            
                            $.ajax({
                                url: _site_url + controller + "emailsend",
                                type: "POST",
                                data:  new FormData(this),
                                contentType: false,
                                cache: false,
                                processData:false,
                                success: function(data){
                                    console.log("Success");
                                    $("#emailmodal").find(".emailsendloader").hide();
                                    swal({   
                                            title: "Email",   
                                            text: "Send SucessFully",   
                                            type: "success",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false
                                            });
                                     $("#emailmodal").find(".sentform").modal('hide');
                                },
                                error: function(){ 	        
                                    swal({   
                                            title: "Email",   
                                            text: "Email not Sent",   
                                            type: "error",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false
                                            });
                                     $("#emailmodal").find(".sentform").modal('hide');
                                }
                            });
                    }));
                     
            });
            
            $(".invperformaemail").on('click',function()
            {
                $("#emailmodal").find("#modalsent2").remove();
                var id = $(this).data('id');
                var compid = $(this).data('compid');
                var mdsent = $("#modalsent").find("#modalsent2").clone();
                $("#emailmodal").append(mdsent);
                $("#emailmodal").find(".sentform").modal();
                $("#emailmodal").find(".sentform .mailattach").remove();
                $("#emailmodal").find(".sentform .summernote").summernote({
                            placeholder: '',
                            height: 200,
                            popover: {
                                air: [
                                  ['color', ['color']],
                                  ['font', ['bold', 'underline', 'clear']]
                                ]
                            },
                            toolbar: [
                                    [ 'style', [ 'style' ] ],
                                    [ 'font', [ 'bold', 'italic', 'underline',  'superscript', 'subscript', 'clear'] ],
                                    [ 'fontname', [ 'fontname' ] ],
                                    [ 'fontsize', [ 'fontsize' ] ],
                                    [ 'color', [ 'color' ] ],
                                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                                    [ 'table', [ 'table' ] ],
                                    [ 'insert', [ 'link'] ],
                                    [ 'view', [  'fullscreen', 'codeview', 'help' ] ]
                                ]
                        });
                //$("#emailmodal").find('div.note-group-select-from-files').remove();
                //
                $("#emailmodal").find(".mailform").hide();
                var dataConfig = {
                     compid: compid,
                     id: id,
                     type:1,//performa
                 };

                    var controller = 'servicespareregister/';

                    $.ajax({
                        method: "POST",
                        url: _site_url + controller + "offerdata",
                        data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            if(data.status ==1)
                            {
                                $(".toaddress").val(data.toaddress);
                                $(".fromaddress").val(data.fromaddress);
                            }
                            else
                            {
                                $("#emailmodal").find("#sentform").modal('hide');
                            }
                            if(data.contact_person == "" || data.contact_person == null)
                            {
                                $("#emailmodal").find(".summernote").code("<b>Dear Sir/Mam,</b><br><span class='m-l-25'> Greeting from Megawin!!</span>");
                            }
                            else
                            {
                                $("#emailmodal").find(".summernote").code("<b>Dear "+data.contact_person+",</b><br><span class='m-l-25'> Greeting from Megawin!!</span>");
                            }
                            
                            $("#emailmodal").find(".emailattach").closest("div").append("<input type='text' class='form-control col-sm-6' readonly name='attachname' value='"+data.filename+"'><input type='hidden' name='mailattach' value='"+data.filepath+"'>");
                            //$("#emailmodal").find(".emailattach .email_attach").val(data.filename);
                            //$("#emailmodal").find(".mailattach  .fileinput-filename").html("SericeOffer.pdf");

                            //$("#emailmodal").find(".emailattach .email_attach").bootstrapFileInput();
                            $("#emailmodal").find(".mailform").show();
                            $("#emailmodal").find(".emailloader").hide();
                            

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    }); 
                    
                    $("#emailmodal").find(".emailattach").on('click',function(e)
                    {
                        e.preventDefault();
                        $("#modalsent").find(".mailattach").show();
                        var attach = $("#modalsent").find("#modalsent2 .mailattach").clone();
                        $("#modalsent").find(".mailattach").hide();
                        console.log(attach);
                        $(this).closest("div").append(attach).on('click','.closeattach',function()
                        {
                          $(this).closest("div").remove();
                          attachreset();
                        });
                        attachreset();
                    });
                    
                     /*$("#emailmodal").on('click','.mailsend',function()
                     {
                        var toaddress = $("#emailmodal").find(".toaddress").val();
                        var fromaddress = $("#emailmodal").find(".fromaddress").val();
                        var ccaddress = $("#emailmodal").find(".ccaddress").val();
                        var ccaddress = $("#emailmodal").find(".ccaddress").val();
                        var subject = $("#emailmodal").find(".subject").val();
                        var body = $("#emailmodal").find(".summernote").code();
                        
                        var dataConfig = {
                            toaddress: toaddress,
                            fromaddress: fromaddress,
                            ccaddress: ccaddress,
                            subject: subject,
                            body: body
                        };

                        var controller = 'servicespareregister/';

                        $.ajax({
                         method: "POST",
                         url: _site_url + controller + "emailsend",
                         data: dataConfig,

                            }).done( function( data, textStatus, jqXHR ) {
                                console.log( " ajax done " );
                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                               console.log( " ajax fail " );
                               console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                               console.log( " ajax always " );
                               console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            }); 
                     });*/
                    $("#emailmodal").find("#offermail").on('submit',(function(e){
                            e.preventDefault();
                            $(this).hide();
                            $("#emailmodal").find(".emailsendloader").show();
                            
                            $.ajax({
                                url: _site_url + controller + "emailsend",
                                type: "POST",
                                data:  new FormData(this),
                                contentType: false,
                                cache: false,
                                processData:false,
                                success: function(data){
                                    console.log("Success");
                                    $("#emailmodal").find(".emailsendloader").hide();
                                    swal({   
                                            title: "Email",   
                                            text: "Send SucessFully",   
                                            type: "success",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false
                                            });
                                     $("#emailmodal").find(".sentform").modal('hide');
                                },
                                error: function(){ 	        
                                    swal({   
                                            title: "Email",   
                                            text: "Email not Sent",   
                                            type: "error",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false
                                            });
                                     $("#emailmodal").find(".sentform").modal('hide');
                                }
                            });
                    }));
                     
            });
            
            var offercnt = $(".offercnt").data('cnt');
            $(".offeradd").attr('data-cnt',offercnt);
                  
            $(".orderstatus").on('click',function()
            {
                $("#modal3").find("#modalstatus2").remove();
                
                
                var mdsent = $("#modalstatus").find("#modalstatus2").clone();
                $("#modal3").append(mdsent);
                
                $("#modal3").find(".ordercalender input").attr("id","po_date")
                $("#modal3").find(".statusform #po_date").datepicker({dateFormat: 'yy-mm-dd'});
                $("#modal3").find(".statusform").modal();
                //$("#upmodal").find("#po_date").datepicker({dateFormat: 'yy-mm-dd'});
              
                  

                
                $("#modal3").on('click','.upstatus',function()
                {
                    var id = $(this).data('id');
                    var orderstatus = $(this).data('orderstatus');
                    var order_ref_no = "";
                    var po_date = "";

                    if(orderstatus == 2)
                    {
                        order_ref_no = $("#modal3").find("#order_ref_no").val();
                        po_date = $("#modal3").find("#po_date").val();
                    }
                    var controller = 'servicespareregister/';
                    
                    $.ajax({
                    method: "POST",
                    url: _site_url + controller + "updateorderstatus",
                    data: {id:id,orderstatus:orderstatus,order_ref_no:order_ref_no,po_date:po_date},

                    }).done( function( data, textStatus, jqXHR ) {
                    console.log( " ajax done " );
                        swal({   
                                title: "Updated!",   
                                text: "Updated successfully",   
                                type: "success",   
                                showCancelButton: false,   
                                allowOutsideClick: false,
                                showCancelButton: false,   
                                confirmButtonText: "Ok",
                                closeOnConfirm: false,
                            },function(){ 
                                window.location.reload();
                            });

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
                });
            });
            
            function attachreset()
            {
                var cntattach = $("#emailmodal").find(".mailattach");
                
                var len = cntattach.length;
                for(var i =0;i<len;i++)
                {
                    $("#emailmodal").find(".mailattach").eq(i).find('.email_attach').attr('name','attachment['+i+']');
                }
            }
            
            /************************* edit service product**********************************/
            $(".editservicecharge").on('click',function()
            {
                var id = $(this).data('id');
                
                $("#modalservice3").find("#modalservice1").remove();
                var service = $("#modalservice").find("#modalservice1").clone();
                $("#modalservice3").append(service);
                
                var servicenew = $("#modalservice3").find(".serchargenew .serchargenew1 .sercharge0").clone();
                $("#modalservice3").find(".servicenew2 form").append(servicenew);
                servicereset();
                $("#modalservice3").find(".serchargenew .serchargenew1 .sercharge0").hide(); 
                
                $("#modalservice3").find(".newserln").remove();
                
                $("#modalservice3").find(".submitservice").removeClass("submitservice").addClass("updateservice");
                $("#modalservice3").find(".updateservice i").html("Update");
                var controller = 'servicespareregister/';

                $.ajax({
                    method: "POST",
                    url: _site_url + controller + "servicechargeedit",
                    data: {id:id},

                    }).done( function( data, textStatus, jqXHR ) {
                    console.log( " ajax done " );
                    if(data.status ==1)
                    {
                        
                        $("#modalservice3").find(".serchargeform .sr_product_id").attr("name","product_id");
                        $("#modalservice3").find(".serchargeform .sr_product").attr("name","product");
                        $("#modalservice3").find(".serchargeform .sr_description").attr("name","description");
                        $("#modalservice3").find(".serchargeform .sr_qty").attr("name","qty");
                        $("#modalservice3").find(".serchargeform .sr_tax_id").attr("name","tax_id");
                        $("#modalservice3").find(".serchargeform .sr_tax_amt").attr("name","tax_amt");
                        $("#modalservice3").find(".serchargeform .sr_unit_price").attr("name","unit_price");
                        $("#modalservice3").find(".serchargeform .sr_total").attr("name","total");
                        
                        $("#modalservice3").find(".serchargeform .sr_product_id").val(data.data.product_id);
                        $("#modalservice3").find(".serchargeform .sr_product").val(data.data.prd_description);
                        $("#modalservice3").find(".serchargeform .sr_description").val(data.data.description);
                        $("#modalservice3").find(".serchargeform .sr_qty").val(data.data.quantity);
                        $("#modalservice3").find(".serchargeform .sr_unit_price").val(data.data.unit_price);
                        $("#modalservice3").find(".serchargeform .sr_tax_id").val(data.data.tax_id);
                        $("#modalservice3").find(".serchargeform .sr_total").val(data.data.total_price);
                        $("#modalservice3").find(".serchargeform .sr_tax_amt").val(data.data.tax_amt);
                        $("#modalservice3 #serchargeform").find('form').append("<input type='hidden' name='service_product_id' value='"+data.data.id+"' />");
                        //$("#modaltaken3").find(".takenform .card").append(textarea);
                        $("#modalservice3").find(".serchargeform").modal();
                        
                        
                        $("#modalservice3").find(".servicenew2").on('change','.sr_tax_id',function(){
                            var indx = $(this).closest(".row").index();
                            var tax_id = $(this).val();
                            var quantity = $("#modalservice3").find(".servicenew2 .sr_qty").val();
                            var price = $("#modalservice3").find(".servicenew2 .sr_unit_price").val();
                            var tot = parseFloat(price)*parseFloat(quantity);
                            $("#modalservice3").find(".servicenew2 .sr_total").val(tot);
                            
                            sertaxcalc(quantity,price,tax_id);
                        });

                        
                        $("#modalservice3").find(".servicenew2").on('change','.sr_unit_price',function(){
                            var indx = $(this).closest(".row").index();
                            var price = $(this).val();
                            var quantity = $("#modalservice3").find(".servicenew2 .sr_qty").val();
                            var tax_id = $("#modalservice3").find(".servicenew2 .sr_tax_id").val();
                            var tot = parseFloat(price)*parseFloat(quantity);
                            $("#modalservice3").find(".servicenew2 .sr_total").val(tot);
                            if(tax_id =="" || typeof(tax_id) === "undefined")
                            {

                            }
                            else
                            {
                                sertaxcalc(quantity,price,tax_id);
                            }
                        });

                        $("#modalservice3").find(".servicenew2").on('change','.sr_qty',function(){
                            var indx = $(this).closest(".row").index();
                            var price = $("#modalservice3").find(".servicenew2 .sr_unit_price").val();
                            var quantity = $(this).val();
                            var tot = parseFloat(price)*parseFloat(quantity);
                            var tax_id = $("#modalservice3").find(".servicenew2 .sr_tax_id").val();
                            $("#modalservice3").find(".servicenew2 .sr_total").val(tot);
                            if(tax_id =="" || typeof(tax_id) === "undefined")
                            {
                                
                            }
                            else
                            {
                                sertaxcalc(quantity,price,tax_id);
                            }
                        });
                        $(".updateservice").click(function()
                        {
                            $(this).hide();
                            console.log($("#modalservice3 .serchargeform").find('form').serializeArray());
                            $.ajax({
                                method: "POST",
                                url: _site_url + controller + "servicechargeupdate",
                                data: $("#modalservice3 .serchargeform").find('form').serializeArray(),

                                }).done( function( data, textStatus, jqXHR ) {
                                console.log( " ajax done " );
                                if(data.status ==1)
                                {
                                    
                                    $("#takenform").modal('hide');
                                    swal({   
                                            title: "Updated!",   
                                            text: "Updated successfully",   
                                            type: "success",   
                                            showCancelButton: false,   
                                            allowOutsideClick: false,
                                            showCancelButton: false,   
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                        },function(){ 
                                            window.location.reload();
                                        });
                                }
                                
                            }).fail( function( jqXHR, textStatus, errorThrown ) {
                                console.log( " ajax fail " );
                                console.log( jqXHR, textStatus, errorThrown );
                            }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                console.log( " ajax always " );
                                console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                            }); 
                        });
                    }
                    else
                    {

                    }

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });
            });
            
            $(".offeradd").click(function()
            {
                var offer = $(".offerfirst #offerform").clone();
                 $("#offermodal form").find("#offerform").remove();
                $("#offermodal form").append(offer);
                $("#offermodal #offerform").modal('toggle');
                var offercnt = $(this).data('cnt'); 
                $("#offermodal #offerform").find("small").html("Revision No: R"+offercnt);
                $("#offermodal #offerform").find("#revision_no").val("R"+offercnt);
                terms();
                
                $("#offermodal #offerform").find("#offervalidity").change(function()
                {
                    terms();
                });
                $("#offermodal #offerform").find("#freight").change(function()
                {
                    terms();
                });
                $("#offermodal #offerform").find("#deliveryperiod").change(function()
                {
                    terms();
                });
                $("#offermodal #offerform").find("#paymentterms").change(function()
                {
                    var paymentterms = $(this).val();
                    if(parseInt(paymentterms)==3)
                    {
                        $("#offermodal #offerform").find(".creditdays").removeClass('hide');
                        terms();
                        $("#offermodal #offerform").find("#dayscredit").change(function()
                        {
                            terms();
                        });
                        
                    }
                    else
                    {
                        $("#offermodal #offerform").find(".creditdays").addClass('hide');
                        terms();
                    }
                });
                
                function terms()
                {
                    var offervalidity = $("#offermodal #offerform").find("#offervalidity option:selected").html();
                    var freight = $("#offermodal #offerform").find("#freight option:selected").html();
                    var deliveryperiod = $("#offermodal #offerform").find("#deliveryperiod option:selected").html();
                    var paymentterms = $("#offermodal #offerform").find("#paymentterms option:selected").val();
                    if(parseInt(paymentterms)==3)
                    {
                        var credit = $("#offermodal #offerform").find("#dayscredit").val();
                        var paywrd = credit+" Days Credit";
                    }
                    else
                    {
                        var paywrd = $("#offermodal #offerform").find("#paymentterms option:selected").html();
                    }
                    var terms = $("#offermodal #offerform").find(".termsdiv").html();
                    var otherterms = "\n * Prices quoted are ex-works(Salem) and Valid for  "+offervalidity+"\n * "+freight+"\n * Delivery Period Should be "+deliveryperiod+" from the date of receipt of Purchase Order. "+"\n * "+paywrd+"\n";

                    $("#offermodal #offerform").find("#terms").html(otherterms+terms);
                }
                
                $("#offermodal #offerform").find(".addoffer").click(function()
                {
                    $(this).hide();
                        //console.log($(".takennew2").find('.taken0').serializeArray());
                    var controller = 'servicespareregister/';
                    console.log($("#offermodal").find('form').serializeArray());
                    $.ajax({
                        method: "POST",
                        url: _site_url + controller + "offeradd",
                        data: $("#offermodal").find('form').serializeArray(),

                        }).done( function( data, textStatus, jqXHR ) {
                        console.log( " ajax done " );
                        if(data.status ==1)
                        {
                            swal({   
                                        title: "Added!",   
                                        text: "Offer Added Successfully",   
                                        type: "success",   
                                        showCancelButton: false,   
                                        allowOutsideClick: false,
                                        showCancelButton: false,   
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false,
                                    },function(){ 
                                        window.location.reload();
                                    });
                            $("#offermodal").find(".offerform").modal('hide');
                        }
                        else
                        {

                        }

                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            console.log( " ajax fail " );
                            console.log( jqXHR, textStatus, errorThrown );
                        }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                            console.log( " ajax always " );
                            console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                        });
                });
                
            });
            
                
            
    });
</script>
@stop


