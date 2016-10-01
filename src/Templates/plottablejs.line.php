<?php

$graph = '
	<svg '; $graph .= $this->responsive ? "width='100%' height='100%'" : "width='$this->width' height='$this->height'"; $graph .= " id='$this->id'></svg>
	<script>
		$(function() {
			var data = [
				"; for ($i = 0; $i < count($this->values); $i++) {
    $graph .= '{x: "'.$this->labels[$i].'", y: '.$this->values[$i];
    $graph .= ' },';
}
                $graph .= "
			];

			var xScale = new Plottable.Scales.Category();
			var yScale = new Plottable.Scales.Linear();

			var xAxis = new Plottable.Axes.Category(xScale, 'bottom');
  			var yAxis = new Plottable.Axes.Numeric(yScale, 'left');

			var plot = new Plottable.Plots.Line()
			  .addDataset(new Plottable.Dataset(data))
			  .x(function(d) { return d.x; }, xScale)
			  .y(function(d) { return d.y; }, yScale)
			  "; $graph .= $this->colors ? ".attr('stroke', \"".$this->colors[0].'")' : ''; $graph .= "
			  .animated(true);

			  var title = new Plottable.Components.TitleLabel(\"$this->title\")
  			  .yAlignment('center');;

			  var label = new Plottable.Components.AxisLabel(\"$this->element_label\")
			  .yAlignment('center')
			  .angle(-90);

			 var table = new Plottable.Components.Table([[null, null, title],[label, yAxis, plot],[null, null, xAxis]]);
		 	table.renderTo('svg#$this->id');


			window.addEventListener('resize', function() {
			  table.redraw();
			});
		});
	</script>
";

return $graph;
