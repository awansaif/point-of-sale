<table class="table table-bordered nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>PTID</th>
                            <th>Product Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>PTID</th>
                            <th>Product Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($product_types as $key => $product_type)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product_type->name }}</td>
                            <td class="text-truncate">{{  $product_type->description }}</td>
                            <td>
                                <button class="btn btn-primary btn-product-type-edit" data-id="{{ $product_type->id }}">Edit</button>
                                <button class="btn btn-danger btn-product-type-remove" data-id="{{  $product_type->id }}">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>