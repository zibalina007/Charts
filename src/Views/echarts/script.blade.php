<script type="text/javascript">
    window.{{ $chart->id }} = echarts.init(document.getElementById("{{ $chart->id }}")).setOption({
        series: {!! $chart->formatDatasets() !!},
        {!! $chart->formatOptions(false, true) !!}
    });
</script>