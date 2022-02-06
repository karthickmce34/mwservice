        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
            <div class="panel panel-collapse">
                <div class="panel-heading color-block bgm-teal" role="tab" id="headingAduit">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAduit" aria-expanded="false" aria-controls="collapseTwo">
                            Complaint Register Audit
                        </a>
                    </h4>
                </div>
                <div id="collapseAduit" class="collapse" role="tabpanel" aria-labelledby="headingAduit">
                    <div class="panel-body p-10">
                        <div class="p-5 pull-right mm-55-0">
                            <a href="{{url('complaintregister/addnew', $record->id)}}" target="_self">
                                <button class="btn bgm-lime btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></button>                                    
                            </a>
                        </div>
                        <div class="row ">  
                            <div class="col-sm-12">
                                <?php
                                $crrDate = date("Y-m-d");
                                $activestatus = "";
                                $active = "";
                                $n = 0;
                                ?>
                                <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                    @if(($record->registeraudits))
                                        <div class="row">
                                        @foreach($record->registeraudits as $registeraudit)
                                            <?php $n++; ?>
                                            
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-body card-padding pd-10-20">
                                                        <div class="row" style="padding: 8px 0 8px 0px;">
                                                            <div class="col-sm-2">{{$registeraudit->name}}</div>
                                                            <div class="col-sm-4 ">
                                                                @if($registeraudit->file_type == 0)
                                                                    <img style="width: inherit;" src="{{url('/')}}/{{$registeraudit->file_path}}/{{$registeraudit->file_name}}" />
                                                                @else
                                                                    <a style="width: inherit;" href="{{url('/')}}/{{$registeraudit->file_path}}/{{$registeraudit->file_name}}" tabindex="_self">{{$registeraudit->file_name}}<a/>
                                                                @endif                                                                    
                                                            </div>
                                                            <div class="col-sm-2 text-center">
                                                                <a href="{{url('complaintregister/editdoc', $registeraudit->id)}}" target="_self">
                                                                    <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit"></i></button>
                                                                </a>
                                                                <a href="{{url('complaintregister/deletedoc', $registeraudit->id)}}" target="_self">
                                                                    <button class="btn bgm-red btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-close"></i></button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>