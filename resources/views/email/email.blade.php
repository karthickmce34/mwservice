@extends('_layouts.app')

@section('title', 'Email List')
@section('page_title', 'Email List')
@section('page_icon_cls', 'fa-building')

@section('page_master_li_cls', 'toggled active')
@section('page_email_li_cls', 'toggled active')
@section('page_email_li_list_cls', 'active')
@section('page_email_li_add_cls', '')

@section('style')
    @parent
    <style>
       #data-table-command {
            table-layout: fixed;
            width: 100% !important;
          }
          #data-table-command td{
            width: auto !important;
            text-overflow: ellipsis;
            overflow: hidden;
          }
          #data-table-command th{
            width: auto !important;
            white-space: normal;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
          }
      
    </style> 
@stop
@section('menu')
    @parent
@stop
@section('content')
    @parent
    @include('_common.base_list_table')      

@stop

@section('css')
    @parent
@stop    
@section('js')
    @parent
    
    <script>
        $(function () {
            //$("#data-table-command").dataTable();
            /*var _site_url = "{{url('/')}}/";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var controller = 'email/';
            $.ajax({
                method: "POST",
                url: _site_url + controller + "message",
                }).done(function (data, textStatus, jqXHR) {
                    
                    
                    console.log(" ajax success ");
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.log(" ajax fail ");
                    /*var controller = 'login/';
                        $.ajax({
                            method: "GET",
                            url: _site_url + controller + "logout",
                        }).done(function (data, textStatus, jqXHR) {
                                window.location.reload();
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            console.log(" ajax fail ");
                            //console.log(jqXHR, textStatus, errorThrown);
                        }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                            console.log(" ajax always ");
                            //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                        });
                    //console.log(jqXHR, textStatus, errorThrown);
                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                    console.log(" ajax always ");
                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                }); */
        });
    </script>
@stop


