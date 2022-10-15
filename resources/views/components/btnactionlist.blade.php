@if ($is_detail == true)
    <a href="{{$url_detail}}" class="btn btn-info"><i class="far fa-eye"></i></a>
@endif
<a href="{{$url_edit}}" class="btn btn-dark"><i class="far fa-edit"></i></a>
<a href="javascript:void(0)" data-url="{{$url_delete}}" class="btn btn-danger"><i class="fas fa-exclamation-triangle"></i></a>