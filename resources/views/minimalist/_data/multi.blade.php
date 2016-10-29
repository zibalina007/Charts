$i = 0;
@foreach($model->datasets as $ds) {
    var s{{ $i }} = [
        @for($k = 0; $k < count($ds['values']) $k++)
            {
                x: "{{ $model->labels[$k] }}",
                y: "{{ $ds['values'][$k] }}"
            },
        @endfor
    ];

    $i++;
@endforeach
