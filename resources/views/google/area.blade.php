@extends('charts::default')


<script type="text/javascript">
chart = google.charts.setOnLoadCallback(drawChart)

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Element', "{{ $model->element_label }}"],
        $i = 0;
        @foreach($model->values as $dta) {
            ["{{ $model->labels[$i] }}", "{{ $model->values[$i] }}"],
            $i++;
        @endforeach
    ])

    var options = {
        @include('charts::_partials.dimensions.js'),
        fontSize: 12,
        title: "{{ $model->title }}",
        @if($model->colors)
            colors: ["{{ $model->colors[0] }}"],
        @endif
        legend: { position: 'top', alignment: 'end' }
    };

    var chart = new google.visualization.AreaChart(document.getElementById("{{ $model->id }}"))

    chart.draw(data, options)
}
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
