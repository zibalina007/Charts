@extends('charts::default')


<script type="text/javascript">
$(function () {
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: "{{ $model->id }}",
            @include('charts::_partials.dimensions.js')
        },
        title: {
            text: "{{ $model->title }}",
            x: -20 //center
        },
        xAxis: {
            categories: [
            @foreach($model->labels as $label)
                "{{ $label }}",
            @endforeach
        ]
        },
        yAxis: {
            plotLines: [{
                value: 0,
                height: 0.5,
                width: 1,
                color: '#808080'
            }]
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
            $i = 0;
            @foreach($model->datasets as $el => $ds)
                {
                    name:  "{{ $el }}",
                    @if($model->colors && count($model->colors) > $i)
                        color: "{{ $model->colors[$i] }}",
                    @endif
                    data: [
                        @foreach($ds['values'] as $dta)
                            "{{ $dta }}",
                        @endforeach
                    ]
                },
                $i++;
            @endforeach
        ]
    })
});
</script>

@if(!$model->customId)
    @include('charts::_partials.div-container')
@endif


