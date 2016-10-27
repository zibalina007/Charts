<?php

$graph .= "
    <canvas id='$model->id' ";
    if (!$model->responsive) {
        $graph .= $model->height ? "height='$model->height' " : '';
        $graph .= $model->width ? "width='$model->width' " : '';
    }
$graph .= ' ></canvas>';
