<?php

$graph = "
    <script type='text/javascript'>
		FusionCharts.ready(function () {
			var revenueChart = new FusionCharts({
				type: 'mscolumn2d',
				renderAt: '$model->id',
				"; if ($model->responsive) {
    $graph .= "
							width: '100%',
							height: '100%',
						";
} else {
    $graph .= $model->width ? "width: '$model->width'," : "width: '100%',";
    $graph .= $model->height ? "height: '$model->height'," : "height: '100%',";
}
                $graph .= "
				dataFormat: 'json',
				dataSource: {
					'chart': {
						'caption': \"$model->title\",
						'yAxisName': \"$model->element_label\",
						'bgColor': '#ffffff',
						'borderAlpha': '20',
						'canvasBorderAlpha': '0',
						'usePlotGradientColor': '0',
						'plotBorderAlpha': '10',
						'rotatevalues': '1',
						'valueFontColor': '#ffffff',
						'showXAxisLine': '1',
						'xAxisLineColor': '#999999',
						'divlineColor': '#999999',
						'divLineIsDashed': '1',
						'showAlternateHGridColor': '0',
						'subcaptionFontBold': '0',
						'subcaptionFontSize': '14'
					},
                    'categories': [{
                        'category': [
                            ";
                            foreach ($model->labels as $l) {
                                $graph .= "{
                                    'label': \"$l\",
                                },";
                            }
                            $graph .= "
                            ]
                        }],
                    'dataset': [
                        ";
                        $i = 0;
                        foreach ($model->datasets as $el => $ds) {
                            $graph .= "
                                {
                                    'seriesname': \"$el\",
                                    ";
                            $graph .= ($model->colors and count($model->colors) > $i) ? "'color': \"".$model->colors[$i].'",' : '';
                            $graph .= "
                                    'data': [
                                        ";
                            foreach ($ds['values'] as $v) {
                                $graph .= "
                                                {
                                                    'value': '$v'
                                                },
                                            ";
                            }
                            $graph .= '
                                    ]
                                },
                            ';
                            $i++;
                        }
                        $graph .= "
                   ]
				}
			}).render();
		});
    </script>
	<div id='$model->id'></div>
";

return $graph;
