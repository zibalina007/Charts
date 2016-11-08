@if(!$model->customId)
    @include('charts::_partials/titledDiv2-container')
@endif

<script type="text/javascript">
    $(function (){
        Morris.Bar({
            element: "{{ $model->id }}",
            resize: true,
            data: [
                @for ($l = 0; $l < count($model->labels); $l++)
                    {
                        x: "{{ $l }}",
                        @for ($l = 0; $l < count($model->datasets); $l++)
                            s{{ $i }}: "{{ $model->datasets[$i]['values'][$l] }}",;
                        @endfor
                    },
                @endfor
            ],
            xkey: 'x',
            labels: [
                @for ($i = 0; $i < count($model->datasets); $i++)
                    "{{ $model->datasets[$i]['label'] }}",
                @endfor
            ],
            ykeys: [
                @for($i = 0; $i < count($model->datasets); $i++)
                    "s{{ $i }}",
                @endfor
            ],
            hideHover: 'auto',
            parseTime: false,
            @if($model->colors)
                lineColors: [
                    @foreach($model->colors as $c)
                        "{{ $c }}",
                    @endforeach
                ],
            @endif
        })
    });
</script>

