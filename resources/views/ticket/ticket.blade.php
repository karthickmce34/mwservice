@extends('_layouts.app')

@section('title', 'Ticket List')
@section('page_title', 'Ticket List')
@section('page_icon_cls', 'fa-building')

@section('page_spares_li_cls', 'toggled active')
@section('page_ticket_li_cls', 'toggled active')
@section('page_ticket_li_list_cls', 'active')
@section('page_ticket_li_add_cls', '')

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
            
        });
    </script>
@stop


