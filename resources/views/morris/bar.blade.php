@extends('charts::default')

@if(!$model->customId)
    @include('charts::_partials/titledDiv2-container')
@endif

<script type="text/javascript">
$(function () {
    Morris.Bar({
        element: "{{ $model->id }}",
        resize: true,
        data: [
            $i = 0;
            @foreach($model->values as $v)
                {
                    x: "{{ $model->labels[$i] }}",
                    y: "{{ $model->values[$i] }}"
                },
            $i++;
            @endforeach
        ],
        xkey: 'x',
        ykeys: ['y'],
        labels: ["{{ $model->element_label }}"],
        hideHover: 'auto',
        @if($model->colors) {
            $i = 0;
            barColors: function (row, series, type) {
                @foreach($model->colors as $c) {
                    @if($i == 0)
                        'if(row.label == "{{ $model->labels[$i] }}") return "{{ $model->colors[$i] }}"';
                    @else
                        'else if(row.label == "{{ $model->labels[$i] }}") return "{{ $model->colors[$i] }}"';
                    @endif
                    $i++;
                @endforeach
            }
        }
    })
});
</script>

