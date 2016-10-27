<?php

$graph = '';

if (!$model->customId) {
    include __DIR__.'/../_partials/titledDiv2-container.php';
}

$graph .= "
    <script type='text/javascript'>
		$(function (){
			Morris.Line({
			  element: '$model->id',
			  resize: true,
			  data: [
				";
                $k = 0;
                    foreach ($model->labels as $l) {
                        $graph .= "{x: \"$l\",";
                        $i = 0;
                        foreach ($model->datasets as $ds) {
                            $graph .= "s$i: ".$ds['values'][$k].', ';
                            $i++;
                        }
                        $graph .= "},\n";
                        $k++;
                    }
                $graph .= "
			  ],
			  xkey: 'x',
			  labels: [";
              foreach ($model->datasets as $el => $ds) {
                  $graph .= "\"$el\", ";
              }
              $graph .= '],
			  ykeys: [';
                  for ($i = 0; $i < count($model->datasets); $i++) {
                      $graph .= "\"s$i\", ";
                  }
                  $graph .= "],
			  hideHover: 'auto',
			  parseTime: false,
			  ";
                if ($model->colors) {
                    $graph .= 'lineColors: [
                        ';
                    foreach ($model->colors as $c) {
                        $graph .= "'$c', ";
                    }
                    $graph .= '
                    ],';
                }
              $graph .= '

			});
		});
    </script>
';

return $graph;
