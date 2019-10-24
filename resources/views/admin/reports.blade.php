@extends('admin.admin-layout')

@section('content')
  <div class="content">
      <div class="container-fluid">
          <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                  <div class="card card-chart">
                    <div class="card-header card-header-warning">
                      <div id="straightLinesChart" class="ct-chart"></div>
                    </div>
                    <div class="card-body">
                      <h4 class="card-title">Today Sells report</h4>
                      <p class="card-category">Line Chart with Points</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-chart">
                    <div class="card-header card-header-rose">
                      <div id="roundedLineChart" class="ct-chart"></div>
                    </div>
                    <div class="card-body">
                      <h4 class="card-title">Weekly Sells Report</h4>
                      <p class="card-category">Line Chart</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="card card-chart">
                    <div class="card-header card-header-icon card-header-danger">
                      <div class="card-icon">
                        <i class="material-icons">D-T</i>
                      </div>
                      <h4 class="card-title">Dine In vs Take Away order</h4>
                    </div>
                    <div class="card-body">
                      <div id="chartPreferences" class="ct-chart"></div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="card-category">Legend</h6>
                        </div>
                        <div class="col-md-12">
                          <i class="fa fa-circle text-info"></i> Dine In Orders
                          <i class="fa fa-circle text-danger"></i> Take Away Order
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-chart">
                    <div class="card-header card-header-icon card-header-danger">
                      <div class="card-icon">
                        <i class="material-icons">O-S</i>
                      </div>
                      <h4 class="card-title">Dine in vs take away order</h4>
                    </div>
                    <div class="card-body">
                      <div id="orderStaticPieChart" class="ct-chart"></div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="card-category">Legend</h6>
                        </div>
                        <div class="col-md-12">
                          <i class="fa fa-circle text-info"></i> Delivired
                          <i class="fa fa-circle text-warning"></i> On Serving Stage
                          <i class="fa fa-circle text-danger"></i> On Cooking Stage
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-chart">
                    <div class="card-header card-header-info">
                      <div id="simpleBarChart" class="ct-chart"></div>
                    </div>
                    <div class="card-body">
                      <h4 class="card-title ">Month Sells Report</h4>
                      <p class="card-category">Bar Chart</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                      <div class="card-icon">
                        <i class="material-icons">insert_chart</i>
                      </div>
                      <h4 class="card-title">15 Days Food Ingridient Prediction
                        <small>- Bar Chart</small>
                      </h4>
                    </div>
                    <div class="card-body">
                      <div id="multipleBarsChart" class="ct-chart"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header card-header-icon card-header-info">
                      <div class="card-icon">
                        <i class="material-icons">timeline</i>
                      </div>
                      <h4 class="card-title">One Week Food Ingridient Prediction
                        <small> - Rounded</small>
                      </h4>
                    </div>
                    <div class="card-body">
                      <div id="colouredBarsChart" class="ct-chart"></div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>
  </div>
@endsection

@section('modal-and-js')




<script>
    $(document).ready(function() {


      /*  **************** Today Sells report ******************** */

      dataStraightLinesChart = {
                labels: [
                          @foreach($todaySellReport as $hour)
                            '\'{{$hour['hour']}}',
                          @endforeach
                        ],
                series: [
                          [ @foreach($todaySellReport as $hour)
                              {{$hour['amount']}},
                            @endforeach
                          ]
                        ]
            };

            optionsStraightLinesChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: {{$highestTodayValue+($highestTodayValue*0.25)}}, 
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
                classNames: {
                    point: 'ct-point ct-white',
                    line: 'ct-line ct-white'
                }
            }

            var straightLinesChart = new Chartist.Line('#straightLinesChart', dataStraightLinesChart, optionsStraightLinesChart);

            md.startAnimationForLineChart(straightLinesChart);


            /*  **************** START Weekly Sells Report ******************** */
            dataRoundedLineChart = {
                labels: [
                        @foreach($last7DaysSellReport as $day)
                          '{{$day['day']}}',
                        @endforeach
                        ],
                series: [
                          [ @foreach($last7DaysSellReport as $day)
                              {{$day['amount']}},
                            @endforeach
                          ]
                        ]
            };

            optionsRoundedLineChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 10
                }),
                axisX: {
                    showGrid: false,
                },
                low: 0,
                high: {{$highest7DaysValue+($highest7DaysValue*0.25)}}, 
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
                showPoint: false
            }

            var RoundedLineChart = new Chartist.Line('#roundedLineChart', dataRoundedLineChart, optionsRoundedLineChart);

            md.startAnimationForLineChart(RoundedLineChart);

            /*  **************** END Weekly Sells Report ******************** */



            /*  **************** Public Preferences - Pie Chart ******************** */
            var dataPreferences = {
                labels: [
                              '{{round($dineIn)}}%',
                              '{{round($takeAway)}}%',
                        ],
                series: [
                              '{{round($dineIn)}}',
                              '{{round($takeAway)}}',
                        ]
            };

            var optionsPreferences = {
                height: '230px'
            };

            Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);
            /*  **************** Public Preferences - Pie Chart ******************** */


            /*  **************** Public Preferences - Pie Chart ******************** */
            var dataPreferences = {
                labels: [
                          @foreach($orderStatusReport as $row)
                              '{{round($row['total']*100/$sumOfOrderStatus)}}%',
                          @endforeach
                        ],
                series: [
                          @foreach($orderStatusReport as $row)
                              {{round($row['total']*100/$sumOfOrderStatus)}},
                          @endforeach
                        ]
            };

            var optionsPreferences = {
                height: '230px'
            };

            Chartist.Pie('#orderStaticPieChart', dataPreferences, optionsPreferences);
            /*  **************** Public Preferences - Pie Chart ******************** */



           
             /*  **************** Mulitple line chart ******************** */

            dataColouredBarsChart = {
                labels: [
                          @foreach($fifteenDsIngridientsReports as $ingridient)
                              {{$ingridient['id']}},
                          @endforeach
                        ],
                series: [
                    [
                      @foreach($fifteenDsIngridientsReports as $ingridient)
                          {{$ingridient['stock']}},
                      @endforeach
                    ],
                    [
                      @foreach($fifteenDsIngridientsReports as $ingridient)
                          {{$ingridient['amount']}},
                      @endforeach]
                ]
            };

            optionsColouredBarsChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 10
                }),
                axisY: {
                    showGrid: true,
                    offset: 40
                },
                axisX: {
                    showGrid: false,
                },
                low: 0,
                high: {{$higestfifteenDsIngridientsReports+($higestfifteenDsIngridientsReports*0.25)}}, 
                showPoint: true,
                height: '300px'
            };


            var colouredBarsChart = new Chartist.Line('#colouredBarsChart', dataColouredBarsChart, optionsColouredBarsChart);

            md.startAnimationForLineChart(colouredBarsChart);

            /*  **************** Mulitple line chart ******************** */


            /*  **************** start Month Sells Report Bar Chart - barchart ******************** */

            var dataSimpleBarChart = {
                labels: [
                          @foreach($last30DaysSellReport as $day)
                            '{{$day['day']}}',
                          @endforeach
                        ],
                series: [
                          [
                            @foreach($last30DaysSellReport as $day)
                              {{$day['amount']}},
                            @endforeach
                          ]
                        ]
            };

            var optionsSimpleBarChart = {
                seriesBarDistance: 10,
                axisX: {
                    showGrid: false
                }
            };

            var responsiveOptionsSimpleBarChart = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function(value) {
                            return value[0];
                        }
                    }
                }]
            ];

            var simpleBarChart = Chartist.Bar('#simpleBarChart', dataSimpleBarChart, optionsSimpleBarChart, responsiveOptionsSimpleBarChart);

            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(simpleBarChart);
             /*  **************** end Month Sells Report Bar Chart - barchart ******************** */


            /*  **************** end multiple bar Chart ******************** */
            var dataMultipleBarsChart = {
                labels: [
                          @foreach($oneWeekIngridientPredictionReport as $ingridient)
                              {{$ingridient['id']}},
                          @endforeach
                        ],
                series: [
                    [
                      @foreach($oneWeekIngridientPredictionReport as $ingridient)
                          {{$ingridient['stock']}},
                      @endforeach
                    ],
                    [
                      @foreach($oneWeekIngridientPredictionReport as $ingridient)
                          {{$ingridient['amount']}},
                      @endforeach
                    ]
                ]
            };

            var optionsMultipleBarsChart = {
                seriesBarDistance: 10,
                axisX: {
                    showGrid: false
                },
                height: '300px'
            };

            var responsiveOptionsMultipleBarsChart = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function(value) {
                            return value[0];
                        }
                    }
                }]
            ];

            var multipleBarsChart = Chartist.Bar('#multipleBarsChart', dataMultipleBarsChart, optionsMultipleBarsChart, responsiveOptionsMultipleBarsChart);

            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(multipleBarsChart);
            /*  **************** end multiple bar Chart ******************** */


            
      
      
    });
  </script>

    
@endsection


