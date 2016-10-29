@extends('charts::default')

@if(!$model->customId)
    @include('charts::_partials/titledDiv2-container')
@endif

<script type="text/javascript">
$(function (){
    Morris.Line({
        element: "{{ $model->id }}",
        resize: true,
        data: [
            $k = 0;
            @foreach($model->labels as $l) {
                {
                    x: "{{ $l }}",
                    $i = 0;
                    @foreach($model->datasets as $ds)
                        s{{ $i }}: "{{ $ds['values'][$k] }}",;
                        $i++;
                    @endforeach
                },
                $k++;
            }
        ],
        xkey: 'x',
        labels: [
            @foreach($model->datasets as $el => $ds) {
                "{{ $el }}",
            }
        ],
        ykeys: [
            @for($i = 0; $i < count($model->datasets) $i++)
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
