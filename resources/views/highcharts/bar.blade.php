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
                    type: 'column'
                },
                title: {
                    text: \"$model->title\"
                },
                plotOptions: {
                   column: {
                       pointPadding: 0.2,
                       borderWidth: 0
                   }
               },
               xAxis: {
                    categories: [
                        ";
                        foreach ($model->labels as $label) {
                            $graph .= "\"$label\",";
                        }
                        $graph .= "
                    ],
                    crosshair: true
                },
                series: [{
                    name: \"$model->element_label\",
                    data: [
                    ";
                    foreach ($model->values as $dta) {
                        $graph .= "$dta,";
                    }
                    $graph .= '
                    ]
                }]
            });
        });
    </script>
';

if (!$model->customId) {
    @include('charts::_partials.div-container');
}

return $graph;
