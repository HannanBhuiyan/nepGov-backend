@extends('layouts.backend.backend-app')

@section('content')
 <!-- PAGE-HEADER -->
 <div class="page-header">
    <h1 class="page-title">NepGov Dashboard</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW-1 -->
<div class="row">
    <div class="col-sm-6 col-xl-4 col-md-6 col-lg-4">
        {{-- <a href="{{ route('month_wise_voting_count') }}">Count Vote</a> --}}
        <div class="card overflow-hidden">
            <div class="card-body text-center">
                <h6 class=""><span class="text-secondary"><i class="fe fe-users mx-2 fs-20 text-secondary-shadow"></i></span>Users</h6>
                <h3 class="text-dark counter mt-0 mb-3 number-font">{{$users->count()}}</h3>
                <div class="progress h-1 mt-0 mb-2">
                    <div class="progress-bar progress-bar-striped  bg-secondary" style="width: 20%;" role="progressbar"></div>
                </div>
                <div class="row mt-4">
                    <div class="col text-center"> <span class="text-muted">Monthly</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font1">{{$last_30_days_users->count()}}</h4>
                    </div>
                    <div class="col text-center"> <span class="text-muted">Weekly</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font1">{{$last_7_days_users->count()}}</h4>
                    </div>
                    <div class="col text-center"> <span class="text-muted">Total</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font1">{{$users->count()}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <h6 class=""><span class="text-primary"><i class="fe fe-file-text mx-2 fs-20 text-primary-shadow"></i></span>Total News</h6>
                <h3 class="text-dark counter mt-0 mb-3 number-font">{{$news->count()}}</h3>
                <div class="progress h-1 mt-0 mb-2">
                    <div class="progress-bar progress-bar-striped bg-primary" style="width: 70%;" role="progressbar"></div>
                </div>
                <div class="row mt-4">
                    <div class="col text-center"> <span class="text-muted">Weekly</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font1">{{$last_7_days_news->count()}}</h4>
                    </div>
                    <div class="col text-center"> <span class="text-muted">Monthly</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font2">{{$last_30_days_news->count()}}</h4>
                    </div>
                    <div class="col text-center"> <span class="text-muted">Total</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font3">{{$news->count()}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4 col-md-6 col-lg-4">
        <div class="card overflow-hidden">
            <div class="card-body text-center">
                <h6 class=""><span class="text-warning"><i class="fe fe-tag mx-2 fs-20 text-dark-shadow"></i></span>Total Crimes</h6>
                <h3 class="text-dark counter mt-0 mb-3 number-font">{{$crimes->count()}}</h3>
                <div class="progress h-1 mt-0 mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: 40%;" role="progressbar"></div>
                </div>
                <div class="row mt-4">
                    <div class="col text-center"> <span class="text-muted">Weekly</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font1">{{$last_7_days_crime->count()}}</h4>
                    </div>
                    <div class="col text-center"> <span class="text-muted">Monthly</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font1">{{ $last_30_days_crime->count() }}</h4>
                    </div>
                    <div class="col text-center"> <span class="text-muted">Total</span>
                        <h4 class="fw-normal mt-2 mb-0 number-font1">{{ $crimes->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Polling Chart</h3>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartArea" class="h-275"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 card">
        <div class="card-header">
            <h3 class="card-title">User Chart</h3>
        </div>
        <div class="card-body">
            <div id="bar_chart"></div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fa fa-firefox text-primary fa-3x"></i>
                <h6 class="mt-4 mb-2">Total News View</h6>
                <h2 class="mb-2 number-font">{{$news_view_count->count() ?? ''}}</h2>
                <p class="text-muted">Page viewed total {{$news_view_count->count() ?? ''}} times</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fa fa-pie-chart text-info fa-3x"></i>
                <h6 class="mt-4 mb-2">Total Page View</h6>
                <h2 class="mb-2  number-font">{{$page_view_count->count() ?? ''}}</h2>
                <p class="text-muted">Page viewed total {{$page_view_count->count() ?? ''}} times</p>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <small class="text-muted">Total users</small>
                    <h2 class="mb-2 mt-0">{{$users->count()}}</h2>
                    <div id="circle" class="mt-3 mb-3 chart-dropshadow-secondary"></div>
                    <div class="chart-circle-value-3 text-secondary fs-20"><i class="icon icon-user-follow"></i></div>
                    <p class="mb-0 text-start"><span class="dot-label bg-secondary me-2"></span>Monthly new users <span class="float-end">{{ round($last_30_days_users->count()) }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="widget text-center">
                    <small class="text-muted">Live Review</small>
                    <h2 class="mb-2 mt-0">{{$live_rev->count()}}</h2>
                    <div id="circle-2" class="mt-3 mb-3 chart-dropshadow-warning"></div>
                    <div class="chart-circle-value-3 text-warning fs-20"><i class="icon icon-chart"></i></div>
                    <p class="mb-0 text-start"><span class="dot-label bg-warning me-2"></span>Weekly Review <span class="float-end">{{round($last_7_days_live->count())}}</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="widget text-center">
                    <small class="text-muted">Normal Review</small>
                    <h2 class="mb-2 mt-0">{{$normal_rev->count()}}</h2>
                    <div id="circle-3" class="mt-3 mb-3 chart-dropshadow-danger"></div>
                    <div class="chart-circle-value-3 text-danger fs-20"><i class="icon icon-chart"></i></div>
                    <p class="mb-0 text-start"><span class="dot-label bg-danger me-2"></span>Weekly Review <span class="float-end">{{round($last_7_days_normal->count())}}</span></p>
                </div>
            </div>
        </div>
    </div>

</div> 


@endsection


@section('scripts')
<script>
    var options = {
        series: [{
        name: 'Total Users',
        data: @json($total_users)
        }, {
        name: 'Total News',
        data: @json($total_news)
        }],
        chart: {
        type: 'bar',
        height: 350,
        toolbar: {
            show: false,
        }
        },
        plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
        },
        dataLabels: {
        enabled: true
        },
        stroke: {
        show: true,
        width:1,
        colors: ['transparent']
        },
        xaxis: {
        categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
        fill: {
        opacity: 0.8
        },
        tooltip: {
        y: {
            formatter: function (val) {
            return val
            }
        }
        }
    };
    var chart = new ApexCharts(document.querySelector("#bar_chart"), options);
    chart.render();
</script>

<script>
$(function() {
	"use strict";
     /* Area Chart*/
    var ctx = document.getElementById("chartArea");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: "Normal Reviews",
                borderColor: "#6c5ffc",
                borderWidth: "3",
                backgroundColor: "rgba(108, 95, 252, .1)",
                data: @json($normal_reviews)
            }, {
                label: "Live Reviews",
                borderColor: "rgba(5, 195, 251 ,0.9)",
                borderWidth: "3",
                backgroundColor: "rgba(	5, 195, 251, 0.7)",
                pointHighlightStroke: "rgba(5, 195, 251 ,1)",
                data: @json($polling_reviews)
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: "#9ba6b5",
                    },
                    gridLines: {
                        color: 'rgba(119, 119, 142, 0.2)'
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#9ba6b5",
                    },
                    gridLines: {
                        color: 'rgba(119, 119, 142, 0.2)'
                    },
                }]
            },
            legend: {
                labels: {
                    fontColor: "#9ba6b5"
                },
            },
        }
    });
})
</script>


@endsection


    


