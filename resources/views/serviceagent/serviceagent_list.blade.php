                    <div class="card">
                        <div class="card-header">
                            <h2>{{ucfirst($baseName)}}</h2>
                        </div>
                        
                            <table id="data-table-command" class="table table-striped table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                    <th data-column-id="name" data-type="string">Name</th>                                    
                                    <th data-column-id="mobileno" >Mobile No</th>     
                                    <th data-column-id="email" >Email</th>
                                    <th data-column-id="status1"  >Status</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->company_name}}</td>
                                        <td>{{$item->mobileno}}</td>
                                        <td>{{$item->emailid}}</td>
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
                                
                                if($.trim(row.status1) == "Active")
                                {
                                    var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"/edit\" target=\"_self\" class=\"btn bgm-orange btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-edit\"></i></a>" +    
                                        "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                
                                }
                                else
                                {
                                    var cmd = "<a href=\"{{url($basePath)}}/delete/"+row.id+"\" target=\"_self\" class=\"btn btn-danger btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-close\"></i></a>" +    
                                        "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                
                                }
                                
                                return cmd; 
                                
                            }
                        }
                    });
                });
            </script>
        @stop