<div @include('charts::_partials.dimensions.css')>
    <center>
        <strong>{{ $model->title }}</strong>
    </center>
</div>

<div id="{{ $model->id }}" @include('charts::_partials.dimensions.html')></div>
