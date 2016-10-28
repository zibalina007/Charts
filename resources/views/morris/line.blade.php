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
                    $i = 0;
                    foreach ($model->values as $v) {
                        $l = $model->labels[$i];
                        $graph .= "{x: \"$l\", y: $v},";
                        $i++;
                    }
                $graph .= "
			  ],
			  xkey: 'x',
			  ykeys: ['y'],
			  labels: [\"$model->element_label\"],
			  hideHover: 'auto',
			  parseTime: false,
			  ";
                if ($model->colors) {
                    $graph .= 'lineColors: ["'.$model->colors[0].'"],';
                }
              $graph .= '

			});
		});
    </script>
';

return $graph;
