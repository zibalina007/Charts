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
			series: [['; foreach ($this->values as $value) {
     $graph .= $value.',';
 } $graph .= ']]

		};

        var options = {
            showArea: true,
            ';
            if (!$this->responsive) {
                $graph .= $this->height ? 'height: "'.$this->height.'px",' : '';
                $graph .= $this->width ? 'width: "'.$this->width.'px",' : '';
            }
            $graph .= "
        };

		new Chartist.Line('#$this->id', data, options);
    </script>
";

return $graph;
