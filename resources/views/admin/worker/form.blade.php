@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="{{ $data == null ? '/admin/masterdata/worker' : '/admin/masterdata/worker/'.$data->id.'/update' }}" method="POST">
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
                    <input type="text" class="form-control" required name="name" value="{{$data->name ?? ''}}" placeholder="ex . Jhon doe">
                </div>
                <div class="form-group mb-2">
                    <label for="">Satuan</label>
                    <input type="text" class="form-control" required name="unit" value="{{$data->unit ?? ''}}" placeholder="ex . buruh lepas">
                </div>
                <div class="form-group mb-2">
                    <label for="">Harga</label>
                    <input type="number" readonly step="any" min="1" class="form-control" required name="price" value="{{$data->price ?? ''}}" placeholder="ex . 100000">
                </div>
            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/masterdata/worker'
            ])
        </div>
    </form>
    </div>
</div>
@endsection