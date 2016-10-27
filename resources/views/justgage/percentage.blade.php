<?php

$graph = "<div id=\"$model->id\" style=\"
    ";
        if (!$model->responsive) {
            $graph .= $model->height ? 'height: '.$model->height.'px;' : '';
            $graph .= $model->width ? 'width: '.$model->width.'px;' : '';
        }
    $graph .= "
\"></div>

<script>
    $(function() {
        var $model->id = new JustGage({
            id: \"$model->id\",
            value: ".$model->values[0].',
            ';

            if (count($model->values) >= 2 and $model->values[1] <= $model->values[0]) {
                $min = $model->values[1];
                $graph .= "min: $min,";
            } else {
                $min = 0;
            }
            if (count($model->values) >= 3 and $model->values[2] >= $model->values[0]) {
                $max = $model->values[2];
                $graph .= "max: $max,";
            } else {
                $max = 100;
            }

            $graph .= "
            donut: true,
            gaugeWidthScale: 0.6,
            counter: true,
            title: \"$model->title\",
            label: \"$model->element_label\",
            hideInnerShadow: true
        });
    });
</script>
";

return $graph;
