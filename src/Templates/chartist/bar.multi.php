<?php

$graph = '';

if( !$this->customId )
{
    include __DIR__ . '/../_partials/titledDiv-container.php';
}

 $graph .= "
    <script type='text/javascript'>
		var data = {
			labels: ["; foreach ($this->labels as $label) {
    $graph .= '"'.$label.'",';
} $graph .= '],
			series: ['; foreach ($this->datasets as $ds) {
    $graph .= '[';
    foreach ($ds['values'] as $value) {
        $graph .= $value.',';
    }
    $graph .= '],';
} $graph .= ']
		};

        var options = {
            ';
            if (!$this->responsive) {
                $graph .= $this->height ? 'height: "'.$this->height.'px",' : '';
                $graph .= $this->width ? 'width: "'.$this->width.'px",' : '';
            }
            $graph .= "
        }
		new Chartist.Bar('#$this->id', data, options);
    </script>
";

return $graph;
