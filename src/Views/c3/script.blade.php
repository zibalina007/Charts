<script {!! $chart->displayScriptAttributes() !!}>
    function {{ $chart->id }}_create(data) {
        {{ $chart->id }}_rendered = true;
        var loader_element = document.getElementById("{{ $chart->id }}_loader");
        loader_element.parentNode.removeChild(loader_element);
        document.getElementById("{{ $chart->id }}").style.display = 'block';
        window.{{ $chart->id }} = c3.generate({
            bindto: '#{{ $chart->id }}',
            data: data,
            {!! $chart->formatOptions(false, true) !!}
        });
    }
    @if ($chart->api_url)
    let {{ $chart->id }}_refresh = function (data) {
        fetch({{ $chart->id }}_api_url)
            .then(data => data.json())
            .then(data => { {{ $chart->id }}.load(data);  });
    };
    @endif
    @include('charts::init')
</script>
