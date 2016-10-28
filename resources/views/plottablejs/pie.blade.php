@extends('charts::default')

@include('charts::_partials.svg-container')

<script type="text/javascript">
$(function() {
    @include('charts::plottablejs._data.one')

    var xScale = new Plottable.Scales.Category()
    var yScale = new Plottable.Scales.Linear()

    var xAxis = new Plottable.Axes.Category(xScale, 'bottom')
    var yAxis = new Plottable.Axes.Numeric(yScale, 'left')

    var reverseMap = {};
    data.forEach(function(d) { reverseMap[d.y] = d.x;})

    var plot = new Plottable.Plots.Pie()
        .addDataset(new Plottable.Dataset(data))
        .sectorValue(function(d) { return d.y; }, yScale)
        @if($model->colors)
            .attr('fill', function(d) { return d.color; })
        @endif
        .labelsEnabled(true)
        .labelFormatter(function(n){ return reverseMap[n] ;})
        .outerRadius(500, yScale)
        .animated(true)

    var title = new Plottable.Components.TitleLabel("{{ $model->title }}").yAlignment('center')

    var table = new Plottable.Components.Table([[title],[plot]])
    table.renderTo('svg#{{ $model->id }}')

    window.addEventListener('resize', function() {
        table.redraw()
    })
});
</script>

