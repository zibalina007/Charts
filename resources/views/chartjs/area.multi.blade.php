<?php

$graph = '';

if (!$model->customId) {
    include __DIR__.'/../_partials/canvas2-container.php';
}

    $graph .= "
    <script>
    	var ctx = document.getElementById('$model->id');
    	var data = {
    	    labels: ["; foreach ($model->labels as $label) {
        $graph .= "'".$label."',";
    } $graph .= '],
    	    datasets: [
                ';
                $i = 0;
                foreach ($model->datasets as $el => $ds) {
                    $graph .= "
        	        {
    					fill: true,
        	            label: \"$el\",
        	            lineTension: 0.3,
                        ";
                    if ($model->colors and count($model->colors) > $i) {
                        $graph .= 'borderColor: "'.$model->colors[$i].'", backgroundColor: "'.$model->colors[$i].'",';
                    } else {
                        $c = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                        $graph .= 'borderColor: "'.$c.'", backgroundColor: "'.$c.'",';
                    }
                    $graph .= 'data: [';
                    foreach ($ds['values'] as $dta) {
                        $graph .= $dta.',';
                    }
                    $graph .= '],
        	        },';
                    $i++;
                }
                $graph .= "
    	    ]
    	};

    	var myLineChart = new Chart(ctx, {
    		type: 'line',
    		data: data,
    		options: {
                responsive: "; $graph .= ($model->responsive or !$model->width) ? 'true' : 'false'; $graph .= ",
                maintainAspectRatio: false,
    			title: {
    	            display: true,
                    text: \"$model->title\",
    				fontSize: 20,
    	        }
    	    }
    	});
    </script>
";

return $graph;
