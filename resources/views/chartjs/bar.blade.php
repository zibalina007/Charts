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
    } $graph .= "],
                datasets: [
                    {
                        label: \"$model->element_label\",
                        backgroundColor: [";
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
                        data: ['; foreach ($model->values as $dta) {
                            $graph .= $dta.',';
                        } $graph .= '],
                    }
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
