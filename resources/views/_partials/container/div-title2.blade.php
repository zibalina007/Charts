<div @include('charts::_partials.dimension.css')>
    <center>
        <strong>{{ $model->title }}</strong>
    </center>
</div>

<div id="{{ $model->id }}" @include('charts::_partials.dimension.html')></div>
