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
            <div class="card-body">
                <h4 id="product-no"></h4>
                <div id="form-group">
                    <div class="from-group row ">
                        <div class="col-sm-4">
                            <label>Product</label>
                            <select class="form-control select2" name="product[]" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option disabled="disabled">California (disabled)</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                          </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Stock</label>
                            <input type="number" class="form-control" name="stock[]">
                        </div>
                        <div class="col-sm-4">
                            <label>Cost/item</label>
                            <input type="number" class="form-control" name="cost_per_item[]">
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
        $(document).ready(function(){
            $(".btn-add-field").on('click', function(){
                if($(this).attr('data-id') <= 9)
                {
                    var data = $("#form-group").html();
                    // var data = "<div class='form-group row'>";
                    // data += "<div class='col-4'>";
                    // data += "<label>"
                    // data += "</div>";
                    // data += "<div class='col-4'>";
                    // data += "</div>";
                    // data += "<div class='col-4'>";
                    // data += "</div>";
                    // data += "</div>";
                    $(".card-body").append(data);
                    var id = $(this).attr('data-id');
                    var new_id =  parseFloat(id) + 1;
                    $("#product-no").html('Product #' + new_id+'/10');
                    $(this).removeAttr('data-id');
                    $(this).attr('data-id', new_id); 
                }
                
            });

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