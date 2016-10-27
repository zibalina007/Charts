<?php

$graph = '
<svg ';
if ($model->responsive) {
    $graph .= "width='100%' height='100%'";
} else {
    $graph .= $model->height ? "height='$model->height' " : '';
    $graph .= $model->width ? "width='$model->width' " : '';
}
$graph .= " id='$model->id'></svg>
	<script>
		$(function() {
			var data = [
				"; for ($i = 0; $i < count($model->values); $i++) {
    $graph .= '{x: "'.$model->labels[$i].'", y: '.$model->values[$i];
    $graph .= $model->colors ? ', color: "'.$model->colors[$i].'" ' : '';
    $graph .= ' },';
}
                $graph .= "
			];

			var xScale = new Plottable.Scales.Category();
			var yScale = new Plottable.Scales.Linear();

			var xAxis = new Plottable.Axes.Category(xScale, 'bottom');
  			var yAxis = new Plottable.Axes.Numeric(yScale, 'left');

			var plot = new Plottable.Plots.Pie()
			  .addDataset(new Plottable.Dataset(data))
			  .sectorValue(function(d) { return d.y; }, yScale)
			  "; $graph .= $model->colors ? ".attr('fill', function(d) { return d.color; })" : ''; $graph .= "
			  .outerRadius(500, yScale)
			  .renderTo('svg#$model->id');

			window.addEventListener('resize', function() {
			  plot.redraw();
			});
		});
	</script>
";

return $graph;
