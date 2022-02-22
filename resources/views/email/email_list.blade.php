                    <div class="card">
                        <div class="card-header">
                            <h2>Details</h2>
                        </div>
                        <div class="card-body card-padding">
                            <div class="table-responsive">
                                <table id="data-table-command" class="display wrap table table-striped f-10" cellspacing="0" width="100%" >
                                    <thead>
                                        <tr>
                                            <th data-column-id="id" data-type="numeric" data-visible="false">ID</th>
                                            <th data-column-id="isread" data-type="numeric" data-visible="false">IsRead</th>
                                            <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                                            <th data-column-id="emailid">Emailid</th>
                                            <th data-column-id="name" data-type="string" data-visible="false">Name</th>                                    
                                            <th data-column-id="recievedate" data-order="desc"  >Received Dt</th>
                                            <th data-column-id="subject" >Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            @if($item->isread == 0)
                                            <tr class="c-red">
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->isread}}</td>
                                                    <td>
                                                        <div class="pti-footer lnk-wh-inh">
                                                        <a href="{{url($basePath)}}/{{$item->id}}" target="_self" class="btn bgm-lightblue btn-icon waves-effect waves-circle"><i class="zmdi zmdi-view-web"></i>
                                                        </a>                                                
                                                        </div>
                                                    </td>
                                                    <td>{{$item->emailaddress}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->recieved_datetime}}</td>
                                                    <td>{{$item->subject}}</td>
                                                    
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->isread}}</td>
                                                    <td>
                                                        <div class="pti-footer lnk-wh-inh">
                                                        <a href="{{url($basePath)}}/{{$item->id}}" target="_self" class="btn bgm-lightblue btn-icon waves-effect waves-circle"><i class="zmdi zmdi-view-web"></i>
                                                        </a>                                                
                                                        </div>
                                                    </td>
                                                    <td>{{$item->emailaddress}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->recieved_datetime}}</td>
                                                    <td>{{$item->subject}}</td>
                                                    
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                                
                        </div>
                    </div>
                    <div id="modalproduct">
                        <div id="modalproduct1">
                            <div class="modal fade productform" id="productform" role="dialog">
                                <div class="modal-dialog  modal-lg">
                                    <div id="sparesload"  class="col-sm-12 text-center">
                                        <div class="preloader pls-blue ">
                                            <svg class="pl-circular" viewBox="25 25 50 50">
                                                <circle class="plc-path" cx="50" cy="50" r="20" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                    
  
    @section('js')
       @parent
            <script>
                $(document).ready(function(){
                    
                    //Command Buttons
                    var table = $("#data-table-command").DataTable({"sorting":false,"responsive": true,});
                    /*$("#data-table-command").bootgrid({
                        css: {
                            icon: 'zmdi icon',
                            iconColumns: 'zmdi-view-module',
                            iconDown: 'zmdi-expand-more',
                            iconRefresh: 'zmdi-refresh',
                            iconUp: 'zmdi-expand-less'
                        },
                        formatters: {
                            
                            "commands": function(column, row) {
                                
                                    var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                
                                
                                return cmd; 
                                
                            }
                        }
                    });*/
                });
            </script>
        @stop