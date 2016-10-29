@extends('charts::default')

<script type="text/javascript">
google.charts.load('current', {'packages':['bar']})

google.charts.setOnLoadCallback(drawChart)
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['', "{{ $model->element_label }}"],
        @for($i = 0; $i < count($model->values) $i++)
            ["{{ $model->labels[$i] }}", "{{ $model->values[$i] }}"],
        @endfor
    ])

    var options = {
        chart: {
            title: "{{ $model->title }}",
        },
        @if($model->colors)
            colors: ["{{ $model->colors[0] }}"],
        @endif
    };

    var chart = new google.charts.Line(document.getElementById("{{ $model->id }}"))

    chart.draw(data, options)
}
</script>

<div id="{{ $model->id }}" style="@include('charts::_partials.dimension.css')"></div>

