@if(!$model->customId)
    @include('charts::_partials/titledDiv2-container')
@endif

<script type="text/javascript">
    $(function (){
        Morris.Bar({
            element: "{{ $model->id }}",
            resize: true,
            data: [
                @php($k = 0)
                @foreach($model->labels as $l) {
                    {
                        x: "{{ $l }}",
                        @php($i = 0)
                        @foreach($model->datasets as $ds)
                            s{{ $i }}: "{{ $ds['values'][$k] }}",;
                            @php($i++)
                        @endforeach
                    },
                    @php($k++)
                }
            ],
            xkey: 'x',
            labels: [
                @foreach($model->datasets as $el => $ds)
                    "{{ $el }}",
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

