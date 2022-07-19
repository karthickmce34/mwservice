        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
            <div class="panel panel-collapse">
                <div class="panel-heading color-block bgm-blue" role="tab" id="headingProduct">
                    <h4 class="panel-title">
                        <a class="collapsed c-white" data-toggle="collapse" data-parent="#accordion" href="#collapseProduct" aria-expanded="false" aria-controls="collapseOne">
                            Project Summary
                        </a>
                    </h4>
                </div>
                <div id="collapseProduct" class="collapse" role="tabpanel" aria-labelledby="headingProduct">
                    <div class="panel-body p-10">
                        
                        <div class="row ">  
                            <div class="col-sm-12">
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                        <div class="col-sm-2"><i class="zmdi "></i><b>Boarding Expense</b></div>
                                        <div class="col-sm-2">{{$record->projectsummary->expense->boarding_expenses}} </div>
                                          
                                        <div class="col-sm-2"><i class="zmdi "></i><b>Lodging Expense</b></div>
                                        <div class="col-sm-2">{{$record->projectsummary->expense->loading_expenses}} </div>
                                    </div>
                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                        <div class="col-sm-2"><i class="zmdi "></i><b>Travel Expense</b></div>
                                        <div class="col-sm-2">{{$record->projectsummary->expense->travel_expenses}} </div>
                                          
                                        <div class="col-sm-2"><i class="zmdi "></i><b>Local Expense</b></div>
                                        <div class="col-sm-2">{{$record->projectsummary->expense->local_expenses}} </div>
                                    </div>
                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                        <div class="col-sm-2"><i class="zmdi "></i><b>Work Description</b></div>
                                        <div class="col-sm-10 ">{{$record->projectsummary->work_description}} </div>
                                    </div>
                                </div>
                                <div class="panel card m-t-25" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                        <div class="col-sm-4"><i class="zmdi "></i><b>Site Photos</b></div>
                                        <div class="col-sm-8 text-center">@if($record->projectsummary->site_file_path == "")  @else
                                            <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$record->projectsummary->site_file_path}}/{{$record->projectsummary->site_file_name}}" /> @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                        <div class="col-sm-4"><i class="zmdi "></i><b>Lodging Bill</b></div>
                                        <div class="col-sm-8 text-center">@if($record->projectsummary->lodgingbill_file_path == "")  @else
                                            <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$record->projectsummary->lodgingbill_file_path}}/{{$record->projectsummary->lodgingbill_file_name}}" /> @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    <div class="row" style="    padding: 8px 0 8px 0px;">       
                                        <div class="col-sm-4"><i class="zmdi "></i><b>Travel Bill</b></div>
                                        <div class="col-sm-8 text-center">@if($record->projectsummary->travelbill_file_path == "")  @else
                                            <img style="width: 25%;height: 25%;" src="{{url('/')}}/{{$record->projectsummary->travelbill_file_path}}/{{$record->projectsummary->travelbill_file_name}}" /> @endif
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>