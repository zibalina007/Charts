<script type="text/javascript">
    google.charts.setOnLoadCallback(drawPieChart)

    function drawPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Value'],
            @php($i = 0)
            @foreach($model->values as $dta)
                ["{{ $model->labels[$i] }}", "{{ $model->values[$i] }}"],
                @php($i++)
            @endforeach
        ])

        var options = {
            @include('charts::_partials.dimension.js'),
            fontSize: 12,
            pieHole: 0.4,
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

        var chart = new google.visualization.PieChart(document.getElementById("{{ $model->id }}"))
        chart.draw(data, options)
    }
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
