<script type="text/javascript">
    window.onload = function() {
        window.{{ $chart->id }} = new Chart(document.getElementById("{{ $chart->id }}").getContext("2d"), {
            type: "{{ $chart->formatType() }}",
            data: {
                labels: {!! $chart->formatLabels() !!},
                datasets: {!! $chart->formatDatasets() !!}
            },
            options: {!! $chart->formatOptions(true) !!}
        });
    };
</script>
