@extends('charts::default')

@if(!$model->customId)
    @include('charts::_partials/titledDiv2-container')
@endif

<script type="text/javascript">
$(function (){
    Morris.Donut({
        element: "{{ $model->id }}",
        resize: true,
        data: [
            $i = 0;
            @foreach($model->values as $v) {
                {
                    label: "{{ $model->labels[$i] }}",
                    value: "{{ $model->values[$i] }}"
                },
                $i++;
            }
        ],
        @if($model->colors) {
            colors: [
                @foreach($model->colors as $c)
                    "{{ $c }}",
                @endforeach
            ]
        @endif
    })
});
</script>

