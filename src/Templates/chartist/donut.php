<?php

$graph = '';

if (!$this->customId) {
    include __DIR__.'/../_partials/chartist1-container.php';
}

 $graph .= "
    <script type='text/javascript'>
		var data = {
			labels: ["; foreach ($this->labels as $label) {
     $graph .= '"'.$label.'",';
 } $graph .= '],
			series: ['; foreach ($this->values as $value) {
     $graph .= $value.',';
 } $graph .= "]

		};

        var options = {
            donut: true,
            labelOffset: 50,
			chartPadding: 20,
			labelDirection: 'explode',
            ";
            if (!$this->responsive) {
                $graph .= $this->height ? 'height: "'.$this->height.'px",' : '';
                $graph .= $this->width ? 'width: "'.$this->width.'px",' : '';
            }
            $graph .= "
        };

		new Chartist.Pie('#$this->id', data, options);
    </script>
";

return $graph;
