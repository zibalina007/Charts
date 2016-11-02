<div @include('charts::_partials.dimension.html')>
    @if($model->title)
        <center>
            <strong>{{ $model->title }}</strong>
        </center>
    @endif
</div>

<div id="{{ $model->id }}" style="@include('charts::_partials.dimension.css')" class="ct-chart ct-perfect-fourth"></div>
