@if(!$model->customId)
    @include('charts::_partials.container.canvas2')
@endif

<script type="text/javascript">
    var ctx = document.getElementById("{{ $model->id }}")
    var data = {
        labels: [
            @foreach($model->labels as $label)
                "{{ $label }}",
            @endforeach
        ],
        datasets: [
            @php($i = 0)
            @foreach($model->datasets as $el => $ds)
                {
                    fill: false,
                    label: "{{ $el }}",
                    lineTension: 0.3,
                    @if($model->colors and count($model->colors) > $i) {
                        @php($c = $model->colors[$i])
                    @else
                        @php($c = sprintf('#%06X', mt_rand(0, 0xFFFFFF)))
                    @endif
                    borderColor: "{{ $c }}",
                    backgroundColor: "{{ $c }}",
                    data: [
                        @foreach($ds['values'] as $dta)
                            "{{ $dta }}",
                        @endforeach
                    ],
                },
                @php($i++)
            @endforeach
        ]
    };

    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: {{ $model->responsive || !$model->width ? 'true' : 'false' }},
            maintainAspectRatio: false,
            @if($model->title)
                title: {
                    display: true,
                    text: "{{ $model->title }}",
                    fontSize: 20,
                }
            @endif
        }
    });
</script>

