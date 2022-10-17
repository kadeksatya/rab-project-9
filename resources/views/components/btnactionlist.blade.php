@if ($is_detail == true)
    <a href="{{$url_detail}}" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>
@endif
@if ($is_edit == true)
<a href="{{$url_edit}}" class="btn btn-dark btn-sm"><i class="far fa-edit"></i></a>
@endif
@if ($is_delete == true)
<a href="javascript:void(0)" data-url="{{$url_delete}}" class="btn btn-danger btn-sm delete-item"><i class="fas fa-exclamation-triangle"></i></a>
@endif
