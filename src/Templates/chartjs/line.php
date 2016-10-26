<?php

$graph = '';

if( !$this->customId )
{
    include __DIR__ . '/../_partials/canvas2-container.php';
}

    $graph .= "
    <script>
    	var ctx = document.getElementById('$this->id');
    	var data = {
    	    labels: ["; foreach ($this->labels as $label) {
        $graph .= "'".$label."',";
    } $graph .= "],
    	    datasets: [
    	        {
					fill: false,
    	            label: \"$this->element_label\",
    	            lineTension: 0.3,
                    "; if ($this->colors) {
        $graph .= 'borderColor: "'.$this->colors[0].'", backgroundColor: "'.$this->colors[0].'",';
    } $graph .= '
    	            data: ['; foreach ($this->values as $dta) {
        $graph .= $dta.',';
    } $graph .= "],
    	        }
    	    ]
    	};

    	var myLineChart = new Chart(ctx, {
    		type: 'line',
    		data: data,
    		options: {
                responsive: "; $graph .= ($this->responsive or !$this->width) ? 'true' : 'false'; $graph .= ",
                maintainAspectRatio: false,
    			title: {
    	            display: true,
                    text: \"$this->title\",
    				fontSize: 20,
    	        }
    	    }
    	});
    </script>
";

return $graph;
