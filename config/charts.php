<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default settings for charts
    |--------------------------------------------------------------------------
    */

    'default'   => [
        'type'          => 'line',
        'library'       => 'google',
        'element_label' => 'Element',
        'title'         => 'My chart',
        'height'        => 400,
        'width'         => 500,
        'responsive'    => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Assets required by the libraries
    |--------------------------------------------------------------------------
    */

    'assets' => [

        'global' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/jquery-3.0.0.min.js'),
            ],
        ],

        'canvas-gauges' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/canvas-gauges/gauge.min.js'),
            ],
        ],

        'chartist' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/chartist/chartist.min.js'),
            ],
            'styles' => [
                asset('/vendor/consoletvs/charts/chartist/chartist.min.css'),
            ],
        ],

        'chartjs' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/chartjs/Chart.js'),
            ],
        ],

        'fusioncharts' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/fusioncharts/fusioncharts.js'),
                asset('/vendor/consoletvs/charts/fusioncharts/themes/fusioncharts.theme.fint.js'),
            ],
        ],

        'google' => [
            'scripts' => [
                'https://www.gstatic.com/charts/loader.js',
                'https://www.google.com/jsapi',
                "google.charts.load('current', {'packages':['corechart', 'gauge', 'geochart', 'bar', 'line']})",
            ],
        ],

        'highcharts' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/highcharts/js/highcharts.js'),
                asset('/vendor/consoletvs/charts/highcharts/js/modules/exporting.js'),
                asset('/vendor/consoletvs/charts/highmaps/js/modules/map.js'),
                asset('/vendor/consoletvs/charts/highmaps/js/modules/data.js'),
                asset('/vendor/consoletvs/charts/highmaps/maps/world.js'),
            ],
        ],

        'justgage' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/justgage/raphael-2.1.4.min.js'),
                asset('/vendor/consoletvs/charts/justgage/justgage.js'),
            ],
        ],

        'morris' => [
            'styles' => [
                asset('/vendor/consoletvs/charts/morris/morris.css'),
            ],
            'scripts' => [
                asset('/vendor/consoletvs/charts/morris/raphael.min.js'),
                asset('/vendor/consoletvs/charts/morris/morris.min.js'),
            ],
        ],

        'plottablejs' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/d3/d3.js'),
                asset('/vendor/consoletvs/charts/plottable/plottable.js'),
            ],
            'styles' => [
                asset('/vendor/consoletvs/charts/plottable/plottable.css'),
            ],
        ],

        'progressbarjs' => [
            'scripts' => [
                asset('/vendor/consoletvs/charts/progressbar/progressbar.min.js'),
            ],
        ],
    ],
];
