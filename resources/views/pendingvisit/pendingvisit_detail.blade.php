@extends('_layouts.app')

@section('title', 'Pending Visitplan List')
@section('page_title', 'Pending Visitplan List')
@section('page_icon_cls', 'fa-building')

@section('page_spares_li_cls', 'toggled active')
@section('page_pendingvisit_li_cls', 'toggled active')
@section('page_pendingvisit_li_list_cls', 'active')
@section('page_pendingvisit_li_add_cls', '')

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
            $(".billlodging").hide();
            $(".billboarding").hide();
            $(".billtravel").hide();
            
            var loading_expenses = $("#loading_expenses").val();
            var boarding_expenses = $("#boarding_expenses").val();
            var travel_expenses = $("#travel_expenses").val();
            if(parseInt(loading_expenses) > 0)
            {
                $(".billlodging").show();
            }
            
            
            if(parseInt(travel_expenses) > 0)
            {
                $(".billtravel").show();
            }
            
            $(".completed").click(function(){
                //alert();return false;
                $("#modal3").find("#modalcomplete1").remove();
                var model2 = $("#modalcomplete").find("#modalcomplete1").clone();
                $("#modal3").append(model2);
                
                var thigsnew3 = $("#modal3").find(".product").find(".things0").clone(); 
                $("#modal3").find("form .thingsnew2").append(thigsnew3).on('click','.remove',function()
                 {
                     $(this).closest(".things0").remove();
                     arrayreset();
                 });
                 arrayreset();
                $("#modal3").find(".act_attend_date_from").attr("id","act_attend_date_from");
                $("#modal3").find(".act_attend_date_to").attr("id","act_attend_date_to");
                
                
                $("#modal3").find("#act_attend_date_from").datepicker({dateFormat: 'yy-mm-dd'});
                $("#modal3").find("#act_attend_date_to").datepicker({dateFormat: 'yy-mm-dd'});
                
                $("#modal3").find(".act_agent_date_from").attr("id","act_agent_date_from");
                $("#modal3").find(".act_agent_date_to").attr("id","act_agent_date_to");
                
                
                $("#modal3").find("#act_agent_date_from").datepicker({dateFormat: 'yy-mm-dd'});
                $("#modal3").find("#act_agent_date_to").datepicker({dateFormat: 'yy-mm-dd'});
                
                
                $("#modal3").find(".newline").on('click',function()
                {
                   var thigsnew2 = $("#modal3").find(".product").find(".things0").clone(); 
                   $("#modal3").find("form .thingsnew2").append(thigsnew2).on('click','.remove',function()
                    {
                        $(this).closest(".things0").remove();
                        arrayreset();
                    });
                   
                   arrayreset();
                });
                
                $("#modal3").find("form .thingsnew2").on('change',"#qty",function(){
                   var qty = $(this).val(); 
                   console.log($(this).closest(".things0"));
                   //$(this).closest(".things0").find("input#unitprice").val(qty);
                });
                
                
                $("#modal3").find("#visitcompleteform").modal(); 
                $("#modal3").find("#submit1").click(function()
                {
                    $(this).hide();
                    /*var data1 = $("#modal3").find('form').serializeArray();
                    $.each($("#modal3").find('.imgupload'), function(i, obj) {
                        //console.log(obj.name);
                             $.each(obj.files,function(j, file){
                                 //console.log(file);
                                 var nam = obj.name;
                                 data1.push({name:nam,value:file});
                             })
                     });*/
                     
                     /*var form_data = new FormData();
                     var totalfiles = $("#modal3").find('.').length;
                        for (var index = 0; index < totalfiles; index++) {
                           form_data.append("files[]", $("#modal3").find('.imgupload').files[index]);
                        }
                        console.log(form_data);*/
                        
                    /*swal({
                        title: "Are you sure?",
                        text: "Job Done Completely!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, I am sure!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: true
                     },
                     function(isConfirm){

                       if (isConfirm){
                            var controller = 'pendingvisit/';

                            $.ajax({
                                    method: "POST",
                                    url: _site_url + controller + "insertsummary",
                                    data:data1,

                                    }).done( function( data, textStatus, jqXHR ) {
                                    console.log( " ajax done " );
                                    if(data.status ==1)
                                    {
                                        swal("Success!", "Completed successfully!", "success");
                                    }
                                    else
                                    {
                                        swal("Error", "Check The Data", "error"); 
                                    }

                                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                                        console.log( " ajax fail " );
                                        console.log( jqXHR, textStatus, errorThrown );
                                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                                        console.log( " ajax always " );
                                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                                    });

                            } else {
                                //swal("Cancelled", "Your imaginary file is safe :)", "error"); 
                            }
                     });*/
                });
                
                function arrayreset()
                {
                    var len = $("#modal3").find(".thingsnew2").find(".things0").length;
                    for(var i=0;i<len;i++)
                    {
                        var j=parseInt(i)+1;
                        $("#modal3").find(".thingsnew2").find(".things0").eq(i).find(".sno").text(j+")");
                        $(".thingsnew2").find(".things0").eq(i).find("#product").attr("name","product["+j+"]");
                        $(".thingsnew2").find(".things0").eq(i).find("#qty").attr("name","qty["+j+"]");
                        $(".thingsnew2").find(".things0").eq(i).find("#unitprice").attr("name","unitprice["+j+"]");
                        $(".thingsnew2").find(".things0").eq(i).find("#amount").attr("name","amount["+j+"]");
                        $(".thingsnew2").find(".things0").eq(i).find(".billimage").attr("name","billimage["+j+"]");
                    }
                }
                
                $("#modal3").find("#loading_expenses").change(function()
                {
                    var loading_expenses = $("#modal3").find("#loading_expenses").val();
                    if(parseInt(loading_expenses) > 0)
                    {
                        $("#modal3").find(".billlodging").show();
                    }
                    else
                    {
                        $("#modal3").find(".billlodging").hide();
                    }
                });
                
                
                $("#modal3").find("#travel_expenses").change(function()
                {
                    var loading_expenses = $("#modal3").find("#travel_expenses").val();
                    if(parseInt(loading_expenses) > 0)
                    {
                        $("#modal3").find(".billtravel").show();
                    }
                    else
                    {
                        $("#modal3").find(".billtravel").hide();
                    }
                });
            
        });  
        
        $(".complaint").click(function(){
            $("#blankModal").modal();

        });
        
        
            
    });
</script>
@stop


