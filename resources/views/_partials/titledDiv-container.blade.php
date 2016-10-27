<?php

$graph .= '
    <div '; if (!$model->responsive) {
    $graph .= $model->width ? "style='width: $model->width'" : '';
} $graph .= "><center><b style='font-family: Arial, Helvetica, sans-serif;font-size: 18px;'>$model->title</b><br></center></div>
    <center><div id='$model->id'></div></center>
    ";
