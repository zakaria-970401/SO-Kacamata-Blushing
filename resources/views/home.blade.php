@extends('layouts.base')
@section('title', 'Home')
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-sm-12">
            <div class="alert alert-primary alert-dismissible alert-solid alert-label-icon shadow fade show" role="alert"
                style="zoom: 120%">
                <i class="ri-user-smile-line label-icon"></i><strong>Welcome {{ Auth::user()->name }}, </strong> You are
                logged in!
                {{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="container"></div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        // Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
        Highcharts.chart('container', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Profit Penjualan'
            },
            subtitle: {
                text: 'Kacamata Blushing Store'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                accessibility: {
                    description: 'Months of the year'
                }
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: {!! $series !!}
        });
    </script>
@endsection
