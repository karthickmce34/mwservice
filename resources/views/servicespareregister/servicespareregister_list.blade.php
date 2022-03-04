                    <div class="card">
                        <div class="card-header">
                            <h2>Spares/Service Call Register</h2>
                        </div>
                        
                            <table id="data-table-command" class="table table-striped table-vmiddle"  >
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-order="desc" data-type="numeric" data-visible="false">ID</th>
                                    <th data-column-id="comp_id">Request No</th>
                                    <th data-column-id="name" data-type="string">Customer Name</th>                                    
                                    <th data-column-id="type" data-visible="false">Request Type</th>
                                    <th data-column-id="compdate" >Request Date</th>     
                                    <th data-column-id="mobileno" >Mobile No</th>     
                                    <th data-column-id="email" data-visible="false">Email</th>
                                    <th data-column-id="compliant_status"  data-visible="false">Doc Status</th>
                                    <th data-column-id="request_status">Req Status</th>
                                    <th data-column-id="status"  data-visible="false">Status</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->compreg->seqno}}</td>
                                        <td>{{$item->compreg->customer_name}}</td>
                                        <td>@if($item->complaint_type == 0) Service @else @if($item->complaint_type == 1) Spares @else Service & Spares @endif @endif</td>
                                        <td>{{$item->compreg->complaint_date}}</td>
                                        <td>{{$item->compreg->mobileno}}</td> 
                                        <td>{{$item->compreg->emailid}}</td>
                                        <td>@if($item->compreg->document_status == 0) Draft @else @if($item->compreg->document_status == 1) In-Progress @else @if($item->compreg->document_status == 2) Completed @else Cancelled @endif @endif @endif</td>
                                        <td>@if($item->order_status == 0) Enquiry Received @else @if($item->order_status == 1) Offer Sent @else @if($item->order_status == 2) PO Received  @else @if($item->order_status == 3) PI Sent @else @if($item->order_status == 4) Advance Received @else @if($item->order_status == 5) Payment Received @else @if($item->order_status == 6) DI Sent @else @if($item->order_status == 7) Partially Dispatched @else @if($item->order_status == 8) @if($item->complaint_type == 0) Completed @else Dispatched @endif @else @if($item->order_status == 10) Deputed @else Cancelled @endif @endif @endif @endif @endif @endif @endif @endif @endif @endif</td>
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
                        caseSensitive: false,
                        formatters: {
                            
                            "commands": function(column, row) {
                                
                                console.log(row.request_status);
                                if(row.request_status.trim() != "Completed")
                                {
                                    var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"/edit\" target=\"_self\" class=\"btn bgm-orange btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-edit\"></i></a>" +    
                                        "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                        
                                     
                                }
                                else
                                {
                                    var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                     
                                }
                                return cmd;
                                
                            }
                        }
                    });
                });
            </script>
        @stop