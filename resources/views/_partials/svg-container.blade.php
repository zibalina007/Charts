<?php

$graph .= '<svg ';
    if ($model->responsive) {
        $graph .= "width='100%' height='100%'";
    } else {
        $graph .= $model->height ? "height='$model->height' " : '';
        $graph .= $model->width ? "width='$model->width' " : '';
    }
$graph .= " id='$model->id'></svg>";
