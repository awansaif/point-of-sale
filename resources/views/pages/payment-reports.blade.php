<x-app-layout>
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Home</a>
    </li>
    <li class="breadcrumb-item active">Payment Reports</li>
  </ol>
  <!-- Icon Cards-->

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card o-hidden h-100">
        <div class="card-header bg-primary text-white">
          <h1>Income</h1>
        </div>
        <div class="card-body">
          <div class="card-body-icon text-white">
            <i class="fa fa-fw fa-shopping-cart"></i>
          </div>
          <div class="card-text text-center">
            <span class="display-3"><strong>38.2</strong>k</span>
          </div>
        </div>
        <a class="card-footer clearfix small z-1" href="#">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card o-hidden h-100">
        <div class="card-header bg-primary text-white">
          <h1>Expense</h1>
        </div>
        <div class="card-body">
          <div class="card-body-icon text-white">
            <i class="fa fa-fw fa-rocket"></i>
          </div>
          <div class="card-text text-center">
            <span class="display-3"><strong>10.7</strong>k</span>
          </div>
        </div>
        <a class="card-footer clearfix small z-1" href="#">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-6 col-sm-12 mb-3">
      <div class="card o-hidden h-100">
        <div class="card-header bg-dark text-white">
          <h1>Your Account</h1>
        </div>
        <div class="card-body">
          <div class="card-body-icon text-white">
            <i class="fa fa-fw fa-dollar"></i>
          </div>
          <div class="card-text text-center">
            <span class="display-3"><strong>27.5</strong>k</span>
            <small class="text-primary"> <strong>52%<i class="fa fa-arrow-up"></i> </strong></small>
          </div>
        </div>
        <a class="card-footer clearfix small z-1" href="#">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <h3></h3>
  </div>
  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-table"></i>
      Account Details
      <a href="#" class="text-white" data-toggle="modal" data-target="#addSaleModal">
        <span class="float-right">
          <i class="fa fa-plus"></i>
          Add Expense
        </span>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>TID</th>
              <th>Transaction Type</th>
              <th>Description</th>
              <th>Account</th>
              <th>Date</th>
              <th>Price</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>TID</th>
              <th>Transaction Type</th>
              <th>Description</th>
              <th>Account</th>
              <th>Date</th>
              <th>Price</th>
            </tr>
          </tfoot>
          <tbody>
            <tr>
              <td>#456421</td>
              <td class="text-danger">Expense</td>
              <td>Served 2 Fresh Juices</td>
              <td>Akhtar Hotel</td>
              <td>03/10/2018</td>
              <td>Rs120</td>
            </tr>
            <tr>
              <td>#456519</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#456517</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#456515</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#455314</td>
              <td class="text-primary">Income</td>
              <td>Audionic MAX-4 Sold out</td>
              <td>Cash Register</td>
              <td>04/10/2018</td>
              <td>Rs2350</td>
            </tr>
            <tr>
              <td>#456513</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#455312</td>
              <td class="text-primary">Income</td>
              <td>Audionic MAX-4 Sold out</td>
              <td>Cash Register</td>
              <td>04/10/2018</td>
              <td>Rs2350</td>
            </tr>
            <tr>
              <td>#456511</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#455310</td>
              <td class="text-primary">Income</td>
              <td>Audionic MAX-4 Sold out</td>
              <td>Cash Register</td>
              <td>04/10/2018</td>
              <td>Rs2350</td>
            </tr>
            <tr>
              <td>#456509</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#455308</td>
              <td class="text-primary">Income</td>
              <td>Audionic MAX-4 Sold out</td>
              <td>Cash Register</td>
              <td>04/10/2018</td>
              <td>Rs2350</td>
            </tr>
            <tr>
              <td>#456507</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#455306</td>
              <td class="text-primary">Income</td>
              <td>Audionic MAX-4 Sold out</td>
              <td>Cash Register</td>
              <td>04/10/2018</td>
              <td>Rs2350</td>
            </tr>
            <tr>
              <td>#456505</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#455304</td>
              <td class="text-primary">Income</td>
              <td>Audionic MAX-4 Sold out</td>
              <td>Cash Register</td>
              <td>04/10/2018</td>
              <td>Rs2350</td>
            </tr>
            <tr>
              <td>#456503</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
            <tr>
              <td>#455302</td>
              <td class="text-primary">Income</td>
              <td>Audionic MAX-4 Sold out</td>
              <td>Cash Register</td>
              <td>04/10/2018</td>
              <td>Rs2350</td>
            </tr>
            <tr>
              <td>#456501</td>
              <td class="text-danger">Expense</td>
              <td>Served 4 Teas</td>
              <td>Mian Tea Stall</td>
              <td>03/10/2018</td>
              <td>Rs80</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">This table shows last 100 Enteries. Check all other enteries <a
        href="#">here</a>.</div>
  </div>
  <br><br><br>
</x-app-layout>