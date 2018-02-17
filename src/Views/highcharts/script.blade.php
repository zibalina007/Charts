<script type="text/javascript">
    let {{ $chart->id }}_load = function() {
        window.{{ $chart->id }} = new Highcharts.Chart("{{ $chart->id }}", {
            series: {!! $chart->formatDatasets() !!},
            {!! $chart->formatOptions(false, true) !!}
        });
    };
    window.onload = {{ $chart->id }}_load;
    document.addEventListener("turbolinks:load", {{ $chart->id }}_load);
</script>
