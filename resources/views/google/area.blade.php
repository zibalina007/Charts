<?php

$graph = "
    <script type='text/javascript'>

    chart = google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', \"$model->element_label\"],
            ";
              $i = 0;
              foreach ($model->values as $dta) {
                  $e = $model->labels[$i];
                  $v = $dta;
                  $graph .= "[\"$e\", $v],";
                  $i++;
              }
              $graph .= '
        ]);

        var options = {
            ';
            if (!$model->responsive) {
                $graph .= $model->width ? "width: $model->width," : '';
                $graph .= $model->height ? "height: $model->height," : '';
            }
            $graph .= "
            fontSize: 12,
            title: \"$model->title\",
            "; if ($model->colors) {
                $graph .= 'colors: ["'.$model->colors[0].'"],';
            } $graph .= "
            legend: { position: 'top', alignment: 'end' }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('$model->id'));

        chart.draw(data, options);
    }
    </script>
";

if (!$model->customId) {
    @include('charts::_partials.div-container');
}

return $graph;
