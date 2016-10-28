<?php

$graph = "
    <script type='text/javascript'>
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
            ['Country', \"$model->element_label\"],
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
          $graph .= '
          colorAxis: {colors: ['; if ($model->colors and count($model->colors >= 2)) {
              $graph .= "'".$model->colors[0]."', '".$model->colors[1]."'";
          } $graph .= "]},
          datalessRegionColor: \"#e0e0e0\",
          defaultColor: \"#607D8\",
        };

        var chart = new google.visualization.GeoChart(document.getElementById('$model->id'));

        chart.draw(data, options);
      }
    </script>
";

if (!$model->customId) {
    include __DIR__.'/../_partials/titledDiv-container.php';
}

return $graph;
