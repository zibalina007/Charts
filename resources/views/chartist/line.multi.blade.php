@if(!$model->customId)
    @include('charts::_partials/titledDiv-container')
@endif

<script type="text/javascript">
    var data = {
        labels: [
            @foreach($model->labels as $label)
                "{{ $label }}",
            @endforeach
        ],
        series: [
            @foreach($model->datasets as $ds)
            [
                @foreach($model->datasets[$i]['values'] as $value)
                    "{{ $value }}",
                @endforeach
            ],
            @endforeach
        ]
    };

    var options = { @include('charts::_partials.dimension.js') }

    new Chartist.Line('#{{ $model->id }}', data, options);
</script>

