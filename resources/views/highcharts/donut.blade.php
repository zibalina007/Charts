<?php

$graph = "
    <script type='text/javascript'>
        $(function () {
            var chart = new Highcharts.Chart({
                chart: {
			renderTo: \"$model->id\",
                    "; if (!$model->responsive) {
    $graph .= $model->width ? "width: $model->width," : '';
    $graph .= $model->height ? "height: $model->height," : '';
}
                    $graph .= "
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: \"$model->title\",
                },
                tooltip: {
                    pointFormat: '{point.y} <b>({point.percentage:.1f}%)</b>'
                },
                plotOptions: {
                    pie: {
						innerSize: 225,
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    colorByPoint: true,
                    data: [
                    ";
                    $i = 0;
                    foreach ($model->values as $dta) {
                        $e = $model->labels[$i];
                        $v = $dta;
                        $graph .= "{name: \"$e\", y: $v},";
                        $i++;
                    }
                    $graph .= '
                    ]
                }]
            });
        });
    </script>
';

if (!$model->customId) {
    include __DIR__.'/../_partials/div-container.php';
}

return $graph;
