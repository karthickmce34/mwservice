@extends('_layouts.app')

@section('title', 'Product List')
@section('page_title', 'Product List')
@section('page_icon_cls', 'fa-building')

@section('page_master_li_cls', 'toggled active')
@section('page_product_li_cls', 'toggled active')
@section('page_product_li_list_cls', 'active')
@section('page_product_li_add_cls', '')

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
    @include('_common.base_list_table')      

@stop

@section('css')
    @parent
@stop    
@section('js')
    @parent
    
    <script>
        $(function () {
            $("#data-table-command").dataTable();
            var _site_url = "{{url('/')}}/";
            $(".prdrefresh").on('click',function(){
               $("#modalproduct").modal();
               var controller = 'home/';
                    $.ajax({
                        method: "GET",
                        url: _site_url + controller + "prddetail",
                        }).done(function (data, textStatus, jqXHR) {
                            var len = data.length;
                            console.log(len);
                            console.log(" ajax success ");
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            console.log(" ajax fail ");
                            //console.log(jqXHR, textStatus, errorThrown);
                        }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                            console.log(" ajax always ");
                            //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                        }); 
            });
        });
    </script>
@stop


