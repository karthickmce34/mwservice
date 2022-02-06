<!--BEGIN INPUT TEXT FIELDS-->
                    <div class="text-center">
                        <h2 class="f-400">{{ucfirst($moduleName)}}</h2>                        
                    </div>
                    <br>
                    <div class="card {{($moduleName)}}" >
                        <div class="card-header">
                            <h2>
                            @if($modeName == "Add")                
                                Add <span class="label label-default">New</span> 
                            @else                    
                                <span class="label label-default">Edit</span>
                            @endif
                            {{ucfirst($moduleName)}}
                            </h2>
                        </div>
                        <div class="card-body card-padding">
                            
                            @include('_common.errors')
                            
                            <div class="row">
                                {!! form($form) !!}
                            </div>
                        </div>
                    </div>
                    

