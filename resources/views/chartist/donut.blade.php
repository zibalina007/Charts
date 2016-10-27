<?php

$graph = '';

if (!$model->customId) {
    include __DIR__.'/../_partials/chartist1-container.php';
}

 $graph .= "
    <script type='text/javascript'>
		var data = {
			labels: ["; foreach ($model->labels as $label) {
     $graph .= '"'.$label.'",';
 } $graph .= '],
			series: ['; foreach ($model->values as $value) {
     $graph .= $value.',';
 } $graph .= "]

		};

        var options = {
            donut: true,
            labelOffset: 50,
			chartPadding: 20,
			labelDirection: 'explode',
            ";
            if (!$model->responsive) {
                $graph .= $model->height ? 'height: "'.$model->height.'px",' : '';
                $graph .= $model->width ? 'width: "'.$model->width.'px",' : '';
            }
            $graph .= "
        };

		new Chartist.Pie('#$model->id', data, options);
    </script>
";

return $graph;
