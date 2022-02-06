                    <div class="card">
                        <div class="card-header">
                            <h2>VisitPlan</h2>
                        </div>
                        
                            <table id="data-table-command" class="table table-striped table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                    <th data-column-id="complaint_id">Complaint No</th>
                                    <th data-column-id="customer_name" >Customer Name</th>
                                    <th data-column-id="coplaint_date">Complaint Date</th>
                                    <th data-column-id="isagent" data-visible="false">Attend by</th>  
                                    <th data-column-id="agent" data-visible="false">Agent/Engineer Name</th>                                    
                                    <th data-column-id="departure_date">Depature Date</th>
                                    <th data-column-id="return_date" >Return Date</th>    
                                    <th data-column-id="visitstatus"  data-visible="false">Visitstatus</th>
                                    <th data-column-id="status"  data-visible="false">Status</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>@if(isset($item->compreg->seqno)) {{$item->compreg->seqno}} @endif</td>
                                        <td>@if(isset($item->compreg->customer_name)) {{$item->compreg->customer_name}} @endif</td>
                                        <td>@if(isset($item->compreg->complaint_date)) {{$item->compreg->complaint_date}} @endif</td>
                                        <td>@if($item->agent_id == 1) Agent @else Megawin Engineer @endif</td>
                                        <td>@if(($item->agent_id == 1)) 
                                                {{$item->agent->company_name}} 
                                            @else 
                                                @foreach($item->visitengs as $index =>$visiteng)
                                                    {{$visiteng->engineer->name}},
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{$item->date_of_depature}}</td>
                                        <td>{{$item->date_of_return}}</td>
                                        <td>@if($item->visit_status == 0) Draft @else @if($item->visit_status == 1) Pending @else @if($item->visit_status == 2) Completed @else @if($item->visit_status == 3) Partially Completed @else Cancelled @endif @endif @endif @endif</td>
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