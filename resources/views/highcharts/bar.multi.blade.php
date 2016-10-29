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

                @foreach($model->labels as $label) {
                     "{{ $label }}",
                }
            ],
            crosshair: true
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
    @include('charts::_partials.container.div')
@endif
