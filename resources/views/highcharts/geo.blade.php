<?php

// Get the max / min index
$max = 0;
$min = $model->values ? $model->values[0] : 0;
foreach ($model->values as $dta) {
    if ($dta > $max) {
        $max = $dta;
    } elseif ($dta < $min) {
        $min = $dta;
    }
}
$graph = "
    <script type='text/javascript'>
        $(function () {
            var chart = new Highcharts.Map({
                chart: {
                        renderTo: \"$model->id\",
                "; if (!$model->responsive) {
    $graph .= $model->width ? "width: $model->width," : '';
    $graph .= $model->height ? "height: $model->height," : '';
}
                $graph .= "
                },
                title : {
                    text : \"$model->title\"
                },

                mapNavigation: {
                    enabled: true,
                    enableDoubleClickZoomTo: true
                },

                colorAxis: {
                    min: $min,
                    "; if ($model->colors and count($model->colors) >= 2) {
                    $graph .= 'minColor: "'.$model->colors[0].'",';
                } $graph .= "
                    max: $max,
                    "; if ($model->colors and count($model->colors) >= 2) {
                    $graph .= 'maxColor: "'.$model->colors[1].'",';
                } $graph .= '
                },

                series : [{
                    data : [';
                      $i = 0;
                      foreach ($model->values as $dta) {
                          $e = $model->labels[$i];
                          $v = $dta;
                          $graph .= "{'code': \"$e\", 'value': $v},";
                          $i++;
                      }
                      $graph .= "
                    ],
                    mapData: Highcharts.maps['custom/world'],
                    joinBy: ['iso-a2', 'code'],
                    name: \"$model->element_label\",
                    states: {
                        hover: {
                            color: '#BADA55'
                        }
                    },
                }]
            });
        });
    </script>
";

if (!$model->customId) {
    include __DIR__.'/../_partials/div-container.php';
}

return $graph;
