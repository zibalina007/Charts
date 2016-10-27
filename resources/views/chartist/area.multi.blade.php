<?php

$graph = '';

if (!$model->customId) {
    include __DIR__.'/../_partials/titledDiv-container.php';
}

 $graph .= "
<script type='text/javascript'>
		var data = {
			labels: ["; foreach ($model->labels as $label) {
     $graph .= '"'.$label.'",';
 } $graph .= '],
			series: ['; foreach ($model->datasets as $ds) {
     $graph .= '[';
     foreach ($ds['values'] as $value) {
         $graph .= $value.',';
     }
     $graph .= '],';
 } $graph .= ']
		};

        var options = {
            showArea: true,
            ';
            if (!$model->responsive) {
                $graph .= $model->height ? 'height: "'.$model->height.'px",' : '';
                $graph .= $model->width ? 'width: "'.$model->width.'px",' : '';
            }
            $graph .= "
        }
		new Chartist.Line('#$model->id', data, options);
    </script>
";

return $graph;
