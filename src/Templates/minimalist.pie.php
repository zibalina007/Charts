<?php

$graph = "
	<svg "; $graph .= $this->responsive ? "width='100%' height='100%'" : "width='$this->width' height='$this->height'"; $graph .=" id='$this->id'></svg>
	<script>
		$(function() {
			var data = [
				"; for($i = 0; $i < count($this->values); $i++){ $graph .= "{x: \"" . $this->labels[$i] . "\", y: " . $this->values[$i];
					$graph .= $this->colors ? ", color: \"" . $this->colors[$i] . "\" " : ""; $graph .= " },"; }
				$graph .= "
			];

			var xScale = new Plottable.Scales.Category();
			var yScale = new Plottable.Scales.Linear();

			var xAxis = new Plottable.Axes.Category(xScale, 'bottom');
  			var yAxis = new Plottable.Axes.Numeric(yScale, 'left');

			var plot = new Plottable.Plots.Pie()
			  .addDataset(new Plottable.Dataset(data))
			  .sectorValue(function(d) { return d.y; }, yScale)
			  "; $graph .= $this->colors ? ".attr('fill', function(d) { return d.color; })" : ""; $graph .= "
			  .outerRadius(500, yScale)
			  .renderTo('svg#$this->id');

			window.addEventListener('resize', function() {
			  plot.redraw();
			});
		});
	</script>
";

return $graph;
