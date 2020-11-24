<x-app-layout>
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Home</a>
    </li>
    <li class="breadcrumb-item active">Revenue</li>
  </ol>
  <!-- Page Content -->
  <div class="col-12">
    <div class="card mb-3">
      <div class="card-header bg-primary text-white">
        <i class="fa fa-chart-bar"></i>
        Revenue Chart
      </div>
      <div class="card-body">
        <canvas id="myBarChart" width="100%" height="30"></canvas>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
  </div>

  <br><br><br>
</x-app-layout>