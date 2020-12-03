<x-app-layout>
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/dashboard">Home</a>
    </li>
    <li class="breadcrumb-item active">Product Brands</li>
  </ol>
  <!-- Page Content -->

  <div id="deleteProductBrandMessage"></div>
  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-table"></i>
      Product Brands
      <a href="#" class="text-white addProductBrandModalBtn" data-toggle="modal" data-target="#addProductBrandModal">
        <span class="float-right">
          <i class="fa fa-plus"></i>
          Add New Brand
        </span>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive" id="ProductBrandContent">
        
      </div>
    </div>
    <div class="card-footer small text-muted"><!-- Updated yesterday at 11:59 PM --></div>
  </div>
  <br><br><br>


  <!-- Edit Product Brand-->
<div class="modal fade" id="editProductBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-industry"></i>
                    Edit Product Brand
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form  class="" id="editProductBrand">
                @csrf
                <div class="modal-body">
                    <div id="editProductBrandMessage"></div>
                    <input type="hidden" name="product_brand_id" id="product-brand-id">
                    <div class="form-group">
                        <label for="">Product Brand</label>
                        <input type="text" class="form-control" name="name" value="" id="product-brand-name" placeholder="Enter brand name here..."
                            required>
                        <small class="text-muted">Example: Nokia, AMB or MSI etc</small>
                    </div>
                    <div class="form-group">
                        <label for="">Description <small class="text-muted">(Optional)</small></label>
                        <textarea name="description" id="product-brand-description" class="form-control" rows="8" cols="80"
                            placeholder="Add some note or description about this vendor..."></textarea>
                    </div>
                    <small class="text-muted"><em>Please double check information before submitting.</em></small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Add Brand">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete product brand -->
<div class="modal" tabindex="-1" role="dialog" id="deleteProductBrandModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteProductBrand">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="product_brand_id" id="product_brand_id_for_deletion">
            <svg width="8em" height="8em" viewBox="0 0 17 16" class=" bi bi-exclamation-triangle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 5zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>
            <p>Are You sure to delete this product brand?</p>
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
      $("#ProductBrandContent").load('show-product-brands');
      
      //edit Product brand
      $(document).on('click', '.btn-edit', function(){
        // alert($(this).attr('data-id'));
        $.ajax({
          url: 'edit-product-brand',
          method: 'get',
          data: {
            'product_brand_id':$(this).attr('data-id'),
          },
          beforeSend:function()
          {
            $("#editProductBrand")[0].reset();
            $("#editProductBrandMessage").html('');
            $("#editProductBrandMessage").removeClass();
          },
          success:function(data)
          {
            if(data)
            {
              $("#product-brand-id").val(data.id);
              $("#product-brand-name").val(data.name);
              $("#product-brand-description").val(data.description);
              $("#editProductBrandModal").modal('show');
            }
          }
        });
      });

      // update product brand
      $("#editProductBrand").on('submit', function(e){
        e.preventDefault();
        // alert($(this).attr('data-id'));
        $.ajax({
          url: 'update-product-brand',
          method: 'post',
          data: new FormData(this),
          processData:false,
          dataType: 'JSON',
          contentType:false,
          cache:false,
          beforeSend:function()
          {
            $("#editProductBrandMessage").html('');
            $("#editProductBrandMessage").removeClass();
          },
          success:function(data)
          {
            if(data.response == 0)
            {
              $.each(data.errors,function(i,v){
                $("#editProductBrandMessage").append('*' + ' '+ v + '<br>');

              });
              $("#editProductBrandMessage").addClass(data.class);
            }
            else
            {
              $("#editProductBrandMessage").append(data.message);
              $("#editProductBrandMessage").addClass(data.class);
              $("#ProductBrandContent").load('show-product-brands');
            }
          }
        });
      });

      $(document).on('click', '.btn-delete', function(){
        $("#deleteProductBrandMessage").html('');
        $("#deleteProductBrandMessage").removeClass();
        $("#product_brand_id_for_deletion").val($(this).attr('data-id'));
        $("#deleteProductBrandModal").modal('show');
      });

      $("#deleteProductBrand").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          url: 'delete-product-brand',
          method: 'post',
          data: new FormData(this),
          processData:false,
          dataType: 'JSON',
          contentType: false,
          cache:false,
          beforeSend:function()
          {
            $("#deleteProductBrandMessage").html('');
            $("#deleteProductBrandMessage").removeClass();
          },
          success:function(data)
          {
            if(data.response == 0)
            {
              $("#deleteProductBrandMessage").append(data.error);
              $("#deleteProductBrandMessage").addClass(data.class);
            }
            else
            {
              $("#deleteProductBrandMessage").append(data.message);
              $("#deleteProductBrandMessage").addClass(data.class);
              $("#ProductBrandContent").load('show-product-brands');
              $("#deleteProductBrand")[0].reset();
              $("#deleteProductBrandModal").modal('hide');
            }
          }

        });
      });

    });
  </script>
</x-app-layout>