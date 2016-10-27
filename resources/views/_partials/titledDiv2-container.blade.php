<?php
    $graph .= '
	<div '; if (!$model->responsive) {
        $graph .= $model->width ? "style='width: ".$model->width."px'" : '';
    } $graph .= "><center><b style='font-family: Arial, Helvetica, sans-serif;font-size: 18px;'>$model->title</b></center></div>
		<div id='$model->id' "; if (!$model->responsive) {
        $graph .= "style='";
        $graph .= $model->height ? 'height: '.$model->height.'px' : '';
        $graph .= $model->width ? 'width: '.$model->width.'px' : '';
        $graph .= "'";
    } else {
        $graph .= "style='height: 100%; width: 100%;'";
    } $graph .= ' ></div>';
