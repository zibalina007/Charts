<?php

$graph = '';

if (!$model->customId) {
    include __DIR__.'/../_partials/canvas2-container.php';
}

    $graph .= "
    <script>
        var ctx = document.getElementById('$model->id');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["; foreach ($model->labels as $label) {
        $graph .= "'".$label."',";
    } $graph .= '],
                datasets: [{
                    data: ['; foreach ($model->values as $dta) {
        $graph .= $dta.',';
    } $graph .= '],
                    backgroundColor: [';
                    if ($model->colors) {
                        foreach ($model->colors as $color) {
                            $graph .= '"'.$color.'",';
                        }
                    } else {
                        foreach ($model->values as $dta) {
                            $graph .= "'".sprintf('#%06X', mt_rand(0, 0xFFFFFF))."',";
                        }
                    }
                    $graph .= '],
                }]
            },
            options: {
                responsive: '; $graph .= ($model->responsive or !$model->width) ? 'true' : 'false'; $graph .= ",
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
