@extends('charts::default')


<script type="text/javascript">
$(function () {
    var chart = new Highcharts.Chart({
        chart: {
            renderTo:  "{{ $model->id }}",
            @include('charts::_partials.dimension.js')
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'column'
        },
        title: {
            text:  "{{ $model->title }}"
        },
        plotOptions: {
           column: {
               pointPadding: 0.2,
               borderWidth: 0
           }
       },
       xAxis: {
            categories: [
                @foreach($model->labels as $label)
                     "{{ $label }}",
                @endforeach
            ],
            crosshair: true
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
    @include('charts::_partials.container.div')
@endif
