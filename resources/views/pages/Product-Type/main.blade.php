<x-app-layout>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Product Types</li>
    </ol>
    <!-- Page Content -->
    <div id="deleteProductTypeMessage"></div>
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
            <div class="table-responsive" id="content">
                
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

<div class="modal" id="deleteProductTypeModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Warning</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="deleteProductType">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="product_type_id" id="product_type_id_for_deletion">
                <svg width="8em" height="8em" viewBox="0 0 17 16" class=" bi bi-exclamation-triangle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 5zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                <p>Are You sure to delete this product type?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Remove</button>
            </div>
        </form>
    </div>
  </div>
</div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#content").load('/show-product-types');
            $(document).on('click', '.btn-product-type-edit' ,function(){
                $.ajax({
                    url: '/edit-product-type',
                    method: 'get',
                    data: {
                        'product_id': $(this).attr('data-id'),
                    },
                    beforeSend:function()
                    {
                        $("#editProductTypeMessage").html('');
                        $("#editProductTypeMessage").removeClass();
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
                            $("#content").load('/show-product-types');
                        }
                    }
                });
            });

            $(document).on('click', '.btn-product-type-remove', function(){
                $("#product_type_id_for_deletion").val($(this).attr('data-id'));
                $("#deleteProductTypeModal").modal('show');
            });

            $("#deleteProductType").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: 'delete-product-type',
                    method: 'get',
                    data: {
                        'product_type_id':$("#product_type_id_for_deletion").val(),
                    },
                    beforeSend:function()
                    {
                        $("#deleteProductTypeMessage").html('');
                        $("#deleteProductTypeMessage").removeClass();
                    },
                    success:function(data)
                    {
                        if(data.response == 1)
                        {
                            $("#deleteProductTypeMessage").append(data.message);
                            $("#deleteProductTypeMessage").addClass(data.class);
                            $("#deleteProductType")[0].reset();
                            $("#deleteProductTypeModal").modal('hide');
                            $("#content").load('/show-product-types');
                        }
                    }
                });
            });
        });
    </script>

</x-app-layout>
