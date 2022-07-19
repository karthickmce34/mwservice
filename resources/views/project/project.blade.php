@extends('_layouts.app')

@section('title', 'Projectplan List')
@section('page_title', 'Projectplan List')
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


