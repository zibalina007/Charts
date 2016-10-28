@extends('charts::default')

<script type="text/javascript">
$(function () {
    var chart = new Highcharts.Chart({
        chart: {
            type: 'area',
            renderTo:  "{{ $model->id }}",
            @include('charts::_partials.dimensions.js')
        },
        title: {
            text:  "{{ $model->title }}",
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
            title: {
                text: "{{ $model->element_label }}"
            },
            plotLines: [{
                value: 0,
                height: 0.5,
                width: 1,
                color: '#808080'
            }]
        },
        @if($model->colors) {
            plotOptions: {
                series: {
                    color: "{{ $model->colors[0] }}"
                }
            },
        @endif
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: "{{ $model->element_label }}",
            data: [
                @foreach($model->values as $dta)
                    "{{ $dta }}",
                @endforeach
            ]
        }]
    })
});
</script>

@if(!$model->customId)
    @include('charts::_partials.div-container')
@endif
