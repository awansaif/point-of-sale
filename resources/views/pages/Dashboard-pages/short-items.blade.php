<x-app-layout>
   <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/dashboard">Home</a>
              </li>
              <li class="breadcrumb-item active">Short Items</li>
            </ol>
            <!-- Page Content -->
            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                A List of Short Items
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>SKU</th>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>In-Stock</th>
                        <th>Vendor</th>
                        <th>Revenue Percentage</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>SKU</th>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>In-Stock</th>
                        <th>Vendor</th>
                        <th>Revenue Percentage</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach($data as $key => $product)
                      <tr>
                        <td>054681</td>
                        <td>{{ $product->brands->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td class="text-danger">{{ $product->stock }}</td>
                        <td>{{ $product->vendors->name }} <br><small>{{ $product->vendors->contact }}</small></td>
                        <td>{{ ( $product->revenue_generated  / $product->inventory_worth ) * 100 }}%</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer small text-muted"></div>
            </div>
</x-app-layout>