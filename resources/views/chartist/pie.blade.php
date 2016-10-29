@extends('charts::default')

@if(!$model->customId)
    @include('charts::_partials.chartist1-container')
@endif

<script type="text/javascript">
var data = {
    labels: [
        @foreach($model->labels as $label)
            "{{ $label }}",
        @endforeach
    ],
    series: [
        @foreach($model->values as $value) {
            "{{ $value }}",
        @endforeach
    ]
};

var options = {
    chartPadding: 20,
    labelDirection: 'explode',
    @include('charts::_partials.dimension.js')
};

new Chartist.Pie('#{{ $model->id }}', data, options);
</script>

