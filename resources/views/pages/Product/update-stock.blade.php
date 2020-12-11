<x-app-layout>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/dashboard">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="/products">Product</a>
        </li>
        <li class="breadcrumb-item active">Update Product Stock</li>
    </ol>
    <!-- Page Content -->
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fa fa-table"></i>
            Update Stock
            <button class="btn btn-success btn-add-field float-right" data-id="0">Add New fields</button>
        </div>
        <form id="update-product-stock">
            @csrf
            <div class="card-body">
                <div id="addProductStockMessage"></div>
                <h4 id="product-no"></h4>
                <div id="form-group">
                    <div class="from-group row ">
                        <div class="col-sm-3">
                            <label>Product:</label>
                            <select class="form-control" name="product[]" style="width: 100%;">
                                @foreach($data as $key => $product)
                                <option value="" disabled selected hidden>Choose a Product ... </option>
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Stock:</label>
                            <input type="number" class="form-control" name="stock[]">
                        </div>
                        <div class="col-sm-3">
                            <label>Cost/item:</label>
                            <input type="number" class="form-control" name="cost_per_item[]">
                        </div>
                        <div class="col-sm-3">
                            <label>Sale Price:</label>
                            <input type="number" class="form-control" name="sale_price[]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-lg">Save</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select').select2();
        });
        $(document).ready(function(){
            $(".btn-add-field").on('click', function(){
                if($(this).attr('data-id') <= 9)
                {
                    
                    var data = $("#form-group").html();
                    $(".card-body").append(data);
                    var id = $(this).attr('data-id');
                    var new_id =  parseFloat(id) + 1;
                    $("#product-no").html('Product #' + new_id+'/10');
                    $(this).removeAttr('data-id');
                    $(this).attr('data-id', new_id);
                    
                }
                
            });
            $("#update-product-stock").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: 'update-product-stock',
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function()
                    {
                        $("#addProductStockMessage").html('');
                        $("#addProductStockMessage").removeClass();
                    },
                    success:function(data)
                    {
                        if(data.response == 0)
                        {
                            $.each(data.errors, function(i,v){
                                $("#addProductStockMessage").append('*' + ' ' + v + '<br>');
                            });
                            $("#addProductStockMessage").addClass(data.class);
                        }
                        else{
                            $("#addProductStockMessage").append(data.message);
                            $("#addProductStockMessage").addClass(data.class);
                            $("#save-product")[0].reset();
                        }
                        
                    }
                });
            });
        });
    </script>
</x-app-layout>