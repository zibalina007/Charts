<script type="text/javascript">
    window.onload = function() {
        window.{{ $chart->id }} = new Highcharts.Chart("{{ $chart->id }}", {
            series: {!! $chart->formatDatasets() !!},
            {!! $chart->formatOptions(false, true) !!}
        });
    };
</script>
