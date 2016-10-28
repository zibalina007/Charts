<?php

$graph = "
    <script type='text/javascript'>
    google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
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
                $graph .= "
          ]);

        var options = {
          chart: {
            title: \"$model->title\",
          },
          ";
          if ($model->colors) {
              $graph .= 'colors: [';
              foreach ($model->colors as $c) {
                  $graph .= "'".$c."',";
              }
              $graph .= '],';
          } $graph .= "
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
