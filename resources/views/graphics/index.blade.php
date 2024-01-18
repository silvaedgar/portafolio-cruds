@extends('layouts.app', ['activePage' => config('labelsMenu.graphicsView.label'), 'collapse' =>
config('labelsMenu.graphicsView.collapse'), 'title' => config('labelsMenu.graphicsView.title')])

@section('content')
<div class="content">
    <div id="container">
    </div>

</div>
@endsection

@push('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    // Highcharts.chart('container', {
        //     chart: {
        //         type: 'bar'
        //     },
        //     title: {
        //         text: 'Historic World Population by Region',
        //         align: 'left'
        //     },
        //     subtitle: {
        //         text: 'Source: <a ' +
        //             'href="https://en.wikipedia.org/wiki/List_of_continents_and_continental_subregions_by_population"' +
        //             'target="_blank">Wikipedia.org</a>',
        //         align: 'left'
        //     },
        //     xAxis: {
        //         categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
        //         title: {
        //             text: null
        //         },
        //         gridLineWidth: 1,
        //         lineWidth: 0
        //     },
        //     yAxis: {
        //         min: 0,
        //         title: {
        //             text: 'Population (millions)',
        //             align: 'high'
        //         },
        //         labels: {
        //             overflow: 'justify'
        //         },
        //         gridLineWidth: 0
        //     },
        //     tooltip: {
        //         valueSuffix: ' millions'
        //     },
        //     plotOptions: {
        //         bar: {
        //             borderRadius: '50%',
        //             dataLabels: {
        //                 enabled: true
        //             },
        //             groupPadding: 0.1
        //         }
        //     },
        //     legend: {
        //         layout: 'vertical',
        //         align: 'right',
        //         verticalAlign: 'top',
        //         x: -40,
        //         y: 80,
        //         floating: true,
        //         borderWidth: 1,
        //         backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        //         shadow: true
        //     },
        //     credits: {
        //         enabled: false
        //     },
        //     series: [{
        //         name: 'Year 1990',
        //         data: [631, 727, 3202, 721, 26]
        //     }, {
        //         name: 'Year 2000',
        //         data: [814, 841, 3714, 726, 31]
        //     }, {
        //         name: 'Year 2010',
        //         data: [1044, 944, 4170, 735, 40]
        //     }, {
        //         name: 'Year 2018',
        //         data: [1276, 1007, 4561, 746, 42]
        //     }]
        // });

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Cantidad de Caracteres por Nombre'
            },
            // subtitle: {
            //     text: 'Source: <a href="https://worldpopulationreview.com/world-cities" target="_blank">World Population Review</a>'
            // },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Cantidad de Nombres'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: '<b>{point.y:.1f} </b> nombres con  {point.x:.1f} caracteres de longitud '
            },
            series: [{
                name: 'Caracteres',
                colors: [
                    '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
                    '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
                    '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
                    '#03c69b', '#00f194'
                ],
                colorByPoint: true,
                groupPadding: 0,
                data: <?= $data ?>,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
</script>
@endpush