<?php

$graph = "
    <script type='text/javascript'>

    chart = google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', "; foreach ($model->datasets as $el => $ds) {
    $graph .= "\"$el\",";
} $graph .= '],
            ';
              $i = 0;
              foreach ($model->labels as $l) {
                  $graph .= "[\"$l\",";
                  foreach ($model->datasets as $el => $ds) {
                      $graph .= $ds['values'][$i].',';
                  }
                  $graph .= '],';
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
                $graph .= 'colors: [';
                foreach ($model->colors as $c) {
                    $graph .= "'".$c."',";
                }
                $graph .= '],';
            } $graph .= "
            legend: { position: 'top', alignment: 'end' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('$model->id'));

        chart.draw(data, options);
    }
    </script>
";

if (!$model->customId) {
    @include('charts::_partials.div-container');
}

return $graph;
