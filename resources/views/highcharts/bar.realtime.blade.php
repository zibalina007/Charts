<?php

$graph = "
    <script type='text/javascript'>
        $(function () {
            Highcharts.setOptions({global: { useUTC: false } });
            $model->id = new Highcharts.Chart({

                    chart: {
                        renderTo: \"$model->id\",
                        type: 'column',
                        events: {
                            load: requestData
                        },
                "; if (!$model->responsive) {
    $graph .= $model->width ? "width: $model->width," : '';
    $graph .= $model->height ? "height: $model->height," : '';
}
                $graph .= "
                },
                title: {
                    text: \"$model->title\",
                    x: -20 //center
                },
                xAxis: {
                    type: 'datetime',
                },
                yAxis: {
                    title: {
                        text: \"$model->element_label\"
                    },
                    plotLines: [{
                        value: 0,
                        height: 0.5,
                        width: 1,
                        color: '#808080'
                    }]
                },
                "; if ($model->colors) {
                    $graph .= '
                        plotOptions: {
                            series: {
                                color: "'.$model->colors[0].'"
                            }
                        },
                    ';
                }
                $graph .= "
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: '$model->element_label',
                    data: [],
                    pointStart: new Date().getTime(),
                    pointInterval: ($model->interval)
                }]
            });
            function requestData() {
                $.ajax({
                    url: \"$model->url\",
                    success: function(point) {
                        var series = $model->id.series[0],
                            shift = series.data.length >= $model->max_values; // shift if the series is
                                                             // longer than 20

                        // add the point
                        $model->id.series[0].addPoint(point[\"$model->value_name\"], true, shift);
                        $model->id.xAxis.categories

                        // call it again after one second
                        setTimeout(requestData, $model->interval);
                    },
                    cache: false
                });
            }
        });
    </script>
";

if (!$model->customId) {
    include __DIR__.'/../_partials/div-container.php';
}

return $graph;
