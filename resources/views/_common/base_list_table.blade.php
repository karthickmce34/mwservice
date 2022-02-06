                
                    <div class="text-center pull-right">
                        @if($baseName == 'purchase')
                        <div class="color-block bgm-amber p-5">
                            <span class="color">In Active</span>
                        </div>
                        <div class="color-block bgm-lightgreen p-5">
                            <span class="color">Active</span>
                        </div>
                        @endif
                        <div class="p-5">
                            @if($baseName != 'servicespareregister' && $baseName != 'visitplan' && $baseName != 'pendingvisit' && $baseName != 'visitplansummary' && $baseName != 'product' && $baseName != 'email')
                            <a href="{{url($basePath)}}/create" target="_self">
                                <button class="btn bgm-lime btn-icon waves-effect waves-circle waves-float" id="addbtn"><i class="zmdi zmdi-plus"></i></button>                                    
                            </a> 
                            @endif
                            @if($baseName == 'product')
                                <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float prdrefresh"><i class="zmdi zmdi-refresh"></i></button>                                   
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="f-400">@if($baseName == 'servicespareregister') Service/Spares Register @else @if($baseName == 'pendingvisit') Pending Visits @else @if($baseName == 'visitplan') Visits Plan @else @if($baseName == 'visitplansummary') Visits Summary @else {{ucfirst($baseName)}} @endif @endif @endif @endif</h2>
                        <p class="c-gray m-t-20 m-b-20">Manage All @if($baseName == 'servicespareregister') Service/Spares Register @else @if($baseName == 'visitplan') Visits Plan @else @if($baseName == 'pendingvisit') Pending Visits @else @if($baseName == 'visitplansummary') Visits Summary @else {{ucfirst($baseName)}} @endif @endif @endif @endif here.</p>
                    </div>
                    <div>
                    @if(isset($errors))
                    @foreach ($errors->toArray() as $kn => $error) {
                    <div>
                        @foreach ($error as $k => $error1)
                        <div class=" pull-left m-5" style="clear:both;">
                            <span class="label label-warning">{{$kn}} : {{$k}} : {{$error1}}</span>
                        </div>
                        @endforeach 
                    </div>
                    @endforeach 
                    @endif
                    </div>
                    <div class="clearfix"></div>
                
                    <div class="row m-t-25">
                        @if($data)
                            @include($baseName . '.' . $baseName .'_list')
                        @endif
                    </div>