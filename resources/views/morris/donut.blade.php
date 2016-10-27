<?php

$graph = '';

if (!$model->customId) {
    include __DIR__.'/../_partials/titledDiv2-container.php';
}

$graph .= "
    <script type='text/javascript'>
		$(function (){
			Morris.Donut({
			  element: '$model->id',
			  resize: true,
			  data: [
				";
                    $i = 0;
                    foreach ($model->values as $v) {
                        $l = $model->labels[$i];
                        $graph .= "{label: \"$l\", value: $v},";
                        $i++;
                    }
                $graph .= '
			  ],
			  ';
                if ($model->colors) {
                    $graph .= 'colors: [';
                    foreach ($model->colors as $c) {
                        $graph .= "\"$c\",";
                    }
                    $graph .= ']';
                }
              $graph .= '

			});
		});
    </script>
';

return $graph;
