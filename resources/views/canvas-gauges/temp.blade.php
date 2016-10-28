@extends('charts::default')


@if(!$model->customId)
    @include('charts::_partials.canvas-container')
}


<script type="text/javascript">
$(function (){
    var gauge = new LinearGauge({
      renderTo: "{{ $model->id }}",
      @if($model->colors)
        colorNumbers: "{{ $model->colors[0] }}",
      @endif
      @include('charts::_partials.dimension.js')
      title: "{{ $model->title }}",
      value: "{{ $model->values[0] }}",
      units: "{{ $model->element_label }}",
        @if(count($model->values) >= 2 and $model->values[1] <= $model->values[0])
            $min = $model->values[1];
            minValue: $min,
        @else
            $min = 0;
        @endif

        @if(count($model->values) >= 3 and $model->values[2] >= $model->values[0])
            $max = $model->values[2];
            maxValue: $max,
        @else
            $max = 100;
        @endif

        // Calculate warning area
        $low_warning = round(0.60 * $max, 2)
        $warning = round(0.75 * $max, 2)
        $max_warning = round(0.90 * $max, 2)

        $interval = 10;
        $interval_adder = round($max / $interval, 2)
        majorTicks: [
            $r = $min;
            @for($i = 0; $i <= $interval; $i++)
                @if($i == 0) {
                    $min,
                @elseif($i == $interval)
                    $max,
                @else
                    $r + $interval_adder.',';
                    $r = $r + $interval_adder;
                @endif
            @endforeach
        ],
      highlights: [
            @if($model->gauge_style == 'right')
                // Calculate warning area
                $low_warning = round(0.40 * $max, 2)
                $warning = round(0.25 * $max, 2)
                $max_warning = round(0.10 * $max, 2)

                { from: $low_warning, to: $max, color: 'rgba(0,258,0,.20)' },
                { from: $warning, to: $low_warning, color: 'rgba(255,255,0,.35)' },
                { from: $max_warning, to: $warning, color: 'rgba(255,69,0,.40)' },
                { from: $min, to: $max_warning, color: 'rgba(255,0,0,.5)' },
            @elseif($model->gauge_style == 'center')
                // Calculate warning area
                $warning = round(0.10 * $max, 2)

                $warning2 = round(0.25 * $max, 2)

                $warning3 = round(0.40 * $max, 2)
                $warning4 = round(0.60 * $max, 2)

                $warning5 = round(0.75 * $max, 2)

                $warning6 = round(0.90 * $max, 2)

                { from: $warning3, to: $warning4, color: 'rgba(0,258,0,.20)' },
                { from: $warning2, to: $warning3, color: 'rgba(255,255,0,.35)' },
                { from: $warning4, to: $warning5, color: 'rgba(255,255,0,.35)' },
                { from: $warning, to: $warning2, color: 'rgba(255,69,0,.40)' },
                { from: $warning5, to: $warning6, color: 'rgba(255,69,0,.40)' },
                { from: $min, to: $warning, color: 'rgba(255,0,0,.5)' },
                { from: $warning6, to: $max, color: 'rgba(255,0,0,.5)' },
            @else
                // Calculate warning area
                $low_warning = round(0.60 * $max, 2)
                $warning = round(0.75 * $max, 2)
                $max_warning = round(0.90 * $max, 2)

                { from: $min, to: $low_warning, color: 'rgba(0,258,0,.15)' },
                { from: $low_warning, to: $warning, color: 'rgba(255,255,0,.35)' },
                { from: $warning, to: $max_warning, color: 'rgba(255,69,0,.40)' },
                { from: $max_warning, to: $max, color: 'rgba(255,0,0,.5)' },
            @endif
        ],
    }).draw()
});
</script>
