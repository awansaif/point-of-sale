<div class="table-responsive" >
<table class="table table-bordered nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>PID</th>
                            <th>Product Pic</th>
                            <th>Product Name</th>
                            <th>Product Type</th>
                            <th>Brand</th>
                            <th>In-stock</th>
                            <th>Cost/item</th>
                            <th>Inventory Worth</th>
                            <th>Revenue Generated</th>
                            <th>Vendor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>PID</th>
                            <th>Product Pic</th>
                            <th>Product Name</th>
                            <th>Product Type</th>
                            <th>Brand</th>
                            <th>In-stock</th>
                            <th>Cost/item</th>
                            <th>Inventory Worth</th>
                            <th>Revenue Generated</th>
                            <th>Vendor</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                       @foreach($data  as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ asset($product->product_pic) }}" width="70px" height="70px">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->types->name }}</td>
                            <td>{{ $product->brands->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>Rs.{{ $product->cost_per_item }}</td>
                            <td>Rs.{{ $product->inventory_worth }}</td>
                            <td>Rs. {{ $product->revenue_generated }}</td>
                            <td>{{ $product->vendors->name }}</td>
                            <th>
                                <button class="btn btn-secondary btn-edit" data-id="{{ $product->id }}">Edit</button>
                                <button class="btn btn-danger btn-delete" data-id="{{ $product->id }}">Remove</button>
                            </th>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/datatables-demo.js') }}"></script>