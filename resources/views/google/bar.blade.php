@extends('charts::default')

<script type="text/javascript">
google.charts.setOnLoadCallback(drawPieChart)

function drawPieChart() {
    var data = google.visualization.arrayToDataTable([
        ['Element', "{{ $model->element_label }}",
            @if($model->colors)
                { role: 'style' }
            @endif
        ],
        $i = 0;
        @foreach($model->values as $dta)
            [
                "{{ $model->labels[$i] }}", "{{ $model->values[$i] }}"
                @if($model->colors)
                    "{{ $model->colors[$i] }}",
                @endif
            ],
            $i++;
        @endforeach
    ])

    var options = {
        @include('charts::_partials.dimension.js'),
        legend: { position: 'top', alignment: 'end' },
        fontSize: 12,
        @if($model->title)
            title: "{{ $model->title }}",
        @endif
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
