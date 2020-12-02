<x-app-layout>
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/dashboard">Home</a>
    </li>
    <li class="breadcrumb-item active">Product Vendors</li>
  </ol>
  <!-- Page Content -->
  <!-- DataTables Example -->
  <div id="deleteProductVendorMessage">
  </div>
  <div class="card mb-3">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-table"></i>
      Product Vendors
      <a href="#" class="text-white addProductVendorModal" data-toggle="modal" data-target="#addProductVendorModal">
        <span class="float-right">
          <i class="fa fa-plus"></i>
          Add New Vendor
        </span>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive" id="ProductVendorContent">
          <div class="text-center" id="spinner">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
      </div>
    </div>
    <div class="card-footer small text-muted"><!-- Updated yesterday at 11:59 PM --></div>
  </div>
  <br><br><br>


<!-- edit product vendor -->
<div class="modal fade" id="editProductVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-user"></i>
                    Edit Products Vendor
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" id="editProductVendor">

                <div class="modal-body">
                    <div id="editProductVendorMessage"></div>
                    @csrf
                    <input type="hidden" name="product_vendor_id" id="product-vendor-id">
                    <div class="form-group">
                        <label for="">Vendor Name</label>
                        <input type="text" class="form-control" name="name" id="product-vendor-name" value=""
                            placeholder="Enter vendor's name here..." required>
                        <small class="text-muted">Example: Anees Ahmad, Faisal Hayat or Shahzaib Khan etc</small>
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" name="contact" id="product-vendor-contact" value=""
                            placeholder="Enter vendor's phone number here...">
                        <small class="text-muted">Example: 555-665-123</small>
                    </div>
                    <div class="form-group">
                        <label for="">Email Address <small class="text-muted">(Optional)</small></label>
                        <input type="email" class="form-control" id="product-vendor-email" name="email" value=""
                            placeholder="Enter vendor's email here...">
                        <small class="text-muted">Example: ahmadanees02@gmail.com</small>
                    </div>
                    <div class="form-group">
                        <label for="">Address <small class="text-muted">(Optional)</small></label>
                        <textarea name="address" class="form-control" id="product-vendor-address" rows="8" cols="80"
                            placeholder="Add address of this vendor..."></textarea>
                    </div>
                    <small class="text-muted"><em>Please double check information before submitting.</em></small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Add Vendor">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete product brand -->
<div class="modal" tabindex="-1" role="dialog" id="deleteProductVendorModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteProductVendor">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="product_vendor_id" id="product_vendor_id_for_deletion">
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
      function loadtContent()
      {
        $.ajax({
        url: 'show-product-vendors',
        method: 'get',
        beforeSend:function()
        {
          
        },
        success:function(data)
        {
          $("#spinner").addClass('d-none');
          $("#ProductVendorContent").html('');
          $("#ProductVendorContent").append(data);
        }
      });
      }
      loadtContent();
      $(document).on('click', '.btn-edit', function(){
        $.ajax({
          url: 'edit-product-vendor',
          method: 'get',
          data: {
            'product_vendor_id': $(this).attr('data-id'),
          },
          beforeSend:function()
          {
            $("#editProductVendorMessage").html('');
            $("#editProductVendorMessage").removeClass();
            $("#editProductVendor")[0].reset();
          },
          success:function(data)
          {
            if(data)
            {
              $("#product-vendor-id").val(data.id);
              $("#product-vendor-name").val(data.name);
              $("#product-vendor-contact").val(data.contact);
              $("#product-vendor-email").val(data.email);
              $("#product-vendor-address").val(data.address);
              $("#editProductVendorModal").modal('show');
            }
          }
        });
      });

      $("#editProductVendor").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          url: 'update-product-vendor',
          method: 'post',
          data: new FormData(this),
          processData:false,
          dataType:'JSON',
          contentType:false,
          cache:false,
          beforeSend:function()
          {
            $("#editProductVendorMessage").html('');
            $("#editProductVendorMessage").removeClass();
          },
          success:function(data)
          {
            if(data.response  == 0)
            {
              $.each(data.errors, function(i,v){
                $("#editProductVendorMessage").append('*'+ ' '+ v + '<br>');
              });
              $("#editProductVendorMessage").addClass(data.class);
            }
            else{
              $("#editProductVendorMessage").append(data.message);
              $("#editProductVendorMessage").addClass(data.class);
              loadtContent();
            }
          }
        });
      });

      $(document).on('click', '.btn-delete',function(){
        $("#deleteProductVendorMessage").html('');
        $("#deleteProductVendorMessage").removeClass();
        $("#deleteProductVendor")[0].reset();
        $("#product_vendor_id_for_deletion").val($(this).attr('data-id'));
        $("#deleteProductVendorModal").modal('show');
      });

      $("#deleteProductVendor").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          url: 'delete-product-vendor',
          method: 'post',
          data: new FormData(this),
          processData:false,
          dataType: 'JSON',
          contentType: false,
          cache:false,
          beforeSend:function()
          {
            $("#deleteProductVendorMessage").html('');
            $("#deleteProductVendorMessage").removeClass();
          },
          success:function(data)
          {
            if(data)
            {
              $("#deleteProductVendorMessage").append(data.message);
              $("#deleteProductVendorMessage").addClass(data.class);
              loadtContent();
              $("#deleteProductVendorModal").modal('hide');

            }
          }
        });
      });
    });
  </script>
</x-app-layout>