<?php

$graph = '
<div '; if (!$this->responsive) {
    $graph .= "style='width: $this->width'";
} $graph .= "><center><b style='font-family: Arial, Helvetica, sans-serif;font-size: 18px;'>$this->title</b></center></div>
<div id='$this->id' "; if (!$this->responsive) {
    $graph .= "style='max-height: $this->height; max-width: $this->width'";
} $graph .= " class='ct-chart ct-perfect-fourth'></div>";

?>
