<?php

$graph = "
    <script type='text/javascript'>
      google.charts.setOnLoadCallback(drawPieChart);
      function drawPieChart() {

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
            legend: { position: 'top', alignment: 'end' },
            fontSize: 12,
            title: \"$model->title\",";
            if ($model->colors) {
                $graph .= 'colors:[';
                foreach ($model->colors as $color) {
                    $graph .= "'$color',";
                }
                $graph .= '],';
            }
        $graph .= "
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('$model->id'));

        chart.draw(data, options);
      }
    </script>
";

if (!$model->customId) {
    @include('charts::_partials.div-container');
}

return $graph;
