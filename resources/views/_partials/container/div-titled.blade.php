<div @include('charts::_partials.dimension.css')>
    @if($model->title)
        <center>
            <strong>{{ $model->title }}</strong>
        </center>
    @endif
</div>

<center>
    <div id="{{ $model->id }}"></div>
</center>
