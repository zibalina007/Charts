<?php

$graph = "
    <script type='text/javascript'>
        $(function () {
            var chart = new Highcharts.Chart({
                chart: {
                    type: 'area',
                    renderTo: \"$model->id\",
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
                    categories: ["; foreach ($model->labels as $label) {
                    $graph .= '"'.$label.'",';
                } $graph .= "]
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
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [
                    ";
                    $i = 0;
                    foreach ($model->datasets as $el => $ds) {
                        $graph .= "{
                            name: \"$el\",
                            ";
                        $graph .= ($model->colors && count($model->colors) > $i) ? 'color: "'.$model->colors[$i].'",' : '';
                        $graph .= '
                            data: [';
                        foreach ($ds['values'] as $dta) {
                            $graph .= $dta.',';
                        }
                        $graph .= ']
                            },';
                        $i++;
                    }
                    $graph .= '
                ]
            });
        });
    </script>
';

if (!$model->customId) {
    include __DIR__.'/../_partials/div-container.php';
}

return $graph;
