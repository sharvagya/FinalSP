@extends('layout')
@section('content')

    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>
    <div class="row">
        <div class="boxes">
            <div class="box box1">
                <i class="uil uil-utensils-alt"></i>
                <span class="text">Today Employees</span>
                <span class="number">{{$totalEmployees}}</span>
            </div>
            <div class="box box2">
                <i class="uil uil-check-circle"></i>
                <span class="text">Today Departments</span>
                <span class="number">{{$totalDepartments}}</span>
            </div>
            <div class="box box3">
                <i class="uil uil-money-bill"></i>
                <span class="text">Montly Salary Bill</span>
                <span class="number">{{$totalSalary}}</span>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Area Chart 
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart 
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
          // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Manually define labels and sessions data
    var _ydata = ['April', 'May', 'June'];
    var _xdata = [5, 2, 5];

    // Line Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: _ydata,
            datasets: [{
                label: "Employees",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(46, 204, 113, 1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(46, 204, 113, 1)",
                pointBorderColor: "rgba(46, 204, 113, 1)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(46, 204, 113, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: _xdata,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7,
                        fontColor: '#6c757d', // X-axis tick font color
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date',
                        fontColor: '#6c757d', // X-axis label font color
                    },
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 10,
                        maxTicksLimit: 5,
                        fontColor: '#6c757d', // Y-axis tick font color
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                        borderDash: [2],
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Sessions',
                        fontColor: '#6c757d', // Y-axis label font color
                    },
                }],
            },
            legend: {
                display: false,
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    title: function (tooltipItem, data) {
                        return tooltipItem[0].label;
                    },
                    label: function (tooltipItem, data) {
                        return 'Sessions: ' + tooltipItem.yLabel;
                    },
                    footer: function (tooltipItem, data) {
                        return 'Total Sessions: ' + data.datasets[0].data.reduce((a, b) => a + b, 0);
                    },
                }
            }
        }
    });
    </script>

<script type="text/javascript">
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';


    var _ydata = ['April', 'May', 'June'];
    var _xdata = [5, 2, 5];


    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: _ydata,
            datasets: [{
                label: "Registration",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: _xdata,
            }],
        },
        options: {
  scales: {
    xAxes: [{
      time: {
        unit: 'month'
      },
      gridLines: {
        display: false,
        drawBorder: false
      },
      ticks: {
        maxTicksLimit: 6,
        fontColor: '#888',
        fontFamily: 'Arial',
        fontSize: 12
      }
    }],
    yAxes: [{
      ticks: {
        min: 0,
        max: 10,
        maxTicksLimit: 5,
        fontColor: '#888',
        fontFamily: 'Arial',
        fontSize: 12
      },
      gridLines: {
        display: true,
        color: '#ddd',
        borderDash: [2],
        drawBorder: false
      }
    }]
  },
  legend: {
    display: false
  }
}
});

</script>

@endsection