<?php

$graph = '';

if (!$model->customId) {
    include __DIR__.'/../_partials/titledDiv2-container.php';
}

$graph .= "
    <script type='text/javascript'>
		$(function () {
			Morris.Bar({
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
					";
                    if ($model->colors) {
                        $i = 0;
                        $graph .= 'barColors: function (row, series, type) {';
                        foreach ($model->colors as $c) {
                            if ($i == 0) {
                                $graph .= 'if(row.label == "'.$model->labels[$i].'") return "'.$model->colors[$i].'";
								';
                            } else {
                                $graph .= 'else if(row.label == "'.$model->labels[$i].'") return "'.$model->colors[$i].'";
								';
                            }
                            $i++;
                        }
                        $graph .= '}';
                    }

                    $graph .= '


			});
		});
    </script>
';

return $graph;
