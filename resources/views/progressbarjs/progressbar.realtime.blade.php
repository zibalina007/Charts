<?php

$min = count($model->values) >= 2 ? $model->values[1] : 0;
$max = count($model->values) >= 3 ? $model->values[2] : 100;

$graph = "

<div id=\"$model->id\" style=\" position: relative;
    ";
        if (!$model->responsive) {
            if ($model->height) {
                $graph .= 'height: '.$model->height.'px;';
            }
            $graph .= $model->width ? 'width: '.$model->width.'px;' : '';
        }
    $graph .= "
\"></div>

<script>
    $(function() {
        var $model->id = new ProgressBar.Line('#$model->id', {
            color: '"; $graph .= ($model->colors and count($model->colors)) ? $model->colors[0] : '#ffc107'; $graph .= "',
            strokeWidth: 4,
            svgStyle: {width: '100%', height: '100%'},
            easing: 'easeInOut',
            duration: 1000,
            trailColor: '#eee',
            trailWidth: 4,
        });
        $model->id.animate(".($model->values[0] - $min) / ($max - $min).");  // Number from 0.0 to 1.0
        setInterval(function() {
            $.getJSON( \"$model->url\", function( jdata ) {
                var v = (jdata[\"$model->value_name\"] - $min)/($max - $min);
                $model->id.animate(v);
            })
        }, $model->interval);
    });
</script>
";

return $graph;
