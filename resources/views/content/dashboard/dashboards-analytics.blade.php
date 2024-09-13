@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>


@endsection

@section('content')
<div class="row">
  <div class="col-12 m-2">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Welcome  {{ Auth::user()->name }} 🎉</h5>
            <p class="mb-4">To Your <span class="fw-bold">Susu-Records</span> Dashboard.</p>
            {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> --}}
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  {{--  --}}

 


   <div class="card-body">
    <small class="text-light fw-semibold">Show By Date: </small>
    <div class="demo-inline-spacing">
       
      <form method="GET" class="form-control" action="{{ route('/') }}">
        <div>
            <label for="year" class="form-label">Year:</label>
            <select id="year"  class="form-select" name="year" onchange="this.form.submit()">
              <option value="All" {{ $year == 'All' ? 'selected' : '' }}>All</option>
              @for($i = 2022; $i <= date('Y'); $i++)
                  <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
            </select>
        </div>
    
        <div>
            <label for="month" class="form-label">Month:</label>
            <select id="month" class="form-select"  name="month" onchange="this.form.submit()">
              <option value="All" {{ $month == 'All' ? 'selected' : '' }}>All</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ str_pad($i, 2, '0', STR_PAD_LEFT) == $month ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
        </div>
    </form>
    </div>
  </div>  


      <div class="col-12 m-2">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item hide" href="javascript:void(0);">Hide</a>
                  {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                </div>
              </div>
            </div>
            <div class="content-section">
                <span class="fw-semibold d-block mb-1">Total Profit</span>  
           <h3 class="card-title mb-2">¢ {{ $profit ?? '0.00' }}</h3>  
            </div>
         
        {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +72.80%</small>   --}}
          </div>
        </div>
      </div>
   
  <div class="col-12 m-2">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item hide" href="javascript:void(0);">Hide</a>
                  {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                </div>
              </div>
            </div>
            <div class="content-section">
               <span>Total Deposits</span>
            <h3 class="card-title text-nowrap mb-1"> ¢ {{ $totaldeposit ?? '0.00' }}</h3>
            </div>
           
            {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.42%</small> --}}
          </div>
        </div>
      </div>

      <div class="col-12 m-2">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/cc-warning.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item hide" href="javascript:void(0);">Hide</a>
                  {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                </div>
              </div>
            </div>
            <div class="content-section">
               <span>Total Withdrawal</span>
            <h3 class="card-title text-nowrap mb-1"> ¢ {{ $totalwithdrwan  ?? '0.00'}}</h3>
            </div>
           
            {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.42%</small> --}}
          </div>
        </div>
      </div>


  
      <div class="col-12 m-2">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item hide" href="javascript:void(0);">Hide</a>
                  {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                </div>
              </div>
            </div>
            <div class="content-section">
                <span class="d-block mb-1">Balance</span>
            <h3 class="card-title text-nowrap mb-2">¢ {{ $balance  ?? '0.00'}}</h3>
            </div>
          
            {{-- <small class="text-danger fw-semibold"><i class='bx bx-down-arrow-alt'></i> -14.82%</small> --}}
          </div>
        </div>
      </div>
      <div class="col-12 m-2  align-items-center justify-content-center">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                  <a class="dropdown-item hide" href="javascript:void(0);">Hide</a>
                  {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                </div>
              </div>
            </div>
            <div class="content-section">
              <span class="fw-semibold d-block mb-1">Active Customers</span>
            <h3 class="card-title mb-2"> {{ $customers ?? '0'  }}</h3>
            </div>
            
            {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.14%</small> --}}
          </div>
        </div>
      </div>
      <!-- </div>
    <div class="row"> -->
      {{-- <div class="col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Profile Report</h5>
                  <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                </div>
                <div class="mt-sm-auto">
                  <small class="text-success text-nowrap fw-semibold"><i class='bx bx-chevron-up'></i> 68.2%</small>
                  <h3 class="mb-0">$84,686k</h3>
                </div>
              </div>
              <div id="profileReportChart"></div>
            </div>
          </div>
        </div>
      </div> --}}

{{-- 
    </div>
  </div> --}}
</div>
<div class="row">
  <!-- Order Statistics -->
  <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2"> Statistics</h5>
          <small class="text-muted">Total Transactions</small>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
            {{-- <a class="dropdown-item" href="javascript:void(0);">Select All</a> --}}
            <a class="dropdown-item" href="{{route('/') }}">Refresh</a>
            {{-- <a class="dropdown-item" href="javascript:void(0);">Share</a> --}}
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">{{$totalTransactions ?? '0'}}</h2>
            <span>Total Transactions</span>
          </div>
          {{-- <div id="orderStatisticsChart"></div> --}}
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-user'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0"> Active Vs Inactive</h6>
                <small class="text-muted">{{ $percentageActive ?? '0'}}% VS {{ $percentageInactive ?? '0'}}%</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">{{$totalActive}} VS {{$totalInactive}} </small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class='bx bx-user-voice'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0"> Female</h6>
                <small class="text-muted">{{ $percentageFemales ?? '0'}}% </small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold"> {{$totalFemales ?? '0'}} </small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-info"><i class='bx bx-user-pin'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Male</h6>
                <small class="text-muted"> {{ $percentageMales ?? '0'}}%</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">{{ $totalMales ?? '0'}}</small>
              </div>
            </div>
          </li>
          {{-- <li class="d-flex">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-secondary"><i class='bx bx-football'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Sports</h6>
                <small class="text-muted">Football, Cricket Kit</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">99</small>
              </div>
            </div>
          </li> --}}
        </ul>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->

  <!-- Expense Overview -->
  <div class="col-md-6 col-lg-6 order-1 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <ul class="nav nav-pills" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tabs-line-card-income" aria-controls="navs-tabs-line-card-income" aria-selected="true">Deposits</button>
          </li>
          {{-- <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Expenses</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Profit</button>
          </li> --}}
        </ul>
      </div>
      <div class="card-body px-0">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <div class="d-flex p-4 pt-3">
              <div class="avatar flex-shrink-0 me-3">
                <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User">
              </div>
              <div>
                <small class="text-muted d-block">Total Deposit</small>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-1">GH₵ {{$totaldeposit}}</h6>
                  <small class="text-success fw-semibold">
                    <i class='bx bx-chevron-up'></i>
                    0.0%
                  </small>
                </div>
              </div>
            </div>
            <div id="incomeChart"></div>
            <div class="d-flex justify-content-center pt-4 gap-2">
              <div class="flex-shrink-0">
                <div id="expensesOfWeek"></div>
              </div>
              <div>
                <p class="mb-n1 mt-1">Expenses This Week</p>
                <small class="text-muted">You made an expense of GH₵ {{$lastWeekExpenses}} last week</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Expense Overview -->

  <!-- Transactions -->
  {{-- <div class="col-md-6 col-lg-4 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Transactions</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Paypal</small>
                <h6 class="mb-0">Send money</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">+82.6</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Wallet</small>
                <h6 class="mb-0">Mac'D</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">+270.69</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/chart.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Transfer</small>
                <h6 class="mb-0">Refund</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">+637.91</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/cc-success.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Credit Card</small>
                <h6 class="mb-0">Ordered Food</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">-838.71</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Wallet</small>
                <h6 class="mb-0">Starbucks</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">+203.33</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/cc-warning.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Mastercard</small>
                <h6 class="mb-0">Ordered Food</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">-92.45</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div> --}}
  <!--/ Transactions -->
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Select all hide links
    const hideLinks = document.querySelectorAll('.hide');
    
    // Loop through each hide link and attach the click event
    hideLinks.forEach(function(link) {
      link.addEventListener('click', function(event) {
        const cardBody = event.target.closest('.card-body');
        const contentSection = cardBody.querySelector('.content-section');
        const originalContent = contentSection.innerHTML;
        const dots = '&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;';
        
        // Check if the content is already hidden
        if (contentSection.getAttribute('data-hidden') === 'true') {
          // Show the original content
          contentSection.innerHTML = contentSection.getAttribute('data-original-content');
          contentSection.setAttribute('data-hidden', 'false');
          event.target.innerHTML = 'Hide'; // Change text back to 'Hide'
        } else {
          // Store the original content and hide by replacing with dots
          contentSection.setAttribute('data-original-content', originalContent);
          contentSection.innerHTML = dots;
          contentSection.setAttribute('data-hidden', 'true');
          event.target.innerHTML = 'Show'; // Change text to 'Show'
        }
      });
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
    const weeklyExpensesEl = document.querySelector('#expensesOfWeek');
    const weeklyExpensesConfig = {
      series: [@json($weeklyExpenses)],
      chart: {
        width: 60,
        height: 60,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          startAngle: 0,
          endAngle: 360,
          strokeWidth: '8',
          hollow: {
            margin: 2,
            size: '45%'
          },
          track: {
            strokeWidth: '50%',
            background: "#e0e0e0"
          },
          dataLabels: {
            show: true,
            name: {
              show: false
            },
            value: {
              formatter: function (val) {
                return '₵' + parseInt(val);
              },
              offsetY: 5,
              color: '#697a8d',
              fontSize: '13px',
              show: true
            }
          }
        }
      },
      fill: {
        type: 'solid',
        colors: config.colors.primary
      },
      stroke: {
        lineCap: 'round'
      },
      grid: {
        padding: {
          top: -10,
          bottom: -15,
          left: -10,
          right: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };

    if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
      const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
      weeklyExpenses.render();
    }
  });





</script>

@endsection
