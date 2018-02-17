<script type="text/javascript">
    FusionCharts.ready(function(){
        window.{{ $chart->id }} = new FusionCharts({
            type: "{!! $chart->formatType() !!}",
            renderAt: "{{ $chart->id }}",
            dataFormat: 'json',
            {!! $chart->formatContainerOptions('js', true) !!}
            dataSource: {
                categories: [{
                    category: {!! $chart->formatLabels() !!}
                }],
                dataset: {!! $chart->formatDatasets() !!},
                chart: {!! $chart->formatOptions(true) !!}
            }
        }).render();
    });
</script>
