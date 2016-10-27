<?php

$graph = '';

if (!$model->customId) {
    @include('charts::_partials.canvas2-container');
}

    $graph .= "
    <script>
        var ctx = document.getElementById('$model->id');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["; foreach ($model->labels as $label) {
        $graph .= '"'.$label.'",';
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
                    $graph .= '
        	    ]
            },
            options: {
                responsive: '; $graph .= ($model->responsive or !$model->width) ? 'true' : 'false'; $graph .= ",
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: '$model->title',
                    fontSize: 20,
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            }
        });
    </script>
";

return $graph;
