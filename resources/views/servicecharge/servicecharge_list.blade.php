                    <div class="card">
                        <div class="card-header">
                            <h2>Service Charge Details</h2>
                        </div>
                        
                            <table id="data-table-command" class="table table-striped table-vmiddle"  style = "table-layout: auto;">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric" data-visible="false">ID</th>
                                    <th data-column-id="code">Code</th>
                                    <th data-column-id="name" data-order="asc"  data-type="string">Service Name</th>                                    
                                    <th data-column-id="uom">UOM</th>
                                    <th data-column-id="hsn">HSN</th>
                                    <th data-column-id="price" >Amount</th>    
                                    <th data-column-id="status1" data-visible="false" >Status</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->uom}}</td>
                                        <td>{{$item->hsn}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>@if($item->status == 0) Inactive @else Active @endif</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
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
                                    var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"/edit\" target=\"_self\" class=\"btn bgm-orange btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-edit\"></i></a>";   
                                
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