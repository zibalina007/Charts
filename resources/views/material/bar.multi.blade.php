@extends('charts::default')


<script type="text/javascript">
google.charts.load('current', {'packages':['bar']})
google.charts.setOnLoadCallback(drawChart)
function drawChart() {
    var data = google.visualization.arrayToDataTable([
        [
            'Element',
            @foreach($model->datasets as $el => $ds)
                "{{ $el }}",
            @endforeach
        ],

        $i = 0;
        @foreach($model->labels as $l) {
            [
                "{{ $l }}",
                @foreach($model->datasets as $el => $ds)
                    "{{ $ds['values'][$i] }}",
                @endforeach
            ],
            $i++;
        }
    ])

    var options = {
        chart: {
            title: "{{ $model->title }}",
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
