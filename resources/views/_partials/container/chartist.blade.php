<div @include('charts::_partials.dimension.html')>
    <center>
        <strong>{{ $model->title }}</strong>
    </center>
</div>

<div id="{{ $model->id }}" style="@include('charts::_partials.dimension.css')" class="ct-chart ct-perfect-fourth"></div>
