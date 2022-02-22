@extends('_layouts.app')

@section('title', 'Service Report')
@section('page_title', 'Service Report')
@section('page_icon_cls', 'fa-building')

@section('page_report_li_cls', 'toggled active')
@section('page_servicereport_li_cls', 'toggled active')
@section('page_servicereport_li_list_cls', 'active')
@section('page_servicereport_li_add_cls', '')

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
    <div class="card">
            <div class="card-header card-padding text-center">
                <h3>Service Report</h3>
            </div>
            <div class="card-body card-padding " >
                <div style="border: 2px gray solid;border-radius: 5px" >
                    <div class="row m-25">
                        <div class="row m-25">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <?php $currdate = date("d-m-Y"); ?>
                                        <p class="c-black f-500 m-b-20">From date</p>
                                        <div class="input-group form-group">
                                            <input type='text' class="form-control" placeholder="Click here..." id='fromdate' name='fromdate' value="{{$currdate}}">
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="col-xs-3">
                               <div class="form-group">
                                    <div class="fg-line">
                                        <p class="c-black f-500 m-b-20">To date</p>

                                        <div class="input-group form-group">
                                            <input type='text' class="form-control" placeholder="Click here..." id='todate' name='todate' value="{{$currdate}}">
                                        </div>
                                    </div>
                                </div>
                           </div>                         
                        </div>

                       
                    </div>
                    <div class="row text-center reportview">
                        <div class="col-xs-12">
                           <div class="form-group">
                               <div class="fg-line">
                                    <button type="button" class="btn bgm-orange search"><i class="zmdi zmdi-search"></i> Search</button>

                               </div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="m-t-25" id="purview">
                    <div class="loader text-center" style="display: none;height: 150px; ">
                        <div class="preloader pls-gray">
                            <svg class="pl-circular m-b-25" viewBox="25 25 50 50">
                                <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                            </svg>

                            <p class="m-t-25">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>        

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


