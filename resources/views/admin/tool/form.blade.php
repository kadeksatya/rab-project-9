@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="{{ $data == null ? '/admin/masterdata/tool' : '/admin/masterdata/tool/'.$data->id.'/update' }}" method="POST">
                @csrf

                @if ($data == null)
                    @method('POST')
                @else
                    @method('PUT') 
                @endif

                <div class="form-group mb-2">
                    <label for="">Kode</label>
                    <input type="text" class="form-control" required name="code" value="{{$data->code ?? ''}}" placeholder="ex . 001">
                </div>                <div class="form-group mb-2">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" required name="name" value="{{$data->name ?? ''}}" placeholder="ex . Tang">
                </div>
                <div class="form-group mb-2">
                    <label for="">Kapasitas</label>
                    <input type="text" class="form-control" required name="unit" value="{{$data->unit ?? ''}}" placeholder="ex . pcs">
                </div>
                <div class="form-group mb-2">
                    <label for="">Harga</label>
                    <input type="number" step="any" min="1" class="form-control" required name="price" value="{{$data->price ?? ''}}" placeholder="ex . 100000">
                </div>
            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/masterdata/tool'
            ])
        </div>
    </form>
    </div>
</div>
@endsection