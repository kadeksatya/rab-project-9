




<div class="dropdown show">
    <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Action
    </a>
  
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @if ($is_detail == true)
        <a href="{{$url_detail}}" class="dropdown-item"><i class="far fa-eye"></i> Detail</a>
        @endif
        @if ($is_edit == true && Auth::user()->role_id == 1)
        <a href="{{$url_edit}}" class="dropdown-item"><i class="far fa-edit"></i> Edit</a>
        @endif
        @if ($is_delete == true && Auth::user()->role_id == 1)
        <a href="javascript:void(0)" data-url="{{$url_delete}}" class="dropdown-item delete-item"> Delete</a>
        @endif
    </div>
</div>