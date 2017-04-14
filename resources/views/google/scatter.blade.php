<script type="text/javascript">
    chart = google.charts.setOnLoadCallback(drawChart)

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [
                'Element', "{!! $model->element_label !!}"],
                @for ($i = 0; $i < count($model->values); $i++)
                    ["{!! $model->labels[$i] !!}", {{ $model->values[$i] }}],
                @endfor
        ])

        var options = {
            @include('charts::_partials.dimension.js')
            fontSize: 12,
            @if($model->title)
                title: "{!! $model->title !!}",
            @endif
            @if($model->x_axis_title)
            hAxis: {title: "{{ $model->x_axis_title }}"},
            @endif
            @if($model->y_axis_title)
            vAxis: {title: "{{ $model->y_axis_title }}"},
            @endif
            @if($model->colors)
                colors: ["{{ $model->colors[0] }}"],
            @endif
            @if($model->background_color)
            backgroundColor: {{ $model->background_color }},
            @endif
            @if(!$model->legend)
            legend: null
            @else
            legend: { position: 'top', alignment: 'end' }
            @endif
        };

        var chart = new google.visualization.ScatterChart(document.getElementById("{{ $model->id }}"))

        chart.draw(data, options)
    }
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
