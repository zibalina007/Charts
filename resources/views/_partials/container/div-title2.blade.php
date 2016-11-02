<div @include('charts::_partials.dimension.css')>
    @if($model->title)
        <center>
            <strong>{{ $model->title }}</strong>
        </center>
    @endif
</div>

<div id="{{ $model->id }}" @include('charts::_partials.dimension.html')></div>
