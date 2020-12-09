<x-app-layout>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/dashboard">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="/products">Product</a>
        </li>
        <li class="breadcrumb-item active">Add Product</li>
    </ol>
    <!-- Page Content -->
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fa fa-table"></i>
            Add Products
        </div>

        <form id="save-product">
            <div class="card-body">
                <div id="addProductMessage"></div>
                <div class="row w-100">
                    <div class="col-4 border p-1">
                        <div class="img-thumbnail">
                            @csrf
                            <img id="show-product-pic" class="img-fluid card-img" src="https://image.shutterstock.com/image-illustration/set-colorful-empty-shopping-bags-260nw-691305127.jpg">
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
                                <input type="text" name="name" id="name" class="form-control" placeholder="Product name">
                                <small class="text-muted">Product name must be unique and required.</small>
                            </div>

                            <div class="col-sm-6">
                                <label>Product Type:</label>

                                <select name="type" id="type" class="form-control custom-select">
                                    <option class="selected disabled" >Choose product type..</option>
                                    @foreach($data['types'] as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
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
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Product brand must be required.</small>
                            </div>

                            <div class="col-sm-6">
                                <label>Product Stock:</label>
                                <input type="number" name="stock" id="stock" class="form-control" placeholder="Product stock">
                                <small class="text-muted">Product stock must be required.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Cost/Item:</label>
                                <input type="number" name="cost_per_item" id="cost_per_item" class="form-control" placeholder="Product cost per item">
                                <small class="text-muted">Product cost/item must be required.</small>
                            </div>

                            <div class="col-sm-6">
                                <label>Product Inventory Worth:</label>
                                <input type="number" name="inventory_worth" id="inventory_worth" class="form-control" placeholder="Product inventory worth">
                                <small class="text-muted">Product inventory must be required.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Vendor:</label>
                                <select name="vendor" id="vendor"  class="form-control custom-select">
                                    <option class="selected disabled" >Choose product vendor..</option>
                                    @foreach($data['vendors'] as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }} -- {{ $vendor->contact }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Product vendor is optional.</small>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="ml-auto">
                    <button class="btn btn-success ml-auto">Save</button>
                </div>
                
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#product-pic").on('change',function(e){
                $("#show-product-pic").attr('src', URL.createObjectURL(e.target.files[0]));
            });
            $("#inventory_worth").on('click',function(){
                if($("#stock").val() == '')
                {
                    alert("Please provide product stock first.");
                }
                else if($("#cost_per_item").val() == '')
                {
                   alert("Please provide product cost per item first."); 
                }
                else
                {
                    $(this).val($("#stock").val() * $("#cost_per_item").val());
                }
            });
            $("#save-product").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: 'save-product',
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function()
                    {
                        $("#addProductMessage").html('');
                        $("#addProductMessage").removeClass();
                    },
                    success:function(data)
                    {
                        if(data.response == 0)
                        {
                            $.each(data.errors, function(i,v){
                                $("#addProductMessage").append('*' + ' ' + v + '<br>');
                            });
                            $("#addProductMessage").addClass(data.class);
                        }
                        else{
                            $("#addProductMessage").append(data.message);
                            $("#addProductMessage").addClass(data.class);
                            $("#save-product")[0].reset();
                        }
                        
                    }
                });
            });
        });
    </script>
</x-app-layout>