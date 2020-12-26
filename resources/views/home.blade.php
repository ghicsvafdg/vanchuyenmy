@extends('layouts.backend.app')

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-primary card-round">
            <div class="card-body">
                <p class="card-category">Số người dùng đăng ký</p>
                <div class="row">
                    <div class="col-3">
                        <div class="icon-big text-center">
                            <i class="flaticon-users"></i>
                        </div>
                    </div>
                    <div class="col col-stats">
                        <div class="numbers">
                            <h4 class="card-title">{{$user}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-info card-round">
            <div class="card-body">
                <p class="card-category">Số lượng đơn hàng</p>
                <div class="row">
                    <div class="col-3">
                        <div class="icon-big text-center">
                            <i class="flaticon-interface-6"></i>
                        </div>
                    </div>
                    <div class="col col-stats">
                        <div class="numbers">
                            <h4 class="card-title">{{$orders}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-success card-round">
            <div class="card-body">
                <p class="card-category">Tổng doanh thu</p>
                <div class="row">
                    <div class="col-3">
                        <div class="icon-big text-center">
                            <i class="flaticon-analytics"></i>
                        </div>
                    </div>
                    <div class="col col-stats">
                        <div class="numbers">
                            <h4 class="card-title">{{number_format($revenue*1000,0,'.',',')}} VNĐ</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-secondary card-round">
            <div class="card-body">
                <p class="card-category">Đơn hàng đã xử lý</p>
                <div class="row">
                    <div class="col-3">
                        <div class="icon-big text-center">
                            <i class="flaticon-success"></i>
                        </div>
                    </div>
                    <div class="col col-stats">
                        <div class="numbers">
                            <h4 class="card-title">{{$orderDone}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Số lượng người đăng ký trong 12 tháng gần nhất</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="lineChart" data-order="{{ $countUser }}"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Số lượng đơn hàng đặt trong 12 tháng gần nhất</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="barChart" data-order="{{ $countOrder }}"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Doanh số trong 12 tháng gần nhất (tính theo trạng thái "đã giao" của đơn hàng)</div>
            </div>
            <div class="card-body">
                <canvas id="profitLineChart" data-order="{{ $countProfit }}"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Top 20 người dùng mua hàng nhiều nhất website</div>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <th></th>
                        <th>Email</th>
                        <th>Số đơn</th>
                    </tr>
                    @foreach ($loyalUser as $user)
                    <tr>
                        <td width="20%">
                            @if (App\Models\User::findOrFail($user->user_id)->avatar)
                            <object data="{{asset('profile/'.App\Models\User::findOrFail($user->user_id)->avatar)}}" class="rounded-circle" width="30" height="30" type="image/png">
                                <img src="{{App\Models\User::findOrFail($user->user_id)->avatar}}" width="30" height="30" alt="image profile" class="rounded-circle">
                            </object>
                            @else
                            <img src="{{asset('profile/default_av.png')}}" alt="image profile" width="30" height="30" class="rounded-circle">
                            @endif
                        </td>
                        <td width="65%">
                            {{App\Models\User::findOrFail($user->user_id)->email}}
                        </td>
                        <td>
                            {{$user->value}}
                        </td>
                    </tr>
                    @endforeach
                </table>
               
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    //the number of users register in latest 12 months
    var lineChart = document.getElementById('lineChart').getContext('2d')
    var order = $('#lineChart').data('order');
    var listOfValue = [];
    var listOfMonth = [];
    
        order.forEach(function(element){
            listOfMonth.push("T"+element.getMonth+"-"+element.getYear);
            listOfValue.push(element.value);
    });
    var myLineChart = new Chart(lineChart, {
        type: 'line',
        data: {
            labels: listOfMonth,
            datasets: [{
                label: "Số người đăng ký",
                borderColor: "#1d7af3",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#1d7af3",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: listOfValue
            }]
        },
        options : {
            responsive: true, 
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels : {
                    padding: 10,
                    fontColor: '#1d7af3',
                }
            },
            tooltips: {
                bodySpacing: 4,
                mode:"nearest",
                intersect: 0,
                position:"nearest",
                xPadding:10,
                yPadding:10,
                caretPadding:10
            },
            layout:{
                padding:{left:15,right:15,top:15,bottom:15}
            }
        }
    });
    
    //the number of orders register in latest 12 months
    var barChart = document.getElementById('barChart').getContext('2d')
    var order = $('#barChart').data('order');
    var listOfValueOrder = [];
    var listOfMonthOrder = [];
    
        order.forEach(function(element){
            listOfMonthOrder.push("T"+element.getMonth+"-"+element.getYear);
            listOfValueOrder.push(element.value);
    });
    var myBarChart = new Chart(barChart, {
        type: 'bar',
        data: {
            labels: listOfMonthOrder,
            datasets : [{
                label: "Số đơn",
                backgroundColor: 'rgb(23, 125, 255)',
                borderColor: 'rgb(23, 125, 255)',
                data: listOfValueOrder,
            }],
        },
        options: {
            responsive: true, 
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
        }
    });

    //count profit
    var lineChartProfit = document.getElementById('profitLineChart').getContext('2d')
    var orderProfit = $('#profitLineChart').data('order');
    var listOfValueProfit = [];
    var listOfMonthProfit = [];
    
        orderProfit.forEach(function(element){
            listOfMonthProfit.push("T"+element.getMonth+"-"+element.getYear);
            listOfValueProfit.push(element.value);
    });
    var myLineChartProfit = new Chart(lineChartProfit, {
        type: 'line',
        data: {
            labels: listOfMonthProfit,
            datasets: [{
                label: "Doanh số",
                borderColor: "#1d7af3",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#1d7af3",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: listOfValueProfit
            }]
        },
        options : {
            responsive: true, 
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels : {
                    padding: 10,
                    fontColor: '#1d7af3',
                }
            },
            tooltips: {
                bodySpacing: 4,
                mode:"nearest",
                intersect: 0,
                position:"nearest",
                xPadding:10,
                yPadding:10,
                caretPadding:10
            },
            layout:{
                padding:{left:15,right:15,top:15,bottom:15}
            }
        }
    });
</script>
@endsection
