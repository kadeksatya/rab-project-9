
@if (Auth::user()->role_id == 1)
<div class="d-flex justify-content-end">
    <div>
        <a href="{{$item->url}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> {{$item->name}}</a>

    </div>
</div>
@endif
