                    <div class="card">
                        <div class="card-header">
                            <h2>{{ucfirst($baseName)}}</h2>
                        </div>
                        <div class="col-sm-offset-6 col-sm-4">
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" class="tkfilter" name="inlineRadioOptions" value="Pending" checked>
                                <i class="input-helper"></i>  
                                Pending
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" class="tkfilter" name="inlineRadioOptions" value="Inprogress">
                                <i class="input-helper"></i>  
                                Inprogress
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" class="tkfilter" name="inlineRadioOptions" value="Completed">
                                <i class="input-helper"></i>  
                                Job Completed
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" class="tkfilter" name="inlineRadioOptions" value="Closed">
                                <i class="input-helper"></i>  
                                Closed
                            </label>
                        </div>
                        <div class="p-5 card-body" style="margin-top:40px;">
                            <table id="data-table-command" class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th data-column-id="id" data-order="desc" data-visible="false" data-type="numeric" >Id</th>                                    
                                        <th data-column-id="doc_no" data-type="string">Ticket No</th>                                    
                                        <th data-column-id="name" data-type="string">Name</th>                                    
                                        <th data-column-id="mobileno" >Mobile No</th>     
                                        <th data-column-id="emailaddress" >Email</th>
                                        <th data-column-id="status" > Status</th>
                                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->doc_no}}</td>
                                            <td>{{$item->customer_name}}</td>
                                            <td>{{$item->mobileno}}</td>
                                            <td>{{$item->email_address}}</td>
                                            <td>@if($item->ticket_status ==0) Pending @else @if($item->ticket_status == 1) Inprogress @else @if($item->ticket_status == 2) Job Completed @else Closed @endif @endif @endif</td>
                                            <td><a href="{{url($basePath)}}/{{$item->id}}" target="_self" class="btn bgm-lightblue btn-icon waves-effect waves-circle"><i class="zmdi zmdi-view-web"></i></a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
  
    @section('js')
       @parent
            <script>
                $(document).ready(function(){
                    
                    //Command Buttons
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
                                
                                if($.trim(row.status1) == "Active")
                                {
                                    var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                
                                }
                                else
                                {
                                    var cmd = "<a href=\"{{url($basePath)}}/"+row.id+"\" target=\"_self\" class=\"btn bgm-lightblue btn-icon waves-effect waves-circle\"><i class=\"zmdi zmdi-view-web\"></i></a>";   
                                
                                }
                                
                                return cmd; 
                                
                            }
                        }
                    });*/
                    
                    var table = $('#data-table-command').DataTable({pagingType: 'numbers',autoWidth:true});
 
                    $("#data-table-command tfoot th").each( function ( i ) {
                        if(i ==5)
                        {
                            var select = $('.tkfilter').on( 'change', function () {
                                    var val = $(this).val();
                                    //alert(val);
                                    table.column( i )
                                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                                        .draw();
                                } );

                            
                            
                            table.column( i )
                                        .search( 'Pending' ? '^'+'Pending'+'$' : 'Pending', true, false )
                                        .draw();
                        }
                            
                            
                    } );
                    
                    table.columns.adjust().draw();
                });
                
                

            </script>
        @stop