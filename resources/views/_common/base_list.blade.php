                    <div class="text-center pull-right">
                        <div class="color-block bgm-amber p-5">
                            <span class="color">In Active</span>
                        </div>
                        <div class="color-block bgm-lightgreen p-5">
                            <span class="color">Active</span>
                        </div>
                        <div class="p-5">
                            
                            @if($baseName != 'servicespareregister' || $baseName != 'visitplan' || $baseName != 'pendingvisit' || $baseName != 'product' || $baseName != 'email')
                            <a href="{{url($baseName)}}/create" target="_self">
                                <button class="btn bgm-lime btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></button>                                   
                            </a>
                            @endif
                            @if($baseName == 'product')
                                <button class="btn bgm-orange btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-refresh"></i></button>                                   
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="f-400 txt-ellipsis" title="{{ucfirst(addslashes($baseName))}}">@if($baseName == 'complaintregister') Spares/Service Call Register @else @if($baseName == 'visitplan') Visits Plan @else @if($baseName == 'pendingvisit') Pending Visits @else {{ucfirst($baseName)}} @endif @endif @endif</h2>
                        <p class="c-gray m-t-20 m-b-20">Manage All @if($baseName == 'complaintregister') Spares/Service Call Register @else @if($baseName == 'visitplan') Visits Plan @else @if($baseName == 'pendingvisit') Pending Visits @else {{ucfirst($baseName)}} @endif @endif @endif here.</p>
                       
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
                        <?php $cnt = 0;?>
                        @foreach ($data as $item)
                    
                        <div class="col-sm-4 " {{(($cnt%3==0)?'style=clear:both;':'')}} >
                            <div class="card pt-inner">
                                <div class="pti-header @if($item->status==1) bgm-lightgreen @else bgm-amber @endif">
                                   
                                    @include($basePath . '.' . $baseName .'_list')
                                    
                                <div class="pti-footer lnk-wh-inh">

                                    @if($baseName == 'organisation')
                                        <a href="{{url($baseName)}}/edit/{{$item->id}}" target="_self" class="bgm-orange"><i class="zmdi zmdi-edit"></i></a>
                                        <a href="{{url($baseName)}}/show/{{$item->id}}" target="_self" class="bgm-lightblue"><i class="zmdi zmdi-view-web"></i></a>
                                    @elseif($baseName == 'uom')
                                        <a href="{{url($baseName)}}/edit/{{$item->id}}" target="_self" class="bgm-orange"><i class="zmdi zmdi-edit"></i></a>
                                        <a href="{{url($baseName)}}/delete/{{$item->id}}" target="_self" class="bgm-red"><i class="zmdi zmdi-close"></i></a>
                                    @else
                                        <a href="{{url($baseName)}}/edit/{{$item->id}}" target="_self" class="bgm-orange"><i class="zmdi zmdi-edit"></i></a>
                                        <a href="{{url($baseName)}}/delete/{{$item->id}}" target="_self" class="bgm-red"><i class="zmdi zmdi-close"></i></a>
                                        <a href="{{url($baseName)}}/show/{{$item->id}}" target="_self" class="bgm-lightblue"><i class="zmdi zmdi-view-web"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <?php $cnt++;?>
                        @endforeach
                        @endif
                    </div>