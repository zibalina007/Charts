<?php

$graph = "
    <script type='text/javascript'>
      google.charts.setOnLoadCallback(drawPieChart);
      function drawPieChart() {
        var data = google.visualization.arrayToDataTable([
          ['Element', 'Value'],
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
			pieHole: 0.4,
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
        var chart = new google.visualization.PieChart(document.getElementById('$model->id'));
        chart.draw(data, options);
      }
    </script>
";

if (!$model->customId) {
    include __DIR__.'/../_partials/div-container.php';
}

return $graph;
