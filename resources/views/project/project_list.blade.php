                    <div class="card">
                        <div class="card-header">
                            <h2>ProjectPlan</h2>
                        </div>
                        
                            <table id="data-table-command" class="table table-striped table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                    <th data-column-id="engineer_name" >Engineer Name</th>
                                    <th data-column-id="visit_date" >Visit Date</th>
                                    <th data-column-id="approvalstatus"  data-visible="true">Approvalstatus</th>
                                    <th data-column-id="visitstatus"  data-visible="true">Visitstatus</th>
                                    <th data-column-id="status"  data-visible="false">Status</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->engineer->name}}</td>
                                        <td>{{$item->visit_date}}</td>
                                        <td>@if(($item->approval_status == 1)) 
                                                Approved 
                                            @else 
                                                Waiting For Approval
                                            @endif
                                        </td>
                                        <td>@if($item->visit_status == 0) Pending @else Completed  @endif </td>
                                        <td>@if($item->status == 0) Inactive @else Active @endif</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
  
    @section('js')
       @parent
            <script>
                $(document).ready(function(){
                    
                    //Command Buttons
                    $("#data-table-command").bootgrid({
                        css: {
                            icon: 'zmdi icon',
                            iconColumns: 'zmdi-view-module',
                            iconDown: 'zmdi-expand-more',
                            iconRefresh: 'zmdi-refresh',
                            iconUp: 'zmdi-expand-less'
                        },
                        formatters: {
                            
                            "commands": function(column, row) {
                                    if(row.visitstatus != 0)
                                    {
                                        var cmd =  "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                
                                    }
                                    else
                                    {
                                        var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"/edit\" target=\"_self\" class=\"btn bgm-orange btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-edit\"></i></a>" +    
                                        "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                
                                    }     
                                         
                                    
                                
                                return cmd; 
                                
                            }
                        }
                    });
                });
            </script>
        @stop