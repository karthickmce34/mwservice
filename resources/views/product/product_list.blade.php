                    <div class="card">
                        <div class="card-header">
                            <h2>Product Details</h2>
                        </div>
                        
                            <table id="data-table-command" class="table table-striped table-vmiddle"  style = "table-layout: auto;">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric" data-visible="false">ID</th>
                                    <th data-column-id="code">Code</th>
                                    <th data-column-id="name" data-order="asc"  data-type="string">Product Name</th>                                    
                                    <th data-column-id="uom">UOM</th>
                                    <th data-column-id="price" >price</th>     

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->uom}}</td>
                                        <td>{{$item->price}}</td>
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
            </script>
        @stop