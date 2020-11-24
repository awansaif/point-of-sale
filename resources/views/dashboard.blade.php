<x-app-layout>
  <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

  <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> -->
    
  <!-- Breadcrumbs-->

  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Home</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
  </ol>
  <!-- Icon Cards-->
  <div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-header">
          <h2>Sales Count</h2>
          <small class="float-left">Last two weeks</small>
        </div>
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-money"></i>
          </div>
          <div class="card-text">
            <h1 class="text-center display-3"><strong>135</strong></h1>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="sales-count.html">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
      <div class="card text-white bg-danger o-hidden h-100">
        <div class="card-header">
          <h2>Top-Selling</h2>
          <small class="float-left">Speakers</small>
        </div>
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-flash"></i>
          </div>
          <div class="card-text">
            <h1 class="text-center display-3"><strong>24</strong></h1>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="top-selling.html">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
      <div class="card text-white bg-dark o-hidden h-100">
        <div class="card-header">
          <h2>Short Items</h2>
          <small class="float-left">Includes short and requested items</small>
        </div>
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-tags"></i>
          </div>
          <div class="card-text">
            <h1 class="text-center display-3"><strong>14</strong></h1>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="short-items.html">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-header">
          <h2>Improvements</h2>
          <small class="float-left">Based on total monthly sales</small>
        </div>
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-shopping-cart"></i>
          </div>
          <div class="card-text">
            <h1 class="text-center display-3"><strong>27%</strong></h1>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="improvements.html">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
  </div>
  <!-- Area Chart Example-->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-chart-area"></i>
      Area Chart Example</div>
    <div class="card-body">
      <canvas id="myAreaChart" width="100%" height="30"></canvas>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>
  </div>
</x-app-layout>