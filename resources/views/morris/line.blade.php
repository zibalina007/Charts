@if(!$model->customId)
    @include('charts::_partials/titledDiv2-container')
@endif

<script type="text/javascript">
    $(function (){
        Morris.Line({
            element: "{{ $model->id }}",
            resize: true,
            data: [
                @for($l = 0; $l < count($model->values); $l++)
                    {
                        x: "{{ $model->labels[$i] }}",
                        y: "{{ $model->values[$i] }}"
                    },
                @endforeach
            ],
            xkey: 'x',
            ykeys: ['y'],
            labels: ["{{ $model->element_label }}"],
            hideHover: 'auto',
            parseTime: false,
            @if($model->colors)
                lineColors: ["{{ $model->colors[0] }}"],
            @endif
        })
    });
</script>

