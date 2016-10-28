@extends('charts::default')

@if(!$model->customId)
    @include('charts::_partials.canvas2-container')
@endif

<script type="text/javascript">
var ctx = document.getElementById("{{ $model->id }}")
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($model->labels as $label)
                "{{ $label }}",
            @endforeach
        ],
        datasets: [
            $i = 0;
            @foreach($model->datasets as $el => $ds)
                {
                    fill: true,
                    label: "{{ $el }}",
                    lineTension: 0.3,
                    @if($model->colors and count($model->colors) > $i)
                        borderColor: "{{ $model->colors[$i] }}",
                        backgroundColor: "{{ $model->colors[$i] }}",
                    @else
                        $c = sprintf('#%06X', mt_rand(0, 0xFFFFFF))
                        borderColor: "{{ $c }}",
                        backgroundColor: "{{ $c }}",
                    @endif
                    data: [
                        @foreach($ds['values'] as $dta)
                            "{{ $dta }}",
                        @endforeach
                    ],
                },
                $i++;
            }
        ]
    },
    options: {
        responsive: ($model->responsive or !$model->width) ? 'true' : 'false',
        maintainAspectRatio: false,
        title: {
            display: true,
            text: '$model->title',
            fontSize: 20,
        },
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                }
            }]
        }
    }
});
</script>

