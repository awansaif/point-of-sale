<x-app-layout>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard">Home</a>
        </li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
    <!-- Page Content -->
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fa fa-table"></i>
            Products
            <a href="/add-product" class="text-white" >
                <span class="float-right">
                    <i class="fa fa-plus"></i>
                    Add New Product
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
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
        });
    </script>
</x-app-layout>
