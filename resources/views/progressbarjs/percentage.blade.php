<?php

$min = count($model->values) >= 2 ? $model->values[1] : 0;
$max = count($model->values) >= 3 ? $model->values[2] : 100;

$graph = "
<div id=\"$model->id\" style=\" position: relative;
    ";
        if (!$model->responsive) {
            if ($model->height) {
                $graph .= 'height: '.$model->height.'px;';
                $model->width = $model->height;
            }
            $graph .= $model->width ? 'width: '.$model->width.'px;' : '';
        }
    $graph .= "
\"></div>

<script>
    $(function() {
        var $model->id = new ProgressBar.Circle('#$model->id', {
            color: '"; $graph .= ($model->colors and count($model->colors) >= 2) ? $model->colors[1] : '#000'; $graph .= "',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 1,
            easing: 'easeInOut',
            duration: 1000,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#aaa', width: 4 },
            to: { color: '"; $graph .= $model->colors ? $model->colors[0] : '#333'; $graph .= "', width: 4 },
            // Set default step function for all animate calls
            step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = ".$model->values[0].";
            if (value === 0) {
              circle.setText('');
            } else {
              circle.setText(value);
            }

            }
        });
        $model->id.animate(".($model->values[0] - $min) / ($max - $min).');  // Number from 0.0 to 1.0
    });
</script>
';

return $graph;
