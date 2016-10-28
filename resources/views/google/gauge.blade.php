@extends('charts::default')

<script type="text/javascript">
google.charts.setOnLoadCallback(drawGaugeChart)

function drawGaugeChart() {
    var data = google.visualization.arrayToDataTable([
        ['Element', 'Value'],
        ["{{ $model->element_label }}", "{{ $model->values[0] }}"],
    ])

    var options = {
        @include('charts::_partials.dimensions.js'),

        @if(count($model->values) >= 2 and $model->values[1] <= $model->values[0])
            $min = $model->values[1];
            min: $min,
        @else
            $min = 0;
        @endif

        @if(count($model->values) >= 3 and $model->values[2] >= $model->values[0])
            $max = $model->values[2];
            max: $max,
        @else
            $max = 100;
        @endif

        @if($model->gauge_style == 'right')
            // Calculate warning area
            $low_warning = round(0.40 * $max, 2)
            $warning = round(0.25 * $max, 2)
            $max_warning = round(0.10 * $max, 2)

            greenColor: '#c8e6c9', yellowColor: '#ffd54f', redColor: '#e57373',
            greenFrom: $low_warning, greenTo: $max,
            yellowFrom: $max_warning, yellowTo: $low_warning,
            redFrom: $min, redTo: $max_warning,
        @elseif($model->gauge_style == 'center') {
            // Calculate warning area
            $warning = round(0.25 * $max, 2)
            $warning2 = round(0.75 * $max, 2)

            greenColor: '#c8e6c9', yellowColor: '#ffd54f', redColor: '#ffd54f',
            greenFrom: $warning, greenTo: $warning2,
            yellowFrom: $min, yellowTo: $warning,
            redFrom: $warning2, redTo: $max,
        @else
            // Calculate warning area
            $low_warning = round(0.60 * $max, 2)
            $warning = round(0.75 * $max, 2)
            $max_warning = round(0.90 * $max, 2)

            greenColor: '#c8e6c9', yellowColor: '#ffd54f', redColor: '#e57373',
            greenFrom: $min, greenTo: $low_warning,
            yellowFrom: $low_warning, yellowTo: $max_warning,
            redFrom: $max_warning, redTo: $max,
        @endif

        minorTicks: 10,
    };

    var chart = new google.visualization.Gauge(document.getElementById("{{ $model->id }}"))
    chart.draw(data, options)
}
</script>

@if(!$model->customId)
    @include('charts::_partials/titledDiv-container')
@endif
