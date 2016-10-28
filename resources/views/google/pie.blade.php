@extends('charts::default')


<script type="text/javascript">
google.charts.setOnLoadCallback(drawPieChart)
function drawPieChart() {
    var data = google.visualization.arrayToDataTable([
        ['Element', 'Value'],
        $i = 0;
        @foreach($model->values as $dta)
            ["{{ $model->labels[$i] }}", "{{ $model->values[$i] }}"],
            $i++;
        @endfor
    ])

    var options = {
        @include('charts::_partials.dimensions.js'),
        fontSize: 12,
        title: "{{ $model->title }}",
        @if($model->colors)
            colors:[
                @foreach($model->colors as $color)
                    "{{ $color}}",
                @endforeach
            ],
        @endif
    };

    var chart = new google.visualization.PieChart(document.getElementById("{{ $model->id }}"))
    chart.draw(data, options)
}
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
