                    <div class="card">
                        <div class="card-header">
                            <h2>{{ucfirst($baseName)}}</h2>
                        </div>
                        
                            <table id="data-table-command" class="table table-striped table-vmiddle" >
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                    <th data-column-id="seqno">Seq No</th>
                                    <th data-column-id="name" data-type="string" >Customer Name</th>                                    
                                    <th data-column-id="mode" data-visible="false">Mode</th>
                                    <!--th data-column-id="type">Type</th-->
                                    <th data-column-id="comp_date">Date</th>
                                    <th data-column-id="mobileno" >Mobile No</th>     
                                    <th data-column-id="email">Email</th>
                                    <th data-column-id="compliant_status" > Status</th>
                                    <th data-column-id="status"  data-visible="false">Status</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->seqno}}</td>
                                        <td>{{$item->customer_name}}</td>
                                        <td>@if($item->mode_of_complaint == 0) Phone @else Email @endif</td>
                                        <!--td>@if($item->complaint_type == 0) Service @else @if($item->complaint_type == 0) Spares @else Service & Spares @endif @endif</td-->
                                        <td>{{$item->complaint_date}}</td>
                                        <td>{{$item->mobileno}}</td>
                                        <td>{{$item->emailid}}</td>
                                        <td>@if($item->document_status == 0) Draft @else @if($item->document_status == 1) In-Progress @else @if($item->document_status == 2) Completed @else Cancelled @endif @endif @endif</td>
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
                        caseSensitive: false,
                        css: {
                            icon: 'zmdi icon',
                            iconColumns: 'zmdi-view-module',
                            iconDown: 'zmdi-expand-more',
                            iconRefresh: 'zmdi-refresh',
                            iconUp: 'zmdi-expand-less'
                        },
                        caseSensitive: false,
                        formatters: {
                            
                            "commands": function(column, row) {
                                
                                    var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"/edit\" target=\"_self\" class=\"btn bgm-orange btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-edit\"></i></a>" +    
                                        "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                
                                
                                return cmd; 
                                
                            }
                        }
                    });
                });
            </script>
        @stop