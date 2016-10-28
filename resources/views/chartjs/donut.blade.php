@extends('charts::default')

@if(!$model->customId)
    @include('charts::_partials.container.canvas2')
@endif

<script type="text/javascript">
var ctx = document.getElementById("{{ $model->id }}")
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
            @foreach($model->labels as $label)
                "{{ $label }}",
            @endforeach
        ],
        datasets: [{
            data: [
                @foreach($model->values as $dta)
                    "{{ $dta }}",
                @endforeach
            ],
            backgroundColor: [
                @if($model->colors)
                    @foreach($model->colors as $color)
                        "{{ $color }}",
                    @endforeach
                @else
                    @foreach($model->values as $dta)
                        "{{ sprintf('#%06X', mt_rand(0, 0xFFFFFF)) }}"
                    @endforeach
                @endif
            ],
        }]
    },
    options: {
        responsive: ($model->responsive or !$model->width) ? 'true' : 'false',
        maintainAspectRatio: false,
        title: {
            display: true,
            text: "{{ $model->title }}",
            fontSize: 20,
        }
    }
});
</script>

