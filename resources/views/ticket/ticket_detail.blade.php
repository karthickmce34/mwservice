@extends('_layouts.app')

@section('title', 'Ticket')
@section('page_title', 'Ticket')
@section('page_icon_cls', 'fa-building')

@section('page_spares_li_cls', 'toggled active')
@section('page_ticket_li_cls', 'toggled active')
@section('page_ticket_li_list_cls', 'active')
@section('page_ticket_li_add_cls', '')
@section('style')
@parent
<style>
    modal-header .btnGrp{
      position: absolute;
      top: 8px;
      right: 10px;
    } 
 

    .min{
        width: 250px; 
        height: 35px;
        overflow: hidden !important;
        padding: 0px !important;
        margin: 0px;    

        float: left;  
        position: static !important; 
      }

    .min .modal-dialog, .min .modal-content{
        height: 100%;
        width: 100%;
        margin: 0px !important;
        padding: 0px !important; 
      }

    .min .modal-header{
        height: 100%;
        width: 100%;
        margin: 0px !important;
        padding: 3px 5px !important; 
      }

    .display-none{display: none;}

    button .fa{
        font-size: 16px;
        margin-left: 10px;
      }

    .min .fa{
        font-size: 14px; 
      }

    .min .menuTab{display: none;}

    button:focus { outline: none; }

    .minmaxCon{
      height: 35px;
      bottom: 1px;
      left: 1px;
      position: fixed;
      right: 1px;
      z-index: 9999;
    }
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
    $(function(){
        var usrtype = <?php echo session()->get('user_type'); ?>;
        
        
        
        var _site_url = "{{url('/')}}/";
        $(".spare_save").addClass("spare_save_eh").removeClass("spare_save");
        $(".app_save").addClass("app_save_eh").removeClass("app_save");
        $(".ticketrequest").on("click",function(){
            var id = $(this).data('id');
            $(".spare_save_eh").attr("data-id",id);
            $(".app_save_eh").attr("data-id",id);
            if(usrtype == 1)
            {
               spares(id); 
            }
            else
            {
                service(id);
            }
            
            
        });
        
        function spares(id)
        {
            var controller = 'home/';
            var dataConfig = {isspares:1};
            $.ajax({
                method: "GET",
                url: _site_url + controller + "docseq",
                data : dataConfig,
            }).done(function (data, textStatus, jqXHR) {
                    if(data.status==1)
                    {
                        if(parseInt(data.seqdata.seqno)<10)
                    {
                        var seq='00'+data.seqdata.seqno;
                    }
                    else 
                    {
                        if(parseInt(data.seqdata.seqno)>9 && parseInt(data.seqdata.seqno)<99)
                        {
                           var seq='0'+data.seqdata.seqno;
                        }
                        else
                        {
                            var seq=data.seqdata.seqno;
                        }
                    }
                    var seqno=data.seqdata.prefix+' '+data.seqdata.year.substring(2, 4)+data.seqdata.month+seq;

                    $('#blankSpares').find('#sp_docseq_no').val(seqno);
                    $('#blankSpares').find('#mode_of_complaint').val(1);
                    
                    $('#blankSpares').find('#sp_customer_name').val($(".email_name").html());
                    
                    var email_id = $(".email_id").html();
                    $('#blankSpares').find('#sp_emailid').val(email_id);
                    
                    
                    
                    var dataconfig={email_id:email_id};
                    var econtroller = 'email/';
                    $.ajax({
                        
                        url:_site_url + econtroller + "emaildata",
                        method:"POST",
                        data:dataconfig,
                    }).done(function (data, textStatus, jqXHR) {
                    if(data.status == 1)
                    {
                        //sp_customer_name,sp_address1,sp_address2,sp_gstin,sp_phoneno,sp_mobileno
                        //$('#blankSpares').find('#sp_customer_name').val(data.modeldata.customer_name);
                        $('#blankSpares').find('#sp_address1').val(data.modeldata.address1);
                        $('#blankSpares').find('#sp_address2').val(data.modeldata.address2);
                        $('#blankSpares').find('#sp_gstin').val(data.modeldata.gstin);
                        $('#blankSpares').find('#sp_phoneno').val(data.modeldata.phoneno);
                        $('#blankSpares').find('#sp_mobileno').val(data.modeldata.mobileno);
                        $('#blankSpares').modal();

                    }
                    else
                    {
                        $('#blankSpares').modal();
                    }
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        console.log(" ajax fail ");
                        //console.log(jqXHR, textStatus, errorThrown);
                    }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                        console.log(" ajax always ");
                        //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                    });
                    

                }
                else
                {
                    swal("Warning","Document sequence is no created","warning");
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(" ajax fail ");
                //console.log(jqXHR, textStatus, errorThrown);
            }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                console.log(" ajax always ");
                //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
            });
        }
        
        function service(id)
        {
            var controller = 'home/';
            var dataConfig = {isspares:0};
            $.ajax({
                method: "GET",
                url: _site_url + controller + "docseq",
                data : dataConfig,
            }).done(function (data, textStatus, jqXHR) {
                    if(data.status==1)
                    {
                        if(parseInt(data.seqdata.seqno)<10)
                    {
                        var seq='00'+data.seqdata.seqno;
                    }
                    else 
                    {
                        if(parseInt(data.seqdata.seqno)>9 && parseInt(data.seqdata.seqno)<99)
                        {
                           var seq='0'+data.seqdata.seqno;
                        }
                        else
                        {
                            var seq=data.seqdata.seqno;
                        }
                    }
                    var seqno=data.seqdata.prefix+' '+data.seqdata.year.substring(2, 4)+data.seqdata.month+seq;

                    $('#blankModal').find('#docseq_no').val(seqno);
                    
                    $('#blankModal').find('#modeofcomplaint').val(1);
                    
                    $('#blankModal').find('#customer_name').val($("#companyname").val());
                    
                    var email_id = $("#emailaddress").val();
                    var modeofcomplaint = $("#modetype").val();
                    $('#blankModal').find('#modeofcomplaint').val($("#modetype").val());
                    $('#blankModal').find('#modeofcomplaint').attr("disabled","true");
                    $('#blankModal').find('#emailid').val(email_id);
                    $('#blankModal').find('#complaint_nature').val($("#complaintnature").val());
                    
                    $('#blankModal').find('#customer_name').val($("#companyname").val());
                    $('#blankModal').find('#mobileno').val($("#mobileno").val());
                    $('#blankModal').find('#contact_person').val($("#contactperson").val());
                    
                    $('#blankModal').modal();

                }
                else
                {
                    swal("Warning","Document sequence is no created","warning");
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(" ajax fail ");
                //console.log(jqXHR, textStatus, errorThrown);
            }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                console.log(" ajax always ");
                //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
            });
        }
      
        $(".spare_save_eh").click(function()
        {
            var id = $(this).data('id');
            var mode = $("#modetype").val();//$("#mode_of_complaint option:selected").val();
            //var complaint_type = $("#complaint_type option:selected").val();
            var complaint_type = 0;
            var customer_name = $("#customer_name").val();
            var address1 = $("#address1").val();
            var address2 = $("#address2").val();
            var city = $("#city").val();
            var pincode = $("#pincode").val();
            var state = $("#state").val();
            var gstin = $("#gstin").val();
            var panno = $("#panno").val();
            var mobileno = $("#mobileno").val();
            var emailid = $("#emailid").val();
            var complaint_nature = $("#complaint_nature").val();
            var contact_person = $("#contact_person").val();

            var fail = false;
            var fail_log = '';
            var name;
            $( "#blankSpares" ).find( 'select, textarea, input' ).each(function(){
                if( ! $( this ).prop( 'required' )){

                } else {
                    if ( ! $( this ).val() ) {
                        fail = true;
                        name = $( this ).attr( 'placeholder' );
                        fail_log += name + " is required \n";
                    }

                }
            });

            //submit if fail never got set to true
            if ( ! fail ) {
                $(this).hide();

                var data = 1;
            } else {
                alert( fail_log );
                var data = 0;
            }

            if(data == 1)
            {
                var form_data = $("#blankSpares").find('form').serializeArray();
                var formarray={};

                $.map(form_data, function(n, i){
                    formarray[n['name']] = n['value'];
                });
                formarray['ticket_id'] = id;
                //console.log(formarray);return false;
                swal({   
                     title: "Are you sure all Entries are correct?",   
                     text: "",   
                     type: "warning",   
                     showCancelButton: true, 
                     confirmButtonText: "Confirm!",
                     cancelButtonText: "Cancel!",  
                     closeOnConfirm: true
                 },function(){ 
                            var controller = 'email/';
                            var dataConfig = formarray;
                            $.ajax({
                                method: "POST",
                                url: _site_url + controller + "spareappdata",
                                data: dataConfig,
                                }).done(function (data, textStatus, jqXHR) {
                                    if(data.status == 1)
                                    {
                                        swal("Added","Your Spare Request is registered","success");
                                        $("#blankSpares").modal('hide');
                                        window.location.reload();
                                    }
                                    else
                                    {
                                        swal("Error","Your Spare Request is not registered","error");
                                    }

                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                            });
            }
        }); 
        
        $(".app_save_eh").click(function()
        {
            var id = $(this).data('id');
            var mode = $("#modetype").val();
            //var complaint_type = $("#complaint_type option:selected").val();
            var complaint_type = 0;
            var customer_name = $("#customer_name").val();
            var address1 = $("#address1").val();
            var address2 = $("#address2").val();
            var city = $("#city").val();
            var pincode = $("#pincode").val();
            var state = $("#state").val();
            var gstin = $("#gstin").val();
            var panno = $("#panno").val();
            var mobileno = $("#mobileno").val();
            var emailid = $("#emailid").val();
            var complaint_nature = $("#complaint_nature").val();
            var contact_person = $("#contact_person").val();

            var fail = false;
            var fail_log = '';
            var name;
            $( "#blankModal" ).find( 'select, textarea, input' ).each(function(){
            
        
            if( ! $( this ).prop( 'required' )){

                } else {
                    if ( ! $( this ).val() ) {
                        fail = true;
                        name = $( this ).attr( 'placeholder' );
                        fail_log += name + " is required \n";
                    }

                }
            });

            //submit if fail never got set to true
            if ( ! fail ) {
                $(this).hide();

                var data = 1;
            } else {
                alert( fail_log );
                var data = 0;
            }


            if(data == 1)
            {
                var form_data = $("#blankModal").find('form').serializeArray();
                var formarray={};

                $.map(form_data, function(n, i){
                    formarray[n['name']] = n['value'];
                });
                formarray['ticket_id'] = id;
                formarray['mode_of_complaint'] = mode;
                swal({   
                 title: "Are you sure all Entries are correct?",   
                 text: "",   
                 type: "warning",   
                 showCancelButton: true, 
                 confirmButtonText: "Confirm!",
                 cancelButtonText: "Cancel!",  
                 closeOnConfirm: true
             },function(){ 
                        var controller = 'ticket/';
                        var dataConfig = formarray;
                        $.ajax({
                            method: "POST",
                            url: _site_url + controller + "appdata",
                            data: dataConfig,
                            }).done(function (data, textStatus, jqXHR) {
                                if(data.status == 1)
                                {
                                    swal("Added","Your Complaint is registered","success");
                                    $("#blankModal").modal('hide');
                                    window.location.reload();
                                }
                                else
                                {
                                    swal("Error","Your Complaint is not registered","error");
                                    $(this).show();
                                }

                            }).fail(function (jqXHR, textStatus, errorThrown) {
                                console.log(" ajax fail ");
                                //console.log(jqXHR, textStatus, errorThrown);
                            }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                console.log(" ajax always ");
                                //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                            });
                        });
            }

        });
        
        function getSelectionHtml() {
            var html = "";
            if (typeof window.getSelection != "undefined") {
                var sel = window.getSelection();
                if (sel.rangeCount) {
                    var container = document.createElement("div");
                    for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                        container.appendChild(sel.getRangeAt(i).cloneContents());
                    }
                    html = container.innerHTML;
                }
            } else if (typeof document.selection != "undefined") {
                if (document.selection.type == "Text") {
                    html = document.selection.createRange().htmlText;
                }
            }
            return html;
        }

        $(document).ready(function() {
            $(document).bind("mouseup", function() {
                var selectedText = getSelectionHtml();
                if(selectedText != ''){
                    //alert(selectedText);
                    
                }
            });
        });
        
        
        $(".ticketclose").on("click",function()
        {
            $(this).hide();
            $(".ticketrequest").hide();
            $("#modalticketstatus").find("#ticketstatusform").modal();
            
            
            $("#modalticketstatus").find(".submitemst").on("click",function()
            {
                    var emstatus = $("#modalticketstatus").find(".selstatus").val();
                    var id = $("#modalticketstatus").find("#ticketid").val();
                    var controller = 'ticket/';

                    $.ajax({
                            method: "POST",
                            url: _site_url + controller + "ticketstatus",
                            data:{status : emstatus,id: id},

                            }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            if(data.status ==1)
                            {
                                swal("Success!", "Completed successfully!", "success");
                                window.location.reload();
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
                                $("#modalticketstatus").find("#ticketstatusform").modal('hide');
                            });
            });
        });
        
        /********************************************************/
            var $content, $modal, $apnData, $modalCon; 

            $content = $(".min");



          

            $("button[data-dismiss='modal']").click(function(){ 
                $(this).closest(".mysrmodal").removeClass("min");
                $(".container").removeClass($apnData);   
                $(this).next('.modalSrMinimize').find("i").removeClass('fa fa-clone').addClass( 'fa fa-minus');
              }); 

            /*******************************************************/
            
    })
    
</script>
@stop


