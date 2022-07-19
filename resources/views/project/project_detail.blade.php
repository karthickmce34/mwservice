@extends('_layouts.app')

@section('title', 'ProjectPlan')
@section('page_title', 'ProjectPlan')
@section('page_icon_cls', 'fa-building')

@section('page_project_li_cls', 'toggled active')
@section('page_projectplan_li_cls', 'toggled active')
@section('page_projectplan_li_list_cls', 'active')
@section('page_projectplan_li_add_cls', '')

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
            
           /* $(".completed").click(function(){
                    
                  swal({
            title: "Are you sure?",
            text: "Once Completed Cannot be Reactive!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
            closeOnConfirm: true,
            closeOnCancel: true
         },
         function(isConfirm){

           if (isConfirm){
                //swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");
                    var controller = 'visitplan/';
                    var id =$(".completed").data('id');
                    
                    $.ajax({
                            method: "POST",
                            url: _site_url + controller + "updatestatus",
                            data:{id:id},

                            }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            if(data.status ==1)
                            {
                                swal("Success!", "Completed successfully!", "success");
                                $(".completed").hide();
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
                            });
                
            } else {
                //swal("Cancelled", "Your imaginary file is safe :)", "error"); 
            }
         });
                    
        });*/
        
            $(".completed").click(function(){
                $("#modal3").find("#modalcomplete1").remove();
                var model2 = $("#modalcomplete").find("#modalcomplete1").clone();
                $("#modal3").append(model2);
                $("#modal3").find("#visitcompleteform").modal(); 
            });
            
            
            $(".approve").click(function(){
                    $(this).hide();  
                    swal({
                        title: "Are you sure?",
                        text: "Once Approved Cannot be Reverse!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, I am sure!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: true,
                        closeOnCancel: true
                     },
                function(isConfirm){

                if (isConfirm){
                    //swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");
                        
                        var id =$(".approve").data('id');
                        var dataConfig = {id:id};
                        var controller = 'project/';

                        $.ajax({
                            method: "POST",
                            url: _site_url + controller + "updateapprove",
                            data: dataConfig,

                        }).done( function( data, textStatus, jqXHR ) {
                            console.log( " ajax done " );
                            $(".approve_div").hide();

                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            console.log( " ajax fail " );
                            $(".approve").show();
                            console.log( jqXHR, textStatus, errorThrown );
                        }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                            console.log( " ajax always " );
                            console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                        });
                
                    } else {
                        //swal("Cancelled", "Your imaginary file is safe :)", "error"); 
                    }
                });
            
            });   
    });
</script>
@stop


