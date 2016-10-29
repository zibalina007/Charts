@extends('charts::default')

<script type="text/javascript">
google.charts.setOnLoadCallback(drawRegionsMap)

function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable([
        ['Country', "{{ $model->element_label }}"],
        $i = 0;
        @foreach($model->values as $dta)
            ["{{ $model->labels[$i] }}", "{{ $model->values[$i] }}"],
            $i++;
        @endfor
    ])

    var options = { @include('charts::') }
        colorAxis: {
            colors: [
                @if($model->colors and count($model->colors >= 2))
                    "{{ $model->colors[0] }}", "{{ $model->colors[1] }}"
                @endif
            ]
        },
        datalessRegionColor: "#e0e0e0",
        defaultColor: "#607D8",
    };

    var chart = new google.visualization.GeoChart(document.getElementById("{{ $model->id }}"))

    chart.draw(data, options)
}
</script>

@if(!$model->customId)
    @include('charts::_partials/titledDiv-container')
@endif
