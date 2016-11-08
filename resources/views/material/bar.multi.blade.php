<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']})

    google.charts.setOnLoadCallback(drawChart)

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [
                'Element',
                @for ($i = 0; $i < count($model->datasets); $i++)
                    "{{ $model->datasets[$i]['key'] }}",
                @endfor
            ],

            @for ($l = 0; $l < count($model->labels); $l++)
                [
                    "{{ $l }}",
                    @for ($i = 0; $i < count($model->datasets); $i++)
                        "{{ $model->datasets[$i]['values'][$l] }}",
                    @endfor
                ],
            @endfor
        ])

        var options = {
            chart: {
              @if($model->title)
                title: "{{ $model->title }}",
              @endif
            },
            @if($model->colors) {
                colors: [
                    @foreach($model->colors as $c) {
                        "{{ $c }}",
                    }
                ],
            }
        };

        var chart = new google.charts.Bar(document.getElementById("{{ $model->id }}"))

        chart.draw(data, options)
    }
</script>

@include('charts::_partials.container.div')
