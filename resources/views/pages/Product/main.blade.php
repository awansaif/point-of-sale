<x-app-layout>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard">Home</a>
        </li>
        <li class="breadcrumb-item active">Products</li>
    </ol>


    <div id="deleteProductMessage"></div>
    <!-- Page Content -->
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fa fa-table"></i>
            Products
            <a href="/add-product" class="text-white mr-3 ml-3" >
                <span class="float-right">
                    <i class="fa fa-plus"></i>
                    Add New Product
                </span>
            </a>
            <a href="/update-product-stock" class="text-white" >
                <span class="float-right ml-3 mr-3">
                    <i class="fa fa-plus"></i>
                    Update New Stock
                </span>
            </a>
        </div>
        <div class="card-body" id="productContent">
            <div class="text-center" id="spinner">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
            </div>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>



<!-- edit Modal -->
<div class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="update-product">
          <div class="modal-body">
            <div id="updateProductMessage"></div>
            <div class="row w-100">
                <div class="col-4 border p-1">
                    <input type="hidden" name="product_id" id="edit-product-id">
                    <div class="img-thumbnail">
                        @csrf
                        <img id="edit-product-pic" class="img-fluid card-img" src="https://image.shutterstock.com/image-illustration/set-colorful-empty-shopping-bags-260nw-691305127.jpg">
                    </div>
                    <label>Product Image:</label>
                    <input type="file" name="product_pic" id="product-pic" class="form-control-file">
                    <br>
                    <small>Product Image is optional.</small>
                </div>
                <div class="col-8"> 
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Product Name:</label>
                            <input type="text" name="name" id="edit-name" class="form-control" placeholder="Product name">
                            <small class="text-muted">Product name must be unique and required.</small>
                        </div>

                        <div class="col-sm-6">
                            <label>Product Type:</label>

                            <select name="type" id="type" class="form-control custom-select">
                                <option class="selected disabled" >Choose product type..</option>
                                @foreach($data['types'] as $type)
                                    <option id="edit-type{{ $type->id }}" value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Product type must be required.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Product Brand:</label>
                            <select name="brand" id="brand" class="form-control custom-select">
                                <option class="selected disabled" >Choose product brand..</option>
                                @foreach($data['brands'] as $brand)
                                    <option id="edit-brand{{$brand->id}}" value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Product brand must be required.</small>
                        </div>

                        <div class="col-sm-6">
                            <label>Product Stock:</label>
                            <input type="number" name="stock" id="edit-stock" class="form-control" placeholder="Product stock">
                            <small class="text-muted">Product stock must be required.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Cost/Item:</label>
                            <input type="number" name="cost_per_item" id="edit-cost-per-item" class="form-control" placeholder="Product cost per item">
                            <small class="text-muted">Product cost/item must be required.</small>
                        </div>

                        <div class="col-sm-6">
                            <label>Product Inventory Worth:</label>
                            <input type="number" name="inventory_worth" id="edit-inventory-worth" class="form-control" placeholder="Product inventory worth">
                            <small class="text-muted">Product inventory must be required.</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Vendor:</label>
                            <select name="vendor" id="vendor"  class="form-control custom-select">
                                <option class="selected disabled" >Choose product vendor..</option>
                                @foreach($data['vendors'] as $vendor)
                                    <option id="edit-vendor{{ $vendor->id }}" value="{{ $vendor->id }}">{{ $vendor->name }} -- {{ $vendor->contact }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Product vendor is optional.</small>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- delete product -->
<div class="modal" tabindex="-1" role="dialog" id="delete-Product-Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="delete-Product">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="product_id" id="product_id_for_deletion">
            <svg width="8em" height="8em" viewBox="0 0 17 16" class=" bi bi-exclamation-triangle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 5zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>
            <p>Are You sure to delete this product?</p>
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
            function loadtContent()
            {
                $.ajax({
                url: 'show-products',
                method: 'get',
                beforeSend:function()
                {
                  
                },
                success:function(data)
                {
                  $("#spinner").addClass('d-none');
                  $("#productContent").html('');
                  $("#productContent").append(data);
                }
              });
            }
            loadtContent();
            $("#product-pic").on('change',function(e){
                $("#edit-product-pic").attr('src', URL.createObjectURL(e.target.files[0]));
            });
            $("#edit-inventory-worth").on('click',function(){
                if($("#edit-stock").val() == '')
                {
                    alert("Please provide product stock first.");
                }
                else if($("#edit-cost-per-item").val() == '')
                {
                   alert("Please provide product cost per item first."); 
                }
                else
                {
                    $(this).val($("#edit-stock").val() * $("#edit-cost-per-item").val());
                }
            });
            $(document).on('click', '.btn-edit',function(){
                $.ajax({
                    url: 'edit-product',
                    method: 'get',
                    data: {
                        'product_id': $(this).attr('data-id')
                    },
                    beforeSend:function()
                    {
                        $("#updateProductMessage").html('');
                        $("#updateProductMessage").removeClass();
                        $("#update-product")[0].reset();
                    },
                    success:function(data)
                    {
                        if(data)
                        {
                            $("#edit-product-id").val(data.id);
                            $("#edit-product-pic").attr('src', data.product_pic);
                            $("#edit-name").val(data.name);
                            $("#edit-type"+data.type).attr('selected', 'selected');
                            $("#edit-brand"+data.brand).attr('selected','selected');
                            $("#edit-stock").val(data.stock);
                            $("#edit-cost-per-item").val(data.cost_per_item);
                            $("#edit-inventory-worth").val(data.inventory_worth);
                            $("#edit-vendor"+data.vendor).attr('selected','selected');
                            $("#edit-product-modal").modal('show');
                        }
                    }
                });
            });

            $("#update-product").on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : 'update-product',
                    method: 'POST',
                    data: new FormData(this),
                    processData:false,
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $("#updateProductMessage").html(' ');
                        $("#updateProductMessage").removeClass();
                    },
                    success:function(data)
                    {
                        if(data.response == 0)
                        {
                            $.each(data.errors,function(i,v){
                                $("#updateProductMessage").append('*'+' ' + v + '<br>');
                            });
                            $("#updateProductMessage").addClass(data.class);
                        }
                        else{
                            loadtContent();
                            $("#updateProductMessage").append(data.message);
                            $("#updateProductMessage").addClass(data.class);
                        }
                    }
                });
            });

            $(document).on('click', '.btn-delete', function(){
               $("#product_id_for_deletion").val($(this).attr('data-id'));
               $("#deleteProductMessage").html('');
               $("#deleteProductMessage").removeClass();
               $("#delete-Product-Modal").modal('show');
            });

            $("#delete-Product").on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : 'delete-product',
                    method: 'POST',
                    data: new FormData(this),
                    processData:false,
                    dataType:'JSON',
                    contentType:false,
                    cache:false,
                    beforeSend:function(){
                      $("#deleteProductMessage").html('');
                      $("#deleteProductMessage").removeClass();  
                    },
                    success:function(data)
                    {
                        if(data.response == 1)
                        {
                            $("#deleteProductMessage").append(data.message);
                            $("#deleteProductMessage").addClass(data.class);
                            loadtContent();
                            $("#delete-Product-Modal").modal('hide');
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>
