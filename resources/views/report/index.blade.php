@extends('layouts.base')
@section('title', 'Report')
@section('content')
    <div class="row">
        {{-- <div class="col-sm-12">
            <div id="frame" style="border-radius: 16px;"></div>
        </div>
        <div class="col-sm-6">
            <div id="container" style="border-radius: 16px;"></div>
        </div> --}}
        <div class="col-sm-6">
            <div id="count-penjualan" style="border-radius: 16px;"></div>
        </div>
        <div class="col-sm-6 ">
            <div id="pie" style="border-radius: 16px;"></div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        // Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
        // Highcharts.chart('container', {
        //     chart: {
        //         type: 'spline'
        //     },
        //     title: {
        //         text: 'Profit Penjualan'
        //     },
        //     subtitle: {
        //         text: 'Kacamata Blushing Store'
        //     },
        //     xAxis: {
        //         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        //             'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        //         ],
        //         accessibility: {
        //             description: 'Months of the year'
        //         }
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Value'
        //         },
        //         labels: {
        //             formatter: function() {
        //                 return this.value;
        //             }
        //         }
        //     },
        //     tooltip: {
        //         crosshairs: true,
        //         shared: true
        //     },
        //     credits: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         spline: {
        //             marker: {
        //                 radius: 4,
        //                 lineColor: '#666666',
        //                 lineWidth: 1
        //             }
        //         }
        //     },
        //     series: {!! $series !!}
        // });

        Highcharts.chart('count-penjualan', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Total Penjualan Kacamata'
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
                        lineColor: '#000000',
                        lineWidth: 1
                    }
                }
            },
            series: {!! $series_count_penjualan !!}
        });

        Highcharts.chart('pie', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: "Persentase Penjualan Kacamata Per Item Tahun {{ date('Y') }}"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: {!! $my_chart !!}
            }]
        });

        // Highcharts.chart('frame', {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: 'Emissions to air in Norway'
        //     },
        //     subtitle: {
        //         text: 'Source: ' +
        //             '<a href="https://www.ssb.no/en/statbank/table/08940/" ' +
        //             'target="_blank">SSB</a>'
        //     },
        //     xAxis: {
        //         categories: [
        //             '2010',
        //             '2011',
        //             '2012',
        //             '2013',
        //             '2014',
        //             '2015',
        //             '2016',
        //             '2017',
        //             '2018',
        //             '2019',
        //             '2010',
        //             '2021'
        //         ],
        //         crosshair: true
        //     },
        //     yAxis: {
        //         title: {
        //             useHTML: true,
        //             text: 'Million tonnes CO<sub>2</sub>-equivalents'
        //         }
        //     },
        //     tooltip: {
        //         headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        //         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        //             '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        //         footerFormat: '</table>',
        //         shared: true,
        //         useHTML: true
        //     },
        //     plotOptions: {
        //         column: {
        //             pointPadding: 0.2,
        //             borderWidth: 0
        //         }
        //     },
        //     series: [{
        //         name: 'Oil and gas extraction',
        //         data: [13.93, 13.63, 13.73, 13.67, 14.37, 14.89, 14.56,
        //             14.32, 14.13, 13.93, 13.21, 12.16]

        //     }, {
        //         name: 'Manufacturing industries and mining',
        //         data: [12.24, 12.24, 11.95, 12.02, 11.65, 11.96, 11.59,
        //             11.94, 11.96, 11.59, 11.42, 11.76]

        //     }, {
        //         name: 'Road traffic',
        //         data: [10.00, 9.93, 9.97, 10.01, 10.23, 10.26, 10.00,
        //             9.12, 9.36, 8.72, 8.38, 8.69]

        //     }, {
        //         name: 'Agriculture',
        //         data: [4.35, 4.32, 4.34, 4.39, 4.46, 4.52, 4.58, 4.55,
        //             4.53, 4.51, 4.49, 4.57]

        //     }]
        // });
    </script>
@endsection
