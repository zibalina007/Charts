@extends('charts::default')


<script type="text/javascript">
google.charts.setOnLoadCallback(drawPieChart)
function drawPieChart() {
    var data = google.visualization.arrayToDataTable([
        [
            'Element',
            @foreach($model->datasets as $el => $ds)
                "{{ $el }}",
            @endforeach
        ],
        $i = 0;
        @foreach($model->labels as $l)
            [
                "{{ $l }}",
                @foreach($model->datasets as $el => $ds)
                    "{{ $ds['values'][$i] }}",
                @endforeach
            ],
            $i++;
        @endforeach
    ])

    var options = {
        @include('charts::_partials.dimensions.js'),
        legend: { position: 'top', alignment: 'end' },
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

var chart = new google.visualization.ColumnChart(document.getElementById("{{ $model->id }}"))

chart.draw(data, options)
}
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
