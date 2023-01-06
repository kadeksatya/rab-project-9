@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="{{ $data == null ? '/admin/masterdata/worktype' : '/admin/masterdata/worktype/'.$data->id.'/update' }}" method="POST">
                @csrf

                @if ($data == null)
                    @method('POST')
                @else
                    @method('PUT') 
                @endif    
                
                <div class="form-group mb-2">
                    <label for="">Kode</label>
                    <input type="text" class="form-control" required name="code" value="{{$data->code ?? ''}}" placeholder="ex . 001">
                </div>               
                <div class="form-group mb-2">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" required name="name" value="{{$data->name ?? ''}}" placeholder="ex . Borongan">
                </div>
            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/masterdata/worktype'
            ])
        </div>
    </form>
    </div>
</div>
@endsection