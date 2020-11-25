<x-app-layout>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Product Types</li>
    </ol>
    <!-- Page Content -->
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fa fa-table"></i>
            Product Types
            <a href="#" class="text-white addProductTypeModalbtn" data-toggle="modal" data-target="#addProductTypeModal">
                <span class="float-right">
                    <i class="fa fa-plus"></i>
                    Add New Product Type
                </span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                        @foreach($data['product_types'] as $key => $product_type)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product_type->name }}</td>
                            <td class="text-truncate">{{  $product_type->description }}</td>
                            <td>
                                <button class="btn btn-primary btn-product-type-edit" data-id="{{ $product_type->id }}">Edit</button>
                                <button class="btn btn-danger" data-id="{{  $product_type->id }}">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated at {{ $data['last_update_time'] }} </div>
    </div>

    <!-- Add edit Product Type-->
<div class="modal fade" id="editProductTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-tags"></i>
                    Edit Product Type
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" id="editProductType" >
                @csrf
                <div id="editProductTypeMessage"></div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Product Type</label>
                        <input type="hidden" name="product_type_id" id="product_type_id">
                        <input type="text" class="form-control" name="name" value="" id="product_type_name" placeholder="Enter product type..."
                            >
                        <small class="text-muted">Example: Mousepads, Headphones or Keyboards etc</small>
                    </div>
                    <div class="form-group">
                        <label for="">Description <small class="text-muted">(Optional)</small></label>
                        <textarea name="description" class="form-control" id="product_type_description" rows="8" cols="80"
                            placeholder="Add some note or description about this product type..."></textarea>
                    </div>
                    <small class="text-muted"><em>Please double check information before submitting.</em></small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Edit Product Type">
                </div>
            </form>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".btn-product-type-edit").on('click', function(){
                $.ajax({
                    url: '/edit-product-type',
                    method: 'get',
                    data: {
                        'product_id': $(this).attr('data-id'),
                    },
                    beforeSend:function()
                    {
                        $("#editProductType")[0].reset();
                    },
                    success:function(data)
                    {
                        if(data)
                        {
                            $("#product_type_id").val(data.id);
                            $("#product_type_name").val(data.name);
                            $("#product_type_description").val(data.description);
                            $("#editProductTypeModal").modal('show');
                        }
                       
                    }
                });
                
            });
            $("#editProductType").on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url: 'update_product_type',
                    method: 'post',
                    data: new FormData(this),
                    processData:false,
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $("#editProductTypeMessage").html('');
                        $("#editProductTypeMessage").removeClass();
                    },
                    success:function(data)
                    {
                        if(data.response == 0)
                        {
                            $.each(data.errors, function(i,v){
                                $("#editProductTypeMessage").append('*'+' ' + v + '<br>');
                            });
                            $("#editProductTypeMessage").addClass(data.class);
                        }
                        else
                        {
                            $("#editProductTypeMessage").append(data.message);
                            $("#editProductTypeMessage").addClass(data.class);
                        }
                    }
                });
            });
        });
    </script>

</x-app-layout>
