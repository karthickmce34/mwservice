                    <div class="card">
                        <div class="card-header">
                            <h2>VisitPlan Summary</h2>
                        </div>
                        
                            <table id="data-table-command" class="table table-striped table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                    <th data-column-id="complaint_id">Complaint No</th>
                                    <th data-column-id="customer_name">Customer Name</th>
                                    <th data-column-id="coplaint_date">Complaint Date</th>
                                    <th data-column-id="isagent">Attend by</th>  
                                    <th data-column-id="agent">Agent/Engineer Name</th>                                    
                                    <th data-column-id="departure_date">Depature Date</th>
                                    <th data-column-id="return_date" >Return Date</th>    
                                    <th data-column-id="visitstatus"  data-visible="false">Expense Status</th>
                                    <th data-column-id="status"  data-visible="false">Status</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>@if(isset($item->visitplan->compreg->id)) {{$item->visitplan->compreg->seqno}} @endif</td>
                                        <td>@if(isset($item->visitplan->compreg->customer_name)) {{$item->visitplan->compreg->customer_name}} @endif</td>
                                        <td>@if(isset($item->visitplan->compreg->complaint_date)) {{$item->visitplan->compreg->complaint_date}} @endif</td>
                                        <td>@if($item->visitplan->agent_id == 1) Agent @else Megawin Engineer @endif</td>
                                        <td>@if(($item->visitplan->agent_id == 1)) 
                                                {{$item->visitplan->agent->company_name}} 
                                            @else 
                                                @foreach($item->visitplan->visitengs as $index =>$visiteng)
                                                    {{$visiteng->engineer->name}},
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{$item->visitplan->date_of_depature}}</td>
                                        <td>{{$item->visitplan->date_of_return}}</td>
                                        <td>@if($item->visitplan->expense_status == 0)
                                                Under Process
                                            @else 
                                                @if($item->visitplan->expense_status == 1)
                                                    Approved By HQ
                                                @else
                                                    Rejected Completed
                                                                                                        
                                            @endif @endif</td>
                                        <td>@if($item->visitplan->status == 0) Inactive @else Active @endif</td>
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