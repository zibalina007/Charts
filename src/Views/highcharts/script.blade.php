<script {!! $chart->displayScriptAttributes() !!}>
    function {{ $chart->id }}_create(data) {
        {{ $chart->id }}_rendered = true;
        var loader_element = document.getElementById("{{ $chart->id }}_loader");
        loader_element.parentNode.removeChild(loader_element);
        window.{{ $chart->id }} = new Highcharts.Chart("{{ $chart->id }}", {
            series: data,
            {!! $chart->formatOptions(false, true) !!}
        });
    }
    @if ($chart->api_url)
    let {{ $chart->id }}_refresh = function (data) {
        fetch({{ $chart->id }}_api_url)
            .then(data => data.json())
            .then(data => { {{ $chart->id }}.update({series: data}); {{$chart->id}}.redraw(); });
    };
    @endif
    @include('charts::init')
</script>
