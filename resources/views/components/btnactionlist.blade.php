@if ($is_detail == true)
    <a href="{{$url_detail}}" class="btn btn-info"><i class="fa fa-eyes"></i></a>
@endif
<a href="{{$url_edit}}" class="btn btn-dark"><i class="fa fa-edit"></i></a>
<a href="javascript:void(0)" data-url="{{$url_delete}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>