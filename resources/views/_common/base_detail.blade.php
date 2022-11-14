                    @if($baseName == 'servicespareregister' || $baseName == 'visitplan' || $baseName == 'pendingvisit' || $baseName == 'visitplansummary' || $baseName != 'email')
                                
                    @else
                    <div class="text-center pull-right">
                        <div class="color-block bgm-amber p-5">
                            <span class="color">In Active</span>
                        </div>
                        <div class="color-block bgm-lightgreen p-5">
                            <span class="color">Active</span>
                        </div>
                        <div class="p-5">
                            @if($baseName != 'servicespareregister' || $baseName != 'visitplan' || $baseName != 'pendingvisit' || $baseName != 'visitplansummary' || $baseName != 'product' || $baseName != 'email')
                                <a href="{{url($basePath)}}/create" target="_self">
                                    <button class="btn bgm-lime btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></button>                                    
                                </a> 
                            @endif   
                        </div>
                    </div>
                     @endif
                    <div class="text-center">
                        <h2 class="f-400">@if($baseName == 'complaintregister') Call Log  
                                                @else
                                                    @if($baseName == 'servicespareregister') Service Register
                                                    @else 
                                                    @if($baseName == 'visitplan') Visits Plan
                                                    @else
                                                    @if($baseName == 'pendingvisit') Pending Visit
                                                    @else 
                                                    @if($baseName == 'visitplansummary') Visit Summary
                                                    @else 
                                                    {{ucfirst($baseName)}} @endif @endif @endif @endif @endif Detail</h2>
                    </div>
                    <?php //echo"<pre>";print_r($record);echo"</pre>";  ?>
                    @include('_common.errors')

                    <div class="clearfix"></div>
                
                    <div class="row m-t-25">
                        
                        @if($record)                                             
                        
                        <div class="col-sm-12">
                            <div class="card pt-inner">
                                <div class="pti-header @if($record->status==1) bgm-lightgreen @else bgm-amber @endif">
                                    @include($baseName . '.' . $baseName .'_dt')  
                                    <div class="pti-footer lnk-wh-inh">
                                        
                                        @if($baseName != 'visitplansummary' && $baseName != 'ticket' )
                                            @if(isset($record->visit_status))
                                                @if($baseName == 'project')
                                                    @if($record->visit_status == 0 && $record->approval_status == 0)
                                                        <a href="{{url($basePath)}}/{{$record->id}}/edit" target="_self" class="bgm-orange"><i class="zmdi zmdi-edit"></i></a>
                                                    @endif
                                                @else 
                                                    @if($record->visit_status == 0)
                                                        <a href="{{url($basePath)}}/{{$record->id}}/edit" target="_self" class="bgm-orange"><i class="zmdi zmdi-edit"></i></a>
                                                    @endif
                                                @endif
                                                    
                                            @else
                                                @if(isset($record->order_status))
                                                    @if($record->order_status != 8 && $record->order_status != 9 && $record->order_status != 11)
                                                        <a href="{{url($basePath)}}/{{$record->id}}/edit" target="_self" class="bgm-orange"><i class="zmdi zmdi-edit"></i></a>
                                                    @endif
                                                @else
                                                    @if(session()->get('user_type') == 0)
                                                        <a href="{{url($basePath)}}/delete/{{$record->id}}" target="_self" class="bgm-red"><i class="zmdi zmdi-close"></i></a>
                                                    @endif
                                                @endif
                                                    
                                            @endif
                                            <!--
                                            <a href="{{url($basePath)}}/show/{{$record->id}}" target="_self" class="bgm-lightblue"><i class="zmdi zmdi-view-web"></i></a>
                                            --> 
                                        @endif
                                    </div>
                            </div>
                        </div>   
                            
                        @endif
                        
                    </div> 
                        
                    @if(ucfirst($baseName)=='Complaintregister')
                        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                            @include('complaintregister.complaintregister_subdt')
                        </div>
                    @endif
                    @if(ucfirst($baseName)=='Servicespareregister')
                        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                            @include('servicespareregister.servicespareregister_subdt')
                        </div>
                    @endif
                    @if(ucfirst($baseName)=='Visitplan')
                        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                            @include('visitplan.visitplan_subdt')
                        </div>
                    @endif
                    @if(ucfirst($baseName)=='Pendingvisit')
                        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                            @include('pendingvisit.pendingvisit_subdt')
                        </div>
                    @endif
                    @if(ucfirst($baseName)=='Visitplansummary')
                        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                            @include('visitplansummary.visitplansummary_subdt')
                        </div>
                    @endif
                    @if(ucfirst($baseName)=='Project')
                        @if($record->visit_status == 1)
                        <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                            @include('project.project_subdt')
                        </div>
                        @endif
                    @endif