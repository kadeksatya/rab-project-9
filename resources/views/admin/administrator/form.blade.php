@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="{{ $data == null ? '/admin/administrator' : '/admin/administrator/'.$data->id.'/update' }}" method="POST">
                @csrf

                @if ($data == null)
                    @method('POST')
                @else
                    @method('PUT') 
                @endif
      
                <div class="form-group mb-2">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" required name="name" value="{{$data->name ?? ''}}" placeholder="ex . Jhon Doe">
                </div>
                <div class="form-group mb-2">
                    <label for="">Email</label>
                    <input type="email" class="form-control" required name="email" value="{{$data->email ?? ''}}" placeholder="ex . jhondoe@mail.com">
                </div>
                <div class="form-group mb-2">
                    <label for="">Username</label>
                    <input type="text" class="form-control" required name="username" value="{{$data->username ?? ''}}" placeholder="ex . jhondoe">
                </div>

                <div class="form-group mb-2">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="ex . xxxx">
                </div>
                @if ($data != null)
                    <small>Leave blank if you no need update</small>
                @endif
                @if ($data != null)
                <div class="form-group mb-2">
                    <label for="">Roles</label>
                    <select name="role_id" id="" class="form-control">
                        <option value="" selected disabled></option>
                        @foreach ($role as $item)
                            <option value="{{$item->id}}" {{$data->role_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <div class="form-group mb-2">
                    <label for="">Roles</label>
                    <select name="role_id" id="" class="form-control">
                        <option value="" selected disabled></option>
                        @foreach ($role as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/administrator'
            ])
        </div>
    </form>
    </div>
</div>
@endsection