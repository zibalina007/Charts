<?php

$graph = "
    <script type='text/javascript'>
    google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', \"$model->element_label\"],
          ";
          for ($i = 0; $i < count($model->values); $i++) {
              $e = $model->labels[$i];
              $v = $model->values[$i];
              $graph .= "[\"$e\", $v],";
          }
          $graph .= "
        ]);

        var options = {
          chart: {
            title: \"$model->title\",
          },
          ";
          $graph .= $model->colors ? "colors: ['".$model->colors[0]."']" : '';
          $graph .= "
        };

        var chart = new google.charts.Bar(document.getElementById('$model->id'));

        chart.draw(data, options);
      }
    </script>
    <div style='";
    if (!$model->responsive) {
        $graph .= $model->height ? 'height: '.$model->height.'px;' : '';
        $graph .= $model->width ? 'width: '.$model->width.'px;' : '';
    }
    $graph .= "' id='$model->id'></div>
";

return $graph;
