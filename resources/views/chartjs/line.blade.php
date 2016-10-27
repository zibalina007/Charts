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
    } $graph .= "],
    	    datasets: [
    	        {
					fill: false,
    	            label: \"$model->element_label\",
    	            lineTension: 0.3,
                    "; if ($model->colors) {
        $graph .= 'borderColor: "'.$model->colors[0].'", backgroundColor: "'.$model->colors[0].'",';
    } $graph .= '
    	            data: ['; foreach ($model->values as $dta) {
        $graph .= $dta.',';
    } $graph .= "],
    	        }
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
